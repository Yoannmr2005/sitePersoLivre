<!--
  Auteur : Yoann Meier
  Site de livre
  Version : 3.0
  Page : Page de vue des détails du livre
-->
<div class="container">
    <h1><?= $livre->getNom() ?></h1>
    <div class="row">
        <div class="p-3 col">
            <img src="img/<?= $livre->getImage() ?>" alt="image du livre" style="width: 250px; height: 350px;">
            <br>
            <br>
            <?php
            if (User::isUserConnected()) {
            ?>
                <a href="index.php?uc=listePerso&action=ajouter&id=<?= $livre->getIdlivre() ?>" class="btn btn-success link-dark text-decoration-none" role="button" style="width: 270px;">Ajouter dans la liste personnelle</a>
                <br>
                <?php
                // Affiche une erreur si le livre est déjà dans la liste perso
                if (isset($_SESSION["msgLivreDejaDansListe"]) && $_SESSION["msgLivreDejaDansListe"] != "") {
                    echo $_SESSION['msgLivreDejaDansListe'];
                    $_SESSION['msgLivreDejaDansListe'] = "";
                }
                ?>
            <?php
            } 
            if (User::isUserConnected() ||User::isAdminConnected()) {
                ?>
                <br>
                <a href="pdf/<?= $livre->getPdf() ?>" download class="btn btn-warning link-dark text-decoration-none" role="button" style="width: 270px;">Télecharger le pdf du livre</a>
                <?php
            }
            if (User::isNotConnected()) {
            ?>
                <a href="index.php?uc=liste&action=pdf&id=<?= $livre->getIdlivre() ?>" class="btn btn-warning link-dark text-decoration-none" role="button" style="width: 270px;">Télecharger le pdf du livre</a>
            <?php
            }
            // Affiche l'erreur de téléchargement de pdf si non-connecté
            if (isset($_SESSION["msgErreurTelechargementPdf"]) && $_SESSION["msgErreurTelechargementPdf"] != "") {
                echo $_SESSION['msgErreurTelechargementPdf'];
                $_SESSION['msgErreurTelechargementPdf'] = "";
            }
            ?>
        </div>
        <div class="p-3 col">
            <h3 class="text-secondary">Auteur :</h3>
            <?= $livre->getAuteur() ?>
            <h3 class="text-secondary">Description :</h3>
            <?= $livre->getDescription() ?>
            <h3 class="text-secondary">Année de sortie :</h3>
            <?= $livre->getAnnee() ?>
            <h3 class="text-secondary">Quantité de livres vendus :</h3>
            <?= Livre::ChangeNumberFormat($livre->getVente()) ?>
            <h3 class="text-secondary">Genre :</h3>
            <?= $genreLivre->genre ?>
        </div>
        <?php
        // Affiche un message si il n'y a pas de lien
        if ($livre->getLien() == "") {
        ?>
            <p class='text-danger h4 text-center'>Il n'y a aucun audiobook pour ce livre</p>
        <?php
        } else {
        ?>
            <iframe height="300" src="<?= $livre->getLien() ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <?php
        }
        ?>
    </div>
</div>