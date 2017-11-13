<?php
session_start(); // Active les sessions

require('controler/frontend.php'); // Appel le controleur

// Permet d'insérer la vue de la connection
try
{
    callConnectMember();
}
catch(Exception $e)
{
    $msgErreur = $e->getMessage();
    require 'view/backend/viewError.php';
}