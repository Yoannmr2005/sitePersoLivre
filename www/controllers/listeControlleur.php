<?php
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    case 'listePerso':
        $liste = Livre::findAllLivreInListe($_SESSION["idutilisateur"]);
        include("vues/afficherliste.php");
        break;
    case 'ajouter':
        $ajouter = new Liste();
        // Filtre le GET
        $idlivre = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        // Regarde si l'utilisateur a déjà ce livre dans ca liste
        $liste = Liste::FindOneBookInListe($_SESSION["idutilisateur"], $idlivre);
        if ($liste == false) {
            // Ajoute le livre
            $ajouter->setIdlivre($idlivre);
            $ajouter->setIdutilisateur($_SESSION["idutilisateur"]);
            Liste::add($ajouter);
            header("location: index.php?uc=listePerso&action=listePerso");
            exit;
        } else {
            // Redirige vers la detail du livre et affiche un message
            $_SESSION["msgLivreDejaDansListe"] = "<br><p class='text-danger h5'>Le livre est déjà dans votre liste</p>";
            header("location: index.php?uc=liste&action=livre&id=${idlivre}");
            exit;
        }
        break;
    case 'supprimer':
        # code...
        break;
}
