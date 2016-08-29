<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/08/2016
 * Time: 14:31
 */

namespace Ovs\Bovimarket\Controller;


use Ovs\Bovimarket\Services\API\CanauxFetcherService;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class ConsoController extends BaseController
{
    public function selectLivraisonAction(Request $request,Response $response, $args)
    {
        if($this->getPanier($request)->isEmpty()){
            return $this->redirectToRoute($response,"app.commande.show_cart");
        }
        /** @var CanauxFetcherService $canauxFetch */
        $canauxFetch = $this->get("canaux");

        $canaux = $canauxFetch->findBy(array("entiteId"=>$this->getPanier($request)->getVendeur()));

        return $this->render($response,"Commande/livraison.html.twig",array("canaux"=>$canaux));
    }

    public function saveCanalAction(Request $request, Response $response,$args)
    {
        if(!$request->isMethod("POST")){
            return $this->redirectToRoute($response,"app.commande.show_cart");
        }


        $canalChoisi = $request->getParsedBodyParam("canal");
        if($canalChoisi == null){
            return $this->redirectToRoute($response,"app.commande.select_livraison");
        }

        $panier = $this->getPanier($request);
        $panier->setCanal($canalChoisi);
        $this->savePanier($request,$panier);

        return $this->redirectToRoute($response,"app.commande.select_paiement");
    }

    public function choixPaiementAction(Request $request, Response $response, $args)
    {
       return $this->render($response,"Commande/choix_paiement.html.twig");
    }

    public function savePaiementAction(Request $request, Response $response, $args)
    {
        if(!$request->isMethod("POST")){
            return $this->redirectToRoute($response,"app.commande.select_paiement");
        }
        $paiementChoisi = $request->getParsedBodyParam("paiement");
        if($paiementChoisi===null){
            return $this->redirectToRoute($response,"app.commande.select_paiement");
        }

        $panier = $this->getPanier($request);
        $panier->setPaiement($paiementChoisi);
        $this->savePanier($request,$panier);

        return $this->redirectToRoute($response,"app.commande.do_paiement");
    }

    public function doPaiementAction(Request $request, Response $response, $args)
    {
        $panier = $this->getPanier($request);

        return $this->render($response,"Commande/paiement.html.twig",array(
            "panier"=>$panier
        ));
    }

    public function saveCommandeAction(Request $request, Response $response, $args)
    {
        $panier = $this->getPanier($request);
    }
}