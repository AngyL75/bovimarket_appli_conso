<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/08/2016
 * Time: 16:21
 */

namespace Ovs\Bovimarket\Controller;



use Ovs\Bovimarket\Services\API\MenuFetcherService;
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

    public function getMenu(Request $request, Response $response, $args)
    {
        $idEntite = $args["id"];
        $date = $args["date"];
        //TODO
    }
}