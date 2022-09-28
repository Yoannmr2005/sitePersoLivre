<?php
class Genre {

    /**
     * Id du genre
     *
     * @var int
     */
    private $idgenre;

    /**
     * Nom du genre
     *
     * @var string
     */
    private $genre;

    /**
     * Get the value of idgenre
     */ 
    public function getIdgenre()
    {
        return $this->idgenre;
    }

    /**
     * Get the value of genre
     */ 
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */ 
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Retourne tous les genres
     *
     * @return Genre[]
     */
    public static function findAll(): array
    {
        $sql = "SELECT `idgenre`, `genre` FROM genre";
        $param = [];
        $query = MonPdo::dbRun($sql,$param);
        return $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Genre');
    }

    /**
     * Trouve un genre par son id
     *
     * @param integer $id
     * @return Genre
     */
    public static function findById(int $id): Genre
    {
        $sql = "SELECT `idgenre`, `genre` FROM genre WHERE idgenre = ?";
        $param = [$id];
        $query = MonPdo::dbRun($sql,$param);
        return $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Genre');
    }

    /**
     * Permet d'ajouter un genre
     *
     * @param Genre $genre
     * @return integer
     */
    public static function add(Genre $genre): int
    {
        $sql = "INSERT INTO genre (`genre`) VALUES (?)";
        $param = [$genre->getGenre()];
        $query = MonPdo::dbRun($sql,$param);
        return $query;
    }

    /**
     * Permet de modifier un genre
     *
     * @param Genre $genre
     * @return integer
     */
    public static function update(Genre $genre): int
    {
        $sql = "UPDATE genre SET `genre` = ? WHERE idgenre = ?)";
        $param = [$genre->getGenre(), $genre->getIdgenre()];
        $query = MonPdo::dbRun($sql,$param);
        return $query;
    }

    /**
     * Supprimer un genre
     *
     * @param Genre $genre
     * @return integer
     */
    public static function delete(Genre $genre): int 
    {
        $sql = "DELETE FROM genre WHERE idgenre = ?)";
        $param = [$genre->getIdgenre()];
        $query = MonPdo::dbRun($sql,$param);
        return $query;
    }
}
