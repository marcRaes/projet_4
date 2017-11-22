<?php
require_once('Model/TicketsManager.php');
require_once('Model/CommentsManager.php');
require_once('Model/MemberManager.php');
require_once('Model/Comment.php');

class ControlerDisplayTicket
{
    private $_ticketManager;
    private $_commentManager;
    private $_memberManager;

    public function __construct()
    {
        // Crée les objets Manager
        $this->setTicketManager(new TicketsManager()); // Manager des chapitres
        $this->setCommentManager(new CommentsManager()); // Manager des commentaires
        $this->setMemberManager(new MemberManager()); // Manager membre
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

    // Méthode de signalement d'un commentaire
    public function alertComment($idComment)
    {
        // Lance la méthode de signalement d'un commentaire
        $this->commentManager()->reportComment($idComment);

        // Renvoie l'utilisateur sur la derniere page enregistrer
        header("Location: $_SERVER[HTTP_REFERER]");
    }

    // Méthode qui teste la connexion d'un membre connecter avec une SESSION
    public function testMember($idTicket, $emailAdress, $idMember, $comment)
    {
        if(filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse email est valide
        {
            // Crée le tableau de données du membre
            $dataMember = [
                'emailAdress' => htmlspecialchars($emailAdress),
            ];

            // Crée l'objet Membre
            $member = new Member($dataMember);
            // Appelle la méthode de connexion du membre => Les données reçu permettront de vérifier si le membre existe dans la BDD
            $stateConnection = $this->memberManager()->connectionMember($member);

            // Le membre existe dans la BDD
            if($stateConnection['emailAdress'] == $emailAdress)
            {
                // Appelle la méthode d'ajout d'un commentaire
                $this->addComment($comment, $idTicket, $idMember);
            }
        }
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

            if(filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse email est valide
            {
                if(strlen($password) >= 6) // Vérifie que le mot de passe posséde au moins 6 caractères
                {
                    if(isset($_SESSION['errorBlog'])) { unset($_SESSION['errorBlog']); }
                    // Crée l'objet membre
                    $member = new Member($dataMember);
                    // Appelle la méthode de connexion du membre => Les données reçu permettront de vérifier si le membre existe dans la BDD
                    $stateConnection = $this->memberManager()->connectionMember($member);

                    if($stateConnection['emailAdress'] != $emailAdress) // Le membre n'est pas inscrit
                    {
                        $dataMember['password'] = password_hash($dataMember['password'], PASSWORD_DEFAULT); // Hash le mot de passe

                        // Crée l'objet membre avec le mot de passe Hasher
                        $member = new Member($dataMember);
                        // Appelle la méthode d'ajout du membre
                        $this->memberManager()->addMember($member);
                        // Appelle la méthode de connexion du membre
                        $connectionMember = $this->memberManager()->connectionMember($member);

                        // Enregistre l'id du membre dans une session afin de le connecter automatiquement
                        $_SESSION['idMember'] = $connectionMember['id'];
                        // Garde l'adresse email du membre dans une session
                        $_SESSION['emailAdress'] = $connectionMember['emailAdress'];
                        // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog
                        $_SESSION['status'] = $connectionMember['status'];
                    }
                    else // Un membre existe sous la même adresse email
                    {
                        if(password_verify($password, $stateConnection['password'])) // Le mot de passe est correcte => Connexion du membre
                        {
                            // Enregistre l'id du membre dans une session afin de le connecter automatiquement
                            $_SESSION['idMember'] = $stateConnection['id'];
                            // Garde l'adresse email du membre dans une session
                            $_SESSION['emailAdress'] = $stateConnection['emailAdress'];
                            // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog
                            $_SESSION['status'] = $stateConnection['status'];
                        }
                    }
                    if(isset($_SESSION['idMember']))
                    {
                        // Appel la fonction d'ajout d'un nouveau commentaire
                        $this->addComment($comment, $idTicket,  $_SESSION['idMember']);
                    }
                }
                else
                {
                    $_SESSION['errorPostComment'] = 'Le mot de passe doit faire au moins 6 caractères'; // Retourne le message d'erreur
                }
            }
            else
            {
                $_SESSION['errorPostComment'] = 'L\'adresse email saisi n\'est pas valide'; // Retourne le message d'erreur
            }
        }
        else
        {
            $_SESSION['errorPostComment'] = 'Tous les champs doivent étre rempli !';
        }
        // Renvoie l'utilisateur sur la derniere page enregistrer
        header("Location: $_SERVER[HTTP_REFERER]");
    }

    // Méthode d'ajout d'un commentaire
    private function addComment($content, $idTicket, $idMember)
    {
        date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
        $dateTime = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle

        // Crée le tableau de données du commentaire
        $dataComment = [
            'content' => $content,
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

    // Setter ticketManager
    public function setTicketManager($ticketManager) { $this->_ticketManager = $ticketManager; }
    // Getter ticketManager
    public function ticketManager() { return $this->_ticketManager; }

    // Setter commentManager
    public function setCommentManager($commentManager) { $this->_commentManager = $commentManager; }
    // Getter commentManager
    public function commentManager() { return $this->_commentManager; }

    // Setter memberManager
    public function setMemberManager($memberManager) { $this->_memberManager = $memberManager; }
    // Getter memberManager
    public function memberManager() { return $this->_memberManager; }
}
