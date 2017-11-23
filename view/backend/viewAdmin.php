<!--***************************************************************************************
* Cette page contient l'affichage des chapitres ainsi que des dernières activités du blog *
****************************************************************************************-->

<?php
// Titre de la page
$this->setTitle('Administration - Billet simple pour l\'Alaska');
?>

<span class="linkPage"><a href="admin.php?action=ticket">Ajouter un chapitre</a></span> <!-- Lien d'ajout d'un chapitre -->

<section id="indexAdmin"> <!-- Section qui affichera la liste des chapitres, ainsi que les derniers activités du blog -->

    <?php
    if($tickets != null)
    {
    ?>
    <article id="listTickets"> <!-- Liste des chapitres -->

        <form method="post" action="admin.php?action=delete">

            <div id="frameDisplayTickets">

                <div id="tableTickets">
                    <?php
                    // Boucle d'affichage des chapitres
                    for($i = 0; $i < count($tickets); $i++) :
                    ?>
                        <div class="tableRowTicket">

                            <div class="tableCellTicket">
                                <input type="checkbox" name="idTicket[<?= $i; ?>]" id="idTicket" value="<?= $tickets[$i]->id(); ?>"> <!-- Case à cocher -->
                            </div>

                            <div class="tableCellTicket">
                                <!-- Titre du chapitre -->
                                <a href="admin.php?action=ticket&change=on&idTicket=<?= $tickets[$i]->id(); ?>" class="titleTicket"><?= $tickets[$i]->title(); ?></a>
                                <!-- Contenu du chapitre couper -->
                                <p><?= $tickets[$i]->content(); ?></p>
                                <!-- Lien d'administration des chapitres -->
                                <li><a href="admin.php?action=ticket&change=on&idTicket=<?= $tickets[$i]->id(); ?>">Modifier</a></li>
                                <li><a href="admin.php?action=delete&deleteTicket=on&idTicket=<?= $tickets[$i]->id(); ?>">Supprimer</a></li>
                                <li><a href="admin.php?action=comment&comment=on&idTicket=<?= $tickets[$i]->id(); ?>&nbComments=<?= $nbComments[$i]; ?>">Afficher commentaire(s)</a></li>
                            </div>

                            <div class="tableCellTicket">
                                <?= $tickets[$i]->dateTimeAdd(); ?> <!-- Date et heure d'ajout du chapitres -->
                            </div>

                            <div class="tableCellTicket">
                                <?= $nbComments[$i]; ?> Commentaire(s) <!-- Nombre de commentaires du chapitres -->
                            </div>

                        </div>

                    <?php endfor; ?> <!-- Fin de la boucle -->

                </div> <!-- /tableTickets -->

            </div> <!-- /frameDisplayTickets -->

            <input type="hidden" name="deleteTicket" value="on"> <!-- Champ cacher qui permettra de valider la suppression de chapitre(s) -->
            <input type="submit" class="linkPage" value="Supprimer"> <!-- Bouton de suppression de chapitre(s) -->
        </form>

    </article> <!-- /Liste des chapitres -->

    <aside id="activitiesBlog"> <!-- Derniers activités du blog -->

        <?php
        if($nbCommentAlert != 0)
        {
        ?>
        <form action="admin.php" method="get">
            <?php
            if($nbCommentAlert == 1)
            {
            ?>
                <p><?= $nbCommentAlert; ?> commentaire a était signaler</p>
                <input type="hidden" name="action" value="comment"> <!-- Permettra de faire apparaitre les commentaires -->
                <input type="hidden" name="alertComments" value="on">
                <input type="hidden" name="nbComments" value="<?= $nbCommentAlert; ?>">
                <input type="submit" class="linkPage" value="Visualiser le commentaire">
            <?php
            }
            else
            {
            ?>
                <p><?= $nbCommentAlert; ?> commentaires ont était signaler</p>
                <input type="hidden" name="action" value="comment"> <!-- Permettra de faire apparaitre les commentaires -->
                <input type="hidden" name="alertComments" value="on">
                <input type="hidden" name="nbComments" value="<?= $nbCommentAlert; ?>">
                <input type="submit" class="linkPage" value="Visualiser les commentaires">
            <?php
            }
            ?>
        </form>
        <?php
        }
        ?>

        <h1>Dernières modifications :</h1>
        <!-- Affichage du dernier chapitre modifier -->
        <p id="TicketModify">
            Le chapitre :<br>
            <span class="infoModificationChapitre"><?= $lastTicketModify->title(); ?></span><br>
            à était modifier le :<br>
            <span class="infoModificationChapitre"><?= $lastTicketModify->dateTimeLastModified(); ?></span>
        </p>

    </aside> <!-- /Derniers activités du blog -->

    <?php
    }
    else
    {
        echo 'Votre roman ne contient encore aucun chapitre';
    }
    ?>

</section>
