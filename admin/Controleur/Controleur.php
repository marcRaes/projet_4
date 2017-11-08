<?php
require 'Modele/ModeleAdmin.php';

function appelGetChapitres() {
    // Récupération des chapitres
    $donneesChapitres = getChapitres();
    
    // Récupération du dernier chapitre modifier
    $dernierChapitreModifier = getDernierChapitreModifier();

    // Affichage
    require 'Vue/vueAdmin.php';
}

function appelModifierAjouterChapitre()
{
    // Ces conditions permmettent de vérifier si on souhaite modifier ou envoyer un nouveaux chapitre
    if(isset($_POST['ajoutChapitre']) && ($_POST['ajoutChapitre'] == 'ajouter')) // Si c'est un nouveau chapitre
    {
        // Appel de la fonction d'ajout d'un nouveau chapitre
        ajoutChapitre($_POST['titreChapitre'], $_POST['contenuChapitre']);
    }
    else if(isset($_POST['idChapitre'])) // Sinon on souhaite modifier un chapitre
    {
        // Appel la fonction de modification du chapitre dans la BDD
        modifierChapitre($_POST['idChapitre'], $_POST['titreChapitre'], $_POST['contenuChapitre']);
    }
}

function appelVueChapitres()
{
    // Si l'URL posséde des paramétres => Demande de modification d'un chapitre
    if(($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET['id']) && (isset($_GET['modification']) && ($_GET['modification'] == 'on'))))
    {
        // Définition des variables de texte pour la modification d'un chapitre
        $titrePage = 'Modification d\'un chapitre - Billet simple pour l\'Alaska'; // Titre de la page
        $texteTitreSection = 'Modification d\'un chapitre existant'; // Titre de la section
        $labelTitreChapitre = 'Titre du chapitre :'; // Texte du label titre
        $labelContenuChapitre = 'Contenu du chapitre :'; // Texte du label contenu
        $valueBoutonEnvoi = 'Modifier le chapitre'; // Texte du bouton d'envoi

        // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
        $_GET['id'] = intval($_GET['id']);

        if($_GET['id'] != 0)
        {
            // Appel de la fonction de récupération du chapitre pour la modification 
            $chapitre = getModifierChapitre($_GET['id']);
            // On ne fait pas de boucle foreach, le contenu de l'épisode sera récupérer sous l'array $chapitre[0]...
        }
        else
        {
            throw new Exception("Identifiant de chapitre incorrect");
        }
    }
    else
    {
        // Définition des variables de texte pour l'ajout d'un chapitre
        $titrePage = 'Ajout d\'un nouveaux chapitre - Billet simple pour l\'Alaska'; // Titre de la page
        $texteTitreSection = 'Ajout d\'un nouveau chapitre'; // Titre de la section
        $labelTitreChapitre = 'Titre du nouveau chapitre :'; // Texte du label titre
        $labelContenuChapitre = 'Contenu du nouveau chapitre :'; // Texte du label contenu
        $valueBoutonEnvoi = 'Ajouter le nouveaux chapitre'; // Texte du bouton d'envoi
    }

    require 'Vue/vueChapitre.php'; // Affichage
}

function appelGetCommentaires()
{
    if(($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET['commentaire']) && ($_GET['commentaire'] == "on") && (isset($_GET['id'])) && (isset($_GET['nbCommentaire']))))
    {
        // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
        $_POST['idChapitre'] = intval($_GET['id']);
        $_POST['nbCommentaire'] = intval($_GET['nbCommentaire']);
        
        if($_POST['idChapitre'] != 0)
        {
            // On appel la fonction de récupération des commentaires d'un chapitre
            $donneesCommentaire = getCommentaires($_POST['idChapitre']);
            require 'Vue/vueCommentaire.php';
        }
        else
        {
            throw new Exception("Identifiant de chapitre incorrect");
        }
    }
}

function adminSecure()
{
    if($_SERVER["REQUEST_METHOD"] == "POST") // Si le formulaire à était envoyer
    {
        if(trim($_POST['adresseMail']) && (trim($_POST['motDePasse'])))
        {
            $etatConnexion = connexionAdmin($_POST['adresseMail'], $_POST['motDePasse']);
        }
    }
    else if(isset($_SESSION['connexionMembre']) && (isset($_SESSION['statutMembre'])) && ($_SESSION['statutMembre'] == 'administrateur'))
    {
        header('Location:admin.php');
    }

    require 'Vue/vueAdminSecure.php';
}

function suppressionBdd()
{
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_GET['suppressionCommentaire']) && (isset($_GET['id'])) && ($_GET['suppressionCommentaire'] == 'on'))
        {
            $_GET['id'] = intval($_GET['id']); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

            if($_GET['id'] != 0)
            {
                // Appel de la fonction de suppression d'un commentaire
                supprimerCommentaire($_GET['id']);
            }
            else
            {
                throw new Exception("Identifiant de chapitre incorrect");
            }
        }
        else if(isset($_GET['suppressionChapitre']) && (isset($_GET['id'])) && ($_GET['suppressionChapitre'] == 'on'))
        {
            $_GET['id'] = intval($_GET['id']); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

            if($_GET['id'] != 0)
            {
                // Appel de la fonction de suppression d'un commentaire
                supprimerChapitre($_GET['id']);
            }
            else
            {
                throw new Exception("Identifiant de chapitre incorrect");
            }
        }
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['suppressionChapitre']) && (isset($_POST['id'])) && (is_array($_POST['id'])) && ($_POST['suppressionChapitre'] == 'on'))
        {
            for($i = 0; $i < count($_POST['id']); $i++)
            {
                $_POST['id'][$i] = intval($_POST['id'][$i]); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
        
                if($_POST['id'][$i] != 0)
                {
                    // On appel la fonction autant de fois qu'il y'a de chapitres
                    supprimerChapitre($_POST['id'][$i]);
                }
                else
                {
                    throw new Exception("Identifiant de chapitre incorrect");
                }
            }
        }
    }
}