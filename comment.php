<?php 
session_start(); // Active les sessions

require('controler/backend.php'); // Appel le fichier de fonctions

// Vérifie si un membre est connecter et si il a le bon statut pour administrer le blog
if(isset($_SESSION['status']) && ($_SESSION['status'] == 'administrateur'))
{
    // Lance une méthode de reconnection du membre avec vérification de la session enregistrer
    if(autorisationEntrer($_SESSION))
    {
        if(isset($_GET['approve']) && ($_GET['approve'] == 'on'))
        {
            callApproveComment($_GET['id']);
        }
    
        // Le controleur se charge de récupérer et d'envoyer la liste des commentaires à la vue
        try
        {
            if($_SERVER["REQUEST_METHOD"] == "GET")
            {
                if(isset($_GET['comment']))
                {
                    callGetComments();
                }
                else if(isset($_GET['nbComments']))
                {
                    AlertComments();
                }
            }
            else
            {
                header('Location:admin.php');
            }
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