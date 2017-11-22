<?php
require_once('Model/Member.php');
require_once('Model/MemberManager.php');
require_once('View/Backend/View.php');

class ControlerAdminSecure
{
    private $_memberManager;

    // Le controleur instanciera le manager dédié au membre
    public function __construct()
    {
        $this->setMemberManager(new MemberManager()); // Crée l'objet Manager
    }

    public function adminSecure()
    {
        $adminSecure = new View('AdminSecure');
        $adminSecure->generate(array(''));
    }

    // Méthode qui permet de savoir si le membre à l'autorisation d'administrer le blog
    public function autorizationEnter($sessionMember)
    {
        if(isset($sessionMember['id']) && (isset($sessionMember['emailAdress'])) && (isset($sessionMember['status'])))
        {
            $dataMember = [
                'id' => $sessionMember['id'],
                'emailAdress' => $sessionMember['emailAdress'],
                'status' => $sessionMember['status']
            ];

            // Crée l'objet membre
            $member = new Member($dataMember);
            // Appelle la méthode de connexion du membre
            $stateConnection = $this->memberManager()->connectionMember($member);

            // S'assure que les données de la session sont les même que celle contenu dans la BDD
            if(($stateConnection['id'] == $dataMember['id']) && ($stateConnection['emailAdress'] == $dataMember['emailAdress']) && ($stateConnection['status'] == $dataMember['status']))
            {
                return TRUE;
            }

            return FALSE;
        }
    }

    // Méthode de connexion
    public function connectAdmin($emailAdress, $password)
    {
        // Crée le tableau de données du membre
        $dataMember = [
            'emailAdress' => htmlspecialchars($emailAdress),
            'password' => htmlspecialchars($password)
        ];

        // Crée l'objet membre
        $member = new Member($dataMember);
        // Appelle la méthode de connexion du membre
        $stateConnection = $this->memberManager()->connectionMember($member);

        if($stateConnection['emailAdress'] == $dataMember['emailAdress'])
        {
            if(password_verify($dataMember['password'], $stateConnection['password'])) // Vérifie si le mot de passe est correcte
            {
                if($stateConnection['status'] == 'administrateur')
                {
                    $_SESSION['id'] = $stateConnection['id'];
                    $_SESSION['emailAdress'] = $stateConnection['emailAdress'];
                    $_SESSION['status'] = 'administrateur';
                    header('Location:admin.php');
                }
                else
                {
                    $_SESSION['errorAdmin'] = 'Vous n\'étes pas autoriser à administrer le Blog';
                }
            }
            else
            {
                $_SESSION['errorAdmin'] = 'Mot de passe incorrecte';
            }
        }
        else
        {
            $_SESSION['errorAdmin'] = 'L\'adresse email saisi est incorrecte';
        }
    }

    // Setter memberManager => Permet d'assigner une valeur à l'attribut $_memberManager
    public function setMemberManager($memberManager) { $this->_memberManager = $memberManager; }
    // Getter memberManager => Permet de renvoyer la valeur de l'attribut $_memberManager
    public function memberManager() { return $this->_memberManager; }
}
