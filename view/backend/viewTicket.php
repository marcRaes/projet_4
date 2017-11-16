<!--*********************************************************************
* Cette page contient le formulaire d'ajout d'un chapitre qui se rempli *
* automatiquement à la selection d'un chapitre pour sa modification     *
**********************************************************************-->

<?php ob_start(); ?> <!-- Mise en tampon du flux HTML -->

<span class="lienPage"><a href="admin.php">Voir la liste des chapitres</a></span> <!-- Lien vers la liste des chapitres -->

<section id="chapitre">

    <h1><?= $textTitleSection; ?></h1>

    <div id="formulaireChapitre">

        <form method="POST" action="ticket.php">

            <!-- Champ titre du chapitre -->
            <p>
                <label for="titreChapitre"><?= $labelTitleTicket; ?></label><br>
                <input type="text" name="titreChapitre" id="titreChapitre"
                <?php if(isset($dataTicket[0]['title']))
                {
                    echo 'value="' . $dataTicket[0]['title'] . '"'; // Remplissage automatique du champ pour la modification du titre d'un chapitre
                } 
                ?>
                required>
            </p>

            <!-- Champ de contenu du chapitre -->
            <p>
                <label for="contenuChapitre"><?= $labelContentTicket; ?></label><br>
                <textarea name="contenuChapitre">
                <?php
                if(isset($dataTicket[0]['content']))
                {
                    echo $dataTicket[0]['content']; // Remplissage automatique du champ pour la modification du contenu d'un chapitre
                }
                ?>
                </textarea>
            </p>

            <p>
                <?php 
                if(isset($_GET['id']))
                {
                ?>
                    <input type="hidden" name="idChapitre" value="<?= $_GET['id']; ?>"> <!-- On conserve l'id du champ en cours d'édition dans un cham caché afin de valider la modification du chapitre -->
                <?php
                }
                else
                {
                ?>
                    <input type="hidden" name="ajoutChapitre" value="ajouter"> <!-- Sinon on applique un champ cacher pour valider l'ajout d'un nouveau chapitre -->
                <?php
                }
                ?>

                <input type="submit" class="lienPage" value="<?= $valueButtonSend; ?>"> <!-- Bouton d'envoi du chapitre -->
            </p>

        </form>

    </div>

</section>

<?php
$content = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';