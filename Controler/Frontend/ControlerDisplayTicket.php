<?php
require_once('Controler/Controler.php');
require_once('Model/TicketsManager.php');
require_once('Model/CommentsManager.php');
require_once('Model/Comment.php');

class ControlerDisplayTicket extends Controler
{
    private $_ticketManager;
    private $_commentManager;

    public function __construct()
    {
        // Crée les objets Manager
        parent::__construct(); // Appelle le constructeur de la classe Controler
        $this->setTicketManager(new TicketsManager()); // Manager des chapitres
        $this->setCommentManager(new CommentsManager()); // Manager des commentaires
    }

    // Méthode de signalement d'un commentaire
    public function alertComment($idComment)
    {
        // Lance la méthode de signalement d'un commentaire
        $this->commentManager()->reportComment($idComment);
    }

    // Méthode d'ajout ou de connexion d'un membre avec ajout commentaire
    public function addMemberComment($idTicket, $emailAdress, $password, $comment)
    {
        if(isset($idTicket) && (trim($emailAdress)) && (trim($password)) && (trim($comment))) // Les champs ont bien était reçu et ne sont pas vide
        {
            // Crée le tableau de données du membre
            $dataMember = [
                'emailAdress' => htmlspecialchars($emailAdress),
                'password' => htmlspecialchars($password)
            ];

            $memberConnection = parent::connect($dataMember); // Appelle la méthode de connection de la classe Controler

            if($memberConnection != null)
            {
                if($memberConnection == 'Adresse email non reconnu')
                {
                    parent::registration($dataMember); // Appelle la méthode d'enregistrement de la classe Controler

                    // Appel la fonction d'ajout d'un nouveau commentaire
                    $this->addComment($comment, $idTicket, $_SESSION['idMember']);
                }
                else
                {
                    return $memberConnection;
                }
            }
            else
            {
                // Appel la fonction d'ajout d'un nouveau commentaire
                $this->addComment($comment, $idTicket, $_SESSION['idMember']);
            }
        }
        else
        {
            return 'Tous les champs doivent étre rempli !';
        }
    }

    // Méthode d'ajout d'un commentaire
    public function addComment($contentComment, $idTicket, $idMember)
    {
        date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
        $dateTime = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle

        // Crée le tableau de données du commentaire
        $dataComment = [
            'content' => $contentComment,
            'dateTimeAdd' => $dateTime,
            'idTicket' => $idTicket,
            'idMember' => $idMember
        ];

        // Crée l'objet Commentaire
        $comment = new Comment($dataComment);
        // Appelle la méthode d'ajout du commentaire
        $this->commentManager()->add($comment);

        // Renvoie l'utilisateur sur la derniere page enregistrer
        header("Location: $_SERVER[HTTP_REFERER]");
    }

    // Méthode de récupération du chapitre et de ses commentaires
    public function displayTicket($idTicket)
    {
        // Appelle la méthode de récupération d'un chapitre
        $ticket = $this->ticketManager()->getTicket($idTicket);

        // Appelle la méthode de récupération des commentaires du chapitre
        $commentsTicket = $this->commentManager()->getListCommentsTicket($idTicket);

        $viewDisplayTicket = new View('DisplayTicket');

        $viewDisplayTicket->generate(array(
            'ticket' => $ticket,
            'commentsTicket' => $commentsTicket
        ));
    }

    // Setter ticketManager
    public function setTicketManager($ticketManager) { $this->_ticketManager = $ticketManager; }
    // Getter ticketManager
    public function ticketManager() { return $this->_ticketManager; }

    // Setter commentManager
    public function setCommentManager($commentManager) { $this->_commentManager = $commentManager; }
    // Getter commentManager
    public function commentManager() { return $this->_commentManager; }
}
