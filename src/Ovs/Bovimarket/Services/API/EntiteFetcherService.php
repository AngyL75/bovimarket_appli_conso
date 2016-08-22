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
use Ovs\Bovimarket\Entities\Api\Entite;
use Ovs\Bovimarket\Entities\Interfaces\Collection;

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
            $res = $this->api->get($this->endpoint,array("query"=>"name=A"));
            $body = (string)$res->getBody();


            $entites = json_decode($body);
            $entites = new Collection($entites,Entite::class);

            return $entites;
        }catch (RequestException $e){

        }
    }

}