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
                    }else {
                        $_SESSION["compte"]["utilisateur"] = 0;
                        $_SESSION["compte"]["admin"] = 1;
                    }
                    header("location: index.php");
                    exit;
                } else {
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
