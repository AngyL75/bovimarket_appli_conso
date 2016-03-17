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
        return "json://v2/cuissons.json";
    }

}