<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/08/2016
 * Time: 15:13
 */

namespace Ovs\Bovimarket\Controller;


use Ovs\Bovimarket\Entities\Api\Produit;
use Ovs\Bovimarket\Entities\Panier;
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

        $panier = $this->getPanier($request);

        return $this->render($response, "Entites/produits.html.twig", array(
            "produits" => $produits,
            "entiteId" => $args["id"],
            "panier"   => $panier
        ));
    }

	public function delToCartAction(Request $request, Response $response, $args)
	{
		$idEntite = $args["idEntite"];
		$id = $args["idProduit"];

		$panier = $this->getPanier($request);
		$panier->remove($id,1);
		$this->savePanier($request,$panier);

		$referer = $request->getServerParams()["HTTP_REFERER"];

		return $response->withRedirect($referer);
	}

    public function addToCartAction(Request $request, Response $response, $args)
    {
        $idEntite = $args["idEntite"];
        $id = $args["idProduit"];


        /** @var ProduitFetcherService $produitsFetcher */
        $produitsFetcher = $this->get("produits");
        $produitsFetcher->setEndpointParams(array("entiteId" => $idEntite));

        /** @var Produit $produit */
        $produit = $produitsFetcher->find($id);

        $panier = $this->getPanier($request);
        $panier->add($produit, 1, $idEntite);
        $this->savePanier($request,$panier);
        
        if($request->getParam('ajax')) return 'OK' ;

	    $redirect = $request->getServerParams()["HTTP_REFERER"];
	    
	    $redirect = $this->get('router')->pathFor('app.commande.show_cart') ;

	    return $response->withRedirect($redirect);
    }

    public function showCartAction(Request $request, Response $response, $args)
    {
    	$entiteFetcher = $this->get('entites');
    	$panier = $this->getPanier($request);

        $produits = $panier->getLignes() ;
        
        $aProduitsEntities = array() ;
        foreach($produits as $p)
        {
        	$entite_id = $p['id_entite'] ;
        	
        	if(!array_key_exists($entite_id, $aProduitsEntities))
        	{
        		$aProduitsEntities[$entite_id] = array() ;
        		
        		$aProduitsEntities[$entite_id]['infos'] = $entiteFetcher->find($entite_id); ;
        		$aProduitsEntities[$entite_id]['items'] = array() ;
        	}
        	
        	array_push($aProduitsEntities[$entite_id]['items'], $p['produit']) ;
        }
        
        //var_dump($aProduitsEntities) ;
        
        return $this->render($response,"Commande/panier.html.twig",array(
            "panier" => $panier,
	        "entites" => $aProduitsEntities
        )); 
    }

    public function removeFromCartAction(Request $request, Response $response, $args)
    {
        $idProduit = $args["idProduit"];
        $panier = $this->getPanier($request);
        $panier->remove($idProduit);

        $this->savePanier($request,$panier);

        return $response->withRedirect($this->get("router")->pathFor("app.commande.show_cart"));
    }
}