<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/08/2016
 * Time: 12:25
 */

namespace Ovs\Bovimarket\Services\Api;


use GuzzleHttp\Exception\RequestException;
use Ovs\Bovimarket\Api\Api;

class EntiteFetcherService extends ApiFetcher
{
    protected $endpoint;

    public function __construct(Api $api)
    {
        parent::__construct($api);
        $this->endpoint = "entites/";
    }

    public function findAll()
    {
        try{
            $res = $this->api->get($this->endpoint);
            $body = $res->getBody();
            return $body;
        }catch (RequestException $e){

        }
    }

}