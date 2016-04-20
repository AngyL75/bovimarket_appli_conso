<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/03/2016
 * Time: 12:23
 */

namespace Ovs\Entities;


use Ovs\Entities\Interfaces\Searchable;

class Cuisson extends Searchable
{
    public static function getUrl()
    {

        if(isset($_SESSION["typeViande"])){
            $typeViande = $_SESSION["typeViande"];
            switch ($typeViande){
                case "agneau":
                    return "json://agneau/cuissons.json";
                    break;
                case "boeuf":
                    return "json://agneau/cuissons.json";
                    break;
                default:
                    return "json://agneau/cuissons.json";
                    break;
            }
        }else{
            return "json://agneau/cuissons.json";
        }
    }

    public static function findAllForMorceau($type,$id)
    {
        $results=array();
        $objects=static::findAll();
        foreach ($objects as $object) {
            $morceaux=$object->morceaux;
            if(is_object($morceaux)){
                if(isset($morceaux->$type)){
                    $morceauxType=$morceaux->$type;
                    if(is_array($morceauxType)){
                        if(in_array($id,$morceauxType)){
                            $results[]=$object;
                        }
                    }
                }
            }else{
                if(is_array($morceaux)){
                    if(in_array($id,$morceaux)){
                        $results[]=$object;
                    }
                }else {
                    if ($morceaux == $id) {
                        $results[] = $object;
                    }
                }
            }
        }
        return $results;
    }

}