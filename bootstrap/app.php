<?php


use \DI\Container;
use Slim\Factory\AppFactory;

// autoload composer
require __DIR__ . "/../vendor/autoload.php";


$container = new Container();


// config
$settings = require __DIR__ . "/../app/config.php";
$settings($container);

// cria a aplicação
AppFactory::setContainer($container);
$app = AppFactory::create();

$responseFactory = $app->getResponseFactory();


// dependencies
$dependencies = require __DIR__ . "/../app/dependencies.php";
$dependencies($container);


// middleware
$middleware = require __DIR__ . "/../app/middleware.php";
$middleware($app);


// rotas
$routes = require __DIR__ . "/../app/routes.php";
$routes($app);