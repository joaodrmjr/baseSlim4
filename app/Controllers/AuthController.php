<?php


namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\User;
use App\Auth\Auth;

class AuthController extends Controller {


	public function login($request, $response)
	{
		if (Auth::check()) {
			return redirect($request, $response, "home");
		}
		return $this->view->render($response, "login.twig");
	}

	public function postLogin($request, $response)
	{
		if (Auth::check()) {
			return redirect($request, $response, "home");
		}
		$data = $request->getParsedBody();

		$attemp = Auth::attemp($data);
		if ($attemp != "ok") {
			$this->flash->addMessage("error", $attemp);
			return redirect($request, $response, "auth.login");
		}

		$this->flash->addMessage("info", "Login realizado");
		return redirect($request, $response, "home");
	}

	public function logout($request, $response)
	{
		Auth::logout();
		$this->flash->addMessage("info", "Sessão encerrada");
		return redirect($request, $response, "home");
	}

}