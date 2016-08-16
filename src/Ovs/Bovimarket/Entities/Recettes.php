<?php

namespace Ovs\Bovimarket\Entities;
use Ovs\Bovimarket\Entities\Interfaces\Searchable;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 15/03/2016
 * Time: 10:41
 */
class Recettes extends Searchable
{
    public static function getUrl()
    {

        if(isset($_SESSION["typeViande"])){
            $typeViande = $_SESSION["typeViande"];
            switch ($typeViande){
                case "agneau":
                    return "json://agneau/listing_recettes_agneau.json";
                    break;
                case "boeuf":
                    return "json://boeuf/recettes.json";
                    break;
                default:
                    return "json://agneau/recettes_agneau.json";
                    break;
            }
        }else{
            return "json://agneau/recettes_agneau.json";
        }
    }

}