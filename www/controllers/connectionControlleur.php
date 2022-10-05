<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : controlleur des pages de connexion (connexion, deconnexion, inscription utilisateur et inscription admin)
 */
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    case '':
        // message d'erreur
        $erreurConnexion = "";
        // Filtre des données
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $connexion = filter_input(INPUT_POST, "connexion", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($connexion == "connexion") {
            $erreurConnexion = User::VerifyDataConnect($nom, $mdp);
            if ($erreurConnexion == "ok") {
                User::GoToIndex();
            }
        }
        include("vues/login.php");
        echo "<br><p class='text-danger h4 text-center'>${erreurConnexion}</p>";
        break;
    case 'disconnect':
        // renvoie à l'accueil si le compte n'est pas connecté
        if (User::isNotConnected()) {
            User::GoToIndex();
        }
        // Fonction de déconnexion
        User::Disconnect();
        break;
    case 'inscription':
        $addUser = new User();
        // message d'erreur
        $erreurInscription = "";
        // Filtre des données
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $inscrire = filter_input(INPUT_POST, "inscription", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($inscrire == "inscription") {
            $erreurInscription = User::VerifyDataInscription($nom, $email, $mdp, "utilisateur");
        }
        include("vues/inscription.php");
        // Renvoie vers la page de connexion si l'inscription c'est bien déroulé, sinon écrit un message d'erreur
        if ($erreurInscription == "ok") {
            header("location: index.php?uc=connect");
            exit;
        } else {
            echo "<br><p class='text-danger h4 text-center'>${erreurInscription}</p>";
        }
        break;
    case 'ajoutAdmin':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // message d'erreur
        $erreurInscriptionAdmin = "";
        // Filtre des données
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $inscrire = filter_input(INPUT_POST, "inscription", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($inscrire == "inscription") {
            $erreurInscriptionAdmin = User::VerifyDataInscription($nom, $email, $mdp, "admin");
        }
        include("vues/inscription.php");
        // Renvoie vers la page de connexion si l'inscription c'est bien déroulé, sinon écrit un message d'erreur
        if ($erreurInscriptionAdmin == "ok") {
            header("location: index.php?uc=connect");
            exit;
        } else {
            echo "<br><p class='text-danger h4 text-center'>${erreurInscriptionAdmin}</p>";
        }
        break;
}
