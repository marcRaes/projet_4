<?php
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

        // Appelle la méthode de connexion de la classe Controler
        $memberConnection = parent::connect($dataMember);

        if($memberConnection == null) // Si aucune erreur n'a était retourner
        {
            if($_SESSION['statusMember'] == 'administrateur') // On vérifie que le membre à le droit d'aministrer le blog
            {
                header('Location:admin.php');
            }
            else // Sinon on lui retourne un message d'erreur
            {
                return 'Vous n\'étes pas autoriser à administrer le Blog';
            }
        }
        else // Si la méthode de connexion à retourner une erreur
        {
            return $memberConnection; // On retourne cette erreur
        }
    }

    // Méthode d'appel de la vue du formulaire de connexion à l'administration
    public function adminSecure()
    {
        $adminSecure = new View('AdminSecure');
        $adminSecure->generate(array(''));
    }
}
