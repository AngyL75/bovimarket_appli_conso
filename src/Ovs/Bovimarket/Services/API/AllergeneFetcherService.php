<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/10/2016
 * Time: 10:41
 */

namespace Ovs\Bovimarket\Services\API;


use JMS\Serializer\SerializerBuilder;
use Ovs\Bovimarket\Entities\Api\Allergene;
use Ovs\Bovimarket\Entities\Interfaces\Collection;

class AllergeneFetcherService extends ApiFetcher {

	public function getEndpoint() {
		return "common/codes";
	}

	public function getClass() {
		return Allergene::class;
	}

	public function updateAllergenes($allergenes) {

		$allergenesObjs = array();
		foreach ( $allergenes as $allergene ) {
			$allergene = explode("##",$allergene);
			$all = new Allergene();
			$all->setId($allergene[0]);
			$all->setNom($allergene[1]);
			$allergenesObjs[] = $all;
		}

		$serial = SerializerBuilder::create()->build();
		$json = $serial->serialize($allergenesObjs,"json");

		$this->api->post("utilisateurs/current/allergies",array(
			"body"=>$json,
			"headers" => array(
				"Content-Type" => "application/json"
			)
		));
	}

	/**
	 * @param $body
	 * @param null $class
	 *
	 * @return array|\JMS\Serializer\scalar|mixed|object|Collection
	 */
	public function unserialize( $body, $class = null ) {
		if($class == null){
			$class = $this->getClass();
		}

		$entites = json_decode($body);
		$entites=$entites->allergies;
		if(is_array($entites)) {
			$entites = new Collection($entites, $class);
		}elseif (is_object($entites)){
			$serializer = SerializerBuilder::create()->build();
			$entites = $serializer->deserialize($body,$class,"json");
		}
		return (is_a($entites,Collection::class))?$entites->toArray():$entites;
	}


}