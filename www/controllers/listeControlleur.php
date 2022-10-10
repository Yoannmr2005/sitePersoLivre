<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : controlleur de la liste perso (affichage, ajouter, supprimer)
 */
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    case 'listePerso':
        // Renvoie à l'index si ce n'est pas un compte utilisateur
        if (User::isAdminConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        $liste = Livre::findAllLivreInListe($_SESSION["idutilisateur"]);
        include("vues/afficherliste.php");
        break;
    case 'ajouter':
        // Renvoie à l'index si ce n'est pas un compte utilisateur
        if (User::isAdminConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        $ajouter = new Liste();
        // Filtre le GET
        $idlivre = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        // Regarde si l'utilisateur a déjà ce livre dans ca liste
        $liste = Liste::FindOneBookInListe($_SESSION["idutilisateur"], $idlivre);
        if ($liste == false) {
            // Ajoute le livre
            $ajouter->setIdlivre($idlivre);
            $ajouter->setIdutilisateur($_SESSION["idutilisateur"]);
            Liste::add($ajouter);
            header("location: index.php?uc=listePerso&action=listePerso");
            exit;
        } else {
            // Redirige vers la detail du livre et affiche un message
            $_SESSION["msgLivreDejaDansListe"] = "<br><p class='text-danger h5'>Le livre est déjà dans votre liste</p>";
            header("location: index.php?uc=liste&action=livre&id=${idlivre}");
            exit;
        }
        break;
    case 'supprimer':
        // Renvoie à l'index si ce n'est pas un compte utilisateur
        if (User::isAdminConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // Filtre le GET
        $idlivre = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $delete = new Liste();
        $delete->setIdlivre($idlivre);
        $delete->setIdutilisateur($_SESSION["idutilisateur"]);
        Liste::delete($delete);
        header("location: index.php?uc=listePerso&action=listePerso");
        exit;
    default:
        // Redirige à l'accueil si l'action est incorrecte
        User::GoToIndex();
        break;
}
