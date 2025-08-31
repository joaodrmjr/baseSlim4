<?php

use \Psr\Container\ContainerInterface;

return function (ContainerInterface $container) {


	$container->set("WebController", function ($container) {
		return new \App\Controllers\WebController($container);
	});

};