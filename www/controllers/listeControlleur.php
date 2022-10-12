<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : controlleur de la liste perso (affichage, ajouter, supprimer)
 */
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    // Controlleur pour afficher la liste perso
    case 'listePerso':
        // Renvoie à l'index si ce n'est pas un compte utilisateur
        if (User::isAdminConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // Récupère les livres de la liste personnelle de l'utilisateur connecté
        $liste = Livre::findAllLivreInListe($_SESSION["idutilisateur"]);
        include("vues/afficherliste.php");
        break;
    // Controlleur pour ajouter un livre dans la liste perso
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
    // Controlleur pour enlever un livre de la liste perso
    case 'supprimer':
        // Renvoie à l'index si ce n'est pas un compte utilisateur
        if (User::isAdminConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // Filtre le GET
        $idlivre = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        // Supprime le livre de la liste
        $delete = new Liste();
        $delete->setIdlivre($idlivre);
        $delete->setIdutilisateur($_SESSION["idutilisateur"]);
        Liste::delete($delete);
        header("location: index.php?uc=listePerso&action=listePerso");
        exit;
    // Redirige si l'URL est inconnue
    default:
        // Redirige à l'accueil si l'action est incorrecte
        User::GoToIndex();
        break;
}
