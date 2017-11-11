<!--***************************************************
* Cette page affichera les commentaires d'un chapitre *
****************************************************-->

<?php
ob_start(); // Mise en tampon du flux HTML

// Titre de la page
$titlePage = 'Commentaires : ' . $donneesCommentaire[0]['titleTicket'] . ' - Billet simple pour l\'Alaska';

// Détermine le titre à afficher dans la section en fonction du nombre(s) de commentaire(s)
if($_POST['nbCommentaire'] == 1)
{
    $titreSection = 'Voici le commentaire pour le chapitre : <br><span>' . $donneesCommentaire[0]['titleTicket'] . '</span>';
}
else
{
    $titreSection = 'Voici les commentaires pour le chapitre :<br><span>' . $donneesCommentaire[0]['titleTicket'] . '</span>';
}
?>

<span class="lienPage"><a href="admin.php">Voir la liste des chapitres</a></span> <!-- Lien vers la liste des chapitres -->

<!-- Affichage des commentaires -->
<section id="commentaires">
    <h1><?= $titreSection; ?></h1>

    <?php
    if($_GET['nbCommentaire'] != 0)
    {
        foreach($donneesCommentaire as $commentaire) :
    ?>
        <article>
            <div class="headerCommentaire">
                <p>Poster par : <span><?= $commentaire['mailMembre']; ?></span></p>
                <p>Poster le : <span><?= $commentaire['dateHeureAjoutCommentaire']; ?></span></p>
            </div>

            <div class="contenuCommentaire">
                <?= $commentaire['contenuCommentaire']; ?>
            </div>

            <ul>
                <li><a href="suppression.php?suppressionCommentaire=on&id=<?= $commentaire['idCommentaire']; ?>">Supprimer</a></li>
                <li><a href="../affichageChapitre.php?id=<?= $_POST['idChapitre']; ?>" target=_blank>Visualiser le chapitre</a></li>
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