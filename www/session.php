<?php 
// Créer la session pour le compte si elle n'existe pas
if (!isset($_SESSION["compte"])) {
    $_SESSION["compte"] = array();
    $_SESSION["compte"]["utilisateur"] = 0;
    $_SESSION["compte"]["admin"] = 0;
}

// Recupère l'id de l'utilisateur connecté
if (isset($_SESSION["nomConnecte"])) {
    //$idUtilisateur = PDO_Select("SELECT idutilisateur FROM utilisateur WHERE nom = ?", [$_SESSION["nomConnecte"]]);
}