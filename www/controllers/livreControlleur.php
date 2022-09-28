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
        include("vues/liste.php");
        break;
    case 'livre':
        # code...
        break;
    case 'listePerso':
        # code...
        break;
}