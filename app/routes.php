<?php


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;


return function (App $app) {


	$app->get("/", "WebController:home")->setName("home");


	$app->get("/login", "AuthController:login")->setName("auth.login");
	$app->post("/login", "AuthController:postLogin");
	$app->get("/logout", "AuthController:logout")->setName("auth.logout");


	$app->group("/user", function (RouteCollectorProxy $group) use ($app) {


		$group->get("/changepw", "UserController:changePassword")->setName("user.changepw");
		$group->post("/changepw", "UserController:postChangePassword");

	})->add(new \App\Middleware\AuthMiddleware($app->getContainer()));
	
	
};