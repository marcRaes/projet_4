<?php
session_start(); // Active les sessions

require('Controleur/Controleur.php'); // Appel le controleur

// Vérifie si un membre est connecter et si il a le bon statut pour administrer le blog
if(isset($_SESSION['connexionMembre']) && (isset($_SESSION['statutMembre'])) && ($_SESSION['statutMembre'] == 'administrateur'))
{
    // Appel des fonctions et insertion du fichier "vueAdmin.php" avec une gestion des erreurs
    try
    {
        appelGetChapitres();
    }
    catch(Exception $e)
    {
        $msgErreur = $e->getMessage();
        require 'Vue/vueErreur.php';
    }
}
else // L'autorisation n'a pas était approuver on affiche le formulaire de connexion de l'administration
{
    adminSecure();
}