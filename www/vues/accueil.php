<!--
  Auteur : Yoann Meier
  Site de livre
  Version : 3.0
  Page : Page de vue d'accueil du site'
-->
<style>
    div>p {
        color: red;
    }
</style>
<div class="container text-center">
    <h1>Site de livre</h1>
    <br>
    <div class="row">
        <h4>Livre les plus vendues au monde</h4>
        <?php
        foreach ($index as $livre) {
        ?>
            <div class="col border p-2">
                <img src="img/<?= $livre->getImage() ?>" alt="">
                <br>
                <?= $livre->getNom() ?>
                <?= Livre::ChangeNumberFormat($livre->getVente()) ?>

            </div>
        <?php
        }
        ?>

    </div>

</div>