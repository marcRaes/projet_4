<?php $titrePage = 'Administration - Billet simple pour l\'Alaska'; ?>

<?php ob_start() ?>
<p>Une erreur est survenue : <?php echo $msgErreur; ?></p>
<?php $contenuErreur = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>