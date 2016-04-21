<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/03/2016
 * Time: 09:11
 */

namespace Ovs\Utils;


class Utils
{

    public static function getIdMorceaux($default = 1)
    {
        if (isset($_GET["idMorceau"])) {
            $idMorceaux = $_GET["idMorceau"];
        } else {
            if (isset($_SESSION["morceau_id"])) {
                $idMorceaux = $_SESSION["morceau_id"];
            } else {
                $idMorceaux = $default;
            }
        }
        return $idMorceaux;
    }

    public static function getTypeViande()
    {
        if(isset($_SESSION["typeViande"])){
            return $_SESSION["typeViande"];
        }else{
            return "agneau";
        }
    }

    public static function getIdRecette($default = 1)
    {
        if (isset($_GET["idRecette"])) {
            $idRecette = $_GET["idRecette"];
        } else {
            $idRecette = $default;
        }
        return $idRecette;
    }

    public static function getIdCuisson($default = 1)
    {
        if (isset($_GET["idCuisson"])) {
            $idCuisson = $_GET["idCuisson"];
        } else {
            $idCuisson = $default;
        }
        return $idCuisson;
    }

    public static function getIdEntite($default = 1)
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            if (isset($_SESSION["entite_id"])) {
                $id = $_SESSION["entite_id"];
            } else {
                $id = $default;
            }
        }
        return $id;
    }

    public static function getImage($image)
    {
        $resDir = static::getResourcesDir();
        return static::getWebPathOfDir($resDir) . "/images/" . $image;
    }

    public static function getResourcesDir()
    {
        return __DIR__ . "/../Resources/";
    }

    public static function getWebPathOfDir($dir)
    {
        $realDir = realpath($dir);
        $baseDir = __DIR__ . "/../../../";
        $baseDir = realpath($baseDir);
        $realDir = str_replace($baseDir, "", $realDir);
        return $realDir;
    }

    public static function saveMorceau($id)
    {
        $_SESSION["morceau_id"] = $id;
    }

    public static function saveEntite($id)
    {
        $_SESSION["entite_id"] = $id;
    }

    public static function resetSession()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        session_destroy();
    }

    public static function getUrlDetailForObject($object)
    {
        switch($object->activite){
            case "RESTAURANT":
                return "/restaurant.php?id=".$object->id;
                break;
            case "RESTAURATION_COLLECTIVE":
                return "/resto.php?id=".$object->id;
                break;
            default:
                return "/boucher.php?id=".$object->id;
                break;

        }
    }

    public static function createMapMarker($object)
    {
        $latLng = \Ovs\Entities\Entite::getLatLng($object);
        if (!$latLng) {
            return "";
        }

        $url = static::getUrlDetailForObject($object);
        $icon = static::getIconForActivite($object->activite);

        $marker = <<<MARKER
var marker$object->id = new google.maps.Marker({
position: new google.maps.LatLng($latLng[0],$latLng[1]),
map: map,
url: "$url",
title: '$object->name',
icon: "$icon"
});

google.maps.event.addListener(marker$object->id, 'click', function() {
    window.location.href = this.url;
});

MARKER;


        return $marker;
    }

    public static function saveTypeViande()
    {
        if(isset($_GET["typeViande"])){
            $_SESSION["typeViande"]=$_GET["typeViande"];
        }
    }

    public static function getIconForActivite($type)
    {
        switch ($type) {
            case "ABATTOIR":
                return "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
                break;
            case "BOUCHER":
                return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/boucher.png");
                break;
            case "ELEVEUR":
                return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/eleveur.png");
                break;
            case "RESTAURANT":
                return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/restaurant.png");
                break;
            case "RESTAURATION_COLLECTIVE":
                return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/resto-co.png");
                break;
            default:
                return "http://maps.google.com/mapfiles/ms/icons/purple-dot.png";
                break;
        }
    }
}