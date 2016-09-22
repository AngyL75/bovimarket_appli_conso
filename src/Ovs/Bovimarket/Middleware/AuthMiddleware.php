<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/09/2016
 * Time: 15:06
 */

namespace Ovs\Bovimarket\Middleware;


use Ovs\Bovimarket\Utils\Session;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Psr7Middlewares\Middleware;
use Slim\Router;

class AuthMiddleware {

	protected $router;
	protected $environment;
	protected $notSecuredPath;

	/**
	 * AuthMiddleware constructor.
	 *
	 * @param Router $router
	 * @param Environment $env
	 */
	public function __construct(Router $router) {
		$this->router = $router;
		$this->notSecuredPath = array(
			"/login",
			"/login/process",
			"/register"
		);
	}

	function __invoke(Request $request, Response $response,$next) {

		$session = Middleware\AuraSession::getSession( $request );
		$segment = $session->getSegment( "overscan" );
		$isLogged = $segment->get( Session::loggedSessionKey, false );
		if(!$isLogged && !in_array($request->getRequestTarget(),$this->notSecuredPath)){
			$response = $response->withRedirect($this->router->pathFor("app.login.form"),403);
			$_SERVER["HTTP_REFERER"]=$request->getRequestTarget();
		}
		return $next($request,$response);
	}
}