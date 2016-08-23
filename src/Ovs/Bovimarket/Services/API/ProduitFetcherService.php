<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/08/2016
 * Time: 15:41
 */

namespace Ovs\Bovimarket\Services\API;


use Ovs\Bovimarket\Entities\Api\Produit;

class ProduitFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "produits/{entiteId}";
    }

    public function getClass()
    {
        return Produit::class;
    }
}