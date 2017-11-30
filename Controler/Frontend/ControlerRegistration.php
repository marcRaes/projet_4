<?php
class ControlerRegistration extends Controler
{
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

            if($post['emailAdress'] == $post['emailAdressConfirmation']) // L'adresse mail est confirmer
            {
                if($post['password'] == $post['passwordConfirmation']) // Le mot de passe est confirmer
                {
                    // Crée le tableau de données du membre
                    $dataMember = [
                        'emailAdress' => $post['emailAdress'],
                        'password' => $post['password']
                    ];

                    $stateRegistration = parent::connect($dataMember);

                    if($stateRegistration == 'Adresse email non reconnu')
                    {
                        parent::registration($dataMember);
                    }
                    else
                    {
                        return $stateRegistration;
                    }
                }
                else
                {
                    return 'Merci de confirmer votre mot de passe'; // Retourne le message d'erreur
                }
            }
            else
            {
                return 'Merci de confirmer votre adresse email'; // Retourne le message d'erreur
            }
        }
        else
        {
            return 'Les champs ne peuvent pas être vides !'; // Retourne le message d'erreur
        }
    }

    public function viewRegistrationMember()
    {
        $viewRegistrationMember = new View('Registration');

        $viewRegistrationMember->generate(array(''));
    }
}
