<?php 
session_start(); // Active les sessions

require('controler/backend.php'); // Appel le fichier de fonctions

if(autorisationEntrer())
{
    if(isset($_GET['approve']) && ($_GET['approve'] == 'on'))
    {
        callApproveComment($_GET['id']);
    }
    else
    {
        // Sauvegarde l'URL courante de la page pour la redirection aprés une suppression
        $_SESSION['urlCurrent'] = $_SERVER["REQUEST_URI"];
    }

    // Le controleur se charge de récupérer et d'envoyer la liste des commentaires à la vue
    try
    {
        if(isset($_GET['comment']))
        {
            callGetComments();
        }
        else if(isset($_GET['nbComments']))
        {
            AlertComments();
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
else // L'autorisation n'a pas était approuver on affiche le formulaire de connexion de l'administration
{
    adminSecure();
}