<?php
$titlePage = 'Une erreur est survenue - Billet simple pour l\'Alaska';

ob_start(); ?>

<p>Une erreur est survenue : <?= $msgErreur ?></p>

<?php
$contenu = ob_get_clean();

require 'template.php';