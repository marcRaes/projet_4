<?php
// Appel du controleur
require("Controleur/Controleur.php");

if($_SERVER["REQUEST_METHOD"] == "POST") // Si le formulaire à était envoyer
{
    // Ces conditions permmettent de vérifier si on souhaite modifier ou envoyer un nouveaux chapitre
    if(isset($_POST['ajoutChapitre']) && ($_POST['ajoutChapitre'] == 'ajouter')) // Si c'est un nouveau chapitre
    {
        // Appel de la fonction d'ajout d'un nouveau chapitre
        appelAjoutChapitre($_POST['titreChapitre'], $_POST['contenuChapitre']);
    }
    else if(isset($_POST['idChapitre'])) // Sinon on souhaite modifier un chapitre
    {
        // Appel la fonction de modification du chapitre dans la BDD
        appelModificationChapitre($_POST['idChapitre'], $_POST['titreChapitre'], $_POST['contenuChapitre']);
    }
}
else if($_SERVER["REQUEST_METHOD"] == "GET") // Sinon on souhaite modifier ou supprimer un chapitre existant
{
    if(isset($_GET['id']) && (isset($_GET['suppression']) && ($_GET['suppression'] == 'on'))) // Si on a demander la suppresion d'un chapitre
    {
        $_GET['id'] = intval($_GET['id']); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

        if($_GET['id'] != 0)
        {
            // Appel de la fonction de suppression d'un chapitre
            appelSuppressionChapitre($_GET['id']);
        }
        else
        {
            throw new Exception("Identifiant de chapitre incorrect");
        }
    }
    else if(isset($_GET['id'])) // Sinon si on désire modifier un chapitre existant
    {
        // Définition des variables de texte
        $texteTitreSection = 'Modification d\'un chapitre existant';
        $labelTitreChapitre = 'Titre du chapitre :';
        $valueBoutonEnvoi = 'Modifier le chapitre';

        $_GET['id'] = intval($_GET['id']); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

        if($_GET['id'] != 0)
        {
            // Appel de la fonction de récupération du chapitre pour la modification 
            $chapitre = appelRemplisageFormulaire($_GET['id']);
            // On ne fait pas de boucle foreach, le contenu de l'épisode sera récupérer sous l'array $chapitre[0]...
        }
        else
        {
            throw new Exception("Identifiant de chapitre incorrect");
        }
    }
}

// Appel la fonction de récupération des chapitres
try {
    $donneesChapitres = accueil();
    require 'Vue/vueAccueil.php'; // Affiche et execute le fichier vueAccueil.php
}
catch (Exception $e) { // En cas d'erreur
    $msgErreur = $e->getMessage();
    require 'Vue/vueErreur.php'; // Affiche et execute le fichier vueErreur.php
}