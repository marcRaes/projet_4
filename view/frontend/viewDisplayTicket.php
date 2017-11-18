<?php $this->setTitle($ticketAsk['title'] . ' - Billet simple pour l\'Alaska'); ?>

<section>

<!-- Affichage du chapitre demander -->
    <article>

    <?php
        echo $ticketAsk['dateTimeAdd'] . '<br>';
        echo $ticketAsk['title'] . '<br>';
        echo $ticketAsk['content'] . '<br>';
    ?>

    </article>

<!-- Affichage des commentaires -->
    <?php foreach($commentsTicketAsk as $comment) : ?>
    <article>

    <?php
        echo $comment['dateTimeAddComment'] . '<br>';
        echo $comment['mailMember'] . '<br>';
        echo $comment['contentComment'] . '<br>';
    ?>

        <form action="index.php?action=ticket" method="post">
            <p>
                <input type="hidden" name="idComment" value="<?= $comment['idComment']; ?>">
                <input type="hidden" name="reportComment" value="reportComment">
                <input type="submit" value="Signaler le commentaire">
            </p>
        </form>

    </article>
    <?php endforeach; ?>

    <!-- Formulaire d'inscription avec ajout commentaire -->
    <div id="inscription">
        <?php if(isset($_SESSION['erreurBlog'])) { echo $_SESSION['erreurBlog']; } ?>
        <form action="index.php?action=ticket" method="post">

            <?php
            if(isset($_SESSION['emailAdress']))
            {
            ?>
            <p>
                <label for="emailAdress">Votre adresse E-mail :</label><br>
                <input type="email" name="emailAdress" id="emailAdress" value="<?= $_SESSION['emailAdress']; ?>" disabled>
            </p>
            <?php
            }
            else
            {
            ?>
            <p>
                <label for="emailAdress">Votre adresse E-mail :</label><br>
                <input type="email" name="emailAdress" id="emailAdress">
            </p>

            <p>
                <label for="password">Mot de passe :</label><br>
                <input type="password" name="password" id="password">
            </p>
            <?php
            }
            ?>

            <p>
                <label for="comment">Votre commentaire :</label><br>
                <textarea name="comment"></textarea>
            </p>

            <p>
                <input type="hidden" name="idTicket" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="publicationComment" value="publicationComment">
                <input type="submit" value="Envoyer le commentaire">
            </p>

        </form>

    </div> <!-- /Formulaire d'inscription avec ajout commentaire -->

</section> <!-- /Affichage du chapitre demander -->
