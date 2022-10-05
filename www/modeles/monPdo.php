<?php
/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : class PDO
 */
class MonPdo
{

    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=dblivre';
    private static $user = 'dbmonstres';
    private static $mdp = 'MegaSecret';
    private static $monPdo;
    private static $unPdo = null;

    //	Constructeur privé, crée l'instance de PDO qui sera sollicitée
    //	pour toutes les méthodes de la classe
    private function __construct()
    {
        MonPdo::$unPdo = new PDO(MonPdo::$serveur . ';' . MonPdo::$bdd, MonPdo::$user, MonPdo::$mdp);
        MonPdo::$unPdo->query("SET CHARACTER SET utf8");
        MonPdo::$unPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function __destruct()
    {
        MonPdo::$unPdo = null;
    }
    /**
     *	Fonction statique qui cree l'unique instance de la classe
     * Appel : $instanceMonPdo = MonPdo::getMonPdo();
     *	@return l'unique objet de la classe MonPdo
     */
    public static function getInstance()
    {
        if (self::$unPdo == null) {
            self::$monPdo = new MonPdo();
        }
        return self::$unPdo;
    }

    public static function dbRun($sql, $param = null)
    {
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        return $statement;
    }
}
