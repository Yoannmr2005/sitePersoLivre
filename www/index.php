<?php 
/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : Controlleur principal
 */
?>
<?php session_start(); ?>
<?php include("session.php"); ?>
<?php 
include("vues/header.php"); 
include("modeles/Livre.php");
include("modeles/monPdo.php");
?>

<?php
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
    case 'disconnect':
        require_once('controllers/deconnectionControlleur.php');
        break;
    case 'liste':
        require_once('controllers/livreControlleur.php');
        break;
    case 'admin':
        require_once('vues/admin.php');
        break;
    case 'listePerso':
        require_once('controllers/livreControlleur.php');
        break;   
}

?>

<?php include("vues/footer.php"); ?>