<?php
require_once('Model/Member.php');
require_once('Model/MemberManager.php');
require_once('View/Frontend/View.php');

class ControlerRegistration
{
    private $_memberManager;

    public function __construct()
    {
        // Crée l'objet Manager
        $this->setMemberManager(new MemberManager()); // Manager du membre
    }

    // Méthode d'inscription d'un membre
    public function registrationMember($post)
    {
        if((trim($post['emailAdress'])) && (trim($post['emailAdressConfirmation'])) && (trim($post['password'])) && (trim($post['passwordConfirmation'])))
        {
            // Convertit les caractères spéciaux des champs
            $post['emailAdress'] = htmlspecialchars($post['emailAdress']);
            $post['emailAdressConfirmation']= htmlspecialchars($post['emailAdressConfirmation']);
            $post['password'] = htmlspecialchars($post['password']);
            $post['passwordConfirmation'] = htmlspecialchars($post['passwordConfirmation']);

            if(filter_var($post['emailAdress'], FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse mail est valide
            {
                if($post['emailAdress'] == $post['emailAdressConfirmation']) // L'adresse mail est confirmer
                {
                    if($post['password'] == $post['passwordConfirmation']) // Le mot de passe est confirmer
                    {
                        if(strlen($post['password']) >= 6) // Le mot de passe posséde au moins 6 caractères
                        {
                            // Crée le tableau de données du membre
                            $dataMember = [
                                'emailAdress' => $post['emailAdress'],
                                'password' => $post['password']
                            ];

                            // Crée l'objet membre
                            $member = new Member($dataMember);
                            // Appelle la méthode de connexion du membre
                            $stateRegistration = $this->memberManager()->connectionMember($member);

                            if($stateRegistration['emailAdress'] != $dataMember['emailAdress']) // Si aucun membre n'est inscrit avec cette adresse email
                            {
                                $dataMember['password'] = password_hash($dataMember['password'], PASSWORD_DEFAULT); // Hash le mot de passe

                                // Crée l'objet membre
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
                                $_SESSION['statusMember'] = $connectionMember['status'];

                                // Redirige le nouveaux membre vers index.php
                                header('Location:index.php');
                            }
                            else
                            {
                                $_SESSION['erreurBlog'] = 'Un membre est déja inscrit avec cette adresse email'; // Retourne le message d'erreur
                            }
                        }
                        else
                        {
                            $_SESSION['erreurBlog'] = 'Le mot de passe doit faire au moins 6 caractères'; // Retourne le message d'erreur
                        }
                    }
                    else
                    {
                        $_SESSION['erreurBlog'] = 'Merci de confirmer votre mot de passe'; // Retourne le message d'erreur
                    }
                }
                else
                {
                    $_SESSION['erreurBlog'] = 'Merci de confirmer votre adresse email'; // Retourne le message d'erreur
                }
            }
            else
            {
                $_SESSION['erreurBlog'] = 'L\'adresse email saisi n\'est pas valide'; // Retourne le message d'erreur
            }
        }
        else
        {
            $_SESSION['erreurBlog'] = 'Les champs ne peuvent pas être vides !'; // Retourne le message d'erreur
        }
    }

    public function viewRegistrationMember()
    {
        $viewRegistrationMember = new View('Registration');

        $viewRegistrationMember->generate(array(''));
    }

    // Setter memberManager
    public function setMemberManager($memberManager) { $this->_memberManager = $memberManager; }
    // Getter memberManager
    public function memberManager() { return $this->_memberManager; }
}
