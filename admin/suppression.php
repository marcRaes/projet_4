<?php
session_start();

require('Controleur/Controleur.php'); // Appel le controleur

if(isset($_SESSION['connexionMembre']) && (isset($_SESSION['statutMembre'])) && ($_SESSION['statutMembre'] == 'administrateur'))
{
    suppressionBdd();
}
else // L'autorisation n'a pas était approuver on affiche le formulaire de connexion de l'administration
{
    adminSecure();
}

// Renvoie l'utilisateur sur la page d'accueil de l'administration
header('Location:admin.php');