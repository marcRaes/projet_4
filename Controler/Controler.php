<?php
require_once('Model/MemberManager.php');
require_once('Model/Member.php');

class Controler
{
    private $_memberManager;

    public function __construct()
    {
        // Crée l'objet Manager
        $this->setMemberManager(new MemberManager()); // Manager du membre
    }

    // Méthode de connexion d'un membre
    public function connect($dataMember)
    {
        if(filter_var($dataMember['emailAdress'], FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse mail est valide
        {
            if(strlen($dataMember['password']) >= 6) // Vérifie que le mot de passe posséde au moins 6 caractères
            {
                // Crée l'objet membre
                $member = new Member($dataMember);
                // Appelle la méthode de connexion du membre
                $memberConnection = $this->memberManager()->connectionMember($member);

                if($memberConnection) // L'adresse email est reconnu
                {
                    if(password_verify($dataMember['password'], $memberConnection->password())) // Vérifie si le mot de passe est correcte
                    {
                        // Enregistre l'id du membre dans une session afin de le connecter automatiquement
                        $_SESSION['idMember'] = $memberConnection->id();
                        // Garde l'adresse email du membre dans une session
                        $_SESSION['emailAdress'] = $memberConnection->emailAdress();
                        // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog
                        $_SESSION['statusMember'] = $memberConnection->status();
                    }
                    else
                    {
                        return 'Mot de passe incorrecte'; // Retourne le message d'erreur
                    }
                }
                else
                {
                    return 'Adresse email non reconnu'; // Retourne le message d'erreur
                }
            }
            else
            {
                return 'Le mot de passe doit faire au moins 6 caractères'; // Retourne le message d'erreur
            }
        }
        else
        {
            return 'L\'adresse email saisi n\'est pas valide'; // Retourne le message d'erreur
        }
    }

    public function registration($dataMember)
    {
        $dataMember['password'] = password_hash($dataMember['password'], PASSWORD_DEFAULT); // Hash le mot de passe

        // Crée l'objet membre
        $member = new Member($dataMember);
        // Appelle la méthode d'ajout du membre
        $lastId = $this->memberManager()->addMember($member);

        // Enregistre l'id du membre dans une session afin de le connecter automatiquement
        $_SESSION['idMember'] = $lastId;
        // Garde l'adresse email du membre dans une session
        $_SESSION['emailAdress'] = $member->emailAdress();
        // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog
        $_SESSION['statusMember'] = $member->status();
    }

    // Setter memberManager
    public function setMemberManager($memberManager) { $this->_memberManager = $memberManager; }
    // Getter memberManager
    public function memberManager() { return $this->_memberManager; }
}
