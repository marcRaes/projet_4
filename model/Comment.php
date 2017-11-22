<?php
// Classe Commentaire
class Comment
{
    // Attributs
    private $_id;
    private $_content;
    private $_dateTimeAdd;
    private $_idTicket;
    private $_idMember;
    private $_alert;

    // Le constructeur => Cette méthode permettra de créer un objet Commentaire à chaque instanciation de la classe
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

    // Setter ID => Modifie l'attribut correspondant à l'ID du commentaire
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

    // Setter content => Modifie l'attribut correspondant au contenu du commentaire
    public function setContent($content)
    {
        if(!is_string($content)) // S'il ne s'agit pas d'une chaine de caractères
        {
            trigger_error('Le contenu du commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        }

        $this->_content = $content;
    }

    // Setter dateTimeAdd => Modifie l'attribut correspondant à la date et l'heure d'ajout du commentaire
    public function setDateTimeAdd($dateTimeAdd)
    {
        $this->_dateTimeAdd = $dateTimeAdd;
    }

    // Setter id du chapitre => Modifie l'attribut correspondant à l'id du chapitre auquel appartient le commentaire
    public function setIdTicket($idTicket)
    {
        $idTicket = (int) $idTicket; // Force la conversion en nombre

        // Vérifie que ce nombre est positif
        if($idTicket > 0)
        {
            // Si c'est bon, on assigne la valeur à l'attribut correspondant
            $this->_idTicket = $idTicket;
        }
    }

    // Setter id du membre => Modifie l'attribut correspondant au membre ayant poster le commentaire
    public function setIdMember($idMember)
    {
        $idMember = (int) $idMember; // Force la conversion en nombre

        // Vérifie que ce nombre est positif
        if($idMember > 0)
        {
            // Si c'est bon, on assigne la valeur à l'attribut correspondant
            $this->_idMember = $idMember;
        }
    }

    // Getter id => Renvoie l'attribut correspondant à l'ID du commentaire
    public function id() { return $this->_id; }
    // Getter content => Renvoie l'attribut correspondant au contenu du commentaire
    public function content() { return $this->_content; }
    // Getter dateTimeAdd => Renvoie l'attribut correspondant à la date et l'heure d'ajout du commentaire
    public function dateTimeAdd() { return $this->_dateTimeAdd; }
    // Getter idTicket => Renvoie l'attribut correspondant à l'id du chapitre
    public function idTicket() { return $this->_idTicket; }
    // Getter idMember => Renvoie l'attribut correspondant à l'id du membre ayant poster le commentaires
    public function idMember() { return $this->_idMember; }
    // Getter alert => Renvoie l'attribut permettant de savoir si un commentaire à était signaler ou socket_set_nonblock
    public function alert() { return $this->_alert; }
}
