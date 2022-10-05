<?php
class Genre
{

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
     * Set id du genre
     *
     * @param  int  $idgenre  Id du genre
     *
     * @return  self
     */ 
    public function setIdgenre(int $idgenre)
    {
        $this->idgenre = $idgenre;

        return $this;
    }

    /**
     * Get the value of genre
     */
    public function getGenre(): string
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
        $query = MonPdo::dbRun($sql, $param);
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Genre');
    }

    /**
     * Trouve un genre par son id
     *
     * @param integer $id
     * @return object
     */
    public static function findById(int $id)
    {
        $sql = "SELECT `idgenre`, `genre` FROM genre WHERE idgenre = ?";
        $param = [$id];
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Livre');
        return $statement->fetch();
    }

    /**
     * Permet d'ajouter un genre
     *
     * @param Genre $genre
     * @return object
     */
    public static function add(Genre $genre)
    {
        $sql = "INSERT INTO genre (`genre`) VALUES (?)";
        $param = [$genre->getGenre()];
        $query = MonPdo::dbRun($sql, $param);
        return $query;
    }

    /**
     * Permet de modifier un genre
     *
     * @param Genre $genre
     * @return object
     */
    public static function update(Genre $genre)
    {
        $sql = "UPDATE genre SET `genre` = ? WHERE idgenre = ?";
        $param = [$genre->getGenre(), $genre->getIdgenre()];
        $query = MonPdo::dbRun($sql, $param);
        return $query;
    }

    /**
     * Supprimer un genre
     *
     * @param Genre $genre
     * @return object
     */
    public static function delete(Genre $genre)
    {
        $sql = "DELETE FROM genre WHERE idgenre = ?";
        $param = [$genre->getIdgenre()];
        $query = MonPdo::dbRun($sql, $param);
        return $query;
    }


    /**
     * fonction qui créer un select des genres
     *
     * @return string
     */
    public static function CreateSelectFromGenre()
    {
        $sql = "SELECT idgenre, genre FROM genre";
        $query = MonPDO::dbRun($sql, []);
        $dataGenre = $query->fetchAll(PDO::FETCH_KEY_PAIR);
        $output = "<select name='genre' class='form-control'>";
        foreach ($dataGenre as $key => $value) {
            $output .= "<option value='$key'>$value</option>";
        }
        $output .= "</select>";
        return $output;
    }

    public static function GenreAlreadyExist($genre)
    {
        $sql = "SELECT `idgenre`, `genre` FROM genre WHERE genre = ?";
        $param = [$genre];
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Genre');
        return $statement->fetch();
        if ($statement == []) {
            return true;
        }else {
            return false;
        }
    }
}
