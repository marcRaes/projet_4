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

/* On cache cette partie qui pourrait servir plus tard...
// Fonction d'inscription d'un nouveau membre avec ajout d'un nouveau commentaire

// Fonction d'enregistrement d'un nouveau commentaire
function enregistrementCommentaire($idMembre, $commentaire, $idChapitre)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
    $dateHeure = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle

    $requete = $bdd->prepare('INSERT INTO commentaires(commentaire, dateHeureAjout, idChapitre, idMembre) VALUES(:commentaire, :dateHeureAjout, :idChapitre, :idMembre)');
    $requete->execute(array(
        'commentaire' => $commentaire,
        'dateHeureAjout' => $dateHeure,
        'idChapitre' => $idChapitre, // ID du chapitre sera modifier par l'id du chapitre ou le commentaire en question sera inscrit...
        'idMembre' => $idMembre
    )) or die(print_r($requete->errorInfo(), TRUE));
}
*/