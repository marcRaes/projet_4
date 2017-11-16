<?php
session_start(); // Active les sessions

require('controler/backend.php'); // Appel le controleur

// Vérifie si un membre est connecter et si il a le bon statut pour administrer le blog
if(isset($_SESSION['status']) && ($_SESSION['status'] == 'administrateur'))
{
    // Lance une méthode de reconnection du membre avec vérification de la session enregistrer
    if(autorisationEntrer($_SESSION))
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
}
else // L'autorisation n'a pas était approuver on redirige vers l'administration
{
    header('Location:admin.php');
}
