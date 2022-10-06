<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : controlleur des pages liée au admin (page admin, ajout compte admin, CRUD livre, CRUD genre)
 */
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    case '':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        include("vues/admin/boutonAdmin.php");
        break;
    case 'listLivres':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        $dataLivre = new Livre();
        $dataLivre = Livre::findAll();
        include("vues/admin/tableauLivre.php");
        break;
    case 'ajouterLivre':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // Filtre des données
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $auteur = filter_input(INPUT_POST, "auteur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $annee = filter_input(INPUT_POST, "annee", FILTER_VALIDATE_INT);
        $vente = filter_input(INPUT_POST, "vente", FILTER_VALIDATE_INT);
        $image = filter_input(INPUT_POST, "image", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $btnajouter = filter_input(INPUT_POST, "ajouter", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Message d'erreur
        $erreurAjouterLivre = "";
        if ($btnajouter == "ajouter") {
            if ($nom && $auteur && $annee && $vente && $description && $genre && basename($_FILES["image"]["name"]) != "") {
                if ($annee <= date("Y")) {
                    if ($vente > 0) {
                        $target_dir = "img/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        if (file_exists($target_file) == false) {
                            if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "jfif") {
                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                    $ajouterLivre = new Livre();
                                    $ajouterLivre->setNom($nom);
                                    $ajouterLivre->setAuteur($auteur);
                                    $ajouterLivre->setAnnee($annee);
                                    $ajouterLivre->setVente($vente);
                                    $ajouterLivre->setImage(basename($_FILES["image"]["name"]));
                                    $ajouterLivre->setDescription($description);
                                    $ajouterLivre->setIdgenre($genre);
                                    Livre::add($ajouterLivre);
                                    header("index.php?uc=admin&action=ListLivres");
                                    exit;
                                } else {
                                    $erreurAjouterLivre = "Erreur lors de l'ajout de l'image";
                                }
                            } else {
                                $erreurAjouterLivre = "Je n'accepte pas ce format d'image";
                            }
                        } else {
                            $erreurAjouterLivre = "L'image est déjà utilisée par un autre livre";
                        }
                    } else {
                        $erreurAjouterLivre = "La vente d'un livre ne peut pas etre inférrieur à 0";
                    }
                } else {
                    $erreurAjouterLivre = "Le livre ne peut pas venir du futur !";
                }
            } else {
                $erreurAjouterLivre = "Il manque des données";
            }
        }
        include("vues/admin/ajouterLivre.php");
        echo "<br><p class='text-danger h4 text-center'>${erreurAjouterLivre}</p>";
        break;
    case 'modifierLivre':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }

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
                        @chmod($filename, 0777);
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
                                $modification->setIdgenre($modifierLivre->getIdgenre());
                                $modification->setIdlivre($id);
                                $modification->setImage(basename($_FILES["image"]["name"]));
                                Livre::update($modification);
                                header("location: index.php?uc=admin&action=listLivres");
                                exit;
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
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }

        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $dataLivre = Livre::findById($id);
        $supprimerLivre = new Livre();
        $supprimerLivre->setIdlivre($id);
        unlink("img/" . $dataLivre->getImage());
        Livre::delete($supprimerLivre);
        header("location: index.php?uc=admin&action=listLivres");
        exit;

        break;
    case 'listGenres':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        $dataGenre = new Genre();
        $dataGenre = Genre::findAll();
        include("vues/admin/tableauGenre.php");
        break;
    case 'ajouterGenre':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // Filtre des données
        $nom = filter_input(INPUT_POST, "nomgenre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $btnAjouterGenre = filter_input(INPUT_POST, "ajouterGenre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Message d'erreur
        $erreurAjouterGenre = "";

        if ($btnAjouterGenre == "ajouterGenre") {
            if ($nom) {
                if (Genre::GenreAlreadyExist($nom) == false) {
                    // Ajoute un genre
                    $ajouterGenre = new Genre();
                    $ajouterGenre->setGenre($nom);
                    Genre::add($ajouterGenre);
                    header("location: index.php?uc=admin&action=listGenres");
                    exit;
                } else {
                    $erreurAjouterGenre = "Le genre existe déjà";
                }
            } else {
                $erreurAjouterGenre = "Il faut remplir le champ";
            }
        }
        include("vues/admin/ajouterGenre.php");
        echo "<br><p class='text-danger h4 text-center'>${erreurAjouterGenre}</p>";
        break;
    case 'modifierGenre':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
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
            } else {
                $erreurModifGenre = "Il faut écrire un genre.";
            }
        }
        include("vues/admin/modifierGenre.php");
        echo "<br><p class='text-danger h4 text-center'>${erreurModifGenre}</p>";
        break;
    case 'supprimerGenre':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $supprimerGenre = new Genre();
        $supprimerGenre->setIdgenre($id);
        Livre::DeleteAllBookOfGenre($id);
        Genre::delete($supprimerGenre);
        header("location: index.php?uc=admin&action=listGenres");
        exit;
        break;
}
