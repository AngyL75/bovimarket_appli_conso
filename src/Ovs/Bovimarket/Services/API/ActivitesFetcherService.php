<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 27/09/2016
 * Time: 09:53
 */

namespace Ovs\Bovimarket\Services\API;


use Ovs\Bovimarket\Entities\Api\Activite;
use JMS\Serializer\SerializerBuilder;
use Ovs\Bovimarket\Entities\Interfaces\ActivitesCollection;

class ActivitesFetcherService extends ApiFetcher
{
	public static $all = null ;
	
	public function __construct($api, $logger)
	{
		parent::__construct($api, $logger) ;
		
		$this->findAll() ;
	}
	
	public function getEndpoint()
	{
		return "activites";
	}

	public function getClass()
	{
		return Activite::class;
	}
	
	public function findAll()
	{
		try{
			$res = $this->api->get($this->getFullEndpoint());
			$body = (string)$res->getBody();
	
			$res = $this->unserialize($body);
			
			ActivitesFetcherService::$all = $res ;
			
			return $res ;
		}catch (RequestException $e){
			$this->logger->addCritical("RequestException : ".$e->getMessage());
		}
	}
	
	public function unserialize($body, $class = null)
	{
		if($class == null){
			$class = $this->getClass();
		}
	
		$entites = json_decode($body);
		if(is_array($entites)) {
			$entites = new ActivitesCollection($entites, $class);
		}elseif (is_object($entites)){
			$serializer = SerializerBuilder::create()->build();
			$entites = $serializer->deserialize($body,$class,"json");
		}
		return $entites;
	}
}