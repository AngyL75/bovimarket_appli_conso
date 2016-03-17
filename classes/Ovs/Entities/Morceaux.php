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
        return "json://v2/morceaux_agneau.json";
    }

}