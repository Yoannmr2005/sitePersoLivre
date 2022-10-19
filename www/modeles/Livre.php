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
     * lien d'un audiobook
     *
     * @var string
     */
    private $lien;

    /**
     * nom du fichier pdf
     *
     * @var string
     */
    private $pdf;
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
     * Get lien d'un audiobook
     *
     * @return  string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set lien d'un audiobook
     *
     * @param  string  $lien  lien d'un audiobook
     *
     * @return  self
     */
    public function setLien(string $lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get nom du fichier pdf
     *
     * @return  string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set nom du fichier pdf
     *
     * @param  string  $pdf  nom du fichier pdf
     *
     * @return  self
     */
    public function setPdf(string $pdf)
    {
        $this->pdf = $pdf;

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
        $sql = "SELECT `idlivre`, `nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image`,`lien`,`pdf` FROM livre WHERE idlivre = ?;";
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
        $sql = "INSERT INTO livre (`nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image`, `lien`, `pdf`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $param = [$livre->getNom(), $livre->getAnnee(), $livre->getDescription(), $livre->getAuteur(), $livre->getVente(), $livre->getIdgenre(), $livre->getImage(), $livre->getLien(), $livre->getPdf()];
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
        $sql = "UPDATE livre SET `nom` = ?, `annee` = ?, `description` = ?, `auteur`= ?, `vente`= ?,`idgenre` = ?, `image`= ?, `lien` = ?, `pdf` = ? WHERE idlivre = ?";
        $param = [$livre->getNom(), $livre->getAnnee(), $livre->getDescription(), $livre->getAuteur(), $livre->getVente(), $livre->getIdgenre(), $livre->getImage(), $livre->getLien(), $livre->getPdf(), $livre->getIdlivre()];
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
        $sql = "DELETE FROM livre WHERE idlivre = ?";
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

    /**
     * Vérifie le fichier pdf envoyer dans le formulaire
     *
     * @param string $pdf_name
     * @param string $pdf_tmr_name
     * @return string
     */
    public static function VerifyPdf($pdf_name, $pdf_tmr_name)
    {
        $target_dir = "pdf/";
        // Récupère la destination du fichier (ex: pdf/batman.pdf)
        $target_file = $target_dir . $pdf_name;
        // Récupère l'extension de l'image dans le formulaire
        $pdfFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Regarde si le fichier existe
        if (file_exists($target_file)) {
            return "Ce pdf est déjà utilisée par un autre livre";
        }
        // Vérifie si le fichier est bien un fichier pdf
        if ($pdfFileType != "pdf") {
            return "Ce n'est pas un fichier pdf";
        }
        // ajoute le fichier pdf dans le dossier pdf, retourne un message s'il y a une erreur de téléchargement
        if (move_uploaded_file($pdf_tmr_name, $target_file) == false) {
            return "Erreur lors de l'ajout du fichier pdf";
        }
        return "ok";
    }

    /**
     * Vérifie le fichier image envoyer dans le formulaire
     *
     * @param string $img_name
     * @param string $img_tmp_name
     * @param object $dataLivre
     * @return string
     */
    public static function VerifyImage($img_name, $img_tmp_name, $dataLivre)
    {
        if ($img_name != "") {
            $target_dir = "img/";
            // récupère l'image à supprimer
            $filename = $target_dir . $dataLivre->getImage();
            // Récupère la destination du fichier (ex: img/batman.png)
            $target_file = $target_dir . $img_name;
            // Récupère l'extension de l'image dans le formulaire
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Regarde si le fichier existe
            if (file_exists($target_file)) {
                return "Cette image est déjà utilisée par un autre livre";
            }
            // Vérifie si le fichier est bien une image
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif") {
                return "L'extension du fihier n'est pas accépté (jpg, png, jpeg, gif ou jfif)";
            }
            // ajoute la nouvelle image dans le dossier img
            if (move_uploaded_file($img_tmp_name, $target_file) == false) {
                return "Erreur lors de l'upload de la nouvelle image";
            }
            // Récupère la taille de l'image
            $dimensions = getimagesize($target_file);
            // Vérifie la taille de l'image (nécessaire pour l'affichage)
            if (($dimensions[0] != "150") && ($dimensions[1] != "200")) {
                // Supprime la nouvelle image puisqu'elle n'est pas de la bonne taille
                unlink($target_file);
                return "La taille de l'image doit etre de 150x200 pixels";
            }
            // Supprime l'ancienne image dans le dossier img
            unlink($filename);
            $_SESSION["nomImage"] = $img_name;
            return "ok";
        } else {
            $_SESSION["nomImage"] = $dataLivre->getImage();
            return "ok";
        }
    }

    /**
     * Vérifie si le nom de livre en paramètre existe déjà dans la DB
     *
     * @param string $nom
     * @return boolean (true si il existe, sinon false)
     */
    public static function VerifyIfNameExist($nom)
    {
        $dataLivre = Livre::findAll();
        foreach ($dataLivre as $livre) {
            if ($livre->getNom() == $nom) {
                return true;
            }
        }
        return false;
    }

    /**
     * Récupère les livres du genre
     *
     * @param int $id
     * @return object
     */
    public static function GetAllBookOfGenre($id)
    {
        $sql = "SELECT `idlivre`, `nom`, `annee`, `description`, `auteur`, `vente`, `idgenre`, `image`, `lien`, `pdf` FROM livre WHERE `idgenre` = ?";
        $param = [$id];
        $query = MonPdo::dbRun($sql, $param);
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Livre');
    }

    /**
     * Supprime les img et les pdf des livres d'un genre qui va etre supprimé
     *
     * @param [type] $id
     * @return void
     */
    public static function DeleteImgAndPdfOfGenre($id)
    {
        // Récupère les données du livre avec son id
        $dataLivre = Livre::GetAllBookOfGenre($id);
        // var_dump($dataLivre);
        foreach ($dataLivre as $livre) {
            // Supprime le livre
            unlink("img/" . $livre->getImage());
            // Supprime le pdf
            unlink("pdf/" . $livre->getPdf());
        }
    }
}
