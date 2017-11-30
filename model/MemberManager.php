<?php
// Manager de la classe Member
class MemberManager extends Manager
{
    // Méthode d'ajout d'un nouveaux membre
    public function addMember($member)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Enregistre le nouveau membre
        $request = $bdd->prepare('INSERT INTO members(emailAdress, password, status) VALUES(:emailAdress, :password, :status)');
        $request->bindValue(':emailAdress', $member->emailAdress());
        $request->bindValue(':password', $member->password());
        $request->bindValue(':status', 'contributeur');

        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        return $bdd->lastInsertId();
    }

    // Méthode de connexion du membre
    public function connectionMember($member)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('SELECT id, emailAdress, password, status FROM members WHERE emailAdress = :emailAdress');
        $request->bindValue(':emailAdress', $member->emailAdress());

        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        $dataConnection = $request->fetch();

        if($dataConnection)
        {
            $member = new Member($dataConnection);
            return $member; // Retourne les données du membre
        }

        return $dataConnection; // Retourne le boolean "false"
    }
}
