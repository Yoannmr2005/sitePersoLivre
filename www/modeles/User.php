<?php

/**
 * Auteur : Yoann Meier
 * Site de livre
 * Version : 3.0
 * Page : class User
 */
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
     * @return object
     */
    public static function delete(User $user)
    {
        $sql = "DELETE FROM utilisateur WHERE idutilisateur = ?";
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

    /**
     * Vérifie les données d'inscription, si tout est ok ajoute un compte dans la DB
     *
     * @param string $nom
     * @param string $email
     * @param string $mdp
     * @param string $role
     * @return string
     */
    public static function VerifyDataInscription($nom, $email, $mdp, $role)
    {
        $addUser = new User();
        if ($nom && $email && $mdp) {
            if (User::NameAlreadyExists($nom) == false) {
                if (User::EmailAlreadyExists($email) == false) {
                    // Hash le mot de passe
                    $hash = password_hash($mdp, PASSWORD_BCRYPT);
                    // set les valeur des variables de la classe
                    $addUser->setNom($nom);
                    $addUser->setEmail($email);
                    $addUser->setMdp($hash);
                    $addUser->setRole($role);
                    // Ajoute l'utilisateur
                    User::add($addUser);
                    return "ok";
                } else {
                    return "L'e-mail est déjà utilisée par un autre utilisateur";
                }
            } else {
                return "Le nom est déjà utilisée par un autre utilisateur";
            }
        } else {
            return "Il manque une donnée";
        }
    }

    /**
     * Vérifie les informations du formulaire de modification des informations du compte
     *
     * @param [type] $nom
     * @param [type] $email
     * @param [type] $ancienMdp
     * @param [type] $nouveauMdp
     * @return void
     */
    public static function VerifyDataModifCompte($nom, $email, $ancienMdp, $nouveauMdp)
    {
        $infoCompteModification = new User();
        $infoCompteModification = User::findById($_SESSION["idutilisateur"]);
        // Vérifie si les champs obligatoires sont remplies
        if ($nom && $email && $ancienMdp) {
            // Vérifie si l'ancien mot de passe est correcte
            if (password_verify($ancienMdp, $infoCompteModification->getMdp())) {
                // Modifier le nom et l'e-mail si le champs nouveau mdp est vide 
                if ($nouveauMdp != "") {
                    // Verifie si le nouveau mot de passe est identique à l'ancien
                    if ($ancienMdp != $nouveauMdp) {
                        // Modifier le nom, l'e-mail et le mot de passe
                        $modifierAvecMdp = new User();
                        $modifierAvecMdp->setNom($nom);
                        $modifierAvecMdp->setEmail($email);
                        $modifierAvecMdp->setMdp(password_hash($nouveauMdp, PASSWORD_BCRYPT));
                        $modifierAvecMdp->setRole($infoCompteModification->getRole());
                        $modifierAvecMdp->setIdutilisateur($_SESSION["idutilisateur"]);
                        User::update($modifierAvecMdp);
                        return "ok";
                    } else {
                        return "Le nouveau mot de passe est identique à l'ancien";
                    }
                } else {
                    // Modifier le nom et l'e-mail
                    $modifierSansMdp = new User();
                    $modifierSansMdp->setNom($nom);
                    $modifierSansMdp->setEmail($email);
                    // Remet l'ancien mot de passe
                    $modifierSansMdp->setMdp($infoCompteModification->getMdp());
                    $modifierSansMdp->setRole($infoCompteModification->getRole());
                    $modifierSansMdp->setIdutilisateur($_SESSION["idutilisateur"]);
                    User::update($modifierSansMdp);
                    return "ok";
                }
            } else {
                return "L'ancien mot de passe est incorrect";
            }
        } else {
            return "Il manque une ou plusieurs donnée(s)";
        }
    }

    public static function VerifyDataConnect($nom, $mdp)
    {
        if ($mdp && $nom) {
            // Vérifie si l'utilisateur existe et récupère l'id
            $iduser = User::VerifyConnect($nom, $mdp);
            if ($iduser != "") {
                // Stocke l'id dans la session
                $_SESSION["idutilisateur"] = $iduser;
                // Permet de récupérer les données de l'utilisateur connecté, utile pour obtenir le role et le stocké dans la session
                $userConnected = User::findById($iduser);
                if ($userConnected->getRole() == "utilisateur") {
                    $_SESSION["compte"]["utilisateur"] = 1;
                    $_SESSION["compte"]["admin"] = 0;
                } else {
                    $_SESSION["compte"]["utilisateur"] = 0;
                    $_SESSION["compte"]["admin"] = 1;
                }
                return "ok";
            } else {
                return "Erreur de nom ou de mot de passe";
            }
        } else {
            return "Il manque une donnée";
        }
    }

    /**
     * Vérifie si un compte utilisateur est connecté
     *
     * @return boolean (true si connecté, sinon false)
     */
    public static function isUserConnected()
    {
        return ($_SESSION["compte"]["utilisateur"] == 1) ? true : false;
    }

    /**
     * Vérifie si un compte admin est connecté
     *
     * @return boolean (true si connecté, sinon false)
     */
    public static function isAdminConnected()
    {
        return ($_SESSION["compte"]["admin"] == 1) ? true : false;
    }

    /**
     * Vérifie si la personne n'est pas connecté
     *
     * @return boolean (true si non connecté, sinon false)
     */
    public static function isNotConnected()
    {
        return ($_SESSION["compte"]["utilisateur"] == 0 && $_SESSION["compte"]["admin"] == 0) ? true : false;
    }

    /**
     * Permet de rediriger vers l'index
     *
     * @return void
     */
    public static function GoToIndex()
    {
        header("location: index.php");
        exit;
    }
}
