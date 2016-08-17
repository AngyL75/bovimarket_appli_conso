<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 11:02
 */

namespace Ovs\Bovimarket\Controller;


use Ovs\Bovimarket\Entities\Interfaces\Collection;
use Ovs\Bovimarket\Services\MorceauxFetcherService;
use Ovs\Bovimarket\Services\RecettesFetcherService;
use Ovs\Bovimarket\Utils\TypeViande;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class FlashController extends BaseController
{
    public function qrCodeAction(Request $request, Response $response, $args)
    {

        $paths = array(
            TypeViande::AGNEAU => "/web/images/barquette1.jpg",
            TypeViande::PORC   => "/web/images/barquette2.jpg",
            TypeViande::VEAU   => "/web/images/barquette3.jpg",
            TypeViande::BOEUF  => "/web/images/barquette4.jpg"
        );

        return $this->render($response, "QRCode/categories.html.twig", array("paths" => $paths, "live" => false));
    }

    public function categorieViandeAction(Request $request, Response $response, $args)
    {
        /** @var MorceauxFetcherService $morceauxFetcher */
        $morceauxFetcher = $this->get("morceaux");
        /** @var Collection $morceaux */
        $morceaux = $morceauxFetcher->getMorceauxForViande($args["categ"]);
        return $this->render($response, "QRCode/viande.html.twig", array("morceau" => $morceaux->random()));
    }

    public function recettesAction(Request $request, Response $response, $args)
    {
        $typeViande = $args["categ"];
        $idMorceau = $args["idMorceau"];

        /** @var MorceauxFetcherService $morceauxFetcher */
        $morceauxFetcher = $this->get("morceaux");
        $morceau = $morceauxFetcher->getMorceauxForViande($typeViande);
        $morceau = $morceau->find($idMorceau);

        /** @var RecettesFetcherService $recetteFetcher */
        $recetteFetcher = $this->get("recettes");
        $recettes = $recetteFetcher->getRecetteForMorceau($morceau);

        return $this->render($response,"QRCode/recettes.html.twig",array("morceau"=>$morceau,"recettes"=>$recettes));

    }
}