<?php
session_start(); // Active les sessions

require('Controler/Frontend/Router.php');

$router = new Router();
$router->routeRequest();
