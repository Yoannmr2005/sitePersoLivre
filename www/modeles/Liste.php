<?php
/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : class Liste
 */
class Liste {

    /**
     * id du livre (clé étrnagère de livre)
     *
     * @var int
     */
    private $idlivre;

    /**
     * id de l'utilisateur (clé étrnagère)
     *
     * @var int
     */
    private $idutilisateur;

    /**
     * Get the value of idlivre
     */ 
    public function getIdlivre()
    {
        return $this->idlivre;
    }

    /**
     * Set the value of idlivre
     *
     * @return  self
     */ 
    public function setIdlivre($idlivre)
    {
        $this->idlivre = $idlivre;

        return $this;
    }

    /**
     * Get the value of idutilisateur
     */ 
    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    /**
     * Set the value of idutilisateur
     *
     * @return  self
     */ 
    public function setIdutilisateur($idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }

    /**
     * Trouve toutes les listes personnelles du site
     *
     * @return object
     */
    public static function findAll()
    {
        $sql = "SELECT `idutilisateur`, `idlivre` FROM liste";
        $param = [];
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Liste');
        return $statement->fetchAll();
    }

    /**
     * Trouve une liste par un id utilisateur
     *
     * @param integer $id
     * @return Liste
     */
    public static function findById(int $id)
    {
        $sql = "SELECT `idlivre`,`idutilisateur` FROM liste WHERE liste.idutilisateur = ?";
        $param = [$id];
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Liste');
        return $statement->fetchAll();
    }

    /**
     * fonction qui permet de trouver un livre dans la liste
     *
     * @param integer $idutilisateur
     * @param integer $idlivre
     * @return object
     */
    public static function FindOneBookInListe(int $idutilisateur, int $idlivre)
    {
        $sql = "SELECT `idlivre`,`idutilisateur` FROM liste WHERE idutilisateur = ? AND idlivre = ?";
        $param = [$idutilisateur, $idlivre];
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Liste');
        return $statement->fetch();
    }

    /**
     * Permet d'ajouter un livre
     *
     * @param Liste $liste
     * @return integer (retourne 1 si réussi, sinon 0)
     */
    public static function add(Liste $liste)
    {
        $sql = "INSERT INTO liste (`idlivre`, `idutilisateur`) VALUES (?, ?)";
        $param = [$liste->getIdlivre(), $liste->getIdutilisateur()];
        $query = MonPdo::dbRun($sql,$param);
        return $query;
    }

    /**
     * Permet de supprimer un livre
     *
     * @param Liste $liste
     * @return void
     */
    public static function delete(Liste $liste) 
    {
        $sql = "DELETE FROM liste WHERE idlivre = ? AND idutilisateur = ?";
        $param = [$liste->getIdlivre(), $liste->getIdutilisateur()];
        $query = MonPdo::dbRun($sql,$param);
        return $query;
    }
}
?>