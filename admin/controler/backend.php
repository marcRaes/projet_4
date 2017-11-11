<?php
require 'model/backend.php';
require 'model/TicketsManager.php';
require 'model/Ticket.php';

function autorisationEntrer()
{
    if(isset($_SESSION['connexionMembre']) && (isset($_SESSION['statutMembre'])) && ($_SESSION['statutMembre'] == 'administrateur'))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function callGetTickets() {
    // Crée l'objet $manager
    $ticketsManager = new TicketsManager();
    // Appel la méthode de récupération des chapitres
    $dataTickets = $ticketsManager->getListTickets();
    
    // Récupération du dernier chapitre modifier
    $lastTicketmodify = $ticketsManager->getLastTicketModify();
    //$dernierChapitreModifier = getDernierChapitreModifier();

    // Affichage
    require 'view/backend/viewAdmin.php';
}

function callModifyAddTicket()
{
    if((trim($_POST['titreChapitre']) != false) || (trim($_POST['contenuChapitre']) != false))
    {
        date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
        $dateTime = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle

        // Ces conditions permmettent de vérifier si on souhaite modifier ou envoyer un nouveaux chapitre
        if(isset($_POST['ajoutChapitre']) && ($_POST['ajoutChapitre'] == 'ajouter')) // Si c'est un nouveau chapitre
        {
            // Crée le tableau de données du chapitre
            $dataTicket = [
                'title' => $_POST['titreChapitre'],
                'content' => $_POST['contenuChapitre'],
                'dateTimeAdd' => $dateTime,
            ];

            // Crée un nouvel objet du chapitre
            $ticket = new Ticket($dataTicket);
            // Appel la méthode d'ajout d'un chapitre dans le BDD
            $ticket->addTicket();
            
            // Redirection vers la premiére page de l'administration aprés l'ajout du chapitre
            header('Location:admin.php');
        }
        else if(isset($_POST['idChapitre'])) // Sinon on souhaite modifier un chapitre
        {
            // Crée le tableau de données du chapitre
            $dataTicket = [
                'id' => $_POST['idChapitre'],
                'title' => $_POST['titreChapitre'],
                'content' => $_POST['contenuChapitre'],
                'dateTimeLastModified' => $dateTime,
            ];

            // Crée un nouvel objet du chapitre
            $ticket = new Ticket($dataTicket);
            // Appel la méthode de modification d'un chapitre
            $ticket->modifyTicket();

            // Redirection vers la premiére page de l'administration aprés la modification du chapitre
            header('Location:admin.php');
        }
    }
    else
    {
        header('Location:admin.php');
    }
}

// Fonction de décision pour la modification ou l'ajout d'un chapitre
function callViewTickets()
{
    // Si l'URL posséde des paramétres => Demande de modification d'un chapitre
    if(($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET['id']) && (isset($_GET['modification']) && ($_GET['modification'] == 'on'))))
    {
        // Définition des variables de texte pour la modification d'un chapitre
        $titlePage = 'Modification d\'un chapitre - Billet simple pour l\'Alaska'; // Titre de la page
        $textTitleSection = 'Modification d\'un chapitre existant'; // Titre de la section
        $labelTitleTicket = 'Titre du chapitre :'; // Texte du label titre
        $labelContentTicket = 'Contenu du chapitre :'; // Texte du label contenu
        $valueButtonSend = 'Modifier le chapitre'; // Texte du bouton d'envoi

        // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
        $_GET['id'] = intval($_GET['id']);

        if($_GET['id'] != 0)
        {
            // Crée l'objet $manager
            $ticketsManager = new TicketsManager();
            // Appel la méthode de récupération d'un chapitre
            $dataTicket = $ticketsManager->getTicket($_GET['id']);
        }
        else
        {
            throw new Exception("Identifiant de chapitre incorrect");
        }
    }
    else
    {
        // Définition des variables de texte pour l'ajout d'un chapitre
        $titlePage = 'Ajout d\'un nouveaux chapitre - Billet simple pour l\'Alaska'; // Titre de la page
        $textTitleSection = 'Ajout d\'un nouveau chapitre'; // Titre de la section
        $labelTitleTicket = 'Titre du nouveau chapitre :'; // Texte du label titre
        $labelContentTicket = 'Contenu du nouveau chapitre :'; // Texte du label contenu
        $valueButtonSend = 'Ajouter le nouveaux chapitre'; // Texte du bouton d'envoi
    }

    require 'view/backend/viewTicket.php'; // Affichage
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
            require 'view/backend/viewComment.php';
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

    require 'view/backend/viewAdminSecure.php';
}

function suppressionBdd()
{
    // Crée l'objet $manager
    $ticketsManager = new TicketsManager();

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
                // Appel de la méthode de suppression d'un chapitre
                $ticketsManager->delete($_GET['id']);
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
                    // On appel la méthode autant de fois qu'il y'a de chapitres
                    $ticketsManager->delete($_POST['id'][$i]);
                }
                else
                {
                    throw new Exception("Identifiant de chapitre incorrect");
                }
            }
        }
    }
}