<?php
class TicketsManager
{
    private $_bdd;

    // Constante de connexion
    const HOST_NAME = 'localhost';
    const DATABASE = 'projet_4';
    const USER_NAME = 'root';
    const PASSWORD = '';

    // Le constructeur
    public function __construct()
    {
        // Connexion à la BDD
        $bdd = new PDO('mysql:host='.self::HOST_NAME.';dbname='.self::DATABASE.'; charset=utf8', self::USER_NAME, self::PASSWORD);
        $this->setBdd($bdd);
    }

    // Méthode d'ajout d'un chapitre
    public function add($ticket)
    {
        // Prépare la requete d'ajout d'un nouveau chapitre
        $request = $this->_bdd->prepare('INSERT INTO tickets(title, content, dateTimeAdd) VALUES(:title, :content, :dateTimeAdd)');
            // Execute la requete d'ajout du chapitre
        $request->execute(array(
            'title' => $ticket['title'],
            'content' => $ticket['content'],
            'dateTimeAdd' => $ticket['dateTimeAdd']
        )) or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de modification d'un chapitre
    public function update($ticket)
    {
        // Prépare la requete de modification d'un chapitre
        $request = $this->_bdd->prepare('UPDATE tickets SET title = :newTitle, 
        content = :newContent, dateTimeLastModified = :dateTimeModified WHERE id = :idTicket');
        // Lance la requéte avec les données reçu
        $request->execute(array(
            'idTicket' => $ticket['id'],
            'newTitle' => $ticket['title'],
            'newContent' => $ticket['content'],
            'dateTimeModified' => $ticket['dateTimeLastModified'],
        )) or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de suppression d'un chapitre
    public function delete($id)
    {
        // Prépare la requéte pour la suppresion d'un chapitre
        $request = $this->_bdd->prepare('DELETE FROM tickets WHERE id = ?');
        $request->execute(array($id)) or die(print_r($request->errorInfo(), TRUE));
    }

    // Méthode de récupération d'un chapitre
    public function getTicket($id)
    {
        // Prépare la requéte de récupération du chapitre demander
        $request = $this->_bdd->prepare('SELECT title, content, DATE_FORMAT(dateTimeAdd, \'%d-%m_%Y à %Hh%i\') AS dateTimeAdd, DATE_FORMAT(dateTimeLastModified, \'%d-%m_%Y à %Hh%i\') AS dateTimeModified FROM tickets WHERE id = ?');
        // Execute la requéte de récupération avec la variable contenu dans l'URL
        $request->execute(array($id)) or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
        
        $data = $request->fetchAll(); // On assemble les données reçu
        
        return $data; // Retourne le chapitre demander
    }

    // Méthode de récupération de tous les chapitres
    public function getListTickets()
    {
        // Retourne la liste de tous les chapitres
        $request = $this->_bdd->query('SELECT id, title, content, DATE_FORMAT(dateTimeAdd, \'%d-%m_%Y à %Hh%i\') AS dateTimeAddTicket FROM tickets ORDER BY dateTimeAdd DESC') 
        or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        $data = $request->fetchAll(); // On assemble les données reçu
        
        return $data; // Retourne les chapitres contenu dans la BDD
    }

    public function getLastTicketModify()
    {
        // retourne le dernier chapitre modifier
        $request = $this->_bdd->query('SELECT title, DATE_FORMAT(dateTimeLastModified, \'%d-%m_%Y à %Hh%i\') AS dateTimeLastModified FROM tickets ORDER BY dateTimeLastModified DESC LIMIT 0, 1') or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        $data = $request->fetchAll(); // On assemble les données reçu

        return $data; // Retourne le dernier chapitre modifier
    }

    // Setter $bdd
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;
    }
}