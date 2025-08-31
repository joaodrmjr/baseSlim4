<?php


use Slim\Routing\RouteContext;

if (!function_exists("test")) {
	function test() {
		die("Test Function");
	}
}


if (!function_exists("redirect")) {
	function redirect($request, $response, $route, $status = 302) {
		$routeParser = RouteContext::fromRequest($request)->getRouteParser();
		$url = $routeParser->urlFor($route);
		return $response->withHeader('Location', $url)->withStatus($status);
	}
}