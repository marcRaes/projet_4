<?php
session_start(); // Active les sessions

$titrePage = 'Le blog de Jean Forteroche - Billet simple pour l\'Alaska';
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"> <!-- Balise meta -->
        <meta name="viewport" content="initial-scale=1, user-scalable=no" />
        <link href="https://fonts.googleapis.com/css?family=Pattaya" rel="stylesheet"> <!-- Police d'écriture "Pattaya" -->
        <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet"> <!-- Police d'écriture "El Messiri" -->
        <link rel="stylesheet" href="css/style.css"> <!-- Feuille de style -->
        <!-- Titre du site définit par la variable $titrePage -->
        <title><?php echo $titrePage; ?></title>
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