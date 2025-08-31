<?php



namespace App\Middleware;



use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;


class ValidationErrorsMiddleware implements MiddlewareInterface {


	protected $container;

	public function __construct($container) {
		$this->container = $container;
	}


	public function process(Request $request, RequestHandler $handler): Response
	{
		if (isset($_SESSION["errors"])) {
			$this->container->get("view")->getEnvironment()->addGlobal("errors", $_SESSION['errors']);
			unset($_SESSION['errors']);
		}

		return $handler->handle($request);
	}

}