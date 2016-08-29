<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/08/2016
 * Time: 10:48
 */

namespace Ovs\Bovimarket\Services\API;


use Ovs\Bovimarket\Entities\Api\Canal;

class CanauxFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "canaux/";
    }

    public function getClass()
    {
        return Canal::class;
    }
}