<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : controlleur des pages non connecté (accueil, liste des livres et page détails d'un livre)
 */
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    // Controlleur de l'accueil
    case '':
        // Récupère les 5 livres les plus vendues
        $index = new Livre();
        $index = Livre::find5mostView();
        include("vues/accueil.php");
        break;
    // Controlleur pour afficher la liste des livres
    case 'liste':
        // Récupère tous les livres de la DB
        $liste = new Livre();
        $liste = Livre::findAll();
        include("vues/afficherliste.php");
        break;
    // Controlleur pour voir les détails du livre
    case 'livre':
        // Récupère l'id dans l'URL
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        // Récupère les données du livre avec son id
        $livre = new Livre();
        $livre = Livre::findById($id);
        // Renvoie à la gestion si l'id de l'url n'existe pas dans la DB
        if ($livre == false) {
            header("location: index.php?uc=liste&action=liste");
            exit;
        }
        // Récupère le nom du genre avec son id
        $genreLivre = new Genre();
        $genreLivre = Genre::findById($livre->getIdgenre());
        include("vues/infoLivre.php");
        break;
    // Controlleur pour rediriger si l'URL est inconnue
    default:
        // Redirige à l'accueil si l'action est incorrecte
        User::GoToIndex();
        break;
}
