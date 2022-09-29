<?php
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

switch ($action) {
    case '':
        $infoCompte = new User();
        $infoCompte = User::findById($_SESSION["idutilisateur"]);
        include("vues/compte/tableauCompte.php");
        break;
    case 'modifier':
        $infoCompteModification = new User();
        $infoCompteModification = User::findById($_SESSION["idutilisateur"]);
        //
        $erreurFormModif = "";
        // Filtre des données
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $ancienMdp = filter_input(INPUT_POST, "ancienmdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nouveauMdp = filter_input(INPUT_POST, "nouveaumdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modifier = filter_input(INPUT_POST, "modifier", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Si on comfirme
        if ($modifier == "modifier") {
            // Vérifie si les champs obligatoires sont remplies
            if ($nom && $email && $ancienMdp) {
                // Vérifie si l'ancien mot de passe est correcte
                if (password_verify($ancienMdp, $infoCompteModification->getMdp())) {
                    // Modifier le nom et l'e-mail si le champs nouveau mdp est vide 
                    if ($nouveauMdp != "") {
                        // Verifie si le nouveau mot de passe est identique à l'ancien
                        if ($ancienMdp != $nouveauMdp) {
                            // Modifier le nom, l'e-mail et le mot de passe
                            $modifierAvecMdp = new User();
                            $modifierAvecMdp->setNom($nom);
                            $modifierAvecMdp->setEmail($email);
                            $modifierAvecMdp->setMdp(password_hash($nouveauMdp, PASSWORD_BCRYPT));
                            $modifierAvecMdp->setRole("utilisateur");
                            $modifierAvecMdp->setIdutilisateur($_SESSION["idutilisateur"]);
                            User::update($modifierAvecMdp);
                            header("location: index.php?uc=compte");
                            exit;
                        } else {
                            $erreurFormModif = "Le nouveau mot de passe est identique à l'ancien";
                        }
                    } else {
                        // Modifier le nom et l'e-mail
                        $modifierSansMdp = new User();
                        $modifierSansMdp->setNom($nom);
                        $modifierSansMdp->setEmail($email);
                        // Remet l'ancien mot de passe
                        $modifierSansMdp->setMdp($infoCompteModification->getMdp());
                        $modifierSansMdp->setRole("utilisateur");
                        $modifierSansMdp->setIdutilisateur($_SESSION["idutilisateur"]);
                        User::update($modifierSansMdp);
                        header("location: index.php?uc=compte");
                        exit;
                    }
                } else {
                    $erreurFormModif = "L'ancien mot de passe est incorrect";
                }
            } else {
                $erreurFormModif = "Il manque une ou plusieurs donnée(s)";
            }
        }
        include("vues/compte/formCompteModif.php");
        echo "<br><p class='text-danger h4 text-center'>${erreurFormModif}</p>";
        break;
    case 'supprimer':
        # code...
        break;
}
