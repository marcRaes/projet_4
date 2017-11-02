<?php 
// Variable de titre du site
$titrePage = 'Administration - Billet simple pour l\'Alaska'; 
// Définition des variables de texte
$texteTitreSection = 'Ajout d\'un nouveau chapitre';
$labelTitreChapitre = 'Titre du nouveau chapitre :';
$valueBoutonEnvoi = 'Ajouter le nouveaux chapitre';
?>

<?php ob_start(); ?> <!-- déclenche la mise en tampon du flux HTML -->

    <form method="post" action="index.php">

        <label for="titreChapitre"><?php echo $labelTitreChapitre; ?></label><br/>
        <input type="text" name="titreChapitre" id="titreChapitre"
        <?php if(isset($chapitre[0]['titre']))
        {
            echo 'value="' . $chapitre[0]['titre'] . '"';
        } 
        ?> 
        required="required" />

        <textarea name="contenuChapitre">
            <?php
            if(isset($chapitre[0]['contenu']))
            {
                echo $chapitre[0]['contenu'];
            }
            ?>
        </textarea>

        <?php if(isset($_GET['id']))
        {
        ?>
            <input type="hidden" name="idChapitre" value="<?php echo $_GET['id']; ?>" />
        <?php
        }
        else
        {
        ?>
            <input type="hidden" name="ajoutChapitre" value="ajouter" />
        <?php
        }
        ?>

        <input type="submit" value="<?php echo $valueBoutonEnvoi; ?>" />

    </form>

<?php $formulaireChapitre = ob_get_clean(); ?> <!-- récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start() -->

<?php ob_start(); ?> <!-- déclenche la mise en tampon du flux HTML -->

    <table>

    <?php
    // Boucle d'affichage des chapitres
    foreach($donneesChapitres as $champChapitre) :?>
        <tr>
            <td>
                <input type="checkbox" name="idChapitre" id="idChapitre" value="<?php echo $champChapitre['id']; ?>" />
            </td>
            <td>
                <a href="index.php?id=<?php echo $champChapitre['id']; ?>" class="titreChapitre"><?php echo $champChapitre['titre']; ?></a>
                
                <p>
                    <a href="index.php?id=<?php echo $champChapitre['id']; ?>">Modifier</a>
                    <a href="index.php?suppression=on&id=<?php echo $champChapitre['id']; ?>">Supprimer</a>
                </p>
            </td>
        </tr>
    <?php endforeach; ?> <!-- Fin de la boucle -->

    </table>

<?php $chapitres = ob_get_clean(); ?> <!-- récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start() -->

<?php require 'gabarit.php'; ?>