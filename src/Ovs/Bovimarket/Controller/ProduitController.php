<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/08/2016
 * Time: 15:13
 */

namespace Ovs\Bovimarket\Controller;


use Ovs\Bovimarket\Services\API\ProduitFetcherService;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class ProduitController extends BaseController
{
    public function listProduitsAction(Request $request, Response $response, $args)
    {
        /** @var ProduitFetcherService $produitsFetcher */
        $produitsFetcher = $this->get("produits");
        $produitsFetcher->setEndpointParams(array("entiteId" => $args["id"]));

        $produits = $produitsFetcher->findAll();

        return $this->render($response, "Entites/produits.html.twig", array(
            "produits" => $produits
        ));
    }
}