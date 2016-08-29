<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 09:36
 */

namespace Ovs\SlimUtils\Controller;


use Interop\Container\ContainerInterface;
use Ovs\Bovimarket\Entities\Panier;
use Psr7Middlewares\Middleware\AuraSession;
use Slim\Http\Request;
use Slim\Http\Response;

class BaseController
{
    protected $container;
    protected $cartSessionKey = "cart";

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     *
     * @param Response $response
     * @param $view
     * @param array $vars
     */
    public function render(Response $response,$view, $vars=array())
    {
        /*$session = $this->getSession($this->container->get("request"));
        $flashes = $session->getFlash("flashes");
        $vars["flashes"]=$flashes;*/
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
        $cart = $session->get($this->cartSessionKey, new Panier());
        return $cart;
    }


    public function savePanier($request,$panier)
    {
        $session = $this->getSession($request);
        $session->set($this->cartSessionKey,$panier);
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

    public function addFlash(Request $request, $type, $message)
    {
        $session = $this->getSession($request);
        $flashes = $session->getFlash("flashes",array());
        $flashes[$type]=$message;
        $session->setFlashNow("flashes",$flashes);
    }
}