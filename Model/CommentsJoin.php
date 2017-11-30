<?php
class CommentsJoin extends Model
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
        parent::__construct($donnees);
    }

    // Setter idComment => Modifie l'attribut correspondant à l'ID du commentaire
    public function setIdComment($idComment)
    {
        $idComment = (int) $idComment; // Force la conversion en nombre

        // Vérifie que ce nombre est positif
        if($idComment > 0)
        {
            $this->_idComment = $idComment;
        }
    }

    // Setter dateTimeAddComment => Modifie l'attribut correspondant à la date et l'heure d'ajout du commentaire
    public function setDateTimeAddComment($dateTimeAddComment) { $this->_dateTimeAddComment = $dateTimeAddComment; }

    // Setter contentComment => Modifie l'attribut correspondant au contenu du commentaire
    public function setContentComment($contentComment)
    {
        if(!is_string($contentComment)) // S'il ne s'agit pas d'une chaine de caractères
        {
            trigger_error('Le contenu du commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        }

        $this->_contentComment = $contentComment;
    }

    // Setter alertComment => Modifie l'attribut correspondant au signalement d'un commentaire
    public function setAlertComment($alertComment) { $this->_alertComment = $alertComment; }

    // Setter mailMember => Modifie l'attribut correspondant au mail du membre ayant poster le commentaire
    public function setMailMember($mailMember) { $this->_mailMember = $mailMember; }

    // Setter titleTicket => Modifie l'attribut correspondant au titre du chapitre ayant reçu un commentaire
    public function setTitleTicket($titleTicket)
    {
        if(!is_string($titleTicket)) // S'il ne s'agit pas d'une chaine de caractères
        {
            trigger_error('Le titre du chapitre doit être une chaine de caractères', E_USER_WARNING);
            return;
        }

        $this->_titleTicket = $titleTicket;
    }

    // Setter idTicket => Modifie l'attribut correspondant à l'id du chapitre
    public function setIdTicket($idTicket)
    {
        $idTicket = (int) $idTicket; // Force la conversion en nombre

        // Vérifie que ce nombre est positif
        if($idTicket > 0)
        {
            $this->_idTicket = $idTicket;
        }
    }

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
