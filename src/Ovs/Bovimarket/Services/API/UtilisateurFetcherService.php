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
use Ovs\Bovimarket\Entities\Api\Entite;
use Ovs\Bovimarket\Entities\Api\Utilisateur;

class UtilisateurFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "utilisateurs/";
    }

    public function getClass()
    {
        return Utilisateur::class;
    }

    public function me()
    {
        $response = $this->api->get("utilisateurs/current");
        $json =(string)$response->getBody();
        $json = json_decode($json);
        $user = json_encode($json->user);
        $user = $this->unserialize($user);
        return $user;
    }

    public function registerUser(Utilisateur $utilisateur)
    {
        $serial=SerializerBuilder::create()->build();
        $json = $serial->serialize($utilisateur,"json");
        try {
            $response = $this->api->put("public/inscription/", array(
                "body"    => $json,
                "headers" => array(
                    "Content-Type" => "application/json"
                )
            ));
        }catch (RequestException $exception){
            if($exception->getCode()==409){
                return false;
            }else{
                throw $exception;
            }
        }

        $body = (string)$response->getBody();
        if(strlen($body)==0){
            return $utilisateur;
        }
        return $serial->deserialize($body,$this->getClass(),"json");
    }

    public function updateUser(Utilisateur $utilisateur)
    {
        $serial=SerializerBuilder::create()->build();
        $json = $serial->serialize($utilisateur,"json");
        $response = $this->api->post($this->getEndpoint(),array(
            "body"=>$json,
            "headers"=>array(
                "Content-Type"=>"application/json"
            )
        ));

        $body = (string)$response->getBody();
        return $serial->deserialize($body,$this->getClass(),"json");
    }

	public function getFavoris() {
		$serializer = SerializerBuilder::create()->build();
		$response = $this->api->get("utilisateurs/current/favoris");
		$json = (string)$response->getBody();
		return json_decode($json);
    }

	public function addFavoris($entite) {
		if(is_a($entite,Entite::class)){
			$entite=$entite->getId();
		}
		$this->api->post("utilisateurs/current/favoris/".$entite);
    }

	public function removeFavoris($entite) {
		if(is_a($entite,Entite::class)){
			$entite=$entite->getId();
		}
		$this->api->delete("utilisateurs/current/favoris/".$entite);
	}

}