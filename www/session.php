<?php
/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : Création de la session
 */

// Créer la session pour le compte si elle n'existe pas
if (!isset($_SESSION["compte"])) {
    $_SESSION["compte"] = array();
    $_SESSION["compte"]["utilisateur"] = 0;
    $_SESSION["compte"]["admin"] = 0;
}