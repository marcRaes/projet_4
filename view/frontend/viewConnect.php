<?php
$this->setTitle('Page de connexion - Billet simple pour l\'Alaska'); ?>

<section id="formConnectionRegistration">

    <form method="post" action="index.php?action=connection">

        <?php if(isset($_SESSION['errorConnect'])) { echo '<p class="errorBlog">' . $_SESSION['errorConnect'] . '</p>'; } ?>

        <p>
            <label for="emailAdress">Votre adresse E-Mail :</label><br>
            <input type="email" name="emailAdress" id="emailAdress">
        </p>

        <p>
            <label for="password">Votre mot de passe :</label><br>
            <input type="password" name="password" id="password">
        </p>

        <p>
            <input type="submit" class="buttonBlog" value="connexion">
        </p>

    </form>

</section>
