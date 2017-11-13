<?php
require_once('Manager.php');

// Manager de la class Ticket
class TicketsManager extends Manager
{
    // Méthode d'ajout d'un chapitre
    public function add($title, $content, $dateTimeAdd)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Prépare la requete d'ajout d'un nouveau chapitre
        $request = $bdd->prepare('INSERT INTO tickets(title, content, dateTimeAdd) VALUES(:title, :content, :dateTimeAdd)');
            // Execute la requete d'ajout du chapitre
        $request->execute(array(
            'title' => $title,
            'content' => $content,
            'dateTimeAdd' => $dateTimeAdd
        )) or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de modification d'un chapitre
    public function update($id, $title, $content, $dateTimeLastModified)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Prépare la requete de modification d'un chapitre
        $request = $bdd->prepare('UPDATE tickets SET title = :newTitle, content = :newContent, dateTimeLastModified = :dateTimeModified WHERE id = :idTicket');
        // Lance la requéte avec les données reçu
        $request->execute(array(
            'idTicket' => $id,
            'newTitle' => $title,
            'newContent' => $content,
            'dateTimeModified' => $dateTimeLastModified
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
        
        $data = $request->fetchAll(); // On assemble les données reçu
        
        return $data; // Retourne le chapitre demander
    }

    // Méthode de récupération de tous les chapitres
    public function getListTickets()
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Retourne la liste de tous les chapitres
        $request = $bdd->query('SELECT id, title, content, DATE_FORMAT(dateTimeAdd, \'%d-%m-%Y à %Hh%i\') AS dateTimeAddTicket FROM tickets ORDER BY dateTimeAdd DESC') or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
        
        // On assemble les données reçu
        $data = $request->fetchAll();
        
        return $data; // Retourne les chapitres contenu dans la BDD
    }

    // Méthode de récupération du dernier chapitre modifier
    public function getLastTicketModify()
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // retourne le dernier chapitre modifier
        $request = $bdd->query('SELECT title, DATE_FORMAT(dateTimeLastModified, \'%d-%m-%Y à %Hh%i\') AS dateTimeLastModified FROM tickets ORDER BY dateTimeLastModified DESC LIMIT 0, 1') or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        $data = $request->fetchAll(); // On assemble les données reçu

        return $data; // Retourne le dernier chapitre modifier
    }
}