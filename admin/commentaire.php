<?php 
session_start(); // Active les sessions

require('Controleur/Controleur.php'); // Appel le fichier de fonctions

if(isset($_SESSION['connexionMembre']) && (isset($_SESSION['statutMembre'])) && ($_SESSION['statutMembre'] == 'administrateur'))
{
    // Le controleur se charge de récupérer et d'envoyer la liste des commentaires à la vue
    try
    {
        appelGetCommentaires();
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