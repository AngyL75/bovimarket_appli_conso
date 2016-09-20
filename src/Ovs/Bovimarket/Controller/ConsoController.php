<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/08/2016
 * Time: 14:31
 */

namespace Ovs\Bovimarket\Controller;


use Doctrine\Common\Collections\ArrayCollection;
use Ovs\Bovimarket\Entities\Api\Canal;
use Ovs\Bovimarket\Entities\Api\Commande;
use Ovs\Bovimarket\Entities\Api\CommandeCanal;
use Ovs\Bovimarket\Entities\Api\CommandeProduit;
use Ovs\Bovimarket\Entities\Api\Produit;
use Ovs\Bovimarket\Entities\Api\Utilisateur;
use Ovs\Bovimarket\Entities\Panier;
use Ovs\Bovimarket\Services\API\CanauxFetcherService;
use Ovs\Bovimarket\Services\API\CommandeFetcherService;
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
        if($retour = $this->isSecure($request,$response)){
            return $retour;
        }

        if($this->getPanier($request)->isEmpty()){
            return $this->redirectToRoute($response,"app.commande.show_cart");
        }

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

        if($retour = $this->isSecure($request,$response)){
            return $retour;
        }

        $panier = $this->getPanier($request);
        $panier->setPaiement($paiementChoisi);
        $this->savePanier($request,$panier);

        return $this->redirectToRoute($response,"app.commande.do_paiement");
    }

    public function doPaiementAction(Request $request, Response $response, $args)
    {
        if($retour = $this->isSecure($request,$response)){
            return $retour;
        }

        if(!$this->getPanier($request)){
            return $this->redirectToRoute($response,"app.commande.show_cart");
        }

        $panier = $this->getPanier($request);

        return $this->render($response,"Commande/paiement.html.twig",array(
            "panier"=>$panier
        ));
    }

    public function saveCommandeAction(Request $request, Response $response, $args)
    {
        if($retour = $this->isSecure($request,$response)){
            return $retour;
        }

        if($request->isPost()) {
            $panier = $this->getPanier($request);
            $cmd = $this->panierToCommande($panier, $this->getUser($request));

            /** @var CommandeFetcherService $cmdFetcher */
            $cmdFetcher = $this->get("commandes");

            $cmd = $cmdFetcher->saveCommande($cmd);
            $this->removePanier($request);
        }else{
            $cmd=new Commande();
        }

        return $this->render($response,"Commande/merci.html.twig",array(
            "commande"=>$cmd
        ));

    }


    /**
     * @param Panier $panier
     * @param Utilisateur $user
     * @return Commande
     */
    protected function panierToCommande(Panier $panier, Utilisateur $user)
    {
        /** @var CanauxFetcherService $canauxFetch */
        $canauxFetch = $this->get("canaux");

        $canalRes = $canauxFetch->getApi()->get("canaux/".$panier->getCanal());
        /** @var Canal $canal */
        $canal =$canauxFetch->unserialize((string)$canalRes->getBody());

        $canalCmd=new CommandeCanal();
        $canalCmd->setNom($canal->getNom());
        $canalCmd->setLieuCollecte($canal->getLieu());

        $cmd = new Commande();
        $cmd->setEntiteId($panier->getVendeur());
        $cmd->setCanal($canalCmd);
        $cmd->setClientId($user->getId());
        $cmd->setDateCommande(date("Y-m-d"));
        $cmd->setEtatCommade(Commande::ETAT_ACCEPTE);

        $listProduits =new ArrayCollection();

        foreach ($panier->getLignes() as $ligne) {
            /** @var Produit $prod */
            $prod = $ligne["produit"];
            $produit = new CommandeProduit();
            $produit->setNom($prod->getNom());
            $produit->setId($prod->getId());
            $produit->setPrixUnitaire($prod->getPrix());
            $produit->setQuantite($ligne["qte"]);
            $produit->setTva(0);
             $listProduits->add($produit);
        }


        $cmd->setListeProduits($listProduits);

        return $cmd;
    }
}