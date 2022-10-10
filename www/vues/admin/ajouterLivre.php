<!--
  Auteur : Yoann Meier
  Site de livre
  Version : 3.0
  Page : Page de vue pour ajouter un livre
-->
<main class="form-signin">
    <div class="container w-50">
        <br>
        <h1 class="h3 mb-3 fw-normal text-center">Ajouter un livre</h1>
        <br>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-floating">
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $nom ?>" placeholder="Nom">
                <label for="floatingInput">Nom</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="auteur" name="auteur" value="<?= $auteur ?>" placeholder="Auteur">
                <label for="floatingInput">Auteur</label>
            </div>
            <div class="form-floating">
                <?= Genre::CreateSelectFromGenre() ?>
                <label for="floatingInput">Genre</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" style="height: 200px;" name="description" id="description" cols="30" rows="10" placeholder="Description"><?= $description ?></textarea>
                <label for="floatingInput">Description</label>
            </div>
            <div class="form-floating">
                <input type="number" class="form-control" id="annee" name="annee" value="<?= $annee ?>" placeholder="Annee">
                <label for="floatingInput">Annee</label>
            </div>

            <label for="floatingInput">Image (150x200 pixel)</label>
            <input type="file" class="form-control" name="image">

            <div class="form-floating">
                <input type="number" class="form-control" id="vente" name="vente" value="<?= $vente ?>" placeholder="Vente">
                <label for="floatingInput">Vente</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" name="ajouter" value="ajouter" type="submit">Ajouter</button>
        </form>
        <br>
        <a href="index.php?uc=admin&action=listLivres" class="link-primary">Retour à la gestion</a>
    </div>
</main>