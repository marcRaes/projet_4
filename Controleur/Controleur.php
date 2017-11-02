<?php

require 'Modele/Modele.php';

// Affiche le formulaire d'ajout et de modification d'un chapitre
function accueil()
{
    // Appel la fonction de récupération des chapitres
    return getChapitres();
}

// Appel la fonction de récupération d'un chapitre pour modification
function appelRemplisageFormulaire($id)
{
    // Appel de la fonction de récupération du chapitre pour la modification 
    return getModifierChapitre($id);
    // On ne fait pas de boucle foreach, le contenu du chapitre sera récupérer sous l'array $chapitre[0]...
}

// Appel la fonction de suppression d'un chapitre
function appelSuppressionChapitre($id)
{
    // Appel de la fonction de suppression d'un chapitre
    supprimerChapitre($id);
    
    // Renvoie l'utilisateur sur la page d'accueil de l'administration
    header('Location:index.php');
}

// Appel les fonctions pour l'ajout ou la modification d'un chapitre
function appelModificationChapitre($id, $titreChapitre, $contenuChapitre)
{
    // Appel la fonction de modification du chapitre dans la BDD
    modifierChapitre($id, $titreChapitre, $contenuChapitre);

    // Renvoie l'utilisateur sur la page d'accueil de l'administration
    header('Location:index.php');
}

function appelAjoutChapitre($titreChapitre, $contenuChapitre)
{
    // Appel de la fonction d'ajout d'un nouveau chapitre
    ajoutChapitre($titreChapitre, $contenuChapitre);

    // Renvoie l'utilisateur sur la page d'accueil de l'administration
    header('Location:index.php');
}