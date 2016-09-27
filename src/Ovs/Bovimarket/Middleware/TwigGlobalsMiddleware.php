<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 27/09/2016
 * Time: 10:50
 */

namespace Ovs\Bovimarket\Middleware;


use Ovs\Bovimarket\Utils\Session;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Psr7Middlewares\Middleware;
use Slim\Views\Twig;

class TwigGlobalsMiddleware {

	protected $app;

	/**
	 * TwigGlobalsMiddleware constructor.
	 */
	public function __construct(App $app) {
		$this->app = $app;
	}

	function __invoke(Request $request, Response $response, $next) {

		$app =$this->app;

		/** @var Twig $view */
		$view = $app->getContainer()->get( "view" );

		$session = Middleware\AuraSession::getSession( $request );
		$segment = $session->getSegment( "overscan" );

		$isLogged = $segment->get( Session::loggedSessionKey, false );
		$view->getEnvironment()->addGlobal( "isLogged", $isLogged );
		$app->getContainer()["myRequest"] = $request;

		$resp = $next( $request, $response );

		return $resp;
	}
}