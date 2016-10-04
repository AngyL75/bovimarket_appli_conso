<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/08/2016
 * Time: 12:25
 */

namespace Ovs\Bovimarket\Services\Api;


use Ovs\Bovimarket\Entities\Api\Entite;

class EntiteFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "entites/";
    }

    public function getClass()
    {
        return Entite::class;
    }

    public function findAll()
    {
        return parent::findBy(array("activites"=>"ELEVEUR,BOUCHER,RESTAURANT,RESTAURATION_COLLECTIVE,ABATTOIR,NEGOCIANT,FILIERE,GROSSISTE,ASSOCIATION,DISTRIBUTEUR"));
    }


}