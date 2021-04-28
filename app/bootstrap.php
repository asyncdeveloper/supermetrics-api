<?php

define('INC_ROOT', dirname(__DIR__));

//Include all dependencies of our application
require_once INC_ROOT .'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(INC_ROOT);
$dotenv->load();

new \App\Core\Database();

new App\Core\Router();
