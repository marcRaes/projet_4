<!--***************************************************
* Cette page affichera les commentaires d'un chapitre *
****************************************************-->
<?php
// Titre de la page
$this->setTitle('Commentaires : ' . $dataComments[0]['titleTicket'] . ' - Billet simple pour l\'Alaska');
?>

<span class="lienPage"><a href="admin.php">Voir la liste des chapitres</a></span> <!-- Lien vers la liste des chapitres -->

<!-- Affichage des commentaires -->
<section id="commentaires">
    <h1><?= $titleSection; ?></h1>

    <?php
    if($_GET['nbComments'] != 0)
    {
        foreach($dataComments as $comment) :

        if(isset($_GET['idTicket'])) { $idTicket = $_GET['idTicket']; } else { $idTicket = $comment['idTicket']; }
    ?>
        <article <?php if($comment['alertComment']) { ?>class="commentAlert"<?php } else { ?>class="comment"<?php } ?>>
            <div class="headerCommentaire">
                <p>Poster par : <span><?= $comment['mailMember']; ?></span></p>
                <p>Poster le : <span><?= $comment['dateTimeAddComment']; ?></span></p>
            </div>

            <div class="contenuCommentaire">
                <?= $comment['contentComment']; ?>
            </div>

            <ul>
                <li><a href="admin.php?action=delete&deleteComment=on&idComment=<?= $comment['idComment']; ?>">Supprimer</a></li>
                <li><a href="displayTicket.php?id=<?= $idTicket; ?>" target=_blank>Visualiser le chapitre</a></li>
            <?php
            if($comment['alertComment'])
            {
            ?>
                <li><a href="admin.php?action=comment&approve=on&id=<?= $comment['idComment']; ?>">Approuver le commentaire</a></li>
            <?php
            }
            ?>
            </ul>
        </article>
    <?php
        endforeach;
    }
    else
    {
        echo 'Aucun commentaire n\'a encore était poster pour ce chapitre !';
    }
    ?>
</section> <!-- /Affichage des commentaires -->
