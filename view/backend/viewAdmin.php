<!--***************************************************************************************
* Cette page contient l'affichage des chapitres ainsi que des dernières activités du blog *
****************************************************************************************-->

<?php
ob_start(); // Mise en tampon du flux HTML

// Titre de la page
$titlePage = 'Administration - Billet simple pour l\'Alaska';
?>

<span class="lienPage"><a href="ticket.php">Ajouter un chapitre</a></span> <!-- Lien d'ajout d'un chapitre -->

<section id="accueilAdmin"> <!-- Section qui affichera la liste des chapitres, ainsi que les derniers activités du blog -->

    <?php
    if($dataTickets != null)
    {
    ?>
    <article id="listeChapitres"> <!-- Liste des chapitres -->

        <form method="post" action="delete.php">
            
            <div id="blocTable">
                <table>

                <?php
                $idIncrement = 0; // Variable qui sera incrémenter à chaque passage dans la boucle et permettra de créer un array d'id

                // Boucle d'affichage des chapitres
                foreach($dataTickets as $areaTicket) :
                    $comment = new CommentsManager();
                    $dataComment = $comment->getNbComments($areaTicket['id']);
                    foreach($dataComment as $nbComment) :
                ?>

                    <tr>
                        <td>
                            <input type="checkbox" name="id[<?= $idIncrement; ?>]" id="id" value="<?= $areaTicket['id']; ?>"> <!-- Case à cocher -->
                            <?php $idIncrement++; ?>
                        </td>

                        <td>
                            <!-- Titre du chapitre -->
                            <a href="ticket.php?modification=on&id=<?= $areaTicket['id']; ?>" class="titreChapitre"><?= ucfirst($areaTicket['title']); ?></a>

                            <!-- Contenu du chapitre couper -->
                            <p><?= cutText($areaTicket['content'], 180); ?></p>
                                        
                            <!-- Lien d'administration des chapitres -->
                            <ul>
                                <li><a href="ticket.php?modification=on&id=<?= $areaTicket['id']; ?>">Modifier</a></li>
                                <li><a href="delete.php?suppressionChapitre=on&id=<?= $areaTicket['id']; ?>">Supprimer</a></li>
                                <li><a href="comment.php?comment=on&id=<?= $areaTicket['id']; ?>&nbComments=<?= $nbComment['nbComments']; ?>">Afficher commentaire(s)</a></li>
                            </ul>

                        </td>

                        <td>
                            <p><?= $areaTicket['dateTimeAddTicket']; ?></p> <!-- Date et heure d'ajout du chapitres -->
                        </td>

                        <td>
                            <?= $nbComment['nbComments']; ?> Commentaire(s) <!-- Nombre de commentaires du chapitres -->
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?> <!-- Fin de la boucle -->

                </table>
            </div>
                
            <input type="hidden" name="suppressionChapitre" value="on"> <!-- Champ cacher qui permettra de valider la suppression de chapitre(s) -->
            <input type="submit" class="lienPage" value="Supprimer"> <!-- Bouton de suppression de chapitre(s) -->
        </form>

    </article> <!-- /Liste des chapitres -->

    <aside id="activitesBlog"> <!-- Derniers activités du blog -->

        <?php
        $nbAlert = nbAlertComments(); // Permet de savoir le nombre de commentaires signaler
        if($nbAlert != null)
        {
        ?>
        <form action="comment.php" method="get">
            <?php
            if($nbAlert == 1)
            {
            ?>
                <p><?= $nbAlert; ?> commentaire a était signaler</p>
                <input type="hidden" name="alertComments" value="on">
                <input type="hidden" name="nbComments" value="<?= $nbAlert; ?>">
                <input type="submit" class="lienPage" value="Visualiser le commentaire">
            <?php
            }
            else
            {
            ?>
                <p><?= $nbAlert; ?> commentaires ont était signaler</p>
                <input type="hidden" name="alertComments" value="on">
                <input type="hidden" name="nbComments" value="<?= $nbAlert; ?>">
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
        <p id="TicketModifiy">
            Le <span class="infoModificationChapitre"><?= $lastTicketmodify[0]['dateTimeLastModified']; ?></span><br>
            Vous avez modifier le chapitre<br>
            <span class="infoModificationChapitre"><?= $lastTicketmodify[0]['title']; ?></span>
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

<?php
$content = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';