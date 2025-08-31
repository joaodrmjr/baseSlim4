<?php


namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\User;

class WebController extends Controller {


	public function home($request, $response)
	{

		return $this->view->render($response, "home.twig");
	}

	public function teste($request, $response)
	{
		return redirect($request, $response, "home");
	}


	public function flash($request, $response)
	{
		$this->flash->addMessage("info", "Testando flash messages");
		return redirect($request, $response, "home");
	}

}