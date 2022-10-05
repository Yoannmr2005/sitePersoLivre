<!--
  Auteur : Yoann Meier
  Site de livre
  Version : 3.0
  Page : Page de vue qui affiche la liste personnelle
-->
<div class="container text-center">
    <h1>Liste des livres</h1>
    <div class="row">
        <?php
        $nb = 0;
        $limit = 5;
        if ($liste == []) {
        ?>
            <p class='text-danger h2'>Il n'y a aucun livre</p>
        <?php
        }
        foreach ($liste as $livre) {
        ?>
            <div class="p-3 col border">
                <img src="img/<?= $livre->getImage() ?>" alt="image du livre">
                <br>
                <p><?= $livre->getNom() ?></p>
                <a href="index.php?uc=liste&action=livre&id=<?= $livre->getIdlivre() ?>" class="link-info text-decoration-none">Plus d'informations</a>
                <?php
                if ($uc == "listePerso") {
                ?>
                    <br><a href="index.php?uc=listePerso&action=supprimer&id=<?= $livre->getIdlivre() ?>" class="link-danger text-decoration-none">Supprimer de la liste</a>
                <?php
                }
                ?>
            </div>
            <?php
            $nb++;
            if ($nb == $limit) {
            ?>
    </div>
    <div class="row">
<?php
                $limit += 5;
            }
        }
?>
    </div>
</div>