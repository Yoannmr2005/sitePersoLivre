<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : class Livre
 */
class Livre
{
    /**
     * id du livre
     *
     * @var int
     */
    private $idlivre;

    /**
     * nom du livre
     *
     * @var string
     */
    private $nom;

    /**
     * annne de sortie du livre
     *
     * @var int
     */
    private $annee;

    /**
     * resume du livre
     *
     * @var string
     */
    private $description;

    /**
     * auteur du livre
     *
     * @var string
     */
    private $auteur;

    /**
     * nombre de vente du livre
     *
     * @var int
     */
    private $vente;

    /**
     * id du genre du livre
     *
     * @var int
     */
    private $idgenre;

    /**
     * image du livre
     *
     * @var string
     */
    private $image;

    /**
     * Get the value of idlivre
     */
    public function getIdlivre()
    {
        return $this->idlivre;
    }

    /**
     * Set id du livre
     *
     * @param  int  $idlivre  id du livre
     *
     * @return  self
     */
    public function setIdlivre(int $idlivre)
    {
        $this->idlivre = $idlivre;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of annee
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set the value of annee
     *
     * @return  self
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of auteur
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set the value of auteur
     *
     * @return  self
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get the value of vente
     */
    public function getVente()
    {
        return $this->vente;
    }

    /**
     * Set the value of vente
     *
     * @return  self
     */
    public function setVente($vente)
    {
        $this->vente = $vente;

        return $this;
    }

    /**
     * Get the value of idgenre
     */
    public function getIdgenre(): int
    {
        return $this->idgenre;
    }

    /**
     * Set the value of idgenre
     *
     * @return  self
     */
    public function setIdgenre($idgenre)
    {
        $this->idgenre = $idgenre;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Retourne l'ensemble des livres
     *
     * @return Livre[]
     */
    public static function findAll(): array
    {
        $sql = "SELECT `idlivre`, `nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image` FROM livre ORDER BY `idgenre`, `auteur`";
        $param = [];
        $query = MonPdo::dbRun($sql, $param);
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Livre');
    }

    /**
     * Trouve les 5 livres avec le plus de vente
     *
     * @return Livre
     */
    public static function find5mostView()
    {
        $sql = "SELECT `idlivre`, `nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image` FROM livre ORDER BY `vente` DESC LIMIT 5";
        $param = [];
        $query = MonPdo::dbRun($sql, $param);
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Livre');
    }

    /**
     * Trouve un livre par son id
     *
     * @param integer $id
     * @return Livre
     */
    public static function findById(int $id)
    {
        $sql = "SELECT `idlivre`, `nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image` FROM livre WHERE idlivre = ?;";
        $param = [$id];
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Livre');
        return $statement->fetch();
    }

    /**
     * Trouve les livres de l'utilisateur connecté
     *
     * @param [type] $idutilisateur
     * @return void
     */
    public static function findAllLivreInListe($idutilisateur)
    {
        $sql = "SELECT `livre`.`idlivre`,`image`,`nom` FROM livre JOIN liste ON (`livre`.`idlivre` = `liste`.`idlivre`) WHERE liste.idutilisateur = ?";
        $param = [$idutilisateur];
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Livre');
        return $statement->fetchAll();
    }

    /**
     * Permet d'ajouter un livre
     *
     * @param Livre $livre
     * @return object
     */
    public static function add(Livre $livre)
    {
        $sql = "INSERT INTO livre (`nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $param = [$livre->getNom(), $livre->getAnnee(), $livre->getDescription(), $livre->getAuteur(), $livre->getVente(), $livre->getIdgenre(), $livre->getImage()];
        $query = MonPdo::dbRun($sql, $param);
        return $query;
    }

    /**
     * Permet de modifier un livre
     *
     * @param Livre $livre
     * @return object
     */
    public static function update(Livre $livre)
    {
        $sql = "UPDATE livre SET `nom` = ?, `annee` = ?, `description` = ?, `auteur`= ?, `vente`= ?,`idgenre` = ?, `image`= ? WHERE idlivre = ?";
        $param = [$livre->getNom(), $livre->getAnnee(), $livre->getDescription(), $livre->getAuteur(), $livre->getVente(), $livre->getIdgenre(), $livre->getImage(), $livre->getIdlivre()];
        $query = MonPdo::dbRun($sql, $param);
        return $query;
    }

    /**
     * Permet de supprimer un livre
     *
     * @param Livre $livre
     * @return object
     */
    public static function delete(Livre $livre)
    {
        $sql = "DELETE FROM livre WHERE idlivre = ?)";
        $param = [$livre->getIdlivre()];
        $query = MonPdo::dbRun($sql, $param);
        return $query;
    }

    /**
     * fonction qui change le format du nombre de vente
     *
     * @param [int] $data
     * @return string
     */
    public static function ChangeNumberFormat($data)
    {
        if ($data >= 1000000000) {
            return "<p>" . number_format($data, 0, ' ', ' ') . " milliards</p>";
        } elseif ($data >= 1000000) {
            return "<p>" . number_format($data, 0, ' ', ' ') . " millions</p>";
        } elseif ($data < 1000000) {
            return "<p>" . number_format($data, 0, ' ', ' ') . " milliers</p>";
        }
    }

    /**
     * Supprime tous les livres d'un genre
     *
     * @param int $idgenre
     * @return object
     */
    public static function DeleteAllBookOfGenre($idgenre)
    {
        $sql = "DELETE FROM livre WHERE idgenre = ?";
        $param = [$idgenre];
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Livre');
        return $statement->fetchAll();
    }
}
