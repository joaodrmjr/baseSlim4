<?php

use \Psr\Container\ContainerInterface;

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return function (ContainerInterface $container) {

	$container->set("view", function ($container) {
		$settings = $container->get("settings");
		$twig = Twig::create($settings["view"]["template_path"], $settings["view"]["twig"]);


		return $twig;
	});

	// controllers
	$container->set("WebController", function ($container) {
		return new \App\Controllers\WebController($container);
	});

};