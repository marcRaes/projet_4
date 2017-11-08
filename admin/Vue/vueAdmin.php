<!--***************************************************************************************
* Cette page contient l'affichage des chapitres ainsi que des dernières activités du blog *
****************************************************************************************-->

<?php ob_start(); ?> <!-- Mise en tampon du flux HTML -->

<!-- Titre de la page -->
<?php $titrePage = 'Administration - Billet simple pour l\'Alaska'; ?>

<span class="lienPage"><a href="chapitre.php">Ajouter un chapitre</a></span> <!-- Lien d'ajout d'un chapitre -->

<section id="accueilAdmin"> <!-- Section qui affichera la liste des chapitres, ainsi que les derniers activités du blog -->

    <?php
    if($donneesChapitres != null)
    {
    ?>
    <article id="listeChapitres"> <!-- Liste des chapitres -->

        <form method="post" action="suppression.php">
            <table>
            <?php
            $idChapitre = 0; // Variable qui sera incrémenter à chaque passage dans la boucle et permettra de créer un array d'id

            // Boucle d'affichage des chapitres
            foreach($donneesChapitres as $champChapitre) :
                $nbCommentaire = getNbCommentaire($champChapitre['id']);
            ?>

                <tr>
                    <td>
                        <input type="checkbox" name="id[<?php echo $idChapitre; ?>]" id="id" value="<?php echo $champChapitre['id']; ?>" /> <!-- Case à cocher -->
                        <?php $idChapitre++; ?>
                    </td>

                    <td>
                        <!-- Titre du chapitre -->
                        <a href="chapitre.php?modification=on&id=<?php echo $champChapitre['id']; ?>" class="titreChapitre"><?php echo ucfirst($champChapitre['titre']); ?></a>

                        <!-- Contenu du chapitre -->
                        <p><?php echo $champChapitre['contenu']; ?></p>
                                    
                        <!-- Lien d'administration des chapitres -->
                        <ul>
                            <li><a href="chapitre.php?modification=on&id=<?php echo $champChapitre['id']; ?>">Modifier</a></li>
                            <li><a href="suppression.php?suppressionChapitre=on&id=<?php echo $champChapitre['id']; ?>">Supprimer</a></li>
                            <li><a href="commentaire.php?commentaire=on&id=<?php echo $champChapitre['id']; ?>&nbCommentaire=<?php echo $nbCommentaire; ?>">Afficher commentaire(s)</a></li>
                        </ul>

                    </td>

                    <td>
                        <p><?php echo $champChapitre['dateHeureAjoutChapitre']; ?></p> <!-- Date et heure d'ajout du chapitres -->
                    </td>

                    <td>
                        <?php echo $nbCommentaire; ?> Commentaire(s) <!-- Nombre de commentaires du chapitres -->
                    </td>
                </tr>
            <?php endforeach; ?> <!-- Fin de la boucle -->
                    
            </table>
                
            <input type="hidden" name="suppressionChapitre" value="on" /> <!-- Champ cacher qui permettra de valider la suppression de chapitre(s) -->
            <input type="submit" class="lienPage" value="Supprimer" /> <!-- Bouton de suppression de chapitre(s) -->
        </form>

    </article> <!-- /Liste des chapitres -->

    <article id="activitesBlog"> <!-- Derniers activités du blog -->

        <h1>Dernières Activités :</h1>
        <!-- Affichage du dernier chapitre modifier -->
        <p>
            Le <span class="infoModificationChapitre"><?php echo $dernierChapitreModifier[0]['dateHeureModification']; ?></span><br>
            Vous avez modifier le chapitre<br>
            <span class="infoModificationChapitre"><?php echo $dernierChapitreModifier[0]['titre']; ?></span>
        </p>

    </article> <!-- /Derniers activités du blog -->

    <?php
    }
    else
    {
        echo 'Votre roman ne contient encore aucun chapitre';
    }
    ?>

</section>

<?php $contenu = ob_get_clean(); ?> <!-- Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start -->

<?php require 'gabarit.php'; ?>
