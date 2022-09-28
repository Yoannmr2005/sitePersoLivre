<?php
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
            if ($mdp != "" && $nom != "") {
                $isConnected = User::VerifyConnect($nom, $mdp);
                if ($isConnected != "") {
                    $_SESSION["idutilisateur"] = $isConnected;
                    $_SESSION["compte"]["utilisateur"] = 1;
                    $_SESSION["compte"]["admin"] = 0;
                    header("location: index.php");
                    exit;
                }else {
                    $erreurConnexion = "Erreur de nom ou de mot de passe";
                }
            } else {
                $erreurConnexion = "Il manque un donnée";
            }
            echo $erreurConnexion;
        }
        include("vues/login.php");
        break;
    case 'disconnect':
        User::Disconnect();
        break;
    case 'inscription':
        # code...
        break;
    case 'desinscription':
        # code...
        break;
}
