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
        $referer = $server["HTTP_REFERER"];

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
        return $this->redirectToRoute($response,"map.homepage");
    }

    public function registerAction(Request $request, Response $response, $args)
    {
        $userValues=$request->getParsedBodyParam("register");
        $user = Utilisateur::fromForm($userValues);
        /** @var UtilisateurFetcherService $userFetcher */
        $userFetcher = $this->get("utilisateurs");
        $user = $userFetcher->registerUser($user);
        if(is_a($user,Utilisateur::class)) {
            $session = $this->getSession($request);
            $session->set(Session::loggedSessionKey, true);
            $session->set(Session::loggedUserSessionKey, $user);


            if (isset($userValues["referer"])) {
                return $response->withRedirect($userValues["referer"]);
            }
        }else{
            $this->addFlash("danger","User exists");
            return $this->redirectToRoute($response,"app.login.form");
        }

        return $this->redirectToRoute($response,"app.commande.select_paiement");
    }

}