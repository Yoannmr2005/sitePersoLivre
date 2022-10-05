<main class="form-signin">
    <div class="container w-50">
        <br>
        <h1 class="h3 mb-3 fw-normal text-center">Modifier un genre</h1>
        <br>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-floating">
                <input type="number" class="form-control" id="idgenre" name="idgenre" value="<?= $modifierGenre->getIdgenre() ?>" disabled placeholder="Id du genre">
                <label for="floatingInput">Id du genre</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="genre" name="genre" value="<?= $modifierGenre->genre ?>" placeholder="Genre">
                <label for="floatingInput">Genre</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" name="modifier" value="modifier" type="submit">Modifier</button>
        </form>
        <br>
        <a href="index.php?uc=admin&action=listGenres" class="link-primary">Retour à la gestion</a>
    </div>
</main>