<?php $this->setTitle($ticket->title() . ' - Billet simple pour l\'Alaska'); ?>

<section id="sectionTicket">
    <!-- Affichage du chapitre demander -->
    <article id="displayTicket">

        <p>Ajouté le : <span class="strong"><?= $ticket->dateTimeAdd(); ?></span></p> <!-- Date et heure d'ajout du chapitre -->

        <h1 class="titleTicket"><?= $ticket->title(); ?></h1> <!-- Titre du chapitre -->

        <div id="contentTicket">
            <?= $ticket->content(); ?> <!-- Contenu du chapitre -->
        </div>

    </article> <!-- /Affichage du chapitre demander -->

    <!-- Affichage des commentaires -->
    <article id="displayComments">

        <h1>Commentaires du chapitre :</h1>

        <div id="listComments">
            <?php for($i = 0; $i < count($commentsTicket); $i++) : ?>
                <?php
                    if($commentsTicket[$i]->alertComment() == 1)
                    {
                ?>
                    <div class="commentSignal">
                <?php
                    }
                    else
                    {
                ?>
                    <div class="comment">
                <?php
                    }
                ?>

                    <p class="headerComment">
                        <p>Poster par : <span class="strong"><?= $commentsTicket[$i]->mailMember(); ?></span></p>
                        <p>Le : <span class="strong"><?= $commentsTicket[$i]->dateTimeAddComment(); ?></span></p>
                    </p>

                    <div class="contentComment">
                        <?= $commentsTicket[$i]->contentComment(); ?>
                    </div>

                    <form action="index.php?action=ticket" method="post">
                        <p>
                            <input type="hidden" name="idComment" value="<?= $commentsTicket[$i]->idComment(); ?>">
                            <input type="hidden" name="reportComment" value="reportComment">
                            <?php
                            if($commentsTicket[$i]->alertComment() == 1)
                            {
                            ?>
                                <input type="submit" class="buttonBlog" value="Commentaire signaler" disabled>
                            <?php
                            }
                            else
                            {
                            ?>
                                <input type="submit" class="buttonBlog" value="Signaler le commentaire">
                            <?php
                            }
                            ?>

                        </p>
                    </form>

                </div>

            <?php endfor; ?>
        </div>

    </article> <!-- /Affichage des commentaires -->

    <!-- Formulaire ajout commentaire -->
    <article id="registrationPostComment">
        <h1>Laisser un commentaire :</h1>
        <p id="textPost">*Si vous ne disposez pas de compte, celui-ci sera automatiquement créer après l'ajout de votre commentaire.</p>

        <form action="index.php?action=ticket" method="post">

            <?php if(isset($_SESSION['errorPostComment'])) { echo '<p class="errorBlog">' . $_SESSION['errorPostComment'] . '</p>'; } ?>

            <div id="fieldsSeized">

            <?php
            if(isset($_SESSION['emailAdress']))
            {
            ?>
                <p>
                    <label for="emailAdress">Votre adresse E-mail :</label>
                    <input type="email" name="emailAdress" id="emailAdress" value="<?= $_SESSION['emailAdress']; ?>" disabled>
                    <input type="hidden" name="emailAdress" id="emailAdress" value="<?= $_SESSION['emailAdress']; ?>"> <!-- Champ qui sera transmis -->
                </p>
            <?php
            }
            else
            {
            ?>
                <p>
                    <label for="emailAdress">Votre adresse E-mail :</label>
                    <input type="email" name="emailAdress" id="emailAdress">
                </p>

                <p>
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password">
                </p>
            <?php
            }
            ?>

            </div>

            <div id="seizedComment">

                <p>
                    <label for="comment">Votre commentaire :</label><br>
                    <textarea name="comment"></textarea>
                </p>

            </div>

            <p>
                <input type="hidden" name="idTicket" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="publicationComment" value="publicationComment">
                <input type="submit" class="buttonBlog" value="Envoyer le commentaire">
            </p>

        </form>

    </article> <!-- /Formulaire ajout commentaire -->
</section>
