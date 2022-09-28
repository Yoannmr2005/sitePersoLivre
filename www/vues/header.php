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
            <p class="h1">YoBook</p>
        </div>
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.php" class="nav-link px-2 text-white">Accueil</a></li>
                    <li><a href="index.php?uc=liste&action=liste" class="nav-link px-2 text-white">Liste de livre</a></li>
                    <?php
                    // Affiche un lien si on est connecté 
                    if (isset($_SESSION["compte"])) {
                        if ($_SESSION["compte"]["admin"] == 1) {
                    ?>
                            <li><a href="index.php?uc=admin" class="nav-link px-2 text-white">Admin</a></li>
                        <?php
                        } elseif ($_SESSION["compte"]["utilisateur"] == 1) {
                        ?>
                            <li><a href="index.php?uc=listePerso&action=listePerso" class="nav-link px-2 text-white">Ma liste</a></li>
                        <?php
                        } else {
                            echo "";
                        }
                        ?>
                        <!-- <a href='gestionCompte.php?id=<?= $idUtilisateur["idutilisateur"] ?>'>Gérer mon compte</a>"; -->
                    <?php
                    }
                    ?>
                </ul>

                <div class="text-end">
                    <?php
                    if ($_SESSION["compte"]["admin"] == 0 && $_SESSION["compte"]["utilisateur"] == 0) {
                    ?>
                        <button type="button" class="btn btn-warning"><a href="index.php?uc=connect" class="text-decoration-none text-dark">Se connecter</a></button>

                    <?php
                    } else {
                    ?>
                        <button type="button" class="btn btn-warning"><a href="index.php?uc=disconnect" class="text-decoration-none text-dark">Se deconnecter</a></button>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </header>