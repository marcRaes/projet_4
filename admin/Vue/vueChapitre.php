<!--*********************************************************************
* Cette page contient le formulaire d'ajout d'un chapitre qui se rempli *
* automatiquement à la selection d'un chapitre pour sa modification     *
**********************************************************************-->

<?php ob_start(); ?> <!-- Mise en tampon du flux HTML -->

<span class="lienPage"><a href="admin.php">Voir la liste des chapitres</a></span> <!-- Lien d'ajout d'un chapitre -->

<section id="chapitre">

    <div id="formulaireChapitre">

        <form method="POST" action="chapitre.php">

            <!-- Champ titre du chapitre -->
            <p>
                <label for="titreChapitre"><?php echo $labelTitreChapitre; ?></label><br>
                <input type="text" name="titreChapitre" id="titreChapitre"
                <?php if(isset($chapitre[0]['titre']))
                {
                    echo 'value="' . $chapitre[0]['titre'] . '"'; // Remplissage automatique du champ pour la modification du titre d'un chapitre
                } 
                ?>
                required>
            </p>

            <!-- Champ de contenu du chapitre -->
            <p>
                <label for="contenuChapitre"><?php echo $labelContenuChapitre; ?></label><br>
                <textarea name="contenuChapitre">
                <?php
                if(isset($chapitre[0]['contenu']))
                {
                    echo $chapitre[0]['contenu']; // Remplissage automatique du champ pour la modification du contenu d'un chapitre
                }
                ?>
                </textarea>
            </p>

            <p>
                <?php 
                if(isset($_GET['id']))
                {
                ?>
                    <input type="hidden" name="idChapitre" value="<?php echo $_GET['id']; ?>"> <!-- On conserve l'id du champ en cours d'édition dans un cham caché afin de valider la modification du chapitre -->
                <?php
                }
                else
                {
                ?>
                    <input type="hidden" name="ajoutChapitre" value="ajouter"> <!-- Sinon on applique un champ cacher pour valider l'ajout d'un nouveau chapitre -->
                <?php
                }
                ?>

                <input type="submit" class="lienPage" value="<?php echo $valueBoutonEnvoi; ?>"> <!-- Bouton d'envoi du chapitre -->
            </p>

        </form>

    </div>

</section>

<?php $contenu = ob_get_clean(); ?> <!-- Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start -->

<?php require 'gabarit.php'; ?>