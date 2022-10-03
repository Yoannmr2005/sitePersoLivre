<?php
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

switch ($action) {
    case '':
        include("vues/admin/boutonAdmin.php");
        break;
    case 'listLivres':
        $dataLivre = new Livre();
        $dataLivre = Livre::findAll();
        include("vues/admin/tableauLivre.php");
        break;
    case 'modifierLivre':
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $modifierLivre = new Livre();
        $modifierLivre = Livre::findById($id);

        // Filtre des données
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $auteur = filter_input(INPUT_POST, "auteur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $annee = filter_input(INPUT_POST, "annee", FILTER_VALIDATE_INT);
        $vente = filter_input(INPUT_POST, "vente", FILTER_VALIDATE_INT);
        $image = filter_input(INPUT_POST, "image", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modifier = filter_input(INPUT_POST, "modifier", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Message d'erreur
        $erreurModification = "";

        if ($modifier == "modifier") {
            if ($nom && $auteur && $annee && $vente && $description && basename($_FILES["image"]["name"]) != "") {
                if ($annee <= date("Y")) {
                    if ($vente > 0) {
                        $target_dir = "img/";
                        $filename = $target_dir . $modifierLivre->getImage();
                        chmod($filename, 0777);
                        if (unlink($filename)) {
                            $target_file = $target_dir . basename($_FILES["image"]["name"]);
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                // Modifie le livre dans la DB
                                $modification = new Livre();
                                $modification->setNom($nom);
                                $modification->setAuteur($auteur);
                                $modification->setAnnee($annee);
                                $modification->setVente($vente);
                                $modification->setDescription($description);
                                $modification->setImage(basename($_FILES["image"]["name"]));
                                Livre::update($modification);
                            } else {
                                $erreurModification = "Erreur lors de l'upload de la nouvelle image";
                            }
                        } else {
                            $erreurModification = "Erreur lors de la supression de l'image";
                        }
                    } else {
                        $erreurModification = "La vente ne peut pas être inférieur à 0";
                    }
                } else {
                    $erreurModification = "Le livre ne peut pas venir du futur !";
                }
            } else {
                $erreurModification = "Il manque des données";
            }
        }
        include("vues/admin/modifierLivre.php");
        echo "<br><p class='text-danger h4 text-center'>${erreurModification}</p>";
        break;
    case 'supprimerLivre':
        # code...
        break;
    case 'listGenres':
        $dataGenre = new Genre();
        $dataGenre = Genre::findAll();
        include("vues/admin/tableauGenre.php");
        break;
    case 'modifierGenre':
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $modifierGenre = new Genre();
        $modifierGenre = Genre::findById($id);
        // Filtre des données
        $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $btnModifier = filter_input(INPUT_POST, "modifier", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Message d'erreur
        $erreurModifGenre = "";
        if ($btnModifier == "modifier") {
            if ($genre) {
                // Modifie le genre
                $modifGenre = new Genre();
                $modifGenre->setGenre($genre);
                $modifGenre->setIdgenre($id);
                Genre::update($modifGenre);
                header("location: index.php?uc=admin&action=listGenres");
                exit;
            }else {
                $erreurModifGenre = "Il faut choisir un genre.";
            }
        }
        include("vues/admin/modifierGenre.php");
        break;
    case 'supprimerGenre':
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $supprimerGenre = new Genre();
        $supprimerGenre->setIdgenre($id);
        Genre::delete($supprimerGenre);
        break;
}
