<?php
session_start(); // Active les sessions

$titrePage = 'Le blog de Jean Forteroche - Billet simple pour l\'Alaska';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> <!-- Balise meta -->
        <link href="https://fonts.googleapis.com/css?family=Pattaya" rel="stylesheet"> <!-- Police d'écriture "Pattaya" -->
        <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet"> <!-- Police d'écriture "El Messiri" -->
        <link rel="stylesheet" href="css/style.css"> <!-- Feuille de style -->
        <title><?php echo $titrePage; ?></title> <!-- Titre du site définit par la variable $titrePage -->
    </head>

    <body>

        <header> <!-- HEADER -->
            
            <div id="titreSite">
                <h1>Billet simple pour l'Alaska</h1> <!-- Titre du Blog -->
            </div>

        </header> <!-- /HEADER -->

        <a href="admin/admin.php">Administration du site</a><br> <!-- Lien vers l'administration du site -->
        <a href="connexion.php">Connexion</a><br> <!-- Lien de connexion d'un membre -->
        <a href="inscription.php">Créer un compte</a><br> <!-- Lien d'inscription -->
        <a href="deconnexion.php">Deconnexion</a> <!-- Lien de deconnexion -->

    </body>
</html>