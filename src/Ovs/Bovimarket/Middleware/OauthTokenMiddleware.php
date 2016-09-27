<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/09/2016
 * Time: 15:59
 */

namespace Ovs\Bovimarket\Middleware;


use Ovs\Bovimarket\Entities\Api\OauthToken;
use Ovs\Bovimarket\Twig\BoviExtension;
use Ovs\Bovimarket\Utils\Session;
use Ovs\Bovimarket\Utils\UserManager;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Psr7Middlewares\Middleware;

class OauthTokenMiddleware {

	/** @var  App */
	protected $app;

	public function __construct( $app ) {
		$this->app = $app;
	}


	function __invoke( Request $request, Response $response, $next ) {
		$app = $this->app;
		/** @var UserManager $oauth */
		$oauth    = $app->getContainer()["oauth"];
		$auraSess = Middleware\AuraSession::getSession( $request );
		$auraSess->setCookieParams( array( 'lifetime' => '3600' ) );
		$session = $auraSess->getSegment( "overscan" );

		//Token en session
		if ( $session->get( Session::oauthToken, false ) ) {
			/** @var OauthToken $token */
			$token = $session->get( Session::oauthToken );
			//Expiré?
			if ( $token->isExpired() ) {
				$oauth->logUser( $session );
			} else {
				$tokenValue = $token->getToken();
				$oauth->refreshApiToken( $tokenValue );
			}
		} else {
			$oauth->logUser( $session );
		}
		$api = $app->getContainer()->get( "api" );
		$app->getContainer()->get( "view" )->addExtension( new BoviExtension( $api,$session ) );

		return $next( $request, $response );
	}


}