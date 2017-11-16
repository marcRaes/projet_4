<?php
require_once('Manager.php');

// Manager de la classe Member
class MemberManager extends Manager
{
    // Méthode d'ajout d'un nouveaux membre
    public function addMember($emailAdress, $password)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Enregistre le nouveau membre
        $request = $bdd->prepare('INSERT INTO members(emailAdress, password, status) VALUES(:emailAdress, :password, :status)');
        $request->execute(array(
            'emailAdress' => $emailAdress,
            'password' => $password,
            'status' => 'contributeur'
        )) or die(print_r($request->errorInfo(), TRUE));
    }

    // Méthode de connexion du membre
    public function connectionMember($emailAdress)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        $request = $bdd->prepare('SELECT id, emailAdress, password, status FROM members WHERE emailAdress = ?');
        $request->execute(array($emailAdress));
        $dataConnection = $request->fetch();
    
        return $dataConnection;
    }
}