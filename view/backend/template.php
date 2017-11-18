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
                <span>Administration</span>
            </div>

        <?php
        // Vérifie si un membre est connecter et si il a le bon statut pour administrer le blog
        if(isset($_SESSION['status']) && ($_SESSION['status'] == 'administrateur'))
        {
        ?>
        <ul id="imgMenu"> <!-- Image et menu déroulant -->
            <li>
                <p><img id="imgAdmin" src="Contenu/images/admin.jpg"></p> <!-- Photo du membre d'administration -->

                <ul id="menuDeroulant"> <!-- Menu déroulant -->
                    <li><a href="index.php">Visualiser le Blog</a></li>
                    <li><a href="deconnect.php">Deconnexion</a></li>
                </ul>
            </li>
        </ul>

        <?php
        }
        ?>

        </header> <!-- /HEADER -->

        <!-- Affichage du flux -->
        <?= $content; ?>

        <script src="Contenu/js/tinymce/tinymce.min.js"></script> <!-- Fichier JS de tinymce -->
        <script src="Contenu/js/tinymceAdmin.js"></script> <!-- Fichier initialisation tinymce -->

    </body>
</html>
