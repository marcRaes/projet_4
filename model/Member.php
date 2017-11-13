<?php
// Classe Membre
class Member
{
    // Attributs
    private $_id;
    private $_emailAdress;
    private $_password;
    private $_status;

    // Le constructeur => Cette méthode permettra de créer un objet Membre à chaque instanciation de la classe
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    // Méthode d'hydratation de l'objet
    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value)
        {
            // Le nom de la méthode à appeler sera determiner par la clé de l'array $donnees
            // La premiére lettre de la clé sera transformer en majuscule avec "ucfirst"
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method)) // Vérifie que le setter à appeler existe
            {
                // Appelle le setter
                $this->$method($value);
            }
        }
    }

    // Setter ID => Modifie l'attribut correspondant à l'ID du membre
    public function setId($id)
    {
        $id = (int) $id; // Force la conversion en nombre
        
        // Vérifie que ce nombre est positif
        if($id > 0)
        {
            // Si c'est bon, on assigne la valeur à l'attribut correspondant
            $this->_id = $id;
        }
    }

    // Setter emailAdress => Modifie l'attribut correspondant à l'adresse email du membre
    public function setEmailAdress($emailAdress)
    {
        if(!filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) // S'il ne s'agit pas d'une chaine de caractères
        {
            trigger_error('L\'adresse email saisi n\'est pas valide', E_USER_WARNING);
            return;
        }

        $this->_emailAdress = $emailAdress;
    }

    // Setter password => Modifie l'attribut correspondant au mot de passe du membre
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    // Setter status => Modifie l'attribut correspondant au statut du membre
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    // Méthode d'ajout d'un nouveau membre
    public function addMember()
    {
        //
    }

    // Méthode de connexion d'un membre sur l'espace administration
    public function callConnectionMemberAdmin()
    {
        // Crée l'objet $manager
        $memberManager = new MemberManager();
        return $memberManager->connectionMemberAdmin($this->_emailAdress);
    }
}