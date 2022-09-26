<?php
class User {

    /**
     * id de l'utilisateur
     *
     * @var int
     */
    private $idutilisateur;

    /**
     * Nom de l'utilisateur
     *
     * @var string
     */
    private $nom;

    /**
     * E-mail de l'utilsiateur
     *
     * @var string
     */
    private $email;

    /**
     * Mot de passe de l'utilisateur (hash)
     *
     * @var string
     */
    private $mdp;

    /**
     * role de l'utilisateur (utilisateur ou admin)
     *
     * @var string
     */
    private $role;

    /**
     * Get the value of idutilisateur
     */ 
    public function getIdutilisateur()
    {
        return $this->idutilisateur;
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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of mdp
     */ 
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     *
     * @return  self
     */ 
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

     /**
     * Retourne tous les utilisateurs
     *
     * @return User[]
     */
    public static function findAll(): array
    {
        return MonPdo::PDO_Select_All("SELECT `idutilisateur`, `nom`, `email`, `mdp`, `role` FROM utilisateur", []);
    }

    /**
     * Trouve un utilisateur par son id
     *
     * @param integer $id
     * @return User
     */
    public static function findById(int $id): User
    {
        return MonPdo::PDO_Select("SELECT `idutilisateur`, `nom`, `email`, `mdp`, `role` FROM utilisateur WHERE idutilisateur = ?", [$id]);
    }

    /**
     * Permet d'ajouter un utilisateur
     *
     * @param User $user
     * @return integer
     */
    public static function add(User $user): int
    {
        $sql = "INSERT INTO genre (`nom`, `email`, `mdp`, `role`) VALUES (?, ?, ?, ?)";
        $param = [$user->getNom(), $user->getEmail(), $user->getMdp(), $user->getRole()];
        return MonPdo::PDO_Insert_Update_Delete($sql, $param);
    }

    /**
     * Permet de modifier un utilisateur
     *
     * @param User $user
     * @return integer
     */
    public static function update(User $user): int
    {
        $sql = "UPDATE genre SET `nom` = ?, `email` = ?, `mdp` = ?, `role` = ? WHERE idutilisateur = ?)";
        $param = [$user->getNom(), $user->getEmail(), $user->getMdp(), $user->getRole(), $user->getIdutilisateur()];
        return MonPdo::PDO_Insert_Update_Delete($sql, $param);
    }

    /**
     * Permet de supprimer un utilisateur
     *
     * @param User $user
     * @return integer
     */
    public static function delete(User $user): int 
    {
        $sql = "DELETE FROM utilisateur WHERE idutilisateur = ?)";
        $param = [$user->getIdutilisateur()];
        return MonPdo::PDO_Insert_Update_Delete($sql, $param);
    }
}