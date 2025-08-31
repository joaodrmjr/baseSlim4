<?php


namespace App\Auth;


use App\Models\User;


class Auth {


	public static function login($id, $password)
	{
		$_SESSION["user"] = [
			"id" => $id,
			"password" => $password
		];
	}

	public static function attemp(array $params)
	{
		$username = $params["username"] ?? "";
		$password = $params["password"] ?? "";

		if (empty($username) || empty($password)) {
			return "Preencha todos os campos";
		}

		if (!$user = User::where("username", $username)->first()) {
			return "Nome de usuario nao encontrado";
		}
		if (!password_verify($password, $user->password)) {
			return "Senha incorreta";
		}

		self::login($user->id, $password);

		return "ok";
	}


	public static function check()
	{
		if (isset($_SESSION["user"])) {
			$session = $_SESSION['user'];
			if ($user = User::find($session['id'])) {
				if (password_verify($session['password'], $user->password)) {
					return true;
				}
			}
		}
		return false;
	}

	public static function user(): ?User
	{
		if (self::check()) {
			return User::find($_SESSION['user']['id']);
		}
		return null;
	}

	public static function logout()
	{
		unset($_SESSION['user']);
		// session_destroy();
	}

}