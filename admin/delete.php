<?php
session_start();

require('controler/backend.php'); // Appel le controleur

if(autorisationEntrer())
{
    suppressionBdd();
}
else // L'autorisation n'a pas était approuver on affiche le formulaire de connexion de l'administration
{
    adminSecure();
}

// Renvoie l'utilisateur sur la page d'accueil de l'administration
header('Location:admin.php');