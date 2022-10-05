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
        $userExist = new User();
        $userExist = User::findAll();
        // message d'erreur
        $erreurConnexion = "";
        // Filtre des données
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $connexion = filter_input(INPUT_POST, "connexion", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($connexion == "connexion") {
            if ($mdp && $nom) {
                // Vérifie si l'utilisateur existe et récupère l'id
                $iduser = User::VerifyConnect($nom, $mdp);
                if ($iduser != "") {
                    // Stocke l'id dans la session
                    $_SESSION["idutilisateur"] = $iduser;
                    // Permet de récupérer les données de l'utilisateur connecté, utile pour obtenir le role et le stocké dans la session
                    $userConnected = User::findById($iduser);
                    if ($userConnected->getRole() == "utilisateur") {
                        $_SESSION["compte"]["utilisateur"] = 1;
                        $_SESSION["compte"]["admin"] = 0;
                    } else {
                        $_SESSION["compte"]["utilisateur"] = 0;
                        $_SESSION["compte"]["admin"] = 1;
                    }
                    header("location: index.php");
                    exit;
                } else {
                    $erreurConnexion = "Erreur de nom ou de mot de passe";
                }
            } else {
                $erreurConnexion = "Il manque une donnée";
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
        }else {
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
        }else {
            echo "<br><p class='text-danger h4 text-center'>${erreurInscriptionAdmin}</p>";
        }
        break;
}
