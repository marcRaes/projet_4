<?php
class Manager
{
    // identifiants connexion WAMP
    // Constante de connexion
    const HOST_NAME = 'localhost';
    const DATABASE = 'projet_4';
    const USER_NAME = 'root';
    const PASSWORD = '';

    // Méthode de connexion à la BDD
    protected function bddConnect()
    {
        // Connexion à la BDD
        $bdd = new PDO('mysql:host='.self::HOST_NAME.';dbname='.self::DATABASE.'; charset=utf8', self::USER_NAME, self::PASSWORD);
        return $bdd;
    }
}