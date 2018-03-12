<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/08/2016
 * Time: 12:25
 */

namespace Ovs\Bovimarket\Services\API;


use Ovs\Bovimarket\Entities\Api\Entite;

class EntiteFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "entites/";
    }
    
    public function find($id)
    {
    	$res = $this->api->get('entites/' . $id) ;
    	$body = (string)$res->getBody();
    	
    	return $this->unserialize($body);
    }

    public function getClass()
    {
        return Entite::class;
    }

    public function findAll()
    {
    	$res = $this->api->get('entites?codePostal=\\\\*') ;
    	$body = (string)$res->getBody();
    	
    	return $this->unserialize($body);
    	
    	//return parent::findBy(array("activites"=>"ELEVEUR,BOUCHER,RESTAURANT,RESTAURATION_COLLECTIVE,ABATTOIR,NEGOCIANT,FILIERE,GROSSISTE,ASSOCIATION,DISTRIBUTEUR"));
    }


}