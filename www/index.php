<?php 
/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : Controlleur principal
 */
?>
<?php 
session_start();
include("session.php");
include("vues/header.php"); 
include("modeles/Livre.php");
include("modeles/Genre.php");
include("modeles/Liste.php");
include("modeles/User.php");
include("modeles/monPdo.php");

// Récupère les paramètres GET
$getUc = filter_input(INPUT_GET,"uc",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// Si l'url est vide, on met accueil
$uc = empty($getUc) ? "accueil" : $getUc;

switch ($uc) {
    case 'accueil':
        require_once('controllers/livreControlleur.php');
        break;
    case 'connect':
        require_once('controllers/connectionControlleur.php');
        break;
    case 'liste':
        require_once('controllers/livreControlleur.php');
        break;
    case 'compte':
        require_once('controllers/compteControlleur.php');
        break;
    case 'listePerso':
        require_once('controllers/listeControlleur.php');
        break;
    case 'admin':
        require_once('controllers/admin/gestionAdmin.php');
        break;
}

include("vues/footer.php"); 
?>