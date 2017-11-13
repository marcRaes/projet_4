<?php
require_once('Manager.php');

// Manager de la classe Member
class MemberManager extends Manager
{
    // Méthode d'ajout d'un nouveaux membre
    public function add($comment)
    {
        //
    }

    public function connectionMemberAdmin($emailAdress)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        $request = $bdd->prepare('SELECT id, emailAdress, password, status FROM members WHERE emailAdress = ?');
        $request->execute(array($emailAdress));
        $dataConnection = $request->fetch();
    
        return $dataConnection;
    }
}