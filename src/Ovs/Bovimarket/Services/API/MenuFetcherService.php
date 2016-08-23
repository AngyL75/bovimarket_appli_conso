<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/08/2016
 * Time: 10:59
 */

namespace Ovs\Bovimarket\Services\API;


use Ovs\Bovimarket\Entities\Api\Menu;

class MenuFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "menus/{entiteId}";
    }

    public function getClass()
    {
        return Menu::class;
    }
}