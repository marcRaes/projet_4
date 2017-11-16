<?php
ob_start(); // Mise en tampon du flux HTML

$titlePage = 'Le blog de Jean Forteroche - Billet simple pour l\'Alaska';
?>

<div id="Chapitres">

    <p>Liste des chapitres :</p>

    <table>
    <?php
    // Boucle d'affichage des chapitres
    foreach($dataTickets as $areaTicket) :
    ?>
        <tr>
            <td>
                <!-- Titre du chapitre -->
                <a href="displayTicket.php?id=<?php echo $areaTicket['id']; ?>" class="titreChapitre"><?php echo ucfirst($areaTicket['title']); ?></a>
            </td>

            <td>
                <p><?php echo $areaTicket['dateTimeAddTicket']; ?></p> <!-- Date et heure d'ajout du chapitres -->
            </td>
        </tr>
    <?php endforeach; ?> <!-- Fin de la boucle -->

    </table>
</div>
<?php
$content = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';