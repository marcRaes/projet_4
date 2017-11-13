<?php
require_once('model/frontend.php');
require_once('model/TicketsManager.php');
require_once('model/Ticket.php');
require_once('model/CommentsManager.php');
require_once('model/Comment.php');
require_once('model/Member.php');
require_once('model/MemberManager.php');

// Fonction qui permet de lancer la récupération des chapitres
function callGetTickets()
{
    // Récupération de tous les chapitres
    $dataTickets = Ticket::displayListTickets();

    // Récupération du dernier chapitre modifier
    $lastTicketmodify = Ticket::displayLastTicketsModify();

    // Affichage
    require 'view/frontend/viewIndex.php';
}

function callConnectMember()
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if((trim($_POST['adresseMail'])) && (trim($_POST['motDePasse'])))
        {
            // Convertit les caractères spéciaux des champs
            $_POST['adresseMail'] = htmlspecialchars($_POST['adresseMail']);
            $_POST['motDePasse'] = htmlspecialchars($_POST['motDePasse']);
    
            // Appel de la fonction de connexion d'un membre
            $etatConnexion = connexionMembre($_POST['adresseMail'], $_POST['motDePasse']);
        }
        else
        {
            $etatConnexion = 'Votre adresse E-Mail ainsi que votre mot de passe sont obligatoire pour vous connecter !';
        }
    }

    require 'view/frontend/viewConnect.php';
}

function callRegistrationMember()
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if((trim($_POST['adresseMail'])) && (trim($_POST['adresseMailConfirmation'])) && (trim($_POST['motDePasse'])) && (trim($_POST['motDePasseConfirmation'])))
        {
            // Convertit les caractères spéciaux des champs
            $_POST['adresseMail'] = htmlspecialchars($_POST['adresseMail']);
            $_POST['adresseMailConfirmation']= htmlspecialchars($_POST['adresseMailConfirmation']);
            $_POST['motDePasse'] = htmlspecialchars($_POST['motDePasse']);
            $_POST['motDePasseConfirmation'] = htmlspecialchars($_POST['motDePasseConfirmation']);
    
            $etatInscription = verificationChampsConfirmation($_POST['adresseMail'], $_POST['adresseMailConfirmation'], $_POST['motDePasse'], $_POST['motDePasseConfirmation']);
            if($etatInscription)
            {
                $etatInscription = verificationChampsInscription($_POST['adresseMail'], $_POST['motDePasse']);
                if($etatInscription)
                {
                    // Tout les champs ont était correctement rempli
                    // On enregistre le nouveau membre dans la BDD
                    $etatInscription = inscriptionMembre($_POST['adresseMail'], $_POST['motDePasse']);
                    if($etatInscription)
                    {
                        header('Location:index.php'); // Redirige le membre vars la page d'accueil
                    }
                }
            }
    
            // Vérification des champs d'inscription
            // En cas d'erreur celle-ci sera retourner dans la variable $etatInscription
            // Sinon le membre sera automatiquement enregistrer
            //$etatInscription = verificationChampsFormulaireInscription($_POST['adresseMail'], $_POST['adresseMailConfirmation'], $_POST['motDePasse'], $_POST['motDePasseConfirmation']);
        }
        else
        {
            $etatInscription = 'Les champs ne peuvent pas être vides !';
        }
    }

    require 'view/frontend/viewRegistration.php';
}

function callGetDisplayTicket()
{
    if(($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET['id']))) // Récupére l'ID du chapitre à partir de l'URL
    {
        // Appelle la méthode de récupération d'un chapitre
        $TicketAsk = Ticket::displayTicket($_GET['id']);
    }
    else
    {
        //header('Location:index.php'); // Si l'ID est absent de l'URL on redirige le membre vers la page d'accueil
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") // Si le formulaire à était envoyer
    {
        if(isset($_POST['idChapitre']) && (trim($_POST['adresseMail'])) && (trim($_POST['motDePasse'])) && (trim($_POST['commentaire']))) // Les champs ont bien était reçu et ne sont pas vide
        {
            // Sécurise l'identifiant et le mot de passe
            $_POST['adresseMail'] = htmlspecialchars($_POST['adresseMail']);
            $_POST['motDePasse'] = htmlspecialchars($_POST['motDePasse']);
    
            $etatInscription = verificationChampsInscription($_POST['adresseMail'], $_POST['motDePasse']);
        }
        else
        {
            $etatInscription = 'Tous les champs doivent étre rempli !';
        }
    }

    require 'view/frontend/viewDisplayTicket.php';
}