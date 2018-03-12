<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/08/2016
 * Time: 11:52
 */

namespace Ovs\Bovimarket\Services\API;


use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerBuilder;
use Ovs\Bovimarket\Entities\Api\Allergie;
use Ovs\Bovimarket\Entities\Interfaces\Collection;

class CommonFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "common/codes/";
    }
    
    public function getClass()
    {
    	return '' ;
    }

    protected function getCodes()
    {
    	$serializer = SerializerBuilder::create()->build();
    	$response = $this->api->get($this->getEndpoint());
    	$json = (string) $response->getBody();
    
    	return json_decode($json) ;
    }

    public function getAllergies()
	{
		$aCodes = $this->getCodes() ;
		
		return new Collection($aCodes->allergies, Allergie::class) ;
	}
}