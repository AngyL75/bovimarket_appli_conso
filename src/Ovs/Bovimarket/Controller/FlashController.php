<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 11:02
 */

namespace Ovs\Bovimarket\Controller;


use Ovs\Bovimarket\Services\MorceauxFetcherService;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class FlashController extends BaseController
{
    public function qrCodeAction(Request $request,Response $response,$args)
    {

        $paths = array(
            MorceauxFetcherService::AGNEAU=>"/web/images/barquette1.jpg",
            MorceauxFetcherService::PORC=>"/web/images/barquette2.jpg",
            MorceauxFetcherService::VEAU=>"/web/images/barquette3.jpg",
            MorceauxFetcherService::BOEUF=>"/web/images/barquette4.jpg"
        );

        return $this->render($response,"QRCode/categories.html.twig",array("paths"=>$paths));
    }

    public function categorieViandeAction(Request $request,Response $response,$args){
        /** @var MorceauxFetcherService $morceaux */
        $morceaux = $this->get("morceaux");
        $morceaux = $morceaux->getMorceauxForViande($args["categ"]);-
        return $this->render($response,"QRCode/viande.html.twig",array("morceaux"=>$morceaux));
    }
}