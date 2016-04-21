<?php

namespace Ovs\Entities;

use Ovs\Entities\Interfaces\Searchable;
use Ovs\Utils\Utils;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 15/03/2016
 * Time: 09:38
 */
class Morceaux extends Searchable
{

    const BOEUF = "boeuf";
    const AGNEAU = "agneau";
    const PORC = "porc";
    const VEAU = "veau";

    public static function getUrl()
    {
        if (isset($_SESSION["typeViande"])) {
            $typeViande = $_SESSION["typeViande"];
            switch ($typeViande) {
                case self::AGNEAU:
                    return "json://agneau/listing_morceaux_agneau.json";
                    break;
                case self::BOEUF:
                    return "json://boeuf/listing_morceaux_boeufs.json";
                    break;
                default:
                    return "json://agneau/morceaux_agneau.json";
                    break;
            }
        } else {
            return "json://agneau/morceaux_agneau.json";
        }
    }

    public static function getImageDecoupe($morceau)
    {
        switch ($morceau->type_viande) {
            case self::AGNEAU:
                return static::getDecoupeAgneau($morceau);
                break;
            case self::BOEUF:
                return static::getDecoupeBoeuf($morceau);
                break;
        }
    }

    private static function getDecoupeAgneau($morceau)
    {
        $images = array(
            "1"  => "agneau1.png",
            "2"  => "agneau5.png",
            "3"  => "agneau6.png",
            "5"  => "agneau7.png",
            "7"  => "agneau9.png",
            "8"  => "agneau8.png",
            "9"  => "agneau3.png",
            "10" => "agneau4.png",
            "11" => "agneau2.png"
        );


        return "/images/" . $images[$morceau->id];
    }

    private static function getDecoupeBoeuf($morceau)
    {
        $images = array(
            "28" => "boeuf1.jpg",
            "1"  => "boeuf2.jpg",
            "33" => "boeuf3.jpg",
            "31"=> "boeuf4.jpg",
            "29" => "boeuf5.jpg",
            "30"=> "boeuf6.jpg",
            "32" => "boeuf7.jpg",
            "2" => "boeuf8.jpg",
            "26" => "boeuf9.jpg",
            "25" => "boeuf10.jpg",
            "3" => "boeuf11.jpg",
            "5" => "boeuf12.jpg",
            "22" => "boeuf13.jpg",
            "24" => "boeuf14.jpg",
            "23" => "boeuf15.jpg",
            "21" => "boeuf16.jpg",
            "20" => "boeuf17.jpg",
            "18" => "boeuf18.jpg",
            "10" => "boeuf19.jpg",
            "10" => "boeuf20.jpg",
            "9" => "boeuf21.jpg",
            "10" => "boeuf22.jpg",
            "9" => "boeuf23.jpg",
            "19" => "boeuf24.jpg",
            "6" =>"boeuf25.jpg",
            "7" => "boeuf26.jpg",
        );

        if(!isset($images[$morceau->id])){
            $images[$morceau->id]= "boeuf0.jpg";
        }
        return "/images/" . $images[$morceau->id];
    }

    public static function getIdForDecoupe($decoupe, $type = self::AGNEAU)
    {
        switch ($type) {
            case self::AGNEAU:
                $decoupes = array(
                    "selle"             => "7",
                    "filet"             => "5",
                    "collier"           => "1",
                    "cotes-decouvertes" => "2",
                    "cotes-secondaires" => "3",
                    "gigot-raccourci"   => "8",
                    "poitrine"          => "9",
                    "haut-cote"         => "10",
                    "epaule"            => "11"
                );
                break;
            case self::BOEUF: {
                $decoupes = array(
                    "gros-poitrine" => "28",
                    "collier" => "1",
                    "jumeau-pot-feu"=>"33",
                    "jumeau-biftek" => "31",
                    "macreuse-biftek" => "29",
                    "paleron"=>"30",
                    "macreuse-pot-feu" => "32",
                    "basse-cote"=>"2",
                    "poitrine"=>"26",
                    "plat-cote"=>"25",
                    "entrecote"=>"3",
                    "faux-filet"=>"5",
                    "bavette-aloyau"=>"22",
                    "flanchet"=>"24",
                    "bavette-flanchet"=>"23",
                    "hampe"=>"21",
                    "onglet"=>"20",
                    "gite"=>"18",
                    "tranche"=>"10",
                    "araignee"=>"10",
                    "noix-gite"=>"9",
                    "merlan"=>"10",
                    "rond-gite"=>"9",
                    "aiguillette"=>"19",
                    "filet"=>"6",
                    "rumstek"=>"7"
                );
                break;
            }
            default:
                $decoupes = array();
                break;
        }

        return (isset($decoupes[$decoupe]))?$decoupes[$decoupe]:"";
    }

    public static function renderMapForMorceau($morceau)
    {
        switch ($morceau->type_viande) {
            case self::AGNEAU:
                include_once Utils::getResourcesDir() . "/views/map_agneau.php";
                break;
            case self::BOEUF:
                include_once Utils::getResourcesDir() . "/views/map_boeuf.php";
                break;
        }
    }

}