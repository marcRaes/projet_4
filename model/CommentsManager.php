<?php
require_once('Manager.php');
require_once('Comment.php');
require_once('CommentsJoin.php');

// Manager de la classe Comment
class CommentsManager extends Manager
{
    // Méthode d'ajout d'un commentaire
    public function add($comment)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Prépare la requète d'ajout d'un nouveau commentaire
        $request = $bdd->prepare('INSERT INTO comments(content, dateTimeAdd, idTicket, idMember, alert) VALUES(:content, :dateTimeAdd, :idTicket, :idMember, :alert)');
        $request->bindValue(':content', $comment->content());
        $request->bindValue(':dateTimeAdd', $comment->dateTimeAdd());
        $request->bindValue(':idTicket', $comment->idTicket(), PDO::PARAM_INT);
        $request->bindValue(':idMember', $comment->idMember(), PDO::PARAM_INT);
        $request->bindValue(':alert', 0);
        // Execute la requète
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de suppression d'un commentaire
    public function delete($id)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Prépare la requète de suppression d'un commentaire
        $request = $bdd->prepare('DELETE FROM comments WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        // Execute la requète
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de suppression des commentaires d'un chapitre
    public function deleteCommentTicket($idTicket)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Prépare la requète de suppression d'un commentaire
        $request = $bdd->prepare('DELETE FROM comments WHERE idTicket = :idTicket');
        $request->bindValue(':idTicket', $idTicket, PDO::PARAM_INT);
        // Execute la requète
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de récupération de tous les commentaires qui ont était signaler => champ alert à TRUE
    public function getListCommentsAlert()
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        $request = $bdd->query('SELECT com.id idComment, DATE_FORMAT(com.dateTimeAdd, \'%d-%m-%Y à %Hh%i\') AS dateTimeAddComment, com.content contentComment, com.alert alertComment, m.emailAdress mailMember, t.title titleTicket, com.idTicket idTicket FROM comments com INNER JOIN members m ON com.idMember = m.id INNER JOIN tickets t ON com.idTicket = t.id WHERE com.alert = TRUE');

        // On assemble les données reçu
        $comment = $request->fetchAll();

        for($i = 0; $i < count($comment); $i++)
        {
            $comment[$i] = new CommentsJoin($comment[$i]);
        }

        return $comment;
    }

    // Méthode de récupération de tous les commentaires d'un chapitre
    public function getListCommentsTicket($id)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Prépare la requéte de récupération des commentaires, avec une jointure vers la table tickets et members
        $request = $bdd->prepare('SELECT com.id idComment, DATE_FORMAT(com.dateTimeAdd, \'%d-%m-%Y à %Hh%i\') AS dateTimeAddComment, com.content contentComment, com.alert alertComment, m.emailAdress mailMember, t.title titleTicket FROM comments com INNER JOIN members m ON com.idMember = m.id INNER JOIN tickets t ON com.idTicket = t.id WHERE com.idTicket = :idTicket ORDER BY com.alert DESC, com.dateTimeAdd DESC');
        $request->bindValue(':idTicket', $id, PDO::PARAM_INT);
        // Execute la requète
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        // Assemble les données reçu
        $comment = $request->fetchAll();

        for($i = 0; $i < count($comment); $i++)
        {
            $comment[$i] = new CommentsJoin($comment[$i]);
        }

        // Retourne les commentaires demander
        return $comment;
    }

    // Méthode de récupération du nombre de commentaires de chaque chapitres
    public function getNbComments($id)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('SELECT COUNT(*) AS nbComments FROM comments WHERE idTicket = :idTicket');
        $request->bindValue(':idTicket', $id, PDO::PARAM_INT);
        // Execute la requète
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        // Assemble les données reçu
        $dataNb = $request->fetch();

        // Retourne le nombre de commentaire
        return $dataNb['nbComments'];
    }

    // Méthode qui signale un commentaire
    public function reportComment($id)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('UPDATE comments SET alert = TRUE WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        // Execute la requète
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode qui approuve un commentaire
    public function approve($id)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('UPDATE comments SET alert = FALSE WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        // Execute la requète
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }
}
