<?php
require_once('Model/Member.php');
require_once('Model/MemberManager.php');
require_once('View/Frontend/View.php');

class ControlerConnect
{
    private $_memberManager;

    public function __construct()
    {
        // Crée l'objet Manager
        $this->setMemberManager(new MemberManager()); // Manager du membre
    }

    // Méthode de connexion d'un membre
    function callConnectMember($post)
    {
        if((trim($post['emailAdress'])) && (trim($post['password'])))
        {
            // Crée le tableau de données du membre
            $dataMember = [
                'emailAdress' => htmlspecialchars($post['emailAdress']),
                'password' => htmlspecialchars($post['password'])
            ];

            if(filter_var($dataMember['emailAdress'], FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse mail est valide
            {
                if(strlen($dataMember['password']) >= 6) // Vérifie que le mot de passe posséde au moins 6 caractères
                {
                    // Crée l'objet membre
                    $member = new Member($dataMember);
                    // Appelle la méthode de connexion du membre
                    $stateConnection = $this->memberManager()->connectionMember($member);

                    if($stateConnection['emailAdress'] == $dataMember['emailAdress']) // L'adresse mail est reconnu
                    {
                        if(password_verify($dataMember['password'], $stateConnection['password'])) // Vérifie si le mot de passe est correcte
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
                            $_SESSION['erreurBlog'] = 'Mot de passe incorrecte'; // Retourne le message d'erreur
                        }
                    }
                    else
                    {
                        $_SESSION['erreurBlog'] = 'Adresse email non reconnu'; // Retourne le message d'erreur
                    }
                }
                else
                {
                    $_SESSION['erreurBlog'] = 'Le mot de passe doit faire au moins 6 caractères'; // Retourne le message d'erreur
                }
            }
            else
            {
                $_SESSION['erreurBlog'] = 'L\'adresse email saisi n\'est pas valide'; // Retourne le message d'erreur
            }
        }
        else
        {
            $_SESSION['erreurBlog'] = 'Votre adresse email ainsi que votre mot de passe sont obligatoire pour vous connecter';
        }
    }

    // Méthode qui envoie la vue de la connexion
    public function viewConnectMember()
    {
        $viewConnectMember = new View('Connect');

        $viewConnectMember->generate(array(''));
    }

    // Setter memberManager
    public function setMemberManager($memberManager) { $this->_memberManager = $memberManager; }
    // Getter memberManager
    public function memberManager() { return $this->_memberManager; }
}
