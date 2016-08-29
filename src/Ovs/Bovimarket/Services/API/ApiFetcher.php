<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/08/2016
 * Time: 12:23
 */

namespace Ovs\Bovimarket\Services\Api;


use GuzzleHttp\Exception\RequestException;
use Monolog\Logger;
use Ovs\Bovimarket\Api\Api;
use Ovs\Bovimarket\Entities\Interfaces\Collection;

abstract class ApiFetcher
{
    protected $endPointParams;
    protected $api;
    protected $logger;

    /**
     * ApiFetcher constructor.
     * @param Api $api
     * @param Logger $logger
     */
    public function __construct(Api $api,Logger $logger)
    {
        $this->api = $api;
        $this->logger = $logger;
    }

    public function findAll()
    {
        try{
            $res = $this->api->get($this->getFullEndpoint());
            $body = (string)$res->getBody();

            return $this->unserialize($body);
        }catch (RequestException $e){
            $this->logger->addCritical("RequestException : ".$e->getMessage());
        }
    }

    public function find($id)
    {
        return $this->findAll()->find($id);
    }

    public function findOneBy($criteria)
    {
        return $this->findBy($criteria)->first();
    }

    public function findBy($criteria)
    {
        try{
            $res = $this->api->get($this->getFullEndpoint(),array("query"=>$criteria));
            $body = (string)$res->getBody();

            return $this->unserialize($body);
        }catch (RequestException $e){
            $this->logger->addCritical("RequestException : ".$e->getMessage());
        }
    }

    public function setEndpointParams(array $params){
        $this->endPointParams = $params;
    }

    public function getFullEndpoint()
    {
        $endpoint = $this->getEndpoint();
        if(!is_array($this->endPointParams)){
            return $endpoint;
        }
        foreach ($this->endPointParams as $key=>$endPointParam) {
            $endpoint = str_replace("{".$key."}",$endPointParam,$endpoint);
        }

        return $endpoint;
    }

    /**
     * @return Api
     */
    public function getApi()
    {
        return $this->api;
    }

    public function unserialize($body, $class = null)
    {
        if($class == null){
            $class = $this->getClass();
        }

        $entites = json_decode($body);
        $entites = new Collection($entites,$class);
        return $entites;
    }

    abstract public function getEndpoint();
    abstract public function getClass();
}