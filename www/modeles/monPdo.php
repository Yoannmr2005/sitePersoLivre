<?php

/**
 *	Classe d'acces aux donnees Utilise les services de la classe PDO
 *	Les attributs sont tous statiques, les 4 premiers pour la connexion
 *	$monPdo qui contiendra l'unique instance de la classe
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

    public static function PDO_Select_All($sql,$param){
        $query = MonPdo::dbRun($sql,$param);
        return $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Livre');
    }
    
    public static function PDO_Select($sql,$param){
        $query = MonPdo::dbRun($sql,$param);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public static function PDO_Insert_Update_Delete($sql,$param){
        $query = MonPdo::dbRun($sql,$param);
        return $query;
    }
}
