<?php
session_start(); // Active les sessions

require('controler/frontend.php'); // Appel le controleur

// Appel des fonctions et insertion du fichier "vueAdmin.php" avec une gestion des erreurs
try
{
    callGetTickets();
}
catch(Exception $e)
{
    $msgErreur = $e->getMessage();
    require 'view/backend/viewError.php';
}