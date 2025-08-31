<?php


namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\User;
use App\Auth\Auth;

class UserController extends Controller {


	public function changePassword($request, $response)
	{
		return $this->view->render($response, "user/changepw.twig");
	}

	public function postChangePassword($request, $response)
	{
		$password = $request->getParsedBody()["password"] ?? "";
		if (empty($password)) {
			die("");
		}

		$user = Auth::user();
		$user->password = password_hash($password, PASSWORD_DEFAULT);
		$user->save();

		Auth::login($user->id, $password);

		$this->flash->addMessage("info", "Senha alterada com sucesso");
		return redirect($request, $response, "user.changepw");
	}


}