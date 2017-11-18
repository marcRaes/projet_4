<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"> <!-- Balise meta -->
        <meta name="viewport" content="initial-scale=1, user-scalable=no">
        <link href="https://fonts.googleapis.com/css?family=Pattaya" rel="stylesheet"> <!-- Police d'écriture "Pattaya" -->
        <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet"> <!-- Police d'écriture "El Messiri" -->
        <link rel="stylesheet" href="Contenu/css/style.css"> <!-- Feuille de style -->
        <!-- Titre du site définit par la variable $titrePage -->
        <title><?= $this->title(); ?></title>
    </head>

    <body>

        <header> <!-- HEADER -->

            <div id="titreSite">
                <h1>Billet simple pour l'Alaska</h1> <!-- Titre du Blog -->
            </div>

        </header> <!-- /HEADER -->

        <?php if(isset($_SESSION['emailAdress'])) { echo $_SESSION['emailAdress']; } ?>

        <a href="admin.php">Administration du site</a><br> <!-- Lien vers l'administration du site -->
        <a href="index.php?action=connection">Se connecter</a><br> <!-- Lien de connexion -->
        <a href="index.php?action=registration">Créer un compte</a><br> <!-- Lien vers la création d'un compte -->
        <a href="index.php?action=deconnect">Deconnexion</a><br> <!-- Lien de deconnexion -->

        <!-- Affichage du flux -->
        <?= $content; ?>

        <script src="Contenu/js/tinymce/tinymce.min.js"></script> <!-- Fichier JS de tinymce -->
        <script src="Contenu/js/tinymceAdmin.js"></script> <!-- Fichier initialisation tinymce -->

    </body>
</html>
