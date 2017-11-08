<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> <!-- Balise meta -->
        <link href="https://fonts.googleapis.com/css?family=Pattaya" rel="stylesheet"> <!-- Police d'écriture "Pattaya" -->
        <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet"> <!-- Police d'écriture "El Messiri" -->
        <link rel="stylesheet" href="Contenu/css/style.css"> <!-- Feuille de style -->
        <title><?php echo $titrePage; ?></title> <!-- Titre du site définit par la variable $titrePage -->
    </head>

    <body>

        <header> <!-- HEADER -->
            
            <div id="titreSite">
                <h1>Billet simple pour l'Alaska</h1> <!-- Titre du Blog -->
                <span>Administration</span>
            </div>

            <ul id="imgMenu"> <!-- Image et menu déroulant -->
                <li>
                    <p><img id="imgAdmin" src="Contenu/images/admin.jpg"></p> <!-- Photo du membre d'administration -->

                    <ul id="menuDeroulant"> <!-- Menu déroulant -->
                        <li><a href="">Visualiser le Blog</a></li>
                        <li><a href="">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>

        </header> <!-- /HEADER -->

        <?php echo $contenu; ?> <!-- Affichage du flux récupérer à partir du fichier "vueAdmin.php" -->

        <script src="../js/tinymce/tinymce.min.js"></script> <!-- Fichier JS de tinymce -->
        <script src="Contenu/js/tinymceAdmin.js"></script> <!-- Fichier initialisation tinymce -->

        </body>
</html>