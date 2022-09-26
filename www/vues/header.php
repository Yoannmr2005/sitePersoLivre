<?php

/**
 * Auteur : Yoann Meier
 * Projet : Site internet de livre
 * Detail : Page qui affiche le header
 */

// Créer la session pour le compte si elle n'existe pas
if (!isset($_SESSION["compte"])) {
    $_SESSION["compte"] = array();
    $_SESSION["compte"]["utilisateur"] = 0;
    $_SESSION["compte"]["admin"] = 0;
}

// Recupère l'id de l'utilisateur connecté
if (isset($_SESSION["nomConnecte"])) {
    //$idUtilisateur = PDO_Select("SELECT idutilisateur FROM utilisateur WHERE nom = ?", [$_SESSION["nomConnecte"]]);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>YoBook</title>
</head>

<body>

    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-white">Accueil</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Liste de livre</a></li>
                </ul>

                <div class="text-end">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </div>
            </div>
        </div>
    </header>

    <!-- <header>
        <div class="connexion">
            <?php
            // if ($_SESSION["compte"]["admin"] == 0 && $_SESSION["compte"]["utilisateur"] == 0) {
            ?>
                <a href="connexion.php">Se connecter</a>

            <?php
            // } else {
            ?>
                <a href="deconnexion.php">Se deconnecter</a>
            <?php
            // }

            ?>
        </div>
        <p>Site de livre</p>
        <div class="lienHeader">
            <a href="index.php">Accueil</a>
            <?php
            // Affiche un lien si on est connecté 
            // if (isset($_SESSION["compte"])) {
            // if ($_SESSION["compte"]["admin"] == 1) {
            ?>
                    <a href='admin.php'>Admin</a>";
                <?php
                // } elseif ($_SESSION["compte"]["utilisateur"] == 1) {
                ?>
                    <a href='maListe.php'>Ma liste</a>";
                <?php
                // } else {
                // echo "";
                // }
                ?>
                <a href='gestionCompte.php?id=<?= $idUtilisateur["idutilisateur"] ?>'>Gérer mon compte</a>";
            <?php
            // }
            ?>
            <a href="listeLivre.php">Liste des Livres</a>
        </div>
    </header> -->