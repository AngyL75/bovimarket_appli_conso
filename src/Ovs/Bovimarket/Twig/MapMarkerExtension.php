<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 10:28
 */

namespace Ovs\Bovimarket\Twig;


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
            new \Twig_SimpleFunction("createMarker",array($this,"createMarker"),array(
                "is_safe"=>array("html")
            ))
        );
    }

    public function createMarker($entite)
    {
        return Utils::createMapMarker($entite);
    }


}