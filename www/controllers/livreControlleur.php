<?php
$action = filter_input(INPUT_GET,"action",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    case '':
        $index = new Livre();
        $index = Livre::find5mostView();
        include("vues/accueil.php");
        break;
    case 'liste':
        # code...
        break;
    case 'listePerso':
        # code...
        break;
}