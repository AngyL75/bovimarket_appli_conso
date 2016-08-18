<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 10:28
 */

namespace Ovs\Bovimarket\Twig;


use Ovs\Bovimarket\Entities\Morceaux;
use Ovs\Bovimarket\Utils\Utils;

class MapMarkerExtension extends \Twig_Extension
{

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
                "is_safe" => array("html")
            )),
            new \Twig_SimpleFunction("mapDecoupe", array($this, "createDecoupe"), array(
                "is_safe"           => array("html"),
                "needs_environment" => true
            ))
        );
    }


    public function createDecoupe(\Twig_Environment $env, Morceaux $morceaux)
    {
        return $env->render("QRCode/decoupes/map_".$morceaux->getTypeViande().".html.twig",array("morceau"=>$morceaux));
    }

    public function createMarker($entite)
    {
        return Utils::createMapMarker($entite);
    }


}