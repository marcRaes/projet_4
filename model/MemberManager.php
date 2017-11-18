<?php
require_once('Manager.php');

// Manager de la classe Member
class MemberManager extends Manager
{
    // Méthode d'ajout d'un nouveaux membre
    public function addMember($member)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        // Enregistre le nouveau membre
        $request = $bdd->prepare('INSERT INTO members(emailAdress, password, status) VALUES(:emailAdress, :password, :status)');
        $request->execute(array(
            'emailAdress' => $member->emailAdress(),
            'password' => $member->password(),
            'status' => 'contributeur'
        )) or die(print_r($request->errorInfo(), TRUE));
    }

    // Méthode de connexion du membre
    public function connectionMember($member)
    {
        // Connexion à la BDD
        $bdd = $this->bddConnect();

        $request = $bdd->prepare('SELECT id, emailAdress, password, status FROM members WHERE emailAdress = ?');
        $request->execute(array($member->emailAdress())) or die(print_r($request->errorInfo(), TRUE));
        $dataConnection = $request->fetch();

        return $dataConnection;
    }
}
