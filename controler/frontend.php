<?php
// Permet d'instancier une classe automatiquement
function loadClass($classe)
{
  require_once('model/' . $classe . '.php'); // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

/*
require_once('model/frontend.php');
require_once('model/TicketsManager.php');
require_once('model/Ticket.php');
require_once('model/CommentsManager.php');
require_once('model/Comment.php');
require_once('model/Member.php');
require_once('model/MemberManager.php');
*/

// Fonction qui lance la récupération des chapitres
function callGetTickets()
{
    // Récupération de tous les chapitres
    $dataTickets = Ticket::displayListTickets();

    // Récupération du dernier chapitre modifier
    $lastTicketmodify = Ticket::displayLastTicketsModify();

    // Affichage
    require 'view/frontend/viewIndex.php';
}

// Fonction de connexion d'un membre
function callConnectMember()
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if((trim($_POST['emailAdress'])) && (trim($_POST['password'])))
        {
            // Convertit les caractères spéciaux des champs
            $_POST['emailAdress'] = htmlspecialchars($_POST['emailAdress']);
            $_POST['password'] = htmlspecialchars($_POST['password']);

            if(filter_var($_POST['emailAdress'], FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse mail est valide
            {
                if(strlen($_POST['password']) >= 6) // Vérifie que le mot de passe posséde au moins 6 caractères
                {
                    // Crée le tableau de données du membre
                    $dataMember = [
                        'emailAdress' => $_POST['emailAdress'],
                        'password' => $_POST['password']
                    ];

                    // Crée l'objet membre
                    $objectMember = new Member($dataMember);
                    // Appelle la méthode de connexion du membre
                    $stateConnection = $objectMember->callConnectionMember();

                    if($stateConnection['emailAdress'] == $_POST['emailAdress']) // L'adresse mail est reconnu
                    {
                        if(password_verify($_POST['password'], $stateConnection['password'])) // Vérifie si le mot de passe est correcte
                        {
                            // Enregistre l'id du membre dans une session afin de le connecter automatiquement
                            $_SESSION['idMember'] = $stateConnection['id'];
                            // Garde l'adresse email du membre dans une session
                            $_SESSION['emailAdress'] = $stateConnection['emailAdress'];
                            // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog
                            $_SESSION['statusMember'] = $stateConnection['status'];

                            // Redirige le membre vers index.php
                            header('Location:index.php');
                        }
                        else
                        {
                            $msgConnection = 'Mot de passe incorrecte'; // Retourne le message d'erreur
                        }
                    }
                    else
                    {
                        $msgConnection = 'Adresse email non reconnu'; // Retourne le message d'erreur
                    }
                }
                else
                {
                    $msgConnection = 'Le mot de passe doit faire au moins 6 caractères'; // Retourne le message d'erreur
                }
            }
            else
            {
                $msgConnection = 'L\'adresse email saisi n\'est pas valide'; // Retourne le message d'erreur
            }
        }
        else
        {
            $msgConnection = 'Votre adresse email ainsi que votre mot de passe sont obligatoire pour vous connecter';
        }
    }

    require 'view/frontend/viewConnect.php';
}

// Fonction d'enregistrement d'un membre
function callRegistrationMember()
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if((trim($_POST['emailAdress'])) && (trim($_POST['emailAdressConfirmation'])) && (trim($_POST['password'])) && (trim($_POST['passwordConfirmation'])))
        {
            // Convertit les caractères spéciaux des champs
            $_POST['emailAdress'] = htmlspecialchars($_POST['emailAdress']);
            $_POST['emailAdressConfirmation']= htmlspecialchars($_POST['emailAdressConfirmation']);
            $_POST['password'] = htmlspecialchars($_POST['password']);
            $_POST['passwordConfirmation'] = htmlspecialchars($_POST['passwordConfirmation']);

            if(filter_var($_POST['emailAdress'], FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse mail est valide
            {
                if($_POST['emailAdress'] == $_POST['emailAdressConfirmation']) // L'adresse mail est confirmer
                {
                    if($_POST['password'] == $_POST['passwordConfirmation']) // Le mot de passe est confirmer
                    {
                        if(strlen($_POST['password']) >= 6) // Le mot de passe posséde au moins 6 caractères
                        {
                            // Crée le tableau de données du membre
                            $dataMember = [
                                'emailAdress' => $_POST['emailAdress'],
                                'password' => $_POST['password']
                            ];

                            // Crée l'objet membre
                            $objectMember = new Member($dataMember);
                            // Appelle la méthode de connexion du membre
                            $stateRegistration = $objectMember->callConnectionMember();

                            if($stateRegistration['emailAdress'] != $_POST['emailAdress']) // Si aucun membre n'est inscrit avec cette adresse email
                            {
                                $dataMember['password'] = password_hash($dataMember['password'], PASSWORD_DEFAULT); // Hash le mot de passe

                                // Crée l'objet membre
                                $objectMember = new Member($dataMember);
                                // Appelle la méthode d'ajout du membre
                                $objectMember->callAddMember();
                                // Appelle la méthode de connexion du membre
                                $connectionMember = $objectMember->callConnectionMember();

                                // Enregistre l'id du membre dans une session afin de le connecter automatiquement
                                $_SESSION['idMember'] = $connectionMember['id'];
                                // Garde l'adresse email du membre dans une session
                                $_SESSION['emailAdress'] = $connectionMember['emailAdress'];
                                // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog
                                $_SESSION['statusMember'] = $connectionMember['status'];

                                // Redirige le nouveaux membre vers index.php
                                header('Location:index.php');
                            }
                            else
                            {
                                $msgRegistration = 'Un membre est déja inscrit avec cette adresse email'; // Retourne le message d'erreur
                            }
                        }
                        else
                        {
                            $msgRegistration = 'Le mot de passe doit faire au moins 6 caractères'; // Retourne le message d'erreur
                        }
                    }
                    else
                    {
                        $msgRegistration = 'Merci de confirmer votre mot de passe'; // Retourne le message d'erreur
                    }
                }
                else
                {
                    $msgRegistration = 'Merci de confirmer votre adresse email'; // Retourne le message d'erreur
                }
            }
            else
            {
                $msgRegistration = 'L\'adresse email saisi n\'est pas valide'; // Retourne le message d'erreur
            }
        }
        else
        {
            $msgRegistration = 'Les champs ne peuvent pas être vides !'; // Retourne le message d'erreur
        }
    }

    require 'view/frontend/viewRegistration.php';
}

// Fonction de récupération d'un chapitre
function callGetDisplayTicket()
{
    if(($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET['id']))) // Récupére l'ID du chapitre à partir de l'URL
    {
        // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
        $_GET['id'] = intval($_GET['id']);

        if($_GET['id'] != 0)
        {
            // Appelle la méthode de récupération d'un chapitre
            $ticketAsk = Ticket::displayTicket($_GET['id']);

            // Appelle la méthode de récupération des commentaire du chapitre
            $commentsTicketAsk = Comment::callGetListCommentsTicket($_GET['id']);
        }
        else
        {
            throw new Exception("Identifiant de chapitre incorrect");
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") // Un formulaire à était envoyer
    {
        if(isset($_POST['reportComment']) && ($_POST['reportComment'] == 'reportComment')) // Un Lecteur à signaler un commentaire
        {
            alertComment($_POST['idComment']);
        }

        if(isset($_POST['publicationComment']) && ($_POST['publicationComment'] == 'publicationComment')) // Un lecteur souhaite publier un commentaire
        {
            postComment($_POST['idTicket'], $_POST['emailAdress'], $_POST['password'], $_POST['comment']);
        }
    }

    require 'view/frontend/viewDisplayTicket.php';
}

// Fonction de signalement d'un Commentaire
function alertComment($idComment)
{
    if(isset($idComment))
    {
        $idComment = intval($idComment); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

        if($idComment != 0)
        {
            // Lance la méthode de signalement d'un commentaire
            Comment::callReportComment($idComment);

            // Renvoie l'utilisateur sur la derniere page enregistrer
            header("Location: $_SERVER[HTTP_REFERER]");
        }
        else
        {
            throw new Exception("Identifiant de commentaire incorrect");
        }
    }
}

// Fonction de publication d'un nouveau Commentaire
function postComment($idTicket, $emailAdress, $password, $comment)
{
    if(isset($idTicket) && (trim($emailAdress)) && (trim($password)) && (trim($comment))) // Les champs ont bien était reçu et ne sont pas vide
    {
        // Sécurise l'identifiant et le mot de passe
        $emailAdress = htmlspecialchars($emailAdress);
        $password = htmlspecialchars($password);

        if(filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse mail est valide
        {
            if(strlen($password) >= 6) // Vérifie que le mot de passe posséde au moins 6 caractères
            {
                // Crée le tableau de données du membre
                $dataMember = [
                    'emailAdress' => $emailAdress,
                    'password' => $password
                ];

                // Crée l'objet membre
                $objectMember = new Member($dataMember);
                // Appelle la méthode de connexion du membre => Les données reçu permettront de vérifier si le membre existe dans la BDD
                $stateConnection = $objectMember->callConnectionMember();

                if($stateConnection['emailAdress'] != $emailAdress) // Le membre n'est pas inscrit
                {
                    $dataMember['password'] = password_hash($dataMember['password'], PASSWORD_DEFAULT); // Hash le mot de passe

                    // Crée l'objet membre
                    $objectMember = new Member($dataMember);
                    // Appelle la méthode d'ajout du membre
                    $objectMember->callAddMember();
                    // Appelle la méthode de connexion du membre
                    $connectionMember = $objectMember->callConnectionMember();

                    // Enregistre l'id du membre dans une session afin de le connecter automatiquement
                    $_SESSION['idMember'] = $connectionMember['id'];
                    // Garde l'adresse email du membre dans une session
                    $_SESSION['emailAdress'] = $connectionMember['emailAdress'];
                    // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog
                    $_SESSION['statusMember'] = $connectionMember['status'];
                }
                else // Un membre existe sous la même adresse email
                {
                    if(password_verify($_POST['password'], $stateConnection['password'])) // Le mot de passe est correcte => Connexion du membre
                    {
                        // Enregistre l'id du membre dans une session afin de le connecter automatiquement
                        $_SESSION['idMember'] = $stateConnection['id'];
                        // Garde l'adresse email du membre dans une session
                        $_SESSION['emailAdress'] = $stateConnection['emailAdress'];
                        // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog
                        $_SESSION['statusMember'] = $stateConnection['status'];
                    }
                }
                if(isset($_SESSION['idMember']))
                {
                    // Appel la fonction d'ajout d'un nouveau commentaire
                    callAddComment($comment, $idTicket,  $_SESSION['idMember']);
                }
            }
            else
            {
                $msgPublicationComment = 'Le mot de passe doit faire au moins 6 caractères'; // Retourne le message d'erreur
            }
        }
        else
        {
            $msgPublicationComment = 'L\'adresse email saisi n\'est pas valide'; // Retourne le message d'erreur
        }
    }
    else
    {
        $msgPublicationComment = 'Tous les champs doivent étre rempli !';
    }
}

// Fonction d'ajout d'un nouveau commentaire
function callAddComment($content, $idTicket, $idMember)
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
    $objectComment = new Comment($dataComment);
    $objectComment->addComment();

    // Renvoie l'utilisateur sur la derniere page enregistrer
    header("Location: $_SERVER[HTTP_REFERER]");
}
