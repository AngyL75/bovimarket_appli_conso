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
        if($this->logUser($oauth,$this->getSession($request),$login,$password))
        {
            if (isset($userValues["referer"])) {
                return $response->withRedirect($userValues["referer"]);
            }
            return $this->redirectToRoute($response,"map.homepage");
        }else{
        	$this->addFlash("danger","Identifiants non valides");
	        return $this->redirectToRoute($response,"app.login.form");
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
    	$userService = $this->get("utilisateurs");
    	
    	$commonService = $this->get("common");
    	
    	$user = $userService->me();
    	
    	$aAllAlergies = $commonService->getAllergies() ;
    	
    	/*$allergies = array(); 
    	$allergies[] = array('name' => 'Céréales contenant du gluten', 'label' => 'blé, seigle, orge, avoine, épeautre, kamut ou leurs souches hybridées) et produits à base de ces céréales.<br/>Exemple: Chapelure, pains, farines, viandes et poissons panés') ;
    	$allergies[] = array('name' => 'Crustacés', 'label' => 'et produits à base de crustacés<br/>Exemple: Crabes, crevettes, écrevisses. homards, bouillons, soupes ou sauces à base de fruits de mer') ;
    	$allergies[] = array('name' => 'Oeufs', 'label' => 'et produits à base d\'oeufs.<br/>Exemple: Pâtisseries, pâtes fraiches, mayonnaise, meringues') ;
    	$allergies[] = array('name' => 'Poissons', 'label' => 'et produits à base de poissons.<br/>Exemple: Sushis, conserves de poissons, fumets, bouillons') ;
    	$allergies[] = array('name' => 'Arachides', 'label' => 'et produits à base d\'arachides.<br/>Exemple: Huile d\'arachide, cacahuètes') ;
    	$allergies[] = array('name' => 'Soja', 'label' => 'et produits à base de soja. Tofu, sauces soja, certains bouillons ou fonds') ;
    	$allergies[] = array('name' => 'Lait', 'label' => 'et produits à base de lait (y compris de lactose).<br/>Exemple: Fromage, beurre, crème, desserts lactés, crêpes, pâtisseries') ;
    	$allergies[] = array('name' => 'Fruits à coques', 'label' => 'amandes, noisettes, noix, noix de : cajou, pécan, macadamia, du Brésil, du  Queensland, pistaches et produits à base de ces fruits.<br/>Exemple: Huiles de noix') ;
    	$allergies[] = array('name' => 'Céleri', 'label' => 'et produits à base de céleri') ;
    	$allergies[] = array('name' => 'Moutarde', 'label' => 'et produits à base de moutarde.<br/>Exemple: Condiments, sauces vinaigrettes, cornichons, mayonnaise') ;
    	$allergies[] = array('name' => 'Graines de sésame', 'label' => 'et  produits à base de graines de sésame.<br/>Exemple: Pains, hamburgers, gressins, huile de sésame') ;
    	$allergies[] = array('name' => 'Anhydride sulfureux et sulfite', 'label' => 'en concentration de plus de 10mg/kg ou 10 mg/l (exprimés en SO2).<br/>Exemple: Vin, vinaigre, jus de citron (en flacon)') ;
    	$allergies[] = array('name' => 'Lupin', 'label' => 'et produits à base de lupin.<br/>Exemples: Graines apéritif') ;
    	$allergies[] = array('name' => 'Mollusques', 'label' => 'et produits à base de mollusques. Bigorneaux, palourdes, pétoncles, huitres, moules, coquilles St Jacques, escargots, seiches, poulpe') ;
        */
    	
    	return  $this->render($response,"User/informations.html.twig",array(
            "user" => $user,
         	"allergies" => $aAllAlergies
        ));
    }
    
    public function showProfileAction(Request $request, Response $response, $args)
    {
    	$userService = $this->get("utilisateurs");
    	 
    	$user = $userService->me();
    	 
    	return  $this->render($response,"User/profile.html.twig",array(
    			"user" => $user,
    			"allergies" => [] //$allergies
    	));
    }
    
    public function favorisAction(Request $request, Response $response, $args)
    {
    	$userService = $this->get("utilisateurs");
    	 
    	$commonService = $this->get("common");
    	 
    	$user = $userService->me();
    	 
    	return  $this->render($response,"User/favoris.html.twig",array(
    			"user" => $user
    	));
    }
    
    public function friendsAction(Request $request, Response $response, $args)
    {
    	$userService = $this->get("utilisateurs");
    
    	$commonService = $this->get("common");
    
    	$user = $userService->me();
    
    	return  $this->render($response,"User/friends.html.twig",array(
    			"user" => $user
    	));
    }

    public function updateProfileAction(Request $request,Response $response,$args)
    {
        $userValues = $request->getParsedBodyParam("profile");
        $user = Utilisateur::fromForm($userValues);
        $this->get("utilisateurs")->updateUser($user);
        
        if(isset($userValues['allergies']))
        {
        	$commonService = $this->get("common");
        	 
        	$aAllAlergies = $commonService->getAllergies() ;
        	
        	$aAllergies = array() ;
        	foreach($userValues['allergies'] as $id)
        	{
        		$a = $aAllAlergies->find($id) ;
        		
        		if($a) array_push($aAllergies, $a) ;
        	}
        	
        	if(count($aAllergies))
        	{
        		$this->get("utilisateurs")->updateAllergies($aAllergies);
        	}
        }

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