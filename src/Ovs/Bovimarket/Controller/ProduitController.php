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
use Psr7Middlewares\Middleware\AuraSession;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;

class ProduitController extends BaseController
{
    public function listProduitsAction(Request $request, Response $response, $args)
    {
        /** @var ProduitFetcherService $produitsFetcher */
        $produitsFetcher = $this->get("produits");
        $produitsFetcher->setEndpointParams(array("entiteId" => $args["id"]));

        $produits = $produitsFetcher->findAll();

        $session = $this->getSession($request);
        $cart= $session->get("cart",array());

        return $this->render($response, "Entites/produits.html.twig", array(
            "produits" => $produits,
            "entiteId"=>$args["id"],
            "panier"=>$cart
        ));
    }

    public function addToCartAction(Request $request, Response $response, $args)
    {
        $idEntite = $args["idEntite"];
        $id = $args["idProduit"];
        $session = $this->getSession($request);
        $cart= $session->get("cart",array());
        $cart[$id]+=1;
        $session->set("cart",$cart);
        /** @var Router $router */
        $router = $this->get("router");
        return $response->withRedirect($router->pathFor("app.entite.produits",array("id"=>$idEntite)));
    }
}