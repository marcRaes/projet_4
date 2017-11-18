<!--***************************************************************************************
* Cette page contient l'affichage des chapitres ainsi que des dernières activités du blog *
****************************************************************************************-->

<?php
// Titre de la page
$this->setTitle('Administration - Billet simple pour l\'Alaska');
?>

<span class="lienPage"><a href="admin.php?action=ticket">Ajouter un chapitre</a></span> <!-- Lien d'ajout d'un chapitre -->

<section id="accueilAdmin"> <!-- Section qui affichera la liste des chapitres, ainsi que les derniers activités du blog -->

    <?php
    if($tickets != null)
    {
    ?>
    <article id="listeChapitres"> <!-- Liste des chapitres -->

        <form method="post" action="admin.php?action=delete">

            <div id="blocTable">
                <table>

                <?php
                $idIncrement = 0; // Variable qui sera incrémenter à chaque passage dans la boucle et permettra de créer un array d'id
                // Boucle d'affichage des chapitres
                foreach($tickets as $areaTicket) :
                ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="idTicket[<?= $idIncrement; ?>]" id="idTicket" value="<?= $areaTicket['id']; ?>"> <!-- Case à cocher -->
                            <?php $idIncrement++; ?>
                        </td>

                        <td>
                            <!-- Titre du chapitre -->
                            <a href="admin.php?action=ticket&change=on&idTicket=<?= $areaTicket['id']; ?>" class="titreChapitre"><?= ucfirst($areaTicket['title']); ?></a>

                            <!-- Contenu du chapitre couper -->
                            <p><?= $areaTicket['content']; ?></p>

                            <!-- Lien d'administration des chapitres -->
                            <ul>
                                <li><a href="admin.php?action=ticket&change=on&idTicket=<?= $areaTicket['id']; ?>">Modifier</a></li>
                                <li><a href="admin.php?action=delete&deleteTicket=on&idTicket=<?= $areaTicket['id']; ?>">Supprimer</a></li>
                                <li><a href="admin.php?action=comment&comment=on&idTicket=<?= $areaTicket['id']; ?>&nbComments=<?= $areaTicket['nbComments']; ?>">Afficher commentaire(s)</a></li>
                            </ul>

                        </td>

                        <td>
                            <p><?= $areaTicket['dateTimeAddTicket']; ?></p> <!-- Date et heure d'ajout du chapitres -->
                        </td>

                        <td>
                            <?= $areaTicket['nbComments']; ?> Commentaire(s) <!-- Nombre de commentaires du chapitres -->
                        </td>
                    </tr>
                <?php endforeach; ?> <!-- Fin de la boucle -->

                </table>
            </div>

            <input type="hidden" name="deleteTicket" value="on"> <!-- Champ cacher qui permettra de valider la suppression de chapitre(s) -->
            <input type="submit" class="lienPage" value="Supprimer"> <!-- Bouton de suppression de chapitre(s) -->
        </form>

    </article> <!-- /Liste des chapitres -->

    <aside id="activitesBlog"> <!-- Derniers activités du blog -->

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
                <input type="submit" class="lienPage" value="Visualiser le commentaire">
            <?php
            }
            else
            {
            ?>
                <p><?= $nbCommentAlert; ?> commentaires ont était signaler</p>
                <input type="hidden" name="action" value="comment"> <!-- Permettra de faire apparaitre les commentaires -->
                <input type="hidden" name="alertComments" value="on">
                <input type="hidden" name="nbComments" value="<?= $nbCommentAlert; ?>">
                <input type="submit" class="lienPage" value="Visualiser les commentaires">
            <?php
            }
            ?>
        </form>
        <?php
        }
        ?>

        <h1>Dernières Activités :</h1>
        <!-- Affichage du dernier chapitre modifier -->
        <p id="TicketModify">
            Le <span class="infoModificationChapitre"><?= $lastTicketModify['dateTimeLastModified']; ?></span><br>
            Vous avez modifier le chapitre<br>
            <span class="infoModificationChapitre"><?= $lastTicketModify['title']; ?></span>
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
