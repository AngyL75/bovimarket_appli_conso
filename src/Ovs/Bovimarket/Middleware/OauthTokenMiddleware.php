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
	protected $notSecuredPath;

	public function __construct( $app ) {
		$this->app = $app;
		
		$this->notSecuredPath = array(
				"/login",
				"/login/process",
				"/register",
				"/presentation",
				"/register/process"
		);
	}


	function __invoke( Request $request, Response $response, $next ) {
		$app = $this->app;
		/** @var UserManager $oauth */
		$oauth    = $app->getContainer()["oauth"];
		$auraSess = Middleware\AuraSession::getSession( $request );
		$auraSess->setCookieParams( array( 'lifetime' => '3600' ) );
		$session = $auraSess->getSegment( "overscan" );

		//Token en session
		$bLoggued = false ;
		if ( $session->get( Session::oauthToken, false ) ) {
			/** @var OauthToken $token */
			$token = $session->get( Session::oauthToken );
			//Expiré?
			if ( $token->isExpired() ) {
				$bLoggued = $oauth->logUser( $session );
			} else {
				$tokenValue = $token->getToken();
				$oauth->refreshApiToken( $tokenValue );
				$bLoggued = true ;
			}
		} else {
			$bLoggued = $oauth->logUser( $session );
		}
		
		if(!$bLoggued && !in_array($request->getRequestTarget(), $this->notSecuredPath))
		{
			$url = $app->getContainer()->get("router")->pathFor("app.not_connected") ;
			$response = $response->withRedirect($url,403);
			$_SERVER["HTTP_REFERER"]=$request->getRequestTarget();
			
			header('Location:' . $url) ;
			exit ;
		}else{
			if(!in_array($request->getRequestTarget(),$this->notSecuredPath))
			{
				$api = $app->getContainer()->get( "api" );
				$app->getContainer()->get( "view" )->addExtension( new BoviExtension( $api, $session ) );
			}
		}

		return $next( $request, $response );
	}


}