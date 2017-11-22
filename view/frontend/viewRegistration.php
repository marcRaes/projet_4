<?php $this->setTitle('Page d\'inscription - Billet simple pour l\'Alaska'); ?>

<section id="formConnectionRegistration">

    <form method="post" action="index.php?action=registration">

        <?php if(isset($_SESSION['errorRegistration'])) { echo '<p class="errorBlog">' . $_SESSION['errorRegistration'] . '</p>'; } ?>

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
            <input type="submit" class="buttonBlog" value="Inscription">
        </p>

    </form>

</section>
