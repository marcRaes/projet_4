<?php $this->setTitle('Le blog de Jean Forteroche - Billet simple pour l\'Alaska'); ?>

<section id="indexBlog">
    <article>
        <p><img src="contenu/images/admin.jpg"></p>
        <p>
            Bonjour à tout mes fans, vous êtes ici sur mon nouveau Blog que j'ai décider d'ouvrir afin de vous faire découvrir mon nouveau roman <span>"Billet simple pour l'Alaska"</span>.<br>
            Je publierais ce roman par chapitre directement sur ce blog vous faisant ainsi découvrir celui-ci en avant première.<br>
            <span>Merci à tous et bonne lecture.</span>
        </p>
    </article>

    <div id="listTicket">

        <h1>Chapitres du roman :</h1>

        <article>

            <?php
            // Boucle d'affichage des chapitres
            for($i = 0; $i < count($tickets); $i++) :
            ?>
                <div class="ticket">

                    <a href="index.php?action=ticket&id=<?= $tickets[$i]->id(); ?>" title="Lire le chapitre">
                        <span class="titleTicket"><?= $tickets[$i]->title(); ?></span> <!-- Titre du chapitre -->
                        <span class="dateTime">Ajouté le : <span class="strong"><?= $tickets[$i]->dateTimeAdd(); ?></span></span> <!-- Date et heure d'ajout du chapitres -->
                    </a>

                </div>
            <?php endfor; ?> <!-- Fin de la boucle -->

        </article>

    </div>
</section>
