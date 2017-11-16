<?php
session_start();

session_destroy();

// Renvoie l'utilisateur sur la derniere page enregistrer
header("Location: $_SERVER[HTTP_REFERER]");