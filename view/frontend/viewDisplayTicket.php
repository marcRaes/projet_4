<?php
ob_start(); // Mise en tampon du flux HTML

$titlePage = $TicketAsk[0]['title'] . ' - Billet simple pour l\'Alaska';
?>
<!-- Affichage du chapitre demander -->
<section>

    <article>

    <?php
        echo $TicketAsk[0]['dateTimeAdd'] . '<br>';
        echo $TicketAsk[0]['title'] . '<br>';
        echo $TicketAsk[0]['content'] . '<br>';
    ?>

    </article>

    <!-- Formulaire d'inscription avec ajout commentaire -->
    <div id="inscription">
        <?php if(isset($etatInscription)) { echo $etatInscription; } ?>
        <form method="post" action="affichageChapitre.php?id=<?php echo $_GET['id']; ?>">

            <p>
                <label for="adresseMail">Votre adresse E-mail :</label><br>
                <input type="email" name="adresseMail" id="adresseMail">
            </p>

            <p>
                <label for="motDePasse">Mot de passe :</label><br>
                <input type="password" name="motDePasse" id="motDePasse">
            </p>

            <p>
                <label for="commentaire">Votre commentaire :</label><br>
                <textarea name="commentaire"></textarea>
            </p>

            <p>
                <input type="hidden" name="idChapitre" value="<?php echo $_GET['id']; ?>">
                <input type="submit" value="Envoyer le commentaire">
            </p>

        </form>

    </div> <!-- /Formulaire d'inscription avec ajout commentaire -->

</section> <!-- /Affichage du chapitre demander -->

<?php
$contenu = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';