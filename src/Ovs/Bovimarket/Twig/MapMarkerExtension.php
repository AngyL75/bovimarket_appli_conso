<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 10:28
 */

namespace Ovs\Bovimarket\Twig;


use Ovs\Bovimarket\Api\Api;
use Ovs\Bovimarket\Entities\Morceaux;
use Ovs\Bovimarket\Utils\Utils;

class MapMarkerExtension extends \Twig_Extension
{
    protected $api;

    /**
     * MapMarkerExtension constructor.
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "create_map_marker";
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction("createMarker", array($this, "createMarker"), array(
                "is_safe"           => array("html"),
                "needs_environment" => true
            )),
            new \Twig_SimpleFunction("mapDecoupe", array($this, "createDecoupe"), array(
                "is_safe"           => array("html"),
                "needs_environment" => true
            )),
            new \Twig_SimpleFunction("apiImagePath", array($this, "getApiImagePath"), array(
                "is_sage" => array("html")
            ))
        );
    }


    public function createDecoupe(\Twig_Environment $env, Morceaux $morceaux)
    {
        return $env->render("QRCode/decoupes/map_" . $morceaux->getTypeViande() . ".html.twig", array("morceau" => $morceaux));
    }

    public function createMarker(\Twig_Environment $env, $entite)
    {
        return $env->render("Block/marker.html.twig", array("entite" => $entite));
    }

    public function getApiImagePath($path)
    {
        if($path) {
            return $this->api->getResourcesPath() . "/" . $path;
        }else{
            return Utils::getImage("nophoto.png");
        }
    }


}