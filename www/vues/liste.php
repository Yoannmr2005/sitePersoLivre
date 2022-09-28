<div class="container text-center">
    <h1>Liste des livres</h1>
    <div class="row">
        <?php
        $nb = 0;
        $limit = 5;
        foreach ($liste as $livre) {
        ?>
            <div class="p-3 col border">
                <img src="img/<?= $livre->getImage() ?>" alt="">
                <br>
                <p><?= $livre->getNom() ?></p>
                <a href="controllers/livreControlleur.php?uc=liste&action=livre" class="link-info text-decoration-none">Plus d'informations</a>
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