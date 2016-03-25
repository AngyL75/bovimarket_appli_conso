<?php

namespace Ovs\Entities;
use Ovs\Entities\Interfaces\Searchable;

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
        return "json://v2/recettes_agneau.json";
    }

}