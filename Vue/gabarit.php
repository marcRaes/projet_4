<!-- Contenu de la page -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> <!-- Balise meta -->
        <link href="https://fonts.googleapis.com/css?family=Pattaya" rel="stylesheet"> <!-- Police d'écriture "Pattaya" -->
        <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet"> <!-- Police d'écriture "El Messiri" -->
        <link rel="stylesheet" href="contenu/css/style.css"> <!-- Feuille de style -->
        <title><?php echo $titrePage; ?></title> <!-- Titre du site définit par la variable $titrePage -->
    </head>

    <body>

        <!-- Header -->
        <header>

            <!-- Le haut du header est contenu dans une div -->
            <div id="topHeader">

                <a href="">Visualiser le Blog</a> <!-- Lien vers le blog -->

                <figure>
                    <p><img src="Contenu/images/alaska.png"></p> <!-- Logo du Blog -->

                    <figcaption> <!-- Titre du Blog -->
                        Billet simple pour l'Alaska
                    </figcaption>
                </figure>

                <span>Administration</span>

            </div>

            <figure>

                <img src="Contenu/images/admin.jpg"> <!-- Photo du membre d'administration -->

                <figcaption> <!-- Mini Bio -->
                    <span>Jean Forteroche</span><br/>
                    <span>Acteur et écrivain</span>
                </figcaption>

            </figure>

        </header><!-- /Header -->

        <section>

            <div class="sectionChapitre">
                <h1 class="titreSection"><?php echo $texteTitreSection; ?></h1>

                <?php echo $formulaireChapitre; ?>

            </div>

            <div class="sectionChapitre">
                <h1 class="titreSection">Liste des chapitres :</h1> <!-- Titre de la page -->

                <p>
                    Selectionner un chapitre dans la liste ci-dessous pour le modifier
                </p>

                <!-- Div qui contiendra le tableaux de la liste des Chapitres -->
                <div id="listeChapitres">
                    <?php echo $chapitres; ?> <!-- Insert le tableau d'affichage des chapitres -->
                </div>

            </div>

        </section>

        <script src="Contenu/js/tinymce/tinymce.min.js"></script> <!-- Fichier JS de tinymce -->
        <script src="Contenu/js/fonctionTinymce.js"></script> <!-- Fichier initialisation tinymce -->

    </body>
</html>