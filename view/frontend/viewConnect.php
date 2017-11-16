<?php
ob_start(); // Mise en tampon du flux HTML

$titlePage = 'Page de connexion - Billet simple pour l\'Alaska';
?>

<div id="formulaireConnexion">

<?php if(isset($msgConnection)) { echo $msgConnection; } ?>

    <form method="post" action="connection.php">

        <p>
            <label for="emailAdress">Votre adresse E-Mail :</label><br>
            <input type="email" name="emailAdress" id="emailAdress">
        </p>

        <p>
            <label for="password">Votre mot de passe :</label><br>
            <input type="password" name="password" id="password">
        </p>

        <p>
            <input type="submit" value="connexion">
        </p>

    </form>

</div>

<?php
$content = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';