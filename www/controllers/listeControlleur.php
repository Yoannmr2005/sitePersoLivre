<?php
$action = filter_input(INPUT_GET,"action",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    case '':
        # code...
        break;
    case 'ajouter':
        $ajouter = new Liste();
        $ajouter->setIdlivre(filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT));
        $ajouter->setIdutilisateur($_SESSION["idutilisateur"]);
        Liste::add($ajouter);
        break;
    case 'supprimer':
        # code...
        break;
}