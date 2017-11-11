<?php
// Classe Commentaire
class Comment
{
    // Attribut
    private $_dataComment; // Tableau de données

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

    // Setter contenu => Modifie l'attribut correspondant au contenu du commentaire
    public function setContent($content)
    {
        //
    }

    // Setter dateHeureAjout => Modifie l'attribut correspondant à la date et l'heure d'ajout du commentaire
    public function setDateTimeAdd($dateTimeAdd)
    {
        //
    }

    // Setter id du chapitre => Modifie l'attribut correspondant à l'id du chapitre auquel appartient le commentaire
    public function setIdTicket($idTicket)
    {
        //
    }
}