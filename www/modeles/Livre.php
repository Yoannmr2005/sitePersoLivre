<?php

use Livre as GlobalLivre;

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
    public function getIdgenre()
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
        return MonPdo::PDO_Select_All("SELECT `idlivre`, `nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image` FROM livre", []);
    }

    /**
     * Trouve un livre par son id
     *
     * @param integer $id
     * @return Livre
     */
    public static function findById(int $id): Livre
    {
        return MonPdo::PDO_Select("SELECT `idlivre`, `nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image` FROM livre WHERE idlivre = ?", [$id]);
    }

    /**
     * Permet d'ajouter un livre
     *
     * @param Livre $livre
     * @return integer (retourne 1 si réussi, sinon 0)
     */
    public static function add(Livre $livre): int
    {
        $sql = "INSERT INTO livre (`nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $param = [$livre->getNom(), $livre->getAnnee(), $livre->getDescription(), $livre->getAuteur(), $livre->getVente(), $livre->getIdgenre(), $livre->getImage()];
        return MonPdo::PDO_Insert_Update_Delete($sql, $param);
    }

    /**
     * Permet de modifier un livre
     *
     * @param Livre $livre
     * @return integer (retourne 1 si réussi, sinon 0)
     */
    public static function update(Livre $livre): int
    {
        $sql = "UPDATE livre SET `nom` = ?, `annee` = ?, `description` = ?, `auteur`= ?, `vente`= ?, `idgenre`= ?, `image`= ? WHERE idlivre = ?)";
        $param = [$livre->getNom(), $livre->getAnnee(), $livre->getDescription(), $livre->getAuteur(), $livre->getVente(), $livre->getIdgenre(), $livre->getIdlivre()];
        return MonPdo::PDO_Insert_Update_Delete($sql, $param);
    }

    /**
     * Permet de supprimer un livre
     *
     * @param Livre $livre
     * @return integer
     */
    public static function delete(Livre $livre): int 
    {
        $sql = "DELETE FROM livre WHERE idlivre = ?)";
        $param = [$livre->getIdlivre()];
        return MonPdo::PDO_Insert_Update_Delete($sql, $param);
    }
}
