<?php
require_once('Model/Ticket.php');
require_once('Model/TicketsManager.php');
require_once('View/Backend/View.php');

class ControlerTicket
{
    private $_ticketManager;

    // Le controleur instanciera le manager dédié aux chapitres
    public function __construct()
    {
        // Crée l'objet Manager
        $this->setTicketManager(new TicketsManager()); // Manager des chapitres
    }

    public function ticket($get)
    {
        // Crée l'objet de la vue
        $view = new View('Ticket');

        if((isset($get['idTicket']) && (isset($get['change']) && ($get['change'] == 'on')))) // On souhaite modifier un chapitre
        {
            // Définition du texte de la page pour la modification d'un chapitre
            $titlePage['titleSection'] = 'Modification d\'un chapitre existant'; // Titre de la section
            $titlePage['titleTicket'] = 'Titre du chapitre :'; // Texte du label titre
            $titlePage['labelContentTicket'] = 'Contenu du chapitre :'; // Texte du label contenu
            $titlePage['buttonSend'] = 'Modifier le chapitre'; // Texte du bouton d'envoi

            // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
            $idTicket = intval($get['idTicket']);

            if($idTicket != 0)
            {
                // Appel la fonction de récupération d'un chapitre
                $ticket = $this->ticketManager()->getTicket($idTicket);

                $view->setTitle('Modification du chapitre : ' . $ticket->title() . ' - Billet simple pour l\'Alaska'); // Titre de la page
            }
            else
            {
                throw new Exception("Identifiant de chapitre incorrect");
            }
        }
        else {
            $ticket = null;

            $view->setTitle('Ajout d\'un nouveaux chapitre - Billet simple pour l\'Alaska'); // Titre de la page
            // Définition du texte de la page pour l'ajout d'un chapitre
            $titlePage['titleSection'] = 'Ajout d\'un nouveau chapitre'; // Titre de la section
            $titlePage['titleTicket'] = 'Titre du nouveau chapitre :'; // Texte du label titre
            $titlePage['labelContentTicket'] = 'Contenu du nouveau chapitre :'; // Texte du label contenu
            $titlePage['buttonSend'] = 'Ajouter le nouveaux chapitre'; // Texte du bouton d'envoi
        }

        $view->generate(array(
            'ticket' => $ticket,
            'titlePage' => $titlePage
        ));
    }

    public function decisionTicket($post)
    {
        date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
        $dateTime = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle

        if(isset($post['addTicket']) && ($post['addTicket'] == 'add')) // On souhaite ajouter un chapitre
        {
            // Crée le tableau de données du chapitre
            $dataTicket = [
                'title' => $post['titleTicket'],
                'content' => $post['contentTicket'],
                'dateTimeAdd' => $dateTime,
            ];

            // Crée un nouvel objet du chapitre
            $ticket = new Ticket($dataTicket);
            // Appel la méthode d'ajout d'un chapitre dans la BDD
            $this->ticketManager()->add($ticket);
        }
        else if(isset($post['change']) && ($post['change'] == 'on')) // On souhaite modifier un chapitre
        {
            // Crée le tableau de données du chapitre
            $dataTicket = [
                'id' => $post['idTicket'],
                'title' => $post['titleTicket'],
                'content' => $post['contentTicket'],
                'dateTimeLastModified' => $dateTime,
            ];

            // Crée un nouvel objet du chapitre
            $ticket = new Ticket($dataTicket);
            // Appel la méthode de modification d'un chapitre
            $this->ticketManager()->update($ticket);
        }

        // Redirection vers la premiére page de l'administration
        header('Location:admin.php');
    }

    // Setter ticketManager
    public function setTicketManager($ticketManager) { $this->_ticketManager = $ticketManager; }
    // Getter ticketManager
    public function ticketManager() { return $this->_ticketManager; }
}
