<?php 
session_start(); // Active les sessions

require('controler/backend.php'); // Appel le controleur

if(autorisationEntrer())
{
    if($_SERVER["REQUEST_METHOD"] == "POST") // Si le formulaire à était envoyer
    {
        // Le controleur se charge d'appeler les méthodes pour modifier ou ajouter un chapitre dans la BDD
        callModifyAddTicket();
        
    }

    // Le controleur s'occupe de savoir si l'utilisateur souhaite ajouter ou modifier un chapitre
    try
    {
        callViewTickets();
    }
    catch(Exception $e)
    {
        $msgErreur = $e->getMessage();
        require 'view/backend/viewError.php';
    }

}
else // L'autorisation n'a pas était approuver on affiche le formulaire de connexion de l'administration
{
    adminSecure();
}