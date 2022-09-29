<div class="container">
    <h1><?= $livre->getNom() ?></h1>
    <div class="row">
        <div class="p-3 col">
            <img src="img/<?= $livre->getImage() ?>" alt="image du livre" style="width: 250px; height: 350px;">
            <br>
            <br>
            <?php
            if ($_SESSION["compte"]["utilisateur"] == 1) {
            ?>
                <button type="button" class="btn btn-success">
                    <a href="index.php?uc=listePerso&action=ajouter&id=<?= $livre->getIdlivre() ?>" class="link-dark text-decoration-none">Ajouter dans la liste personnelle</a>
                </button>
            <?php
            }
            ?>
        </div>
        <div class="p-3 col">
            <h3 class="text-secondary">Auteur :</h3>
            <?= $livre->getAuteur() ?>
            <h3 class="text-secondary">Description :</h3>
            <?= $livre->getDescription() ?>
            <h3 class="text-secondary">Année de sortie</h3>
            <?= $livre->getAnnee() ?>
            <h3 class="text-secondary">Nombre de livres vendues :</h3>
            <?= Livre::ChangeNumberFormat($livre->getVente()) ?>
            <h3 class="text-secondary">Genre :</h3>
            <?= $genreLivre->genre ?>
        </div>
    </div>
</div>