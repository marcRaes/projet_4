<?php
session_start(); // Active les sessions

require('controler/frontend.php'); // Appel le controleur

// Permet d'insérer la vue de l'affichage d'un chapitre
try
{
    callGetDisplayTicket();
}
catch(Exception $e)
{
    $msgErreur = $e->getMessage();
    require 'view/backend/viewError.php';
}