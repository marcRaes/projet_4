<!--*******************************************************************
* Cette page affichera le formulaire de connexion de l'administration *
********************************************************************-->

<?php $this->setTitle('Connexion administration - Billet simple pour l\'Alaska'); ?> <!-- Titre de la page -->

<span class="lienPage"><a href="index.php">Retourner sur le blog</a></span> <!-- Lien de retour vers la page d'acceuil du blog -->

<!-- Cadre de connexion -->
<div id="cadreConnexion">

    <p>Vous devez vous connecter pour administrer le Blog :</p>

    <?php if(isset($_SESSION['erreurAdmin'])) { echo '<p class="messageErreur">' . $_SESSION['erreurAdmin'] . '</p>'; } ?> <!-- Affichera un message en cas d'erreur de connexion -->

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
