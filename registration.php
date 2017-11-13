<?php
session_start(); // Active les sessions

require('controler/frontend.php'); // Appel le controleur

// Permet d'insérer la vue de l'enregistrement d'un membre
try
{
    callRegistrationMember();
}
catch(Exception $e)
{
    $msgErreur = $e->getMessage();
    require 'view/backend/viewError.php';
}