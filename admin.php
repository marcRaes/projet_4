<?php
session_start(); // Active les sessions

require('Controler/Backend/Router.php');

$router = new Router();
$router->routeRequest();
