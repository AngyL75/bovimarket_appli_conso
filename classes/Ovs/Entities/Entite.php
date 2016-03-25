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
use Ovs\Utils\Utils;

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
        if(empty($photo)){
            return Utils::getWebPathOfDir(__DIR__."/../../../images/nophoto.png");
        }
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

    public static function findOneEleveurRandom()
    {
        $eleveurs=static::findAllFor(array("activite"=>"ELEVEUR"));
        if(is_array($eleveurs)) {
            $nbMax = count($eleveurs) - 1;
            return $eleveurs[rand(0, $nbMax)];
        }
        return null;
    }


    public static function hasValidCertifs($object)
    {
        foreach($object->certifications as $certif):
            if($certif->valide){return true;}
        endforeach;
        return false;
    }


}