<?php
ob_start(); // Mise en tampon du flux HTML

$titlePage = 'Page d\'inscription - Billet simple pour l\'Alaska';
?>

<div id="formulaireInscription">

<?php if(isset($msgRegistration)) { echo $msgRegistration; } ?>

    <form method="post" action="registration.php">

        <p> <!-- Champ E-Mail -->
            <label for="emailAdress">Saisissez une adresse E-Mail :</label><br>
            <input type="email" name="emailAdress" id="emailAdress" <?php if(isset($msgRegistration)) { echo 'value='.$_POST['emailAdress']; } ?>>
        </p>

        <p> <!-- Champ E-Mail confirmation -->
            <label for="emailAdressConfirmation">Confirmer votre adresse E-Mail :</label><br>
            <input type="email" name="emailAdressConfirmation" id="emailAdressConfirmation" <?php if(isset($msgRegistration)) { echo 'value='.$_POST['emailAdressConfirmation']; } ?>>
        </p>

        <p> <!-- Champ mot de passe -->
            <label for="password">Saisissez un mot de passe :</label><br>
            <input type="password" name="password" id="password">
        </p>

        <p> <!-- Champ mot de passe confirmation -->
            <label for="passwordConfirmation">Confirmer votre mot de passe :</label><br>
            <input type="password" name="passwordConfirmation" id="passwordConfirmation">
        </p>

        <p> <!-- Bouton d'envoi -->
            <input type="submit" value="Inscription">
        </p>

    </form>

</div>

<?php
$content = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';