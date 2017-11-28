<!--***************************************************
* Cette page affichera les commentaires d'un chapitre *
****************************************************-->
<?php
// Titre de la page
if(isset($comments[0]))
{
    $this->setTitle('Commentaires : ' . $comments[0]->titleTicket() . ' - Billet simple pour l\'Alaska');
}
else
{
    $this->setTitle('Aucun commentaires pour ce chapitre - Billet simple pour l\'Alaska');
}
?>

<span class="linkPage"><a href="admin.php">Voir la liste des chapitres</a></span> <!-- Lien vers la liste des chapitres -->

<!-- Affichage des commentaires -->
<section id="comments">
    <h1><?= $titleSection; ?></h1>

    <?php
    if(count($comments) != 0)
    {
        for($i = 0; $i < count($comments); $i++) :

        if(isset($_GET['idTicket'])) { $idTicket = $_GET['idTicket']; } else { $idTicket = $comments[$i]->idTicket(); }
    ?>
        <article <?php if($comments[$i]->alertComment()) { ?>class="commentAlert"<?php } else { ?>class="comment"<?php } ?>>
            <div class="headerCommentaire">
                <p>Poster par : <span><?= $comments[$i]->mailMember(); ?></span></p>
                <p>Poster le : <span><?= $comments[$i]->dateTimeAddComment(); ?></span></p>
            </div>

            <div class="contentComment">
                <?= $comments[$i]->contentComment(); ?>
            </div>

            <ul>
                <li><a href="admin.php?action=delete&deleteComment=on&idComment=<?= $comments[$i]->idComment(); ?>" title="Supprimer le commentaire">Supprimer</a></li>
                <li><a href="index.php?action=ticket&id=<?= $idTicket; ?>" title="Visualiser le chapitre du commentaire" target=_blank>Visualiser le chapitre</a></li>
            <?php
            if($comments[$i]->alertComment())
            {
            ?>
                <li><a href="admin.php?action=comment&approve=on&id=<?= $comments[$i]->idComment(); ?>" title="Approuver le commentaire signaler">Approuver le commentaire</a></li>
            <?php
            }
            ?>
            </ul>
        </article>
    <?php
        endfor;
    }
    else
    {
        echo 'Aucun commentaire n\'a encore était poster pour ce chapitre !';
    }
    ?>
</section> <!-- /Affichage des commentaires -->
