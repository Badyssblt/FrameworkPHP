<?php
require '../vendor/autoload.php';

use App\Router\Router;

$router = new Router();

$controllerPath =  '/var/www/framework/src/Controllers';

$router->discoverControllers($controllerPath);

$router->dispatch($_SERVER['REQUEST_URI']);
