<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/08/2016
 * Time: 16:21
 */

namespace Ovs\Bovimarket\Controller;



use Ovs\Bovimarket\Services\API\CertificationFetcherService;
use Ovs\Bovimarket\Services\API\MenuFetcherService;
use Ovs\Bovimarket\Utils\Region;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class EntiteController extends BaseController
{
    public function showDetailAction(Request $request, Response $response, $args)
    {
        $entite = $this->get("entites")->find($args["id"]);

        /** @var MenuFetcherService $menuFetcher */
        $menuFetcher = $this->get("menus");
        $menuFetcher->setEndpointParams(array("entiteId"=>$args["id"]));
        $menus = $menuFetcher->findAll();

        $template = "Entites/detail.html.twig";
        if($entite->getActivite()=="RESTAURANT" || $entite->getActivite()=="RESTAURATION_COLLECTIVE"){
            $template= "Entites/detail_restaurant.html.twig";
        }
        return $this->render($response,$template,array("entite"=>$entite,"menus"=>$menus));
    }

    public function getMenuAction(Request $request, Response $response, $args)
    {
        $idEntite = $args["id"];
        $date = $args["date"];

        /** @var MenuFetcherService $menuFetcher */
        $menuFetcher = $this->get("menus");
        //On triche un peu pour construire une url type /menus/plannings
        $menus = $menuFetcher->getPlanning($idEntite,$date);

        return $this->render($response,"Block/menu.html.twig",array(
           "planning"=>$menus,
        ));

        //TODO
    }

    public function searchMapAction(Request $request, Response $response, $args)
    {
        return $this->render($response,"Entites/search_map.html.twig");
    }

    public function searchAction(Request $request, Response $response, $args)
    {
        $region=null;


        /** @var CertificationFetcherService $certifFetcher */
        $certifFetcher=$this->get("certifications");

        $parsedBody = $request->getParsedBody();

        if(isset($parsedBody["region"]) && $region = $parsedBody["region"]){
            $this->getSession($request)->set("region",$region);
        }

        if(!$region) {
            $region = $this->getSession($request)->get("region");
        }

        if($region) {
            $region = Region::CODE[$region];
        }

        if(!$region){
            return $response->withRedirect($this->get("router")->pathFor("app.entite.search_map"));
        }

        $certifications = $certifFetcher->findAll();

        return $this->render($response,"Entites/search.html.twig",array(
            "region"=>$region,
            "certifications"=>$certifications
        ));
    }

    public function doSearchAction(Request $request,Response $response,$args){
        $parsedBody = $request->getParsedBody();
        $fetcher = $this->get("entites");

        if($request->isPost() && isset($parsedBody["search_form"])) {
            $criteres=$parsedBody["search_form"];
            $results = $fetcher->findBy($criteres);
        }else{
            return $response->withRedirect($this->get("router")->pathFor("app.entite.search_form"));
        }


        return $this->render($response,"Entites/results.html.twig",array(
            "results"=>$results
        ));
    }

    public function getCertificationsAction(Request $request, Response $response, $args)
    {

        $viande = $args["viande"];

        /** @var CertificationFetcherService $certifFetcher */
        $certifFetcher=$this->get("certifications");
        $certifications = $certifFetcher->findAll();
        if($viande) {
           $certifications = $certifications->findContaining("categoriesIngredients", $viande);
        }

        return $this->render($response,"Block/certifications.html.twig",array(
            "certifications" =>$certifications
        ));
    }
}