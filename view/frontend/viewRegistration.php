<?php
ob_start(); // Mise en tampon du flux HTML

$titlePage = 'Page d\'inscription - Billet simple pour l\'Alaska';
?>

<div id="formulaireInscription">

<?php if(isset($etatInscription)) { echo $etatInscription; } ?>

    <form method="post" action="inscription.php">

        <p> <!-- Champ E-Mail -->
            <label for="adresseMail">Saisissez une adresse E-Mail :</label><br>
            <input type="email" name="adresseMail" id="adresseMail" required>
        </p>

        <p> <!-- Champ E-Mail confirmation -->
            <label for="adresseMailConfirmation">Confirmer votre adresse E-Mail :</label><br>
            <input type="email" name="adresseMailConfirmation" id="adresseMailConfirmation" required>
        </p>

        <p> <!-- Champ mot de passe -->
            <label for="motDePasse">Saisissez un mot de passe :</label><br>
            <input type="password" name="motDePasse" id="motDePasse" required>
        </p>

        <p> <!-- Champ mot de passe confirmation -->
            <label for="motDePasseConfirmation">Confirmer votre mot de passe :</label><br>
            <input type="password" name="motDePasseConfirmation" id="motDePasseConfirmation" required>
        </p>

        <p> <!-- Bouton d'envoi -->
            <input type="submit" value="Inscription">
        </p>

    </form>

</div>

<?php
$contenu = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';