<!--***************************************************
* Cette page affichera les commentaires d'un chapitre *
****************************************************-->

<?php ob_start(); ?> <!-- Mise en tampon du flux HTML -->

<?php
$titrePage = 'Commentaires : ' . $donneesCommentaire[0]['titreChapitre'] . ' - Billet simple pour l\'Alaska'; // Titre de la page

// Détermine le titre à afficher dans la section en fonction du nombre(s) de commentaire(s)
if($_POST['nbCommentaire'] == 1)
{
    $titreSection = 'Voici le commentaire pour le chapitre : <br><span>' . $donneesCommentaire[0]['titreChapitre'] . '</span>';
}
else
{
    $titreSection = 'Voici les commentaires pour le chapitre :<br><span>' . $donneesCommentaire[0]['titreChapitre'] . '</span>';
}
?>

<span class="lienPage"><a href="admin.php">Voir la liste des chapitres</a></span> <!-- Lien d'ajout d'un chapitre -->

<!-- Affichage des commentaires -->
<section id="commentaires">
    <h1><?php echo $titreSection; ?></h1>

    <?php
    if($_GET['nbCommentaire'] != 0)
    {
        foreach($donneesCommentaire as $commentaire) :
    ?>
        <article>
            <div class="headerCommentaire">
                <p>Poster par : <span><?php echo $commentaire['mailMembre']; ?></span></p>
                <p>Poster le : <span><?php echo $commentaire['dateHeureAjoutCommentaire']; ?></span></p>
            </div>

            <div class="contenuCommentaire">
                <?php echo $commentaire['contenuCommentaire']; ?>
            </div>

            <ul>
                <li><a href="suppression.php?suppressionCommentaire=on&id=<?php echo $commentaire['idCommentaire']; ?>">Supprimer</a></li>
                <li><a href="../affichageChapitre.php?id=<?php echo $_POST['idChapitre']; ?>" target=_blank>Visualiser le chapitre</a></li>
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

<?php $contenu = ob_get_clean(); ?> <!-- Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start -->

<?php require 'gabarit.php'; ?>