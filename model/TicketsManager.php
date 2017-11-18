<?php
require_once('Manager.php');

// Manager de la class Ticket
class TicketsManager extends Manager
{
    // Méthode d'ajout d'un chapitre
    public function add($ticket)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Prépare la requete d'ajout d'un nouveau chapitre
        $request = $bdd->prepare('INSERT INTO tickets(title, content, dateTimeAdd) VALUES(:title, :content, :dateTimeAdd)');
            // Execute la requete d'ajout du chapitre
        $request->execute(array(
            'title' => $ticket->title(),
            'content' => $ticket->content(),
            'dateTimeAdd' => $ticket->dateTimeAdd()
        )) or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de modification d'un chapitre
    public function update($ticket)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Prépare la requete de modification d'un chapitre
        $request = $bdd->prepare('UPDATE tickets SET title = :newTitle, content = :newContent, dateTimeLastModified = :dateTimeModified WHERE id = :idTicket');
        // Lance la requéte avec les données reçu
        $request->execute(array(
            'idTicket' => $ticket->id(),
            'newTitle' => $ticket->title(),
            'newContent' => $ticket->content(),
            'dateTimeModified' => $ticket->dateTimeLastModified()
        )) or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de suppression d'un chapitre
    public function delete($id)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Prépare la requéte pour la suppresion d'un chapitre
        $request = $bdd->prepare('DELETE FROM tickets WHERE id = ?');
        $request->execute(array($id)) or die(print_r($request->errorInfo(), TRUE));
    }

    // Méthode de récupération d'un chapitre
    public function getTicket($id)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Prépare la requéte de récupération du chapitre demander
        $request = $bdd->prepare('SELECT title, content, DATE_FORMAT(dateTimeAdd, \'%d-%m-%Y à %Hh%i\') AS dateTimeAdd, DATE_FORMAT(dateTimeLastModified, \'%d-%m-%Y à %Hh%i\') AS dateTimeModified FROM tickets WHERE id = ?');
        // Execute la requéte de récupération avec la variable contenu dans l'URL
        $request->execute(array($id)) or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        $data = $request->fetch(); // On assemble les données reçu

        return $data; // Retourne le chapitre demander
    }

    // Méthode de récupération de tous les chapitres
    public function getListTickets()
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Retourne la liste de tous les chapitres
        $request = $bdd->query('SELECT id, title, content, DATE_FORMAT(dateTimeAdd, \'%d-%m-%Y à %Hh%i\') AS dateTimeAddTicket FROM tickets ORDER BY dateTimeAdd DESC') or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        // Crée le manager des commentaires
        $commentManager = new CommentsManager();

        // On assemble les données reçu en récupérant le nombre de commentaires de chaque chapitres
        while($data = $request->fetchAll())
        {
            for($i = 0; $i < count($data); $i++)
            {
                $ticket[$i]['id'] = $data[$i]['id'];
                $ticket[$i]['title'] = $data[$i]['title'];
                $ticket[$i]['content'] = $data[$i]['content'];
                $ticket[$i]['dateTimeAddTicket'] = $data[$i]['dateTimeAddTicket'];

                // Récupére et stocke le nombre de commentaires de chaque chapitres
                $nbComments = $commentManager->getNbComments($data[$i]['id']);
                $ticket[$i]['nbComments'] = $nbComments['nbComments'];
            }
        }

        return $ticket; // Retourne les chapitres ainsi que leur nombres de commentaires contenu dans la BDD
    }

    // Méthode de récupération du dernier chapitre modifier
    public function getLastTicketModify()
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // retourne le dernier chapitre modifier
        $request = $bdd->query('SELECT title, DATE_FORMAT(dateTimeLastModified, \'%d-%m-%Y à %Hh%i\') AS dateTimeLastModified FROM tickets ORDER BY dateTimeLastModified DESC LIMIT 0, 1') or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        $data = $request->fetch(); // On assemble les données reçu

        return $data; // Retourne le dernier chapitre modifier
    }
}
