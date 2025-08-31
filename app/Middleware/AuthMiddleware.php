<?php



namespace App\Middleware;



use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

use App\Auth\Auth;


class AuthMiddleware implements MiddlewareInterface {


	protected $container;

	public function __construct($container) {
		$this->container = $container;
	}


	public function process(Request $request, RequestHandler $handler): Response
	{
		if (!Auth::check()) {
			$this->container->get("flash")->addMessage("error", "Acesso não permitido");
			$response = new Response();
			return redirect($request, $response, "auth.login");
		}

		return $handler->handle($request);
	}

}