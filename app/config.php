<?php

use \Psr\Container\ContainerInterface;

return function (ContainerInterface $container) {
	$container->set("settings", function () {
		return [
			'displayErrorDetails' => true,
			'logErrorDetails' => true,
			'logErrors' => true,


			"db" => [
				"driver" => "mysql",
				"host" => "localhost",
				"database" => "baseSlim4",
				"username" => "root",
				"password" => "",
				"charset" => "utf8",
				"collation" => "utf8_unicode_ci",
				"prefix" => ""
			],


			'view' => [
				'template_path' => __DIR__ . "/../resources/views",
				'twig' => [
					'cache' => __DIR__ . "/../cache/twig",
					'debug' => true,
					'auto_reload' => true
				]
			]
		];
	});
};