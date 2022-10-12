<?php
/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : Controlleur principal
 */

// Inclus la session
include("session.php");
// Inclus les modèles
include("modeles/Livre.php");
include("modeles/Genre.php");
include("modeles/Liste.php");
include("modeles/User.php");
include("modeles/monPdo.php");
// Inclus le header
include("vues/header.php");

// Récupère les paramètres GET
$getUc = filter_input(INPUT_GET, "uc", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// Si l'url est vide, on met accueil
$uc = empty($getUc) ? "accueil" : $getUc;

switch ($uc) {
    // Inclus le controlleur de livre
    case 'accueil':
        require_once('controllers/livreControlleur.php');
        break;
    // Inclus le controlleur de connection
    case 'connect':
        require_once('controllers/connectionControlleur.php');
        break;
    // Inclus le controlleur de livre
    case 'liste':
        require_once('controllers/livreControlleur.php');
        break;
    // Inclus le controlleur de gestion du compte
    case 'compte':
        require_once('controllers/compteControlleur.php');
        break;
    // Inclus le controlleur de gestion de la liste personnelle
    case 'listePerso':
        require_once('controllers/listeControlleur.php');
        break;
    // Inclus le controlleur de la gestion administrateur
    case 'admin':
        require_once('controllers/gestionAdmin.php');
        break;
    // Redirige si l'URL est inconnue
    default:
        // Redirige à l'accueil si l'uc est incorrecte
        User::GoToIndex();
        break;
}
// Inclus le footer
include("vues/footer.php");
?>