<!--***************************************************
* Cette page affichera les commentaires d'un chapitre *
****************************************************-->

<?php
ob_start(); // Mise en tampon du flux HTML

// Titre de la page
$titlePage = 'Commentaires : ' . $dataComments[0]['titleTicket'] . ' - Billet simple pour l\'Alaska';

// Détermine le titre à afficher dans la section en fonction du nombre(s) de commentaire(s)
if(isset($_GET['comment']) && ($_GET['comment']) == 'on')
{
    if($_GET['nbComments'] == 1)
    {
        $titleSection = 'Voici le commentaire pour le chapitre : <br><span>' . $dataComments[0]['titleTicket'] . '</span>';
    }
    else if($_GET['nbComments'] > 1)
    {
        $titleSection = 'Voici les commentaires pour le chapitre :<br><span>' . $dataComments[0]['titleTicket'] . '</span>';
    }
    else // Si le nombre de commentaire et égale à 0
    {
        $titleSection = '';
    }
}
else if(isset($_GET['alertComments']) && ($_GET['alertComments']) == 'on')
{
    if($_GET['nbComments'] == 1)
    {
        $titleSection = 'Voici le commentaire signaler :';
    }
    else if($_GET['nbComments'] > 1)
    {
        $titleSection = 'Voici les commentaires signaler :';
    }
    else // Si le nombre de commentaire et égale à 0
    {
        $titleSection = '';
    }
}
?>

<span class="lienPage"><a href="admin.php">Voir la liste des chapitres</a></span> <!-- Lien vers la liste des chapitres -->

<!-- Affichage des commentaires -->
<section id="commentaires">
    <h1><?= $titleSection; ?></h1>

    <?php
    if($_GET['nbComments'] != 0)
    {
        foreach($dataComments as $comment) :
        
        if(isset($_GET['id'])) { $idTicket = $_GET['id']; } else { $idTicket = $comment['idTicket']; }
    ?>
        <article <?php if($comment['alertComment']) { ?>class="commentAlert"<?php } else { ?>class="comment"<?php } ?>>
            <div class="headerCommentaire">
                <p>Poster par : <span><?= $comment['mailMembre']; ?></span></p>
                <p>Poster le : <span><?= $comment['dateTimeAddComment']; ?></span></p>
            </div>

            <div class="contenuCommentaire">
                <?= $comment['contentComment']; ?>
            </div>

            <ul>
                <li><a href="delete.php?suppressionCommentaire=on&id=<?= $comment['idComment']; ?>">Supprimer</a></li>
                <li><a href="../affichageChapitre.php?id=<?= $idTicket; ?>" target=_blank>Visualiser le chapitre</a></li>
            <?php
            if($comment['alertComment'])
            {
            ?>
                <li><a href="comment.php?approve=on&id=<?= $comment['idComment']; ?>">Approuver le commentaire</a></li>
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

<?php
$contenu = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';