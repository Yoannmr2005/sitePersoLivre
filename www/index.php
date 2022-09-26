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
<?php include("vues/header.php"); ?>

<?php
// Récupère les paramètres GET
$getUc = filter_input(INPUT_GET,"uc",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// Si l'url est vide, on met accueil
$uc = empty($getUc) ? "accueil" : $getUc;

switch ($uc) {
    case 'accueil':
        include("vues/accueil.php");
        break;
    case 'connect':
        require_once('Controllers/connectionControlleur.php');
        break;
    case 'disconnect':
        require_once('Controllers/deconnectionControlleur.php');
        break;
    case 'liste':
        require_once('Controllers/listeControlleur.php');
        break;
    case 'admin':
        require_once('Controllers/adminControlleur.php');
        break;
    case 'listePerso':
        require_once('Controllers/personnalListeControlleur.php');
        break;   
}

?>

<?php include("vues/footer.php"); ?>