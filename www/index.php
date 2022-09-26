<?php 
/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : Controlleur principal
 */
?>
<?php session_start(); ?>
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
    
    case 'liste':
        
        break;
}

?>

<?php include("vues/footer.php"); ?>