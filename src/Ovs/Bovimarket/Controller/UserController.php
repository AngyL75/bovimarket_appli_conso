<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/08/2016
 * Time: 10:42
 */

namespace Ovs\Bovimarket\Controller;


use Ovs\Bovimarket\Entities\Api\Utilisateur;
use Ovs\Bovimarket\Services\API\UtilisateurFetcherService;
use Ovs\Bovimarket\Utils\Session;
use Ovs\Bovimarket\Utils\UserManager;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends BaseController
{
    public function loginFormAction(Request $request,Response $response,$args)
    {

        $server=$request->getServerParams();
	    $referer="/";
	    if(isset($_SERVER["HTTP_REFERER"])) {
		    $referer = $_SERVER["HTTP_REFERER"];
	    }

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
        if($oauth->logUser($this->getSession($request),$login,$password)){
            $user = $this->get("utilisateurs")->me();
            $session = $this->getSession($request);
            $session->set(Session::loggedSessionKey,true);
            $session->set(Session::loggedUserSessionKey,$user);
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
        return $this->redirectToRoute($response,"map.homepage");
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
            // Log l'utilisateur auto
            /** @var UserManager $oauth */
            $oauth = $this->get("oauth");
            $oauth->logUser($session,$user->getEmail(),$user->getPassword());
            //Récupère mes infos
            $userFetcher = $this->get("utilisateurs");
            $user = $userFetcher->me();
            //Sauvegarde la connexion en Session
            $session->set(Session::loggedSessionKey, true);
            $session->set(Session::loggedUserSessionKey, $user);


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

}