<?php

/**
 * Auteur : Yoann Meier
 * Projet : site perso livre V2
 */

require_once "config.php";

/**
 * fonction qui connecte à une DB en utilisant PDO
 *
 * @return PDO un objet PDO
 */
function db()
{
    static $db = null;
    if ($db === null) {
        $dbString = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8";
        $db = new PDO($dbString, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    return $db;
}

function dbRun($sql, $param = null){
    $statement = db()->prepare($sql);
    $statement->execute($param);
    return $statement;
}

