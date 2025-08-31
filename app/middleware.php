<?php

use Slim\App;

use Slim\Views\TwigMiddleware;

return function (App $app) {

	$settings = $app->getContainer()->get("settings");

	$app->addRoutingMiddleware();

	$app->addErrorMiddleware($settings['displayErrorDetails'], $settings['logErrors'], $settings['logErrorDetails']);


	$app->add(TwigMiddleware::create($app, $app->getContainer()->get("view")));

	$app->add(new \App\Middleware\ValidationErrorsMiddleware($app->getContainer()));

};