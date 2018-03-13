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

    public function findByEntite($id)
    {
        $res = $this->api->get($this->getEndpoint() . 'entiteId/' . $id) ;
        $body = (string)$res->getBody();

        return $this->unserialize($body);
    }

    public function getClass()
    {
        return Canal::class;
    }
}