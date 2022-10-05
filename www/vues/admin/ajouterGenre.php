<!--
  Auteur : Yoann Meier
  Site de livre
  Version : 3.0
  Page : Page de vue pour ajouter un genre
-->
<main class="form-signin">
  <div class="container w-50 text-center">
    <br>
    <h1 class="h3 mb-3 fw-normal">Ajouter un genre</h1>
    <br>
    <form method="POST">
      <div class="form-floating">
        <input type="text" class="form-control" id="nomgenre" name="nomgenre" value="<?= $nom ?>" placeholder="Nom du genre">
        <label for="floatingInput">Nom du genre</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" name="ajouterGenre" value="ajouterGenre" type="submit">Ajouter un genre</button>
    </form>
    <br>
    <a href="index.php?uc=admin&action=listGenres" class="link-primary">Retour à la gestion</a>
  </div>
</main>