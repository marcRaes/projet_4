<?php
session_start();

require('controler/backend.php'); // Appel le controleur

// Vérifie si un membre est connecter et si il a le bon statut pour administrer le blog
if(isset($_SESSION['status']) && ($_SESSION['status'] == 'administrateur'))
{
    // Lance une méthode de reconnection du membre avec vérification de la session enregistrer
    if(autorisationEntrer($_SESSION))
    {
        deleteBdd();
    }
}
else // L'autorisation n'a pas était approuver on affiche le formulaire de connexion de l'administration
{
    header('Location:admin.php');
}

// Renvoie l'utilisateur sur la derniere page enregistrer
header("Location: $_SERVER[HTTP_REFERER]");