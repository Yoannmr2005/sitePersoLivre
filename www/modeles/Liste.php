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
}


?>