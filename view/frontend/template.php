<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"> <!-- Balise meta -->
        <meta name="viewport" content="initial-scale=1, user-scalable=no">
        <link rel="icon" type="image/png" href="Contenu/images/favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Pattaya" rel="stylesheet"> <!-- Police d'écriture "Pattaya" -->
        <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet"> <!-- Police d'écriture "El Messiri" -->
        <link rel="stylesheet" href="contenu/font-awesome/css/font-awesome.min.css"> <!-- Font Awesome -->
        <link rel="stylesheet" href="Contenu/css/style.css"> <!-- Feuille de style général -->
        <link rel="stylesheet" href="Contenu/css/styleFrontend.css"> <!-- Feuille de style du Frontend -->
        <!-- Titre du site définit par la variable $titrePage -->
        <title><?= $this->title(); ?></title>
    </head>

    <body>

        <header>
            <p><img src="contenu/images/logo.png"></p>
            <h1>Billet simple pour l'Alaska</h1>
        </header>

        <nav>
            <ul id="oneLevel">
                <li><span class="fa fa-home"></span><a href="index.php" title="Retourner à l'accueil du blog">Accueil</a></li>
                <ul id="secondLevel">
                <?php if(isset($_SESSION['emailAdress']))
                {
                    if($_SESSION['statusMember'] == 'administrateur')
                    {
                    ?>
                        <li><a href="admin.php" title="Accéder à l'espace administration du blog">Administrer le Blog</a></li> <!-- Lien vers l'administration du site -->
                    <?php
                    }
                    ?>
                        <li><a href="index.php?action=deconnect" title="Se déconnecter">Deconnexion</a></li> <!-- Lien de deconnexion -->
                    <?php
                }
                else
                {
                ?>
                    <li><a href="index.php?action=connection" title="Connecter vous">Se connecter</a></li> <!-- Lien de connexion -->
                    <li><a href="index.php?action=registration" title="Créer un compte">Créer un compte</a></li> <!-- Lien vers la création d'un compte -->
                <?php
                }
                ?>
                </ul>
            </ul>
        </nav>

        <!-- Affichage du flux -->
        <?= $content; ?>

        <script src="Contenu/js/tinymce/tinymce.min.js"></script> <!-- Fichier JS de tinymce -->
        <script src="Contenu/js/tinymceIndex.js"></script> <!-- Fichier initialisation tinymce -->

    </body>
</html>
