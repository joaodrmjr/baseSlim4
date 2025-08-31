<?php

use \Psr\Container\ContainerInterface;

use Slim\Views\Twig;

use Illuminate\Database\Capsule\Manager as Capsule;

return function (ContainerInterface $container) {

	// banco de dados
	$capsule = new Capsule();
	$capsule->addConnection($container->get("settings")["db"]);
	$capsule->setAsGlobal();
	$capsule->bootEloquent();

	$container->set("db", function ($container) use ($capsule) {
		return $capsule;
	});

	$container->set("flash", function () {
		return new \Slim\Flash\Messages();
	});

	$container->set("validation", function () {
		return new \App\Validation\Validator();
	});

	// twig view
	$container->set("view", function ($container) {
		$settings = $container->get("settings");
		$twig = Twig::create($settings["view"]["template_path"], $settings["view"]["twig"]);

		$twig->getEnvironment()->addGlobal("flash", $container->get("flash")->getMessages());		

		return $twig;
	});

	// controllers
	$container->set("WebController", function ($container) {
		return new \App\Controllers\WebController($container);
	});

};