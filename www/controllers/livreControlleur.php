<?php
$action = filter_input(INPUT_GET,"action",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    case '':
        $index = new Livre();
        $index = Livre::find5mostView();
        include("vues/accueil.php");
        break;
    case 'liste':
        $liste = new Livre();
        $liste = Livre::findAll();
        include("vues/afficherliste.php");
        break;
    case 'livre':
        $id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
        $livre = new Livre();
        $livre = Livre::findById($id);
        $genreLivre = new Genre();
        $genreLivre = Genre::findById($livre->getIdgenre());
        include("vues/infoLivre.php");
        break;
}