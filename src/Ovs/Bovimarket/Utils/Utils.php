<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/03/2016
 * Time: 09:11
 */

namespace Ovs\Bovimarket\Utils;


use Ovs\Bovimarket\Entities\Api\Entite;

class Utils
{
	public static function trunc($text, $maxLength = 300, $bDot = true)
	{
		$text = strip_tags($text) ;
		
		if (strlen($text) > $maxLength && $maxLength)
		{
			$text = substr($text, 0, $maxLength);
			$space = strrpos($text, ' ');
			if($space === false) $space = $maxLength ;
			$text = substr($text, 0, $space);
			if($bDot) $text = $text . '...' ;
		}
	
		return $text ;
	}
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
        return str_replace('\\', '/', static::getWebPathOfDir($resDir) . "/images/" . $image) ;
    }

    public static function getResourcesDir()
    {
        return __DIR__ . "/../../../../web/";
    }

    public static function getWebPathOfDir($dir)
    {
        $realDir = realpath($dir);
        $baseDir = __DIR__ . "/../../../../";
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
        switch($object->getActivite()){
            case "RESTAURANT":
                return "/restaurant.php?id=".$object->getId();
                break;
            case "RESTAURATION_COLLECTIVE":
                return "/resto.php?id=".$object->getId();
                break;
            default:
                return "/boucher.php?id=".$object->getId();
                break;

        }
    }

    /**
     * @param Entite $object
     * @return string
     */
    public static function createMapMarker($object)
    {

        $latLng = $object->getLatLng();
        if (!$latLng) {
            return "";
        }
        $activite = $object->getActivite();

        $url = static::getUrlDetailForObject($object);
        $icon = static::getIconForActivite($object->getActivite(), $object->getRealActivite(), $object->getProduits());
        $name=$object->getName();
        $name=addcslashes($name,"'");
        $id = $object->getId();

        $marker = <<<MARKER
var marker$id = new google.maps.Marker({
position: new google.maps.LatLng($latLng[0],$latLng[1]),
map: map,
url: "$url",
title: '$activite',
icon: "$icon"
});

google.maps.event.addListener(marker$id, 'click', function() {
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

    public static function getIconForActivite($type, $activite, $produits, $isFav)
    {

    	$suffix="";
	    if($isFav){
	    	$suffix="_fav";
	    }

        switch ($type) {
            case Constants::ABATTOIR :
	            return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/abattoir$suffix.png");
                break;
            case Constants::ARTISAN:
                if(strpos($activite, 'Boucher') !== false) return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/boucher$suffix.png");
                
                return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/artisan$suffix.png");
            case Constants::ELEVEUR:
                {
                    switch ($produits)
                    {
                        case Constants::BOEUF:
                            return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/boeuf$suffix.png");
                            break;
                        case Constants::PORC:
                            return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/porc$suffix.png");
                            break;
                        case Constants::MOUTON:
                            return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/mouton$suffix.png");
                            break;
                        case Constants::AGNEAU:
                            return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/mouton$suffix.png");
                            break;
                    }
                    
                    return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/eleveur$suffix.png");
                }
                break;
            case Constants::RESTAURANT:
                return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/restaurant$suffix.png");
                break;
            case Constants::RESTAURATION_COLLECTIVE:
                return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/resto-co$suffix.png");
                break;
	        case Constants::FILIERE:
		        return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/filiere$suffix.png");
	        	break;
            default:
                //return static::getWebPathOfDir(static::getResourcesDir() . "/images/pictos/defaut$suffix.png");
                return "http://maps.google.com/mapfiles/ms/icons/purple-dot.png";
                break;
        }
    }
}