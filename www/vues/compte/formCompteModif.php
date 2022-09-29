<main class="form-signin">
    <div class="container w-50 text-center">
        <br>
        <h1 class="h3 mb-3 fw-normal">Modifier mon compte</h1>
        <br>
        <form method="POST">
            <div class="form-floating">
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $infoCompteModification->getNom() ?>" placeholder="Nom">
                <label for="floatingInput">Nom</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" value="<?= $infoCompteModification->getEmail() ?>" name="email" placeholder="E-mail">
                <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="ancienmdp" name="ancienmdp" placeholder="Ancien mot de passe (obligatoire)">
                <label for="floatingPassword">Ancien mot de passe (obligatoire)</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="nouveaumdp" name="nouveaumdp" placeholder="Nouveau mot de passe (non obligatoire)">
                <label for="floatingPassword">Nouveau mot de passe (non obligatoire)</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" name="modifier" value="modifier" type="submit">Modifier mes informations</button>
        </form>
        <br>
        <a href="index.php?uc=compte" class="link-primary">Retour à la gestion du compte</a>
    </div>
</main>