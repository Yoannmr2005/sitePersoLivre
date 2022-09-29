<main class="form-signin">
    <div class="container w-50 text-center">
        <br>
        <h1 class="h3 mb-3 fw-normal">S'inscrire</h1>
        <br>
        <form method="POST">
            <div class="form-floating">
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
                <label for="floatingInput">Nom</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="emial" name="email" placeholder="E-mail">
                <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe">
                <label for="floatingPassword">Mot de passe</label>
            </div>
            <div class="checkbox mb-3">
            </div>
            <button class="w-100 btn btn-lg btn-primary" name="inscription" value="inscription" type="submit">S'inscrire</button>
        </form>
        <br>
        <a href="index.php?uc=connect" class="link-primary">Retour à la connexion</a>
    </div>
</main>