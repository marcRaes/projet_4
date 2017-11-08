<?php
// Effectue la connexion à la BDD
// Instancie et renvoie l'objet PDO associé
function getBdd()
{
    $host_name = 'localhost';
    $database = 'projet_4';
    $user_name = 'root';
    $password = '';

    $bdd = null;

    try {
      $bdd = new PDO("mysql:host=$host_name; dbname=$database; charset=utf8", $user_name, $password);
    } catch (PDOException $e) {
      echo "Erreur!: " . $e->getMessage() . "<br/>";
      die();
    }
    
    return $bdd;
}
// Fonction de connexion à l'espace administration
function connexionAdmin($email, $motDePasse)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    $requete = $bdd->prepare('SELECT id, adresseMail, motDePasse, statut FROM membres WHERE adresseMail = ?');
    $requete->execute(array($email));
    $donneesConnexion = $requete->fetch();

    if($donneesConnexion['adresseMail'] == $email)
    {
        if(password_verify($motDePasse, $donneesConnexion['motDePasse'])) // Vérifie si le mot de passe est correcte
        {
            if($donneesConnexion['statut'] == 'administrateur')
            {
                $_SESSION['connexionMembre'] = $donneesConnexion['id'];
                $_SESSION['statutMembre'] = 'administrateur';
                header('Location:admin.php');
            }
            else
            {
                return 'Vous n\'étes pas autoriser à administrer le Blog';
            }
        }
        else
        {
            return 'Mot de passe incorrecte';
        }
    }
    else
    {
        return 'L\'adresse E-Mail saisi est incorrecte';
    }
}

// Fonction de verification de connexion à l'espace administration
function connexionAuto($idMembre, $statutMembre)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    $requete = $bdd->prepare('SELECT id, statut FROM membres WHERE id = ?');
    $requete->execute(array($idMembre));

    $donneesConnexion = $requete->fetch();
}

// Fonction qui récupére tout les chapitres dans la BDD
function getChapitres()
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD
    
    // requéte à la BDD avec une jointure externe afin de récupérer le nombre de commentaires de chaque chapitre (A revoir plus tard)
    /*
    $requete = $bdd->query('SELECT c.id idChapitre, c.titre titreChapitre, c.contenu contenuChapitre, DATE_FORMAT(c.dateHeureAjout, \'%d-%m_%Y à %Hh%i\') AS dateHeureAjoutChapitre, com.idChapitre idChapitreCommentaire FROM chapitres c LEFT JOIN commentaires com ON com.idChapitre = c.id ORDER BY c.dateHeureAjout DESC') or die(print_r($requete->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    */
    $requete = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(dateHeureAjout, \'%d-%m_%Y à %Hh%i\') AS dateHeureAjoutChapitre FROM chapitres ORDER BY dateHeureAjout DESC');
    $donnees = $requete->fetchAll(); // On assemble les données reçu

    return $donnees; // Retourne les chapitres contenu dans la BDD
}

function getNbCommentaire($idChapitre)
{
    $bdd = getBdd();

    $requete = $bdd->prepare('SELECT COUNT(*) AS nbCommentaire FROM commentaires WHERE idChapitre=?');
    $requete->execute(array($idChapitre));

    $donneesNbCommentaire = $requete->fetch();

    return $donneesNbCommentaire[0]; // Retourne le nombre de commentaire
}

function getDernierChapitreModifier()
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    // requéte à la BDD avec une jointure externe afin de récupérer le nombre de commentaires de chaque chapitre
    $requete = $bdd->query('SELECT titre, DATE_FORMAT(dateHeureDerniereModification, \'%d-%m_%Y à %Hh%i\') AS dateHeureModification FROM chapitres
    ORDER BY dateHeureDerniereModification DESC LIMIT 0, 1') or die(print_r($requete->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

    $donnees = $requete->fetchAll(); // On assemble les données reçu

    return $donnees; // Retourne le dernier chapitre modifier
}

// Fonction de récupération d'un chapitre précis avec son ID
function getModifierChapitre($id)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD
    
    // Prépare la requéte de récupération du chapitre demander
    $requete = $bdd->prepare('SELECT titre, contenu, DATE_FORMAT(dateHeureAjout, \'%d-%m_%Y à %Hh%i\') AS dateHeureAjout, DATE_FORMAT(dateHeureDerniereModification, \'%d-%m_%Y à %Hh%i\') AS dateHeureModification FROM chapitres WHERE id = ?');
    // Execute la requéte de récupération avec la variable contenu dans l'URL
    $requete->execute(array($id)) or die(print_r($requete->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    
    $donneesChapitre = $requete->fetchAll(); // On assemble les données reçu
    
    return $donneesChapitre; // Retourne le chapitre demander
}

// Fonction d'ajout de chapitre
function ajoutChapitre($titre, $contenu)
{
    if((trim($titre) == false) || (trim($contenu) == false))
    {
        header('Location:admin.php');
    }
    else
    {
        $bdd = getBdd(); // Appel de la fonction de connexion à la BDD
        
        date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
        $dateHeure = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle
        
        // Prépare la requete d'ajout d'un nouveau chapitre
        $requete = $bdd->prepare('INSERT INTO chapitres(titre, contenu, dateHeureAjout) VALUES(:titre, :contenu, :dateHeure)');
        // Execute la requete d'ajout du chapitre
        $requete->execute(array(
            'titre' => $titre,
            'contenu' => $contenu,
            'dateHeure' => $dateHeure
        )) or die(print_r($requete->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

        header('Location:admin.php');
    }
}

// Fonction de modification d'un chapitre
function modifierChapitre($id, $titre, $contenu)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
    $dateHeure = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle

    // Prépare la requete pour la BDD
    $requete = $bdd->prepare('UPDATE chapitres SET titre = :nouveauTitre, 
    contenu = :nouveauContenu, dateHeureDerniereModification = :dateHeure WHERE id = :idChapitre');
    // Lance la requéte avec les données reçu
    $requete->execute(array(
        'nouveauTitre' => $_POST['titreChapitre'],
        'nouveauContenu' => $_POST['contenuChapitre'],
        'dateHeure' => $dateHeure,
        'idChapitre' => $_POST['idChapitre']
    )) or die(print_r($requete->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

    header('Location:admin.php');
}

// Fonction de suppression d'un chapitre
function supprimerChapitre($id)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD
    
    $requete = $bdd->prepare('DELETE FROM chapitres WHERE id = ?');
    $requete->execute(array($id)) or die(print_r($requete->errorInfo(), TRUE));
}

// Fonction de récupération d'un commentaire
function getCommentaires($id)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    $requete = $bdd->prepare('SELECT com.id idCommentaire, DATE_FORMAT(com.dateHeureAjout, \'%d-%m_%Y à %Hh%i\') AS dateHeureAjoutCommentaire, com.commentaire contenuCommentaire, m.adresseMail mailMembre, c.titre titreChapitre FROM commentaires com INNER JOIN membres m ON com.idMembre = m.id INNER JOIN chapitres c ON com.idChapitre = c.id WHERE com.idChapitre = ?');

    $requete->execute(array($id)) or die(print_r($requete->errorInfo(), TRUE));
    
    $commentaires = $requete->fetchAll(); // On assemble les données reçu
    
    return $commentaires; // Retourne les commentaires demander
}

// Fonction de suppression d'un commentaire
function supprimerCommentaire($id)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD
    
    $requete = $bdd->prepare('DELETE FROM commentaires WHERE id = ?');
    $requete->execute(array($id)) or die(print_r($requete->errorInfo(), TRUE));
}