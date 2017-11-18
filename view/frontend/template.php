<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"> <!-- Balise meta -->
        <meta name="viewport" content="initial-scale=1, user-scalable=no" />
        <link href="https://fonts.googleapis.com/css?family=Pattaya" rel="stylesheet"> <!-- Police d'écriture "Pattaya" -->
        <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet"> <!-- Police d'écriture "El Messiri" -->
        <link rel="stylesheet" href="Contenu/css/style.css"> <!-- Feuille de style -->
        <link rel="stylesheet" href="Contenu/font-awesome/css/font-awesome.min.css"> <!-- Feuille de style FontsAwesome -->
        <!-- Titre du site définit par la variable $titrePage -->
        <title><?= $titlePage; ?></title>
    </head>

    <body>

        <header> <!-- HEADER -->

            <div id="titreSite">
                <h1>Billet simple pour l'Alaska</h1> <!-- Titre du Blog -->
            </div>

        </header> <!-- /HEADER -->

        <?php if(isset($_SESSION['emailAdress'])) { echo $_SESSION['emailAdress']; } ?>

        <a href="admin.php">Administration du site</a><br> <!-- Lien vers l'administration du site -->
        <a href="connection.php">Se connecter</a><br> <!-- Lien de connexion -->
        <a href="registration.php">Créer un compte</a><br> <!-- Lien vers la création d'un compte -->
        <a href="deconnect.php">Deconnexion</a><br> <!-- Lien de deconnexion -->

        <!-- Affichage du flux -->
        <?= $content; ?>

        <script src="Contenu/js/tinymce/tinymce.min.js"></script> <!-- Fichier JS de tinymce -->
        <script src="Contenu/js/tinymceAdmin.js"></script> <!-- Fichier initialisation tinymce -->

    </body>
</html>
