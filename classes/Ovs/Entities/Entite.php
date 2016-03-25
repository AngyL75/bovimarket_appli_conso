<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 21/03/2016
 * Time: 10:34
 */

namespace Ovs\Entities;


use Ovs\Api\Api;
use Ovs\Entities\Interfaces\Searchable;

class Entite extends Searchable
{
    public static function getLatLng($object)
    {
        if(isset($object->adresse)){
            if(isset($object->adresse->location) && is_array($object->adresse->location))
            {
                return $object->adresse->location;
            }
        }
        return null;
    }

    public static function getImage($photo)
    {
        $url=Api::getBaseUrl()."resources";
        $photo=str_replace("\\","/",$photo);
        return $url."/".$photo;
    }

    public static function getUrl()
    {
        return Api::getBaseApiUrl()."entites?name=";
    }

    public static function find($id)
    {
        return json_decode(Api::get(Api::getBaseApiUrl()."entites/".$id));
    }

    public static function getAdresse($entite)
    {
        $adresseStr="";
        if($entite->adresse) {
            $adresse = $entite->adresse;
            $adresseStr .= $adresse->adresse;
            if ($adresse->complementAdresse) {
                $adresseStr .= " - " . $adresse->complementAdresse;
            }
            $adresseStr .= " - " . $adresse->codePostal . " " . ucwords($adresse->ville);
        }
        return $adresseStr;
    }


}