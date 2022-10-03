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
    case 'listGenres':
        include("vues/admin/tableauGenre.php");
        break;
}
