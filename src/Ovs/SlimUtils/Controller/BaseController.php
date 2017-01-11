<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 09:36
 */

namespace Ovs\SlimUtils\Controller;


use Interop\Container\ContainerInterface;
use Ovs\Bovimarket\Entities\Api\Utilisateur;
use Ovs\Bovimarket\Entities\Panier;
use Ovs\Bovimarket\Twig\FlashExtension;
use Ovs\Bovimarket\Utils\Session;
use Psr7Middlewares\Middleware\AuraSession;
use Slim\Http\Request;
use Slim\Http\Response;

class BaseController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Verifie sur l'utilisateur est loggé
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    protected function isLogged(Request $request)
    {
        $session = $this->getSession($request);
        return $session->get(Session::loggedSessionKey,false);
    }

    protected function isSecure(Request $request,Response $response)
    {
        if(!$this->isLogged($request)){
            return $this->redirectToRoute($response,"app.login.form");
        }
        return null;
    }

    /**
     *
     * @param Response $response
     * @param $view
     * @param array $vars
     */
    public function render(Response $response,$view, $vars=array())
    {
        $session=$this->getSession($this->container->get("myRequest"));
        $session->getFlash("flashes");
        $this->get("view")->addExtension(new FlashExtension($session));

        return $this->container->get("view")->render($response,$view,$vars);
    }

    public function get($key)
    {
        return $this->container->get($key);
    }

    public function getSession($request)
    {
        $config = $this->get("config");
        $session  = AuraSession::getSession($request);
        if(isset($config["session"]) && isset($config["session"]["lifetime"])) {
            $session->setCookieParams(array("lifetime" =>$config["session"]["lifetime"]));
        }
        return $session->getSegment("overscan");
    }

    /**
     * @param $request
     * @return Panier
     */
    public function getPanier($request)
    {
        $session = $this->getSession($request);
        $cart = $session->get(Session::cartSessionKey, new Panier());
        return $cart;
    }


    public function savePanier($request,$panier)
    {
        $session = $this->getSession($request);
        $session->set(Session::cartSessionKey,$panier);
    }

    public function destroySession($request)
    {
        $session = AuraSession::getSession($request);
        $session->destroy();
    }

    public function redirectToRoute(Response $response,$routeName,$args=array())
    {
        return $response->withRedirect($this->get("router")->pathFor($routeName,$args));
    }

    public function addFlash($type, $message)
    {
        $session = $this->getSession($this->getRequest());
        $flashes = $session->getFlash("flashes",array());
        $flashes[$type]=$message;
        $session->keepFlash();
        $session->setFlashNow("flashes",$flashes);
    }

    public function getRequest()
    {
        return $this->container->get("myRequest");
    }

    /**
     * @param Request $request
     * @return mixed|Utilisateur
     */
    public function getUser(Request $request)
    {
        return $this->getSession($request)->get(Session::loggedUserSessionKey,null);
    }

    public function removePanier(Request $request)
    {
        return $this->getSession($request)->set(Session::cartSessionKey,null);
    }
    
    public function formatDate($sDate, $format = '%d %b %Y')
	{
		setlocale(LC_ALL, 'fr_FR');
		return utf8_encode(strftime(utf8_decode($format), is_numeric($sDate) ? $sDate : $this->_mktime($sDate))) ;
	}
	
	protected function _mktime($date)
	{
		if(!$date) return time() ;
	
		$h	= substr($date, 11, 2) ;
		$mn	= substr($date, 14, 2) ;
		$s	= substr($date, 17, 2) ;
	
		$d = substr($date, 8, 2) ;
		$m = substr($date, 5, 2) ;
		$y = substr($date, 0, 4) ;
	
		return mktime($h, $mn, $s, $m, $d, $y) ;
	}
}