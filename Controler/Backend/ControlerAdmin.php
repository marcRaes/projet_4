<?php
require_once('Model/TicketsManager.php');
require_once('Model/CommentsManager.php');
require_once('View/Backend/View.php');

class ControlerAdmin
{
    private $_ticketManager;
    private $_commentManager;

    // Le controleur instanciera le manager dédié au chapitres et au commentaires
    public function __construct()
    {
        // Crée l'objet Manager
        $this->setTicketManager(new TicketsManager()); // Manager des chapitres
        $this->setCommentManager(new CommentsManager()); // Manager des commentaires
    }

    // Méthode d'affichage de la liste des chapitres
    public function accueilAdmin()
    {
        // Récupération de la liste des chapitres
        $tickets = $this->ticketManager()->getListTickets();

        for($i = 0; $i < count($tickets); $i++)
        {
            // Récupére le monbre de commentaires de chaque chapitres
            $nbComments[$i] = $this->commentManager()->getNbComments($tickets[$i]->id());

            // Passe le contenu des chapitres dans la méthode "cutText"
            $tickets[$i]->setContent($this->cutText($tickets[$i]->content(), 140));

            // transforme la premiére lettre du titre du chapitre en majuscule
            $tickets[$i]->setTitle(ucfirst($tickets[$i]->title()));
        }

        // Retourne le nombre de commentaire signaler
        $nbCommentAlert = count($this->commentManager()->getListCommentsAlert());

        // Crée l'objet de la vue
        $view = new View('Admin');

        // Appel la méthode qui génère la vue
        $view->generate(array(
            'tickets' => $tickets,
            'nbComments' => $nbComments,
            'nbCommentAlert' => $nbCommentAlert
        ));
    }

    // Fonction qui permet de couper le contenu d'un chapitre pour l'affichage
    private function cutText($text, $nbChar)
    {
        $text = trim(strip_tags($text)); // suppression des balises HTML

    	if(is_numeric($nbChar))
    	{
            $PointSuspension = ' [...]'; // points de suspension

    		$LengthText = strlen($text); // Taille du texte
    		if ($LengthText > $nbChar) {
    			// pour ne pas couper un mot, on va à l'espace suivant
                $text = substr($text, 0, strpos($text, ' ', $nbChar));

    			// On ajoute des points de suspension à la fin si le texte brut est plus long que $nbChar
    			$text .= $PointSuspension;
    		}
    	}
    	// On renvoie le résumé du texte correctement formaté.
    	return $text;
    }

    // Méthode de suppression d'un chapitre et de ses commentaires
    public function deleteTicket($idTicket)
    {
        // Appel de la méthode de suppression d'un chapitre
        $this->ticketManager()->delete($idTicket);

        // Supprime également les commentaires du chapitre
        $this->commentManager()->deleteCommentTicket($idTicket);
    }

    // Setter ticketManager
    public function setTicketManager($ticketManager) { $this->_ticketManager = $ticketManager; }
    // Getter ticketManager
    public function ticketManager() { return $this->_ticketManager; }

    // Setter commentManager
    public function setCommentManager($commentManager) { $this->_commentManager = $commentManager; }
    // Getter commentManager
    public function commentManager() { return $this->_commentManager; }
}
