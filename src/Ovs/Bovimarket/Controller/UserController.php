<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/08/2016
 * Time: 10:42
 */

namespace Ovs\Bovimarket\Controller;


use Aura\Session\Segment;
use Ovs\Bovimarket\Entities\Api\Utilisateur;
use Ovs\Bovimarket\Services\API\UtilisateurFetcherService;
use Ovs\Bovimarket\Utils\Session;
use Ovs\Bovimarket\Utils\UserManager;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends BaseController
{

	public function notConnectedAction( Request $request, Response $response, $args ) {
		return $this->render($response,"User/notConnected.html.twig");
	}

    public function loginFormAction(Request $request,Response $response,$args)
    {

        $server=$request->getServerParams();
	    $referer="/";

        return $this->render($response,"User/login.html.twig",array(
            "referer"=>$referer
        ));
    }

    public function loginAction(Request $request, Response $response, $args)
    {
        $userValues=$request->getParsedBodyParam("login");
        $login = $userValues["username"];
        $password = $userValues["password"];

        /** @var UserManager $oauth */
        $oauth = $this->get("oauth");
        if($this->logUser($oauth,$this->getSession($request),$login,$password)){
            if (isset($userValues["referer"])) {
                return $response->withRedirect($userValues["referer"]);
            }
            return $this->redirectToRoute($response,"map.homepage");
        }
    }

    public function logoutAction(Request $request,Response $response,$args)
    {
        $this->getSession($request)->set(Session::loggedSessionKey,false);
        $this->getSession($request)->set(Session::loggedUserSessionKey,null);
        $this->getSession($request)->set(Session::oauthToken,null);
	    $this->getSession($request)->set(Session::favoris,null);
        return $this->redirectToRoute($response,"map.homepage");
    }


	/**
	 * @param UserManager $oauthService
	 * @param UtilisateurFetcherService $userService
	 * @param Segment $session
	 * @param $login
	 * @param $password
	 *
	 * @return bool
	 */
	private function logUser($oauthService,$session,$login,$password){
		if($oauthService->logUser($session,$login,$password)){
			$userService=$this->get("utilisateurs");
			$user = $userService->me();
			$session->set(Session::loggedSessionKey,true);
			$session->set(Session::loggedUserSessionKey,$user);
			$this->updateFavorites($userService,$session);
			return true;
		}
		return false;
	}

	private function updateFavorites($userService,$session){
		$favs=$userService->getFavoris();
		$session->set(Session::favoris,$favs);
	}

	public function registerFormAction( Request $request, Response $response, $args ) {
		$server=$request->getServerParams();
		$referer="/";

		return $this->render($response,"User/register.html.twig",array(
			"referer"=>$referer
		));
    }

    public function registerAction(Request $request, Response $response, $args)
    {
        $userValues=$request->getParsedBodyParam("register");
        $user = Utilisateur::fromForm($userValues);
        $user->setHideTelephone(null);
        /** @var UtilisateurFetcherService $userFetcher */
        $userFetcher = $this->get("utilisateurs");

        // Inscription de l'utilisateur
        $user = $userFetcher->registerUser($user);
        //Inscription OK
        if(is_a($user,Utilisateur::class)) {
            $session = $this->getSession($request);
            $oauth = $this->get("oauth");
	        $this->logUser($oauth,$session,$user->getEmail(),$user->getPassword());
            if (isset($userValues["referer"])) {
                return $response->withRedirect($userValues["referer"]);
            }
        }else{
            $this->addFlash("danger","Ce compte existe déjà");
            return $this->redirectToRoute($response,"app.login.form");
        }

        return $this->redirectToRoute($response,"app.commande.select_paiement");
    }

    public function profileAction(Request $request, Response $response, $args)
    {
        $user = $this->get("utilisateurs")->me();
        return  $this->render($response,"User/profile.html.twig",array(
            "user"=>$user
        ));
    }

    public function updateProfileAction(Request $request,Response $response,$args)
    {
        $userValues = $request->getParsedBodyParam("profile");
        $user = Utilisateur::fromForm($userValues);
        $this->get("utilisateurs")->updateUser($user);

        $this->addFlash("success","Profil mis à jour");
        return $this->redirectToRoute($response,"app.profile");
    }

	public function changeFavoriteAction( Request $request, Response $response, $args ) {
		/** @var UtilisateurFetcherService $userFetcher */
		$userFetcher = $this->get("utilisateurs");
		if($args["action"]=="add") {
			$userFetcher->addFavoris( $args["idEntite"] );
		}else{
			$userFetcher->removeFavoris( $args["idEntite"] );
		}

		$this->updateFavorites($userFetcher,$this->getSession($request));

		return $response->withRedirect($_SERVER["HTTP_REFERER"]);
    }

}