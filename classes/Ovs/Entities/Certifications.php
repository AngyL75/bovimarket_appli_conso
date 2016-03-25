<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 21/03/2016
 * Time: 12:25
 */

namespace Ovs\Entities;


use Ovs\Api\Api;
use Ovs\Entities\Interfaces\Searchable;

class Certifications extends Searchable
{
    public static function getUrl()
    {
        return Api::getBaseApiUrl()."/certifications";
    }

}