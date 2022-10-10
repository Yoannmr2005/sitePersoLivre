<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : controlleur des pages du compte connecté (CRUD compte connecté)
 */
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    case '':
        $infoCompte = new User();
        $infoCompte = User::findById($_SESSION["idutilisateur"]);
        $delete = filter_input(INPUT_POST, "supprimer", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($delete == "supprimer") {
            header("location: index.php?uc=compte&action=supprimer");
            exit;
        }
        include("vues/compte/tableauCompte.php");
        break;
    case 'modifier':
        $infoCompteModification = new User();
        $infoCompteModification = User::findById($_SESSION["idutilisateur"]);
        // Message d'erreur de modification du compte
        $erreurFormModif = "";
        // Filtre des données
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $ancienMdp = filter_input(INPUT_POST, "ancienmdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nouveauMdp = filter_input(INPUT_POST, "nouveaumdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modifier = filter_input(INPUT_POST, "modifier", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Si on comfirme
        if ($modifier == "modifier") {
            $erreurFormModif = User::VerifyDataModifCompte($nom, $email, $ancienMdp, $nouveauMdp, $infoCompteModification);
            // On redirige si la modification est ok
            if ($erreurFormModif == "ok") {
                header("location: index.php?uc=compte");
                exit;
            }
        }
        include("vues/compte/formCompteModif.php");
        echo "<br><p class='text-danger h4 text-center'>${erreurFormModif}</p>";
        break;
    case 'supprimer':
        $deleteUser = new User();
        $deleteUser->setIdutilisateur($_SESSION["idutilisateur"]);
        User::delete($deleteUser);
        User::Disconnect();
        User::GoToIndex();
        break;
    default:
        // Redirige à l'accueil si l'action est incorrecte
        User::GoToIndex();
        break;
}
