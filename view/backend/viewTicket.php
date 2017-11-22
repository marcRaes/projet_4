<!--*********************************************************************
* Cette page contient le formulaire d'ajout d'un chapitre qui se rempli *
* automatiquement à la selection d'un chapitre pour sa modification     *
**********************************************************************-->

<span class="linkPage"><a href="admin.php">Voir la liste des chapitres</a></span> <!-- Lien vers la liste des chapitres -->

<section id="ticket">

    <h1><?= $titlePage['titleSection']; ?></h1>

    <div id="formTicket">

        <form method="POST" action="admin.php?action=ticket">

            <!-- Champ titre du chapitre -->
            <p>
                <label for="titleTicket"><?= $titlePage['titleTicket']; ?></label><br>
                <input type="text" name="titleTicket" id="titleTicket"
                <?php if(isset($_GET['idTicket'])) { echo 'value="' . $ticket->title() . '"'; } ?>
                required>
            </p>

            <!-- Champ de contenu du chapitre -->
            <p>
                <label for="contentTicket"><?= $titlePage['labelContentTicket']; ?></label><br>
                <textarea name="contentTicket">
                    <?php if(isset($_GET['idTicket'])) { echo $ticket->content(); } ?>
                </textarea>
            </p>

            <p>
                <?php
                if(isset($_GET['change']) && ($_GET['change'] == 'on'))
                {
                ?>
                    <input type="hidden" name="change" value="on"> <!-- Champ caché pour la modification d'un chapitre -->
                    <input type="hidden" name="idTicket" value="<?= $_GET['idTicket']; ?>"> <!-- On conserve l'id du champ en cours d'édition dans un champ caché afin de valider la modification du chapitre -->
                <?php
                }
                else
                {
                ?>
                    <input type="hidden" name="addTicket" value="add"> <!-- Sinon on applique un champ cacher pour valider l'ajout d'un nouveau chapitre -->
                <?php
                }
                ?>

                <input type="submit" class="linkPage" value="<?= $titlePage['buttonSend']; ?>"> <!-- Bouton d'envoi du chapitre -->
            </p>

        </form>

    </div>

</section>
