<?php
require_once('Model/TicketsManager.php');
require_once('Model/CommentsManager.php');
require_once('View/Frontend/View.php');

class ControlerIndex
{
    private $_ticketManager;

    public function __construct()
    {
        // Crée l'objet Manager
        $this->setTicketManager(new TicketsManager()); // Manager des chapitres
    }

    // Méthode de récupération des chapitres
    function callGetTickets()
    {
        // Récupération de la liste des chapitres
        $dataTickets = $this->ticketManager()->getListTickets();

        // Affichage
        $viewIndex = new View('Index');
        $viewIndex->generate(array('dataTickets' => $dataTickets));
    }

    // Setter ticketManager
    public function setTicketManager($ticketManager) { $this->_ticketManager = $ticketManager; }
    // Getter ticketManager
    public function ticketManager() { return $this->_ticketManager; }
}
