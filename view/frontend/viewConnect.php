<?php
$this->setTitle('Page de connexion - Billet simple pour l\'Alaska'); ?>

<div id="formulaireConnexion">

<?php if(isset($_SESSION['erreurBlog'])) { echo $_SESSION['erreurBlog']; } ?>

    <form method="post" action="index.php?action=connection">

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
