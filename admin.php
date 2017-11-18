<?php
session_start(); // Active les sessions

require('controler/Router.php');

$router = new Router();
$router->routeRequest();
