<?php
/*On cache en attendant de pouvoir résoudre l'erreur fatale...
function loadClass($classe)
{
  require_once($classe . '.php'); // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
*/

require_once('model/TicketsManager.php');
require_once('model/Ticket.php');
require_once('model/CommentsManager.php');
require_once('model/Comment.php');
require_once('model/Member.php');
require_once('model/MemberManager.php');

function autorisationEntrer()
{
    if(isset($_SESSION['connectionMember']) && (isset($_SESSION['statusMember'])) && ($_SESSION['statusMember'] == 'administrateur'))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

// Fonction de connexion
function adminSecure()
{
    if($_SERVER["REQUEST_METHOD"] == "POST") // Si le formulaire à était envoyer
    {
        if(trim($_POST['emailAdress']) && (trim($_POST['password'])))
        {
            // Crée le tableau de données du membre
            $dataMember = [
                'emailAdress' => htmlspecialchars($_POST['emailAdress']),
                'password' => htmlspecialchars($_POST['password'])
            ];

            // Crée l'objet membre
            $objectMember = new Member($dataMember);
            // Appelle la méthode de connexion du membre
            $etatConnexion = $objectMember->callConnectionMemberAdmin();

            if($etatConnexion['emailAdress'] == $_POST['emailAdress'])
            {
                if(password_verify($_POST['password'], $etatConnexion['password'])) // Vérifie si le mot de passe est correcte
                {
                    if($etatConnexion['status'] == 'administrateur')
                    {
                        $_SESSION['connectionMember'] = $etatConnexion['id'];
                        $_SESSION['statusMember'] = 'administrateur';
                        header('Location:admin.php');
                    }
                    else
                    {
                        $msgConnexion = 'Vous n\'étes pas autoriser à administrer le Blog';
                    }
                }
                else
                {
                    $msgConnexion = 'Mot de passe incorrecte';
                }
            }
            else
            {
                $msgConnexion = 'L\'adresse email saisi est incorrecte';
            }
        }
    }
    else if(isset($_SESSION['connectionMember']) && (isset($_SESSION['statusMember'])) && ($_SESSION['statusMember'] == 'administrateur'))
    {
        header('Location:admin.php');
    }

    require 'view/backend/viewAdminSecure.php';
}

// Fonction qui permet de lancer la récupération des chapitres
function callGetTickets() {
    // Récupération de tous les chapitres
    $dataTickets = Ticket::displayListTickets();

    // Récupération du dernier chapitre modifier
    $lastTicketmodify = Ticket::displayLastTicketsModify();

    // Affichage
    require 'view/backend/viewAdmin.php';
}

// Appel des méthodes pour modifier ou envoyer un chapitre
function callModifyAddTicket()
{
    if((trim($_POST['titreChapitre']) != false) || (trim($_POST['contenuChapitre']) != false))
    {
        date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
        $dateTime = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle

        // Ces conditions permettent de vérifier si on souhaite modifier ou envoyer un nouveaux chapitre
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
            // Appel la méthode de récupération d'un chapitre
            $dataTicket = Ticket::displayTicket($_GET['id']);
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

// Appel la méthode de récupération des commentaires d'un chapitre
function callGetComments()
{
    if(($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET['comment']) && ($_GET['comment'] == "on") && (isset($_GET['id'])) && (isset($_GET['nbComments']))))
    {
        // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
        $_GET['id'] = intval($_GET['id']);
        $_GET['nbComments'] = intval($_GET['nbComments']);
        
        if($_GET['id'] != 0)
        {
            // Appel la méthode de récupération des commentaires d'un chapitre
            $dataComments = Comment::callGetListCommentsTicket($_GET['id']);

            require 'view/backend/viewComment.php';
        }
        else
        {
            throw new Exception("Identifiant de commentaire incorrect");
        }
    }
}

// Fonction qui permettra de récuperer les commentaires signaler
function AlertComments()
{
    $dataComments = Comment::callGetListCommentsAlert();

    require 'view/backend/viewComment.php';
}

// Fonction qui lance la méthode de calcul du nombre de commentaires signaler
function nbAlertComments()
{
    return count(Comment::callGetListCommentsAlert());
}

// Fonction qui permettra d'approuver un commentaire
function callApproveComment($id)
{
    $id = intval($id); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

    if($id != 0)
    {
        Comment::approveComment($id);
    }
    else
    {
        throw new Exception("Identifiant de commentaire incorrect");
    }
}

// Fonction de suppression d'un chapitre ou d'un commentaire
function deleteBdd()
{
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_GET['suppressionCommentaire']) && (isset($_GET['id'])) && ($_GET['suppressionCommentaire'] == 'on'))
        {
            $_GET['id'] = intval($_GET['id']); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

            if($_GET['id'] != 0)
            {
                // Appel de la méthode de suppression d'un commentaire
                Comment::deleteComment($_GET['id']);
            }
            else
            {
                throw new Exception("Identifiant de commentaire incorrect");
            }
        }
        else if(isset($_GET['suppressionChapitre']) && (isset($_GET['id'])) && ($_GET['suppressionChapitre'] == 'on'))
        {
            $_GET['id'] = intval($_GET['id']); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

            if($_GET['id'] != 0)
            {
                // Appel de la méthode de suppression d'un chapitre
                Ticket::deleteTicket($_GET['id']);
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
                    Ticket::deleteTicket($_POST['id'][$i]);
                }
                else
                {
                    throw new Exception("Identifiant de chapitre incorrect");
                }
            }
        }
    }
}