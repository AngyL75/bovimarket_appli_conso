<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/03/2016
 * Time: 10:25
 */

namespace Ovs\Entities;

use Ovs\Api\Api;
use Ovs\Entities\Interfaces\Searchable;
use Ovs\Utils\Utils;

class Menu
{

    public static function renderMenu()
    {
        $recette=Recettes::findOneRandom();
        $eleveur=Entite::findOneEleveurRandom();
        //$eleveur=Entite::find("55df29687525d90d7d066072");
        include Utils::getResourcesDir()."/views/menu.php";
    }
}