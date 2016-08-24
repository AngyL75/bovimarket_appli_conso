<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 09:36
 */

namespace Ovs\SlimUtils\Controller;


use Interop\Container\ContainerInterface;
use Psr7Middlewares\Middleware\AuraSession;
use Slim\Http\Response;

class BaseController
{
    protected $container;

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
}