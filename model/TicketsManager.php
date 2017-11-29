<?php
require_once('Manager.php');
require_once('Ticket.php');

// Manager de la class Ticket
class TicketsManager extends Manager
{
    // Méthode d'ajout d'un chapitre
    public function add($ticket)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Prépare la requete d'ajout d'un nouveau chapitre
        $request = $bdd->prepare('INSERT INTO tickets(title, content, dateTimeAdd) VALUES(:title, :content, :dateTimeAdd)');
        $request->bindValue(':title', $ticket->title());
        $request->bindValue(':content', $ticket->content());
        $request->bindValue(':dateTimeAdd', $ticket->dateTimeAdd());

        // Execute la requete d'ajout du chapitre
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de modification d'un chapitre
    public function update($ticket)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Prépare la requete de modification d'un chapitre
        $request = $bdd->prepare('UPDATE tickets SET title = :newTitle, content = :newContent, dateTimeLastModified = :newDateTimeModified WHERE id = :idTicket');
        $request->bindValue(':idTicket', $ticket->id(), PDO::PARAM_INT);
        $request->bindValue(':newTitle', $ticket->title());
        $request->bindValue(':newContent', $ticket->content());
        $request->bindValue(':newDateTimeModified', $ticket->dateTimeLastModified());

        // Lance la requéte avec les données reçu
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de suppression d'un chapitre
    public function delete($id)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Prépare la requéte pour la suppresion d'un chapitre
        $request = $bdd->prepare('DELETE FROM tickets WHERE id = :idTicket');
        $request->bindValue(':idTicket', $id, PDO::PARAM_INT);

        // Execute la requéte
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    // Méthode de récupération d'un chapitre
    public function getTicket($id)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Prépare la requéte de récupération du chapitre demander
        $request = $bdd->prepare('SELECT title, content, DATE_FORMAT(dateTimeAdd, \'%d-%m-%Y à %Hh%i\') AS dateTimeAdd, DATE_FORMAT(dateTimeLastModified, \'%d-%m-%Y à %Hh%i\') AS dateTimeModified FROM tickets WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);

        // Execute la requéte de récupération avec la variable contenu dans l'URL
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        $data = $request->fetch(); // On assemble les données reçu

        $ticket = new Ticket($data);

        return $ticket; // Retourne le chapitre demander
    }

    // Méthode de récupération de tous les chapitres
    public function getListTickets()
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Retourne la liste de tous les chapitres
        $request = $bdd->query('SELECT id, title, content, DATE_FORMAT(dateTimeAdd, \'%d-%m-%Y à %Hh%i\') AS dateTimeAdd FROM tickets ORDER BY dateTimeAdd DESC') or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        // On assemble les données reçu en récupérant le nombre de commentaires de chaque chapitres
        $data = $request->fetchAll();

        for($i = 0; $i < count($data); $i++)
        {
            $ticket[$i] = new Ticket($data[$i]);
        }

        return $ticket; // Retourne les chapitres contenu dans la BDD
    }
}
