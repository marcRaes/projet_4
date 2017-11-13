<!--*******************************************************************
* Cette page affichera le formulaire de connexion de l'administration *
********************************************************************-->

<?php ob_start(); ?> <!-- Mise en tampon du flux HTML -->

<?php $titlePage = 'Connexion administration - Billet simple pour l\'Alaska'; ?> <!-- Titre de la page -->

<!-- Cadre de connexion -->
<div id="cadreConnexion">

    <p>Vous devez vous connecter pour administrer le Blog :</p>

    <?php if(isset($msgConnexion)) { echo '<p class="messageErreur">' . $msgConnexion . '</p>'; } ?> <!-- Affichera un message en cas d'erreur de connexion -->

    <form action="admin.php" method="post">

        <p> <!-- Champ adresse mail -->
            <label form="emailAdress">Identifiant :</label><br>
            <input type="text" name="emailAdress" id="emailAdress" required>
        </p>

        <p> <!-- Champ mot de passe -->
            <label form="password">Mot de passe :</label><br>
            <input type="password" name="password" id="password" required>
        </p>

        <p> <!-- Bouton de connexion -->
            <input type="submit" class="lienPage" value="connexion">
        </p>

    </form>

</div> <!-- /Cadre de connexion -->

<?php
$contenu = ob_get_clean(); // Récupére dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start

require 'template.php';