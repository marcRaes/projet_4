<?php 
session_start(); // Active les sessions

require('Controleur/Controleur.php'); // Appel le controleur

if(isset($_SESSION['connexionMembre']) && (isset($_SESSION['statutMembre'])) && ($_SESSION['statutMembre'] == 'administrateur'))
{
    if($_SERVER["REQUEST_METHOD"] == "POST") // Si le formulaire à était envoyer
    {
        // Le controleur se charge d'appeler les fonctions pour modifier ou ajouter un chapitre dans la BDD
        try
        {
            appelModifierAjouterChapitre();
        }
        catch(Exception $e)
        {
            $msgErreur = $e->getMessage();
            require 'Vue/vueErreur.php';
        }
        
    }

    // Le controleur s'occupe de savoir si l'utilisateur souhaite ajouter ou modifier un chapitre
    try
    {
        appelVueChapitres();
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