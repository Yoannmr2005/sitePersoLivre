<?php
class User
{

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
     * Set id de l'utilisateur
     *
     * @param  int  $idutilisateur  id de l'utilisateur
     *
     * @return  self
     */
    public function setIdutilisateur(int $idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;

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
        $sql = "SELECT `idutilisateur`, `nom`, `email`, `mdp`, `role` FROM utilisateur";
        $param = [];
        $query = MonPdo::dbRun($sql, $param);
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
    }

    /**
     * Trouve un utilisateur par son id
     *
     * @param integer $id
     * @return User
     */
    public static function findById(int $id): User
    {
        $sql = "SELECT `idutilisateur`, `nom`, `email`, `mdp`, `role` FROM utilisateur WHERE idutilisateur = ?";
        $param = [$id];
        $statement = MonPdo::getInstance()->prepare($sql);
        $statement->execute($param);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        return $statement->fetch();
    }

    /**
     * Permet d'ajouter un utilisateur
     *
     * @param User $user
     * @return void
     */
    public static function add(User $user)
    {
        $sql = "INSERT INTO utilisateur (`nom`, `email`, `mdp`, `role`) VALUES (?, ?, ?, ?)";
        $param = [$user->getNom(), $user->getEmail(), $user->getMdp(), $user->getRole()];
        $query = MonPdo::dbRun($sql, $param);
        return $query;
    }

    /**
     * Permet de modifier un utilisateur
     *
     * @param User $user
     * @return object
     */
    public static function update(User $user)
    {
        $sql = "UPDATE utilisateur SET `nom` = ?, `email` = ?, `mdp` = ?, `role` = ? WHERE idutilisateur = ?";
        $param = [$user->getNom(), $user->getEmail(), $user->getMdp(), $user->getRole(), $user->getIdutilisateur()];
        $query = MonPdo::dbRun($sql, $param);
        return $query;
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
        $query = MonPdo::dbRun($sql, $param);
        return $query;
    }

    /**
     * fonction qui verifie si les données de connexion sont correctes 
     *
     * @param string $nom
     * @param string $mdp
     * @return int
     */
    public static function VerifyConnect($nom, $mdp)
    {
        $dataUser = User::findAll();
        foreach ($dataUser as $user) {
            if ($user->nom == $nom && password_verify($mdp, $user->mdp) == true) {
                return $user->idutilisateur;
            }
        }
        return false;
    }

    /**
     * fonction qui détruit la séssion, nous déconnectons
     *
     * @return void
     */
    public static function Disconnect()
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            setcookie(session_name(), '', 0);
        }
        session_destroy();
        header("location: index.php");
        exit;
    }

    /**
     * Retourne true si le nom est déjà utilisé par un autre utilisateur, sinon false
     *
     * @param string $nom
     * @return bool
     */
    public static function NameAlreadyExists($nom)
    {
        $dataUser = User::findAll();
        foreach ($dataUser as $user) {
            if ($user->nom == $nom) {
                return true;
            }
        }
        return false;
    }

    /**
     * Retourne true si l'e-mail est déjà utilisé par un autre utilisateur, sinon false
     *
     * @param string $email
     * @return bool
     */
    public static function EmailAlreadyExists($email)
    {
        $dataUser = User::findAll();
        foreach ($dataUser as $user) {
            if ($user->email == $email) {
                return true;
            }
        }
        return false;
    }
}
