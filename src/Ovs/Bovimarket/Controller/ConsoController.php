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
use Ovs\Bovimarket\Entities\Interfaces\Collection;
use Ovs\Bovimarket\Entities\Panier;
use Ovs\Bovimarket\Services\API\CanauxFetcherService;
use Ovs\Bovimarket\Services\API\CommandeFetcherService;
use Ovs\Bovimarket\Services\Api\EntiteFetcherService;
use Ovs\Bovimarket\Services\API\ProduitFetcherService;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;
use Ovs\Bovimarket\Entities\Api\Ovs\Bovimarket\Entities\Api;

class ConsoController extends BaseController
{
    public function selectLivraisonAction(Request $request,Response $response, $args)
    {
        if($this->getPanier($request)->isEmpty())
        {
            return $this->redirectToRoute($response,"app.commande.show_cart");
        }
        /** @var CanauxFetcherService $canauxFetch */
        $canauxFetch = $this->get("canaux");
        $entiteFetcher = $this->get('entites');
        
        $panier = $this->getPanier($request) ;
        $produits = $panier->getLignes() ;
        
        $aCanaux = array() ;
        foreach($produits as $p)
        {
        	$entite_id = $p['id_entite'] ;
        
        	$canaux = $canauxFetch->findByEntite($entite_id);
        	
        	array_push($aCanaux, $canaux) ;
        }
        
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
        
        $aDates = array() ;
        $aDates[0] = array('id' => 1, 'label' => 'Dès maintenant', 'entites' => $aProduitsEntities) ;
        
        /*var_dump($aCanaux) ;
        exit ;
*/
        return $this->render($response,"Commande/livraison.html.twig", array("panier" => $panier, "dates" => $aDates));
    }

    public function saveCanalAction(Request $request, Response $response,$args)
    {
        if(!$request->isMethod("POST"))
        {
            return $this->redirectToRoute($response,"app.commande.show_cart");
        }

        /*$canalChoisi = $request->getParsedBodyParam("canal");
        if($canalChoisi == null)
        {
            return $this->redirectToRoute($response,"app.commande.select_livraison");
        }*/

        $panier = $this->getPanier($request);
        //$panier->setCanal($canalChoisi);
        $this->savePanier($request,$panier);

        return $this->redirectToRoute($response, "app.commande.do_paiement");
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
        if($retour = $this->isSecure($request,$response))
        {
            return $retour;
        }

        if($request->isPost())
        {
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
            "commande"=>$cmd,
	        "email"=>$this->getUser($request)->getEmail()
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
        //$cmd->setEntiteId($panier->getVendeur());
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

    public function listCommandesAction(Request $request, Response $response, $args)
    {
        /** @var CommandeFetcherService $commandeApi */
        $commandeApi = $this->get("commandes");

        $user = $this->getUser($request);

        $json = $commandeApi->getApi()->get("commandes/client/".$user->getId());
        //$json = $commandeApi->getApi()->get("commandes/client/67");
        $json= (string)$json->getBody();
        /** @var Collection $commandes */
        $commandes = $commandeApi->unserialize($json);
        
        $aCommandes = $commandes->toArray() ;
        
        $aCommandes = array_reverse($aCommandes) ;
        
        /*array_unshift($aCommandes, array('id' => -1, 'numeroCommande' => '123AB', 'dateCommande' => 1487688792000, 'total' => 16)) ;
        array_unshift($aCommandes, array('id' => -2, 'numeroCommande' => '457XV', 'dateCommande' => 1485655792000, 'total' => 140)) ;
        */
        return $this->render($response,"User/commandes.html.twig",array(
            "commandes"=> $aCommandes
        ));
    }
    
    public function recupCommandesAction(Request $request, Response $response, $args)
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
        
        $aDates = array() ;
        $aDates[0] = array('id' => 1, 'label' => 'Dès maintenant', 'entites' => $aProduitsEntities) ;
    	return $this->render($response,"Commande/recuperation.html.twig", array("panier" => $panier, "dates" => $aDates));
    }

    public function showCommandeAction(Request $request, Response $response, $args)
    {
        /** @var CommandeFetcherService $commandeApi */
        $commandeApi = $this->get("commandes");
        /** @var EntiteFetcherService $entiteApi */
        $entiteApi = $this->get("entites");
        /** @var ProduitFetcherService $produitApi */
        $produitApi=$this->get("produits");
        
        $commande = new Commande() ;
        //$commande->setNumeroCommande($args["id"] == -1 ? '123AB' : '457XV') ;
        //$commande->setDateCommande($args["id"] == -1 ? 1487688792000 : 1485655792000) ;

        $commande = $commandeApi->getApi()->get("commandes/".$args["id"]);
        $commande = (string)$commande->getBody();
        $commande = $commandeApi->unserialize($commande);
        $entite_id = $commande->getEntiteId();
        //$entite = $entiteApi->find($entiteId);
        
        $produitApi->setEndpointParams(array("entiteId"=>$entite_id));
        $produitsEntite = $produitApi->findAll();
        $produits = $commande->getListeProduits();
        
        foreach($produits as $prod)
        {
            $produit = $produitsEntite->find($prod->getId());
            $prod->setProduitObj($produit);
        }
        
        $aProduitsEntities = array() ;
        foreach($produits as $p)
        {
        	if(!array_key_exists($entite_id, $aProduitsEntities))
        	{
        		$aProduitsEntities[$entite_id] = array() ;
        
        		$aProduitsEntities[$entite_id]['infos'] = $entiteApi->find($entite_id); ;
        		$aProduitsEntities[$entite_id]['items'] = array() ;
        	}
        
        	array_push($aProduitsEntities[$entite_id]['items'], $p) ;
        }
        
        return $this->render($response,"Commande/detail.html.twig",array(
            "commande"=>$commande,
        	"entites"=>$aProduitsEntities
        ));
    }
}