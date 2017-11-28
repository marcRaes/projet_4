<?php
require_once('Controler/Controler.php');
require_once('Model/Member.php');
require_once('View/Backend/View.php');

class ControlerAdminSecure extends Controler
{
    // Méthode qui permet de savoir si le membre à l'autorisation d'administrer le blog
    public function autorizationEnter($sessionMember)
    {
        if(isset($sessionMember['idMember']) && (isset($sessionMember['emailAdress'])) && (isset($sessionMember['statusMember'])))
        {
            $dataMember = [
                'id' => $sessionMember['idMember'],
                'emailAdress' => $sessionMember['emailAdress'],
                'status' => $sessionMember['statusMember']
            ];

            // Crée l'objet membre
            $member = new Member($dataMember);
            // Appelle la méthode de connexion du membre
            $memberConnection = $this->memberManager()->connectionMember($member);

            // S'assure que les données de la session sont les même que celle contenu dans la BDD
            if(($memberConnection->id() == $dataMember['id']) && ($memberConnection->emailAdress() == $dataMember['emailAdress']) && ($memberConnection->status() == $dataMember['status']))
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

        $memberConnection = parent::connect($dataMember);

        if($memberConnection == null)
        {
            if($_SESSION['statusMember'] == 'administrateur')
            {
                header('Location:admin.php');
            }
            else
            {
                return 'Vous n\'étes pas autoriser à administrer le Blog';
            }
        }
        else
        {
            return $memberConnection;
        }
    }

    // Méthode d'appel de la vue du formulaire de connexion à l'administration
    public function adminSecure()
    {
        $adminSecure = new View('AdminSecure');
        $adminSecure->generate(array(''));
    }
}
