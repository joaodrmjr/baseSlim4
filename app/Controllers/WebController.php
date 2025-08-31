<?php


namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class WebController extends Controller {


	public function home($request, $response)
	{
		$response->getBody()->write("Olá mundo!");
		return $response;
	}

}