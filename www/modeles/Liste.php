<?php
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
     * Trouve une liste par un id utilisateur id
     *
     * @param integer $id
     * @return Liste
     */
    public static function findById(int $id): Liste
    {
        $sql = "SELECT `nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image` FROM livre JOIN liste ON (livre.idlivre = liste.idlivre) WHERE liste.idutilisateur = ?";
        $param = [$id];
        $query = MonPdo::dbRun($sql,$param);
        return $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Liste');
    }

    /**
     * Permet d'ajouter un livre
     *
     * @param Liste $liste
     * @return integer (retourne 1 si réussi, sinon 0)
     */
    public static function add(Liste $liste): int
    {
        $sql = "INSERT INTO liste (`idlivre`, `idutilisateur` VALUES (?, ?)";
        $param = [$liste->getIdlivre(), $liste->getIdutilisateur()];
        $query = MonPdo::dbRun($sql,$param);
        return $query;
    }

    /**
     * Permet de supprimer un livre
     *
     * @param Liste $liste
     * @return integer
     */
    public static function delete(Liste $liste): int 
    {
        $sql = "DELETE FROM livre WHERE idlivre = ?)";
        $param = [$liste->getIdlivre()];
        $query = MonPdo::dbRun($sql,$param);
        return $query;
    }
}
?>