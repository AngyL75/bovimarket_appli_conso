<?php

namespace Ovs\Entities;
use Ovs\Entities\Interfaces\Searchable;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 15/03/2016
 * Time: 09:38
 */
class Morceaux extends Searchable
{
    public static function getUrl()
    {
        if(isset($_SESSION["typeViande"])){
            $typeViande = $_SESSION["typeViande"];
            switch ($typeViande){
                case "agneau":
                    return "json://agneau/morceaux_agneau.json";
                    break;
                case "boeuf":
                    return "json://boeuf/morceaux.json";
                    break;
                default:
                    return "json://agneau/morceaux_agneau.json";
                    break;
            }
        }else{
            return "json://agneau/morceaux_agneau.json";
        }
    }

    public static function getImageDecoupe($morceau)
    {
        switch($morceau->type_viande){
            case "agneau":
                return static::getDecoupeAgneau($morceau);
                break;
        }
    }

    private static function getDecoupeAgneau($morceau)
    {
        $images=array(
            "1"=>"agneau1.png",
            "2"=>"agneau5.png",
            "3"=>"agneau6.png",
            "5"=>"agneau7.png",
            "7"=>"agneau9.png",
            "8"=>"agneau8.png",
            "9"=>"agneau3.png",
            "10"=>"agneau4.png",
            "11"=>"agneau2.png"
        );


        return "/images/".$images[$morceau->id];
    }

    public static function getIdForDecoupe($decoupe)
    {
        $decoupes=array(
            "selle"=>"7",
            "filet"=>"5",
            "collier"=>"1",
            "cotes-decouvertes"=>"2",
            "cotes-secondaires"=>"3",
            "gigot-raccourci"=>"8",
            "poitrine"=>"9",
            "haut-cote"=>"10",
            "epaule"=>"11"
        );

        return $decoupes[$decoupe];
    }

}