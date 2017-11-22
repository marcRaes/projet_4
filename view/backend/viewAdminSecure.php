<!--*******************************************************************
* Cette page affichera le formulaire de connexion de l'administration *
********************************************************************-->

<?php $this->setTitle('Connexion administration - Billet simple pour l\'Alaska'); ?> <!-- Titre de la page -->

<!-- Cadre de connexion -->
<div id="frameConnection">

    <p>Vous devez vous connecter pour administrer le Blog :</p>

    <?php if(isset($_SESSION['errorAdmin'])) { echo '<p class="errorAdmin">' . $_SESSION['errorAdmin'] . '</p>'; } ?> <!-- Affichera un message en cas d'erreur de connexion -->

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
            <input type="submit" class="linkPage" value="connexion">
        </p>

    </form>

</div> <!-- /Cadre de connexion -->
