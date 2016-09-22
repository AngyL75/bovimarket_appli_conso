<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 12/08/2016
 * Time: 16:05
 */

namespace Ovs\SlimUtils;


use DebugBar\StandardDebugBar;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Ovs\Bovimarket\Api\Api;
use Ovs\Bovimarket\Middleware\AuthMiddleware;
use Ovs\Bovimarket\Middleware\OauthTokenMiddleware;
use Ovs\Bovimarket\Services\CuissonsFetcherService;
use Ovs\Bovimarket\Services\MorceauxFetcherService;
use Ovs\Bovimarket\Services\RecettesFetcherService;
use Ovs\Bovimarket\Utils\Session;
use Ovs\Bovimarket\Utils\UserManager;
use Psr7Middlewares\Middleware;
use Slim\App;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Stream;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

class ServicesManager {
	/**
	 * @param Container $container
	 */
	public static function registerServices( &$container ) {
		$configApi = $container->settings["api"];
		$configLog = $container->settings["logger"];

		$container["config"]   = $container->settings;
		$container["debugBar"] = new StandardDebugBar();


		$logger       = new Logger( $configLog["name"] );
		$logPath      = realpath( __DIR__ ) . "/../../../logs/" . $configLog["path"];
		$file_handler = new StreamHandler( $logPath );
		$logger->pushHandler( $file_handler );
		$container['logger'] = $logger;

		$container["oauth"] = new UserManager(
			$container,
			new Api(
				array(
					"base_uri" => $configApi["baseURI"]
				),
				$logger,
				$container["debugBar"]
			),
			$configApi["oauthLogin"],
			$configApi["oauthSecret"]
		);


		$container["morceaux"] = new MorceauxFetcherService();
		$container["recettes"] = new RecettesFetcherService();
		$container["cuissons"] = new CuissonsFetcherService();


		$view = new Twig(
			array(
				realpath( __DIR__ . "/../Bovimarket/Resources/views" ),
				'views/'
			),
			[
				'debug'       => $container->settings["debug"],
				'cache'       => 'cache/',
				'auto_reload' => $container->settings["debug"]
			]
		);
		$view->addExtension( new TwigExtension(
			$container['router'],
			$container['request']->getUri()
		) );
		$view->addExtension( new \Twig_Extension_Debug() );
		$view->addExtension( new \Twig_Extensions_Extension_Intl() );

		$container['view'] = $view;
	}


	public static function registerMiddlewares( App $app ) {

		Middleware::setStreamFactory( function ( $file, $mode ) {
			return new Stream( fopen( $file, $mode ) );
		} );


		if ( $app->getContainer()->settings["debug"] ) {
			$debugBar = $app->getContainer()["debugBar"];
			$app->add(
				Middleware::DebugBar( $debugBar )->captureAjax( true )
			);
		}


		$middlewares = array(
			Middleware::FormatNegotiator(),
			Middleware::AuraSession()->name( 'boviSession' ),
			new AuthMiddleware($app->getContainer()->get("router")),
			new OauthTokenMiddleware($app),
			function ( Request $request, Response $response, $next ) use ( $app ) {

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
		);

		/**
		 * On tourne le tableau parce qu'à priori, les middlewares sont ajoutés de manière à ce que le dernier ajouté soit le premier lancé
		 */
		foreach ( array_reverse( $middlewares ) as $middleware ) {
			$app->add( $middleware );
		}

	}

}