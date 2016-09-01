<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/08/2016
 * Time: 17:37
 */

namespace Ovs\Bovimarket\Services\API;


use JMS\Serializer\SerializerBuilder;
use Ovs\Bovimarket\Entities\Api\Commande;

class CommandeFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "commandes/";
    }

    public function getClass()
    {
        return Commande::class;
    }

    public function saveCommande(Commande $commande)
    {
        $serializer = SerializerBuilder::create()->build();
        $datas = $serializer->serialize($commande,"json");
        $response=$this->api->post($this->getEndpoint(),array(
            "headers"=>array(
                "Content-Type"=>"application/json"
            ),
            "body"=>$datas
        ));

        $body = (string)$response->getBody();
        return $serializer->deserialize($body,$this->getClass(),"json");
    }
}