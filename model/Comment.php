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
        //
    }

    // Méthode d'hydratation de l'objet
    public function hydrate(array $donnees)
    {
        //
    }

    // Setter ID => Modifie l'attribut correspondant à l'ID du commentaire
    public function setId($id)
    {
        //
    }

    // Setter content => Modifie l'attribut correspondant au contenu du commentaire
    public function setContent($content)
    {
        //
    }

    // Setter dateTimeAdd => Modifie l'attribut correspondant à la date et l'heure d'ajout du commentaire
    public function setDateTimeAdd($dateTimeAdd)
    {
        //
    }

    // Setter id du chapitre => Modifie l'attribut correspondant à l'id du chapitre auquel appartient le commentaire
    public function setIdTicket($idTicket)
    {
        //
    }

    // Setter id du membre => Modifie l'attribut correspondant au membre ayant poster le commentaire
    public function setIdMember($idMember)
    {
        //
    }

    // Getter id => Renvoie l'attribut correspondant à l'ID du commentaire
    public function id()
    {
        //
    }

    // Getter content => Renvoie l'attribut correspondant au contenu du commentaire
    public function content()
    {
        //
    }

    // Getter dateTimeAdd => Renvoie l'attribut correspondant à la date et l'heure d'ajout du commentaire
    public function dateTimeAdd()
    {
        //
    }

    // Méthode d'ajout d'un commentaire
    public function addComment()
    {
        //
    }

    // méthode de modification d'un commentaire
    public function modifyComment()
    {
        //
    }

    // Méthode de suppression d'un commentaire
    public static function deleteComment($idComment)
    {
        (new CommentsManager)->delete($idComment);
    }

    // Méthode d'affichage des commentaires
    public function displayListComment()
    {
        //
    }

    // Méthode de récupération de tous les commentaires d'un chapitre
    public static function callGetListCommentsTicket($idTicket)
    {
        return (new CommentsManager)->getListCommentsTicket($idTicket);
    }

    // Méthode de récupération des commentaires signaler
    public static function callGetListCommentsAlert()
    {
        return (new CommentsManager)->getListCommentsAlert();
    }

    // Méthode qui permet d'approuver un commentaire
    public static function approveComment($id)
    {
        (new CommentsManager)->approve($id);
    }
}