<?php
// Effectue la connexion à la BDD
// Instancie et renvoie l'objet PDO associé
function getBdd()
{
    $bdd = new PDO('mysql:host = localhost; dbname=projet_4; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
}

// Fonction qui récupére tout les chapitres dans la BDD
function getChapitres()
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    $requete = $bdd->query('SELECT id, titre, DATE_FORMAT(dateHeureAjout, \'%d-%m_%Y à %Hh%i\') 
    AS date_creation_fr FROM chapitres ORDER BY dateHeureAjout DESC') or die(print_r($requete->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql

    $donnees = $requete->fetchAll(); // On assemble les données reçu

    return $donnees; // Retourne les chapitres contenu dans la BDD
}

function modifierChapitre($id, $titre, $contenu)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
    $dateHeure = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle

    // Prépare la requete pour la BDD
    $requete = $bdd->prepare('UPDATE chapitres SET titre = :nouveauTitre, 
    contenu = :nouveauContenu, dateHeureAjout = :dateHeure WHERE id = :idChapitre');
    // Lance la requéte avec les données reçu
    $requete->execute(array(
        'nouveauTitre' => $_POST['titreChapitre'],
        'nouveauContenu' => $_POST['contenuChapitre'],
        'dateHeure' => $dateHeure,
        'idChapitre' => $_POST['idChapitre']
    )) or die(print_r($requete->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
}

function getModifierChapitre($id)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    // Prépare la requéte de récupération du chapitre demander
    $requete = $bdd->prepare('SELECT titre, contenu FROM chapitres WHERE id = ?');
    // Execute la requéte de récupération avec la variable contenu dans l'URL
    $requete->execute(array($id)) or die(print_r($requete->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    
    $donneesChapitre = $requete->fetchAll(); // On assemble les données reçu
    
    return $donneesChapitre; // Retourne le chapitre demander
}

function ajoutChapitre($titre, $contenu)
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
}

function supprimerChapitre($id)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    $requete = $bdd->prepare('DELETE FROM chapitres WHERE id = ?');
    $requete->execute(array($id)) or die(print_r($requete->errorInfo(), TRUE));
}