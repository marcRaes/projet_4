<?php
require_once('Controler/Controler.php');
require_once('View/Frontend/View.php');

class ControlerConnect extends Controler
{
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

            // Appelle la méthode de connection de la classe Controler
            return parent::connect($dataMember);
        }
        else
        {
            return 'Votre adresse email ainsi que votre mot de passe sont obligatoire';
        }
    }

    // Méthode qui envoie la vue de la connexion
    public function viewConnectMember()
    {
        $viewConnectMember = new View('Connect');

        $viewConnectMember->generate(array(''));
    }
}
