<?php 
session_start(); // Active les sessions

require('controler/backend.php'); // Appel le fichier de fonctions

if(autorisationEntrer())
{
    // Le controleur se charge de récupérer et d'envoyer la liste des commentaires à la vue
    try
    {
        appelGetCommentaires();
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