<!--
  Auteur : Yoann Meier
  Site de livre
  Version : 3.0
  Page : Page de vue pour modifier un livre
-->
<main class="form-signin">
    <div class="container w-50">
        <br>
        <h1 class="h3 mb-3 fw-normal text-center">Modifier un livre</h1>
        <br>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-floating">
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $modifierLivre->getNom() ?>" placeholder="Nom">
                <label for="floatingInput">Nom</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="auteur" name="auteur" value="<?= $modifierLivre->getAuteur() ?>" placeholder="Auteur">
                <label for="floatingInput">Auteur</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="lien" name="lien" value="<?= $modifierLivre->getLien() ?>" placeholder="Lien de l'audiobook (https:// obligatoire)">
                <label for="floatingInput">Lien de l'audiobook (https:// obligatoire)</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" style="height: 200px;" name="description" id="description" cols="30" rows="10" placeholder="Description"><?= $modifierLivre->getDescription() ?></textarea>
                <label for="floatingInput">Description</label>
            </div>
            <div class="form-floating">
                <input type="number" class="form-control" id="annee" name="annee" value="<?= $modifierLivre->getAnnee() ?>" placeholder="Annee">
                <label for="floatingInput">Annee</label>
            </div>
            <div class="form-floating">
                <?= Genre::CreateSelectFromGenre($modifierLivre->getIdgenre()) ?>
                <label for="floatingInput">Genre</label>
            </div>
            <label for="floatingInput">Image (150x200 pixel) (non-obligatoire)</label>
            <input type="file" class="form-control" name="image">

            <label for="floatingInput">Livre en format Pdf (non-obligatoire)</label>
            <input type="file" class="form-control" name="pdf">

            <div class="form-floating">
                <input type="number" class="form-control" id="vente" name="vente" value="<?= $modifierLivre->getVente() ?>" placeholder="Vente">
                <label for="floatingInput">Vente</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" name="modifier" value="modifier" type="submit">Modifier</button>
        </form>
        <br>
        <a href="index.php?uc=admin&action=listLivres" class="link-primary">Retour ?? la gestion</a>
    </div>
</main>