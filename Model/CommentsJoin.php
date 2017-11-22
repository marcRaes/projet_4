<?php
class CommentsJoin
{
    // Attributs
    private $_idComment;
    private $_dateTimeAddComment;
    private $_contentComment;
    private $_alertComment;
    private $_mailMember;
    private $_titleTicket;
    private $_idTicket;

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

    // Setter idComment => Modifie l'attribut correspondant à l'ID du commentaire
    public function setIdComment($idComment) { $this->_idComment = $idComment; }
    // Setter dateTimeAddComment => Modifie l'attribut correspondant à la date et l'heure d'ajout du commentaire
    public function setDateTimeAddComment($dateTimeAddComment) { $this->_dateTimeAddComment = $dateTimeAddComment; }
    // Setter contentComment => Modifie l'attribut correspondant au contenu du commentaire
    public function setContentComment($contentComment) { $this->_contentComment = $contentComment; }
    // Setter alertComment => Modifie l'attribut correspondant au signalement d'un commentaire
    public function setAlertComment($alertComment) { $this->_alertComment = $alertComment; }
    // Setter mailMember => Modifie l'attribut correspondant au mail du membre ayant poster le commentaire
    public function setMailMember($mailMember) { $this->_mailMember = $mailMember; }
    // Setter titleTicket => Modifie l'attribut correspondant au titre du chapitre ayant reçu un commentaire
    public function setTitleTicket($titleTicket) { $this->_titleTicket = $titleTicket; }
    // Setter idTicket => Modifie l'attribut correspondant à l'id du chapitre
    public function setIdTicket($idTicket) { $this->_idTicket = $idTicket; }

    // Getter idComment => Renvoie l'attribut correspondant à l'ID du commentaire
    public function idComment() { return $this->_idComment; }
    // Getter dateTimeAddComment => Renvoie l'attribut correspondant à la date et l'heure d'ajout du commentaire
    public function dateTimeAddComment() { return $this->_dateTimeAddComment; }
    // Getter contentComment => Renvoie l'attribut correspondant au contenu du commentaire
    public function contentComment() { return $this->_contentComment; }
    // Getter alertComment => Renvoie l'attribut correspondant au signalement d'un commentaire
    public function alertComment() { return $this->_alertComment; }
    // Getter mailMember => Renvoie l'attribut correspondant au mail du membre ayant poster le commentaire
    public function mailMember() { return $this->_mailMember; }
    // Getter titleTicket => Renvoie l'attribut correspondant au titre du chapitre ayant reçu un commentaire
    public function titleTicket() { return $this->_titleTicket; }
    // Getter idTicket => Renvoie l'attribut correspondant à l'id du chapitre
    public function idTicket() { return $this->_idTicket; }
}
