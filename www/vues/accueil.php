<div class="container text-center">
    <h1>Site de livre</h1>
    <br>
    <div class="row">
    <h4>Livre les plus lues au monde</h4>
        <?php
        foreach ($index as $livre) {
        ?>
            <div class="col border p-2">
                <img src="img/<?= $livre->getImage()?>" alt="">
                <br>
                <?= $livre->getNom() ?>
            </div>
        <?php
        }
        ?>

    </div>

</div>