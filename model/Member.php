<?php
require_once('Model.php');

// Classe Membre
class Member extends Model
{
    // Attributs
    private $_id;
    private $_emailAdress;
    private $_password;
    private $_status;

    // Le constructeur => Cette méthode permettra de créer un objet Membre à chaque instanciation de la classe
    public function __construct(array $donnees)
    {
        parent::__construct($donnees);
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

    // Getter id => Renvoie l'attribut id du membre
    public function id()
    {
        return $this->_id;
    }

    // Getter emailAdress => Renvoie l'adresse email du Membre
    public function emailAdress()
    {
        return $this->_emailAdress;
    }

    // Getter password => Renvoie le mot de passe du Membre
    public function password()
    {
        return $this->_password;
    }

    // Getter status => Renvoie le statut du Membre
    public function status()
    {
        return $this->_status;
    }
}
