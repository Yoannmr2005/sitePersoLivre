<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : controlleur des pages liée au admin (page admin, ajout compte admin, CRUD livre, CRUD genre)
 */
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    // Controlleur pour afficher un menu
    case '':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // Inclus la page de vue du menu admin
        include("vues/admin/boutonAdmin.php");
        break;
    // Controlleur pour afficher un tableau de tous les livres
    case 'listLivres':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        $dataLivre = new Livre();
        // Récupère tous les livres de la DB
        $dataLivre = Livre::findAll();
        // Inclus la page de vue du tableau de livre
        include("vues/admin/tableauLivre.php");
        break;
    // Controlleur pour ajouter un livre
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
        $lien = filter_input(INPUT_POST, "lien", FILTER_VALIDATE_URL);
        $pdf = filter_input(INPUT_POST, "pdf", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $btnajouter = filter_input(INPUT_POST, "ajouter", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Message d'erreur
        $erreurAjouterLivre = "";

        // Traitement du formulaire
        if ($btnajouter == "ajouter") {
            // Vérifie si les champs sont remplis
            if ($nom && $auteur && $annee && $vente && $description && $lien && $genre && basename($_FILES["image"]["name"]) != "" && basename($_FILES["pdf"]["name"]) != "") {
                // Vérifie si le nom est déjà utilisée
                if (Livre::VerifyIfNameExist($nom) == false) {
                    // Vérifie si l'année rentrée est inférieur à l'année actuelle
                    if ($annee <= date("Y")) {
                        // Vérifie si la vente rentrée est supérieur à 0
                        if ($vente > 0) {
                            // Vérifie si le genre sélectionné existe
                            if (Genre::findById($genre) != []) {
                                // Vérifie si le pdf est ok
                                $msgVerifyPdf = Livre::VerifyPdf(basename($_FILES["pdf"]["name"]), $_FILES["pdf"]["tmp_name"]);
                                if ($msgVerifyPdf == "ok") {
                                    // Chemin d'accèes au images
                                    $target_dir = "img/";
                                    // Récupère la destination du fichier (ex: img/batman.png)
                                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                                    // Récupère l'extension de l'image dans le formulaire
                                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                    // Regarde si le fichier existe
                                    if (file_exists($target_file) == false) {
                                        // Vérifie si le fichier est bien une image
                                        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "jfif") {
                                            // ajoute la nouvelle image dans le dossier img     
                                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                                // Récupère la taille de l'image
                                                $dimensions = getimagesize($target_file);
                                                // Vérifie la taille de l'image (nécessaire pour l'affichage)
                                                if (($dimensions[0] == "150") && ($dimensions[1] == "200")) {
                                                    // Crée une nouvelle instance de livre
                                                    $ajouterLivre = new Livre();
                                                    // Set les données de l'instance
                                                    $ajouterLivre->setNom($nom);
                                                    $ajouterLivre->setAuteur($auteur);
                                                    $ajouterLivre->setAnnee($annee);
                                                    $ajouterLivre->setVente($vente);
                                                    $ajouterLivre->setLien($lien);
                                                    $ajouterLivre->setImage(basename($_FILES["image"]["name"]));
                                                    $ajouterLivre->setPdf(basename($_FILES["pdf"]["name"]));
                                                    $ajouterLivre->setDescription($description);
                                                    $ajouterLivre->setIdgenre($genre);
                                                    // Ajoute le livre puis redirige vers la liste de livres
                                                    Livre::add($ajouterLivre);
                                                    header("location: index.php?uc=admin&action=listLivres");
                                                    exit;
                                                } else {
                                                    // Supprime le livre qui vient d'etre ajouté car il n'est pas à la bonne taille
                                                    unlink($target_file);
                                                    $erreurAjouterLivre = "La taille de l'image doit etre de 150x200 pixels";
                                                }
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
                                    $erreurAjouterLivre = $msgVerifyPdf;
                                }
                            } else {
                                $erreurAjouterLivre = "Le genre n'existe pas";
                            }
                        } else {
                            $erreurAjouterLivre = "La vente d'un livre ne peut pas etre inférrieur à 0";
                        }
                    } else {
                        $erreurAjouterLivre = "Le livre ne peut pas venir du futur !";
                    }
                } else {
                    $erreurAjouterLivre = "Le nom du livre est déjà utilisée";
                }
            } else {
                $erreurAjouterLivre = "Il manque des données";
            }
        }
        // Inclus la vue
        include("vues/admin/ajouterLivre.php");
        // Affiche le message d'erreur
        echo "<br><p class='text-danger h4 text-center'>${erreurAjouterLivre}</p>";
        break;
    // Controlleur pour modifier un livre
    case 'modifierLivre':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // Récupère l'id dans l'URL
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        // Récupère les données du livre avec l'id
        $modifierLivre = new Livre();
        $modifierLivre = Livre::findById($id);
        // Renvoie à la gestion si l'id de l'url n'existe pas dans la DB
        if ($modifierLivre == false) {
            header("location: index.php?uc=admin&action=listLivres");
            exit;
        }
        // Filtre des données
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $auteur = filter_input(INPUT_POST, "auteur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $annee = filter_input(INPUT_POST, "annee", FILTER_VALIDATE_INT);
        $vente = filter_input(INPUT_POST, "vente", FILTER_VALIDATE_INT);
        $lien = filter_input(INPUT_POST, "lien", FILTER_VALIDATE_URL);
        $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modifier = filter_input(INPUT_POST, "modifier", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Message d'erreur
        $erreurModification = "";
        // Traitement du formulaire
        if ($modifier == "modifier") {
            if ($nom && $auteur && $annee && $vente && $lien && $genre && $description) {
                if ($annee <= date("Y")) {
                    if ($vente > 0) {
                        // Vérifie si le genre sélectionné existe
                        if (Genre::findById($genre) != []) {
                            $msgVerifyImg = Livre::VerifyImage(basename($_FILES["image"]["name"]), $_FILES["image"]["tmp_name"], $modifierLivre);
                            if ($msgVerifyImg == "ok") {
                                if (basename($_FILES["pdf"]["name"]) != "") {
                                    $msgModifierPdf = Livre::VerifyPdf(basename($_FILES["pdf"]["name"]), $_FILES["pdf"]["tmp_name"]);
                                    if ($msgModifierPdf == "ok") {
                                        unlink("pdf/" . $modifierLivre->getPdf());
                                        $nomPdf = basename($_FILES["pdf"]["name"]);
                                    } else {
                                        $erreurModification = $msgModifierPdf;
                                        $nomPdf = "";
                                    }
                                } else {
                                    $nomPdf = $modifierLivre->getPdf();
                                }
                                if ($nomPdf != "") {
                                    // Modifie le livre dans la DB
                                    $modification = new Livre();
                                    $modification->setNom($nom);
                                    $modification->setAuteur($auteur);
                                    $modification->setAnnee($annee);
                                    $modification->setVente($vente);
                                    $modification->setDescription($description);
                                    $modification->setIdgenre($genre);
                                    $modification->setIdlivre($id);
                                    $modification->setLien($lien);
                                    $modification->setPdf($nomPdf);
                                    $modification->setImage($_SESSION["nomImage"]);
                                    Livre::update($modification);
                                    header("location: index.php?uc=admin&action=listLivres");
                                    exit;
                                }
                            } else {
                                $erreurModification = $msgVerifyImg;
                            }
                        } else {
                            $erreurModification = "Le genre n'existe pas";
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
    // Controlleur pour supprimer un livre
    case 'supprimerLivre':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // Récupère l'id de l'URL
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        // Récupère les données du livre avec son id
        $dataLivre = Livre::findById($id);
        // Supprime le livre de la DB et l'image
        $supprimerLivre = new Livre();
        $supprimerLivre->setIdlivre($id);
        // Supprime le livre
        unlink("img/" . $dataLivre->getImage());
        // Supprime le pdf
        unlink("pdf/" . $dataLivre->getPdf());
        Livre::delete($supprimerLivre);
        header("location: index.php?uc=admin&action=listLivres");
        exit;
        break;
    // Controlleur pour afficher un tableau de tous les genres
    case 'listGenres':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        // Récupère les données de genre
        $dataGenre = new Genre();
        $dataGenre = Genre::findAll();
        include("vues/admin/tableauGenre.php");
        break;
    // Controlleur pour ajouter un genre
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
    // Controlleur pour modifier un genre
    case 'modifierGenre':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $modifierGenre = new Genre();
        $modifierGenre = Genre::findById($id);
        // Renvoie à la gestion si l'id de l'url n'existe pas dans la DB
        if ($modifierGenre == false) {
            header("location: index.php?uc=admin&action=listGenres");
            exit;
        }
        // Filtre des données
        $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $btnModifier = filter_input(INPUT_POST, "modifier", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Message d'erreur
        $erreurModifGenre = "";
        if ($btnModifier == "modifier") {
            if ($genre) {
                if (Genre::GenreAlreadyExist($genre) == false) {
                    // Modifie le genre
                    $modifGenre = new Genre();
                    $modifGenre->setGenre($genre);
                    $modifGenre->setIdgenre($id);
                    Genre::update($modifGenre);
                    header("location: index.php?uc=admin&action=listGenres");
                    exit;
                }else {
                    $erreurModifGenre = "Le nom est déjà utilisée par un autre genre";
                }
            } else {
                $erreurModifGenre = "Il faut écrire un genre.";
            }
        }
        include("vues/admin/modifierGenre.php");
        echo "<br><p class='text-danger h4 text-center'>${erreurModifGenre}</p>";
        break;
    // Controlleur pour supprimer un genre
    case 'supprimerGenre':
        // renvoie à l'accueil si le compte n'est pas admin
        if (User::isUserConnected() || User::isNotConnected()) {
            User::GoToIndex();
        }
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $supprimerGenre = new Genre();
        $supprimerGenre->setIdgenre($id);
        Livre::DeleteImgAndPdfOfGenre($id);
        Livre::DeleteAllBookOfGenre($id);
        Genre::delete($supprimerGenre);
        header("location: index.php?uc=admin&action=listGenres");
        exit;
        break;
    // Redirige si l'URL est inconnue
    default:
        // Redirige à l'accueil si l'action est incorrecte
        User::GoToIndex();
        break;
}
