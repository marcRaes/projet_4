<?php
require_once('Manager.php');

// Manager de la classe Comment
class CommentsManager extends Manager
{
    // Méthode d'ajout d'un commentaire
    public function add($comment)
    {
        //
    }

    // Méthode de modification d'un commentaire
    public function update($comment)
    {
        //
    }

    // Méthode de suppression d'un commentaire
    public function delete($id)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Prépare la requète de suppression d'un commentaire
        $request = $bdd->prepare('DELETE FROM comments WHERE id = ?');
        // Execute la requète
        $request->execute(array($id)) or die(print_r($request->errorInfo(), TRUE));
    }

    // Méthode de récupération d'un commentaire
    public function getComment($id)
    {
        //
    }

    // Méthode de récupération de tous les commentaires qui ont était signaler => champ alert à TRUE
    public function getListCommentsAlert()
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        $request = $bdd->query('SELECT com.id idComment, DATE_FORMAT(com.dateTimeAdd, \'%d-%m-%Y à %Hh%i\') AS dateTimeAddComment, com.content contentComment, com.alert alertComment, m.emailAdress mailMembre, t.title titleTicket, com.id idTicket FROM comments com INNER JOIN members m ON com.idMember = m.id INNER JOIN tickets t ON com.idTicket = t.id WHERE com.alert = TRUE');

        // On assemble les données reçu
        $data = $request->fetchAll();

        return $data;
    }

    // Méthode de récupération de tous les commentaires d'un chapitre
    public function getListCommentsTicket($id)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Prépare la requéte de récupération des commentaires, avec une jointure vers la table tickets et members
        $request = $bdd->prepare('SELECT com.id idComment, DATE_FORMAT(com.dateTimeAdd, \'%d-%m-%Y à %Hh%i\') AS dateTimeAddComment, com.content contentComment, com.alert alertComment, m.emailAdress mailMembre, t.title titleTicket FROM comments com INNER JOIN members m ON com.idMember = m.id INNER JOIN tickets t ON com.idTicket = t.id WHERE com.idTicket = ? ORDER BY com.alert DESC');
        // Execute la requéte
        $request->execute(array($id)) or die(print_r($request->errorInfo(), TRUE));
        // Assemble les données reçu
        $data = $request->fetchAll();
        // Retourne les commentaires demander
        return $data;
    }

    // Méthode de récupération du nombre de commentaires de chaque chapitres
    public function getNbComments($id)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        $request = $bdd->prepare('SELECT COUNT(*) AS nbComments FROM comments WHERE idTicket=?');
        $request->execute(array($id)) or die(print_r($request->errorInfo(), TRUE));
        // Assemble les données reçu
        $dataNb = $request->fetchAll();
        // Retourne le nombre de commentaire
        return $dataNb;
    }

    public function approve($id)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        $request = $bdd->prepare('UPDATE comments SET alert = FALSE WHERE id = ?');
        $request->execute(array($id)) or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }
}