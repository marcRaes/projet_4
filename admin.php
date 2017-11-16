<?php
session_start(); // Active les sessions

require_once('controler/backend.php'); // Appel le controleur

// Vérifie si un membre est connecter et si il a le bon statut pour administrer le blog
if(isset($_SESSION['status']) && ($_SESSION['status'] == 'administrateur'))
{
    // Lance une méthode de reconnection du membre avec vérification de la session enregistrer
    if(autorisationEntrer($_SESSION))
    {
        // Appel des fonctions et insertion du fichier "vueAdmin.php" avec une gestion des erreurs
        try
        {
            callGetTickets();
        }
        catch(Exception $e)
        {
            $msgErreur = $e->getMessage();
            require 'view/backend/viewError.php';
        }
    }
}
else // L'autorisation n'a pas était approuver on affiche le formulaire de connexion de l'administration
{
    adminSecure();
}