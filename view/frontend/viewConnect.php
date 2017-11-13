<?php
ob_start(); // Mise en tampon du flux HTML

$titlePage = 'Page de connexion - Billet simple pour l\'Alaska';
?>

<div id="formulaireConnexion">

<?php if(isset($etatConnexion)) { echo $etatConnexion; } ?>

    <form method="post" action="connection.php">

        <p>
            <label for="adresseMail">Votre adresse E-Mail :</label><br>
            <input type="email" name="adresseMail" id="adresseMail">
        </p>

        <p>
            <label for="motDePasse">Votre mot de passe :</label><br>
            <input type="password" name="motDePasse" id="motDePasse">
        </p>

        <p>
            <input type="submit" value="connexion">
        </p>

    </form>

</div>

<?php
$contenu = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';