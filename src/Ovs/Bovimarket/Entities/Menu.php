<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/03/2016
 * Time: 10:25
 */

namespace Ovs\Bovimarket\Entities;

use Ovs\Bovimarket\Api\Api;
use Ovs\Bovimarket\Entities\Interfaces\Searchable;
use Ovs\Bovimarket\Utils\Utils;

class Menu
{

    public static function renderMenu($recette=null)
    {
        if(!$recette) {
            $recette = Recettes::findOneRandom();
        }
        $eleveur=Entite::findOneActiviteRandom("ELEVEUR");
        $filiere=Entite::findOneActiviteRandom("FILIERE");
        include Utils::getResourcesDir()."/views/menu.php";
    }
}