<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : Affiche le header
 */
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

<body class="d-flex flex-column h-100">

    <header class="p-3 bg-dark text-white">
        <div class="text-center">
            <p class="h1 text-white">YoBook</p>
        </div>
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.php" class="nav-link px-2 text-white">Accueil</a></li>
                    <li><a href="index.php?uc=liste&action=liste" class="nav-link px-2 text-white">Liste de livre</a></li>
                    <?php
                    // Affiche un lien si on est connecté 
                    if (isset($_SESSION["compte"])) {
                        if (User::isAdminConnected()) {
                    ?>
                            <li><a href="index.php?uc=admin" class="nav-link px-2 text-white">Admin</a></li>
                        <?php
                        } elseif (User::isUserConnected()) {
                        ?>
                            <li><a href="index.php?uc=listePerso&action=listePerso" class="nav-link px-2 text-white">Ma liste</a></li>
                        <?php
                        } else {
                            echo "";
                        }
                        ?>
                        <?php
                        if (isset($_SESSION["idutilisateur"])) {
                        ?>
                            <li><a href="index.php?uc=compte" class="nav-link px-2 text-white">Gérer mon compte</a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>

                <div class="text-end">
                    <?php
                    if (User::isNotConnected()) {
                    ?>
                        <a href="index.php?uc=connect" class="btn btn-warning text-decoration-none text-dark" role="button">Se connecter</a>
                    <?php
                    } else {
                    ?>
                        <a href="index.php?uc=connect&action=disconnect" class="btn btn-warning text-decoration-none text-dark" role="button">Se deconnecter</a>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </header>