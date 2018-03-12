<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/08/2016
 * Time: 17:31
 */

namespace Ovs\Bovimarket\Utils;


use Aura\Session\Segment;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerBuilder;
use Ovs\Bovimarket\Api\Api;
use Ovs\Bovimarket\Entities\Api\OauthToken;
use Ovs\Bovimarket\Entities\Api\Utilisateur;
use Ovs\Bovimarket\Services\API\BilletFetcherService;
use Ovs\Bovimarket\Services\API\CanauxFetcherService;
use Ovs\Bovimarket\Services\API\CertificationFetcherService;
use Ovs\Bovimarket\Services\API\CommandeFetcherService;
use Ovs\Bovimarket\Services\API\ProduitFetcherService;
use Ovs\Bovimarket\Services\API\UtilisateurFetcherService;
use Ovs\Bovimarket\Services\API\CommonFetcherService;
use Aura\Session\Exception;
use Ovs\Bovimarket\Services\API\MenuFetcherService;
use Ovs\Bovimarket\Services\API\EntiteFetcherService;
use Ovs\Bovimarket\Services\API\ActivitesFetcherService;

class UserManager
{

    protected $api;
    protected $container;

    /**
     * UserManager constructor.
     */
    public function __construct($container, Api $api, $clientLogin, $clientSecret)
    {
        $this->container = $container;
        $this->api = $api;
        $this->oauthClientLogin = $clientLogin;
        $this->oauthClientSecret = $clientSecret;
    }

    /**
     * @param Segment $session
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function logUser($session, $login = null, $password = null)
    {

        if ($session->get(Session::loggedSessionKey, false) && $session->get(Session::loggedUserSessionKey, null)) {
            /** @var Utilisateur $loggedUser */
            $loggedUser = $session->get(Session::loggedUserSessionKey);
            $login = $loggedUser->getEmail();
            if($loggedUser->getPassword()) $password= $loggedUser->getPassword();
        }elseif($login == null || $password == null){
            /*$login = "mobile";
            $password="mobile";*/
        }

        if(!$login || !$password) return false ;
        
        /*debug_print_backtrace() ;
        exit ;
        */
        $auth = base64_encode($this->oauthClientLogin . ":" . $this->oauthClientSecret);

        try {
            $response = $this->api->post("/bovimarket/oauth/token", array(
                "form_params" => array(
                    "grant_type" => "password",
                    "scope"      => "read write",
                    "username"   => $login,
                    "password"   => $password
                ),
                "headers"     => array(
                    "Authorization" => "Basic " . $auth
                )
            ));
            if ($response->getStatusCode() == 200) {
                $body = (string)$response->getBody();
                $this->container->get("debugBar")["messages"]->info("Retrieved Token : ".$body);
                $token=SerializerBuilder::create()->build()->deserialize($body,OauthToken::class,"json");
                $session->set(Session::oauthToken, $token);
                $this->refreshApiToken($token->getToken());
                return true;
            }
        }catch (RequestException $exception){
        	if($exception->getCode() == 400){
        		$body = (string)$exception->getResponse()->getBody();
		        $body = json_decode($body);
		        if($body->error_description == "Bad credentials"){
		        	return false;
		        }
	        }
            throw $exception;
            return false;
        }
    }

    public function refreshApiToken($token)
    {

        $container = $this->container;

        $configApi = $container->settings["api"];
        $logger = $container["logger"];

        $container["api"] = new Api(
            [
                "base_uri" => $configApi["baseURI"],
                "headers"  => [
                    "Authorization" => "Bearer " . $token
                ]
            ],
            $container["logger"],
            $container["debugBar"]
        );
        $container["activites"] = new ActivitesFetcherService($container["api"], $logger);
        $container["entites"] = new EntiteFetcherService($container["api"], $logger);
        $container["menus"] = new MenuFetcherService($container["api"], $logger);
        $container["produits"] = new ProduitFetcherService($container["api"], $logger);
        $container["certifications"] = new CertificationFetcherService($container["api"], $logger);
        $container["canaux"] = new CanauxFetcherService($container["api"], $logger);
        $container["utilisateurs"] = new UtilisateurFetcherService($container["api"], $logger);
        $container["commandes"] = new CommandeFetcherService($container["api"], $logger);
	    $container["billets"] = new BilletFetcherService($container["api"],$logger);
	    $container["common"] = new CommonFetcherService($container["api"],$logger);
	    
	    $this->container = $container;
	    $this->api = $container["api"];
    }

}