<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 11:02
 */

namespace Ovs\Bovimarket\Controller;


use Ovs\Bovimarket\Entities\Cuisson;
use Ovs\Bovimarket\Entities\Interfaces\Collection;
use Ovs\Bovimarket\Entities\Morceaux;
use Ovs\Bovimarket\Services\CuissonsFetcherService;
use Ovs\Bovimarket\Services\MorceauxFetcherService;
use Ovs\Bovimarket\Services\RecettesFetcherService;
use Ovs\Bovimarket\Utils\Session;
use Ovs\Bovimarket\Utils\TypeViande;
use Ovs\Bovimarket\Utils\Utils;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class FlashController extends BaseController {
	public function qrCodeAction( Request $request, Response $response, $args ) {

		$paths = array(
			TypeViande::BOEUF  => "5613bb825c8bc97055715635",
			TypeViande::VEAU   => "5613bb825c8bc97055715635",
			TypeViande::AGNEAU => "57f2b778e4b0a5c3f540ea5f",
			TypeViande::PORC   => false,
		);

		return $this->render( $response, "QRCode/categories.html.twig", array(
			"paths" => $paths,
			"live"  => false
		) );
	}

	public function categorieViandeAction( Request $request, Response $response, $args ) {
		/** @var MorceauxFetcherService $morceauxFetcher */
		$morceauxFetcher = $this->get( "morceaux" );
		/** @var Collection $morceaux */
		$morceaux = $morceauxFetcher->getMorceauxForViande( $args["categ"] );
		$morceau  = $morceaux->find( $args["id"] );

		/** @var RecettesFetcherService $recetteFetcher */
		$recetteFetcher = $this->get( "recettes" );
		$recettes       = $recetteFetcher->getRecettesForMorceau( $morceau );


		/** @var CuissonsFetcherService $cuissonFetcher */
		$cuissonFetcher = $this->get( "cuissons" );
		$cuissons       = $cuissonFetcher->getCuissonsForMorceau( $morceau );

		$idCss= "morceau" . $morceau->getId();

		if ( isset( $args["idProducteur"] ) && $args["idProducteur"] )
		{
			$idProducteur = $args["idProducteur"];
			$this->getSession( $request )->set( Session::idProducteur, $idProducteur );
		} else {
			$idProducteur = $this->getSession( $request )->get( Session::idProducteur, false );
		}
		
		$entite = null ;
		if($idProducteur)
		{
			$entiteFetcher = $this->get('entites');
			/** @var Entite $entite */
			$entite = $entiteFetcher->find($idProducteur);
		}
		
		return $this->render( $response, "QRCode/viande.html.twig", array(
				"morceau"      => $morceau,
				"cuissons"     => $cuissons,
				"recettes"     => $recettes,
				"idProducteur" => $idProducteur,
				"fournisseur"  => $entite,
				"idCss" => $idCss
			)
		);
	}

	public function recettesAction( Request $request, Response $response, $args ) {
		$typeViande = $args["categ"];
		$idMorceau  = $args["idMorceau"];

		/** @var MorceauxFetcherService $morceauxFetcher */
		$morceauxFetcher = $this->get( "morceaux" );
		$morceau         = $morceauxFetcher->getMorceauForViande( $typeViande, $idMorceau );

		/** @var RecettesFetcherService $recetteFetcher */
		$recetteFetcher = $this->get( "recettes" );
		$recettes       = $recetteFetcher->getRecettesForMorceau( $morceau );

		return $this->render( $response, "QRCode/recettes.html.twig", array(
				"morceau"  => $morceau,
				"recettes" => $recettes
			)
		);

	}

	public function detailRecetteAction( Request $request, Response $response, $args ) {
		$typeViande = $args["categ"];
		$idMorceau  = $args["idMorceau"];
		$idRecette  = $args["idRecette"];

		/** @var MorceauxFetcherService $morceauxFetcher */
		$morceauxFetcher = $this->get( "morceaux" );
		$morceau         = $morceauxFetcher->getMorceauForViande( $typeViande, $idMorceau );

		/** @var RecettesFetcherService $recetteFetcher */
		$recetteFetcher = $this->get( "recettes" );
		$recette        = $recetteFetcher->getRecetteForMorceau( $morceau, $idRecette );

		$morceauxRecommandes = $morceauxFetcher->getMorceauxForRecette( $recette );

		return $this->render( $response, "QRCode/recette.html.twig", array(
				"morceau"  => $morceau,
				"recette"  => $recette,
				"morceaux" => $morceauxRecommandes
			)
		);

	}

	public function detailMorceauAction( Request $request, Response $response, $args )
	{
		$typeViande = $args["categ"];
		$idMorceau  = $args["idMorceau"];
		$morceauStr = false;

		/** @var MorceauxFetcherService $morceauxFetcher */
		$morceauxFetcher = $this->get( "morceaux" );
		$morceauStr      = "morceau" . $idMorceau;
		$morceau         = $morceauxFetcher->getMorceauForViande( $typeViande, $idMorceau );

		return $this->render( $response, "QRCode/morceau.html.twig", array(
			"morceau" => $morceau,
			"idCss"   => $morceauStr
		) );
	}

	public function cuissonsListAction( Request $request, Response $response, $args ) {
		$typeViande = $args["categ"];
		$idMorceau  = $args["idMorceau"];

		/** @var MorceauxFetcherService $morceauxFetcher */
		$morceauxFetcher = $this->get( "morceaux" );
		$morceau         = $morceauxFetcher->getMorceauForViande( $typeViande, $idMorceau );

		/** @var CuissonsFetcherService $cuissonFetcher */
		$cuissonFetcher = $this->get( "cuissons" );
		$cuissons       = $cuissonFetcher->getCuissonsForMorceau( $morceau );

		return $this->render( $response, "QRCode/cuissons.html.twig", array(
			"cuissons" => $cuissons,
			"morceau"  => $morceau
		) );
	}

	public function detailCuissonAction( Request $request, Response $response, $args ) {
		$typeViande = $args["categ"];
		$idMorceau  = $args["idMorceau"];
		$idCuisson  = $args["idCuisson"];

		/** @var MorceauxFetcherService $morceauFetcher */
		$morceauFetcher = $this->get( "morceaux" );
		$morceau        = $morceauFetcher->getMorceauForViande( $typeViande, $idMorceau );

		/** @var CuissonsFetcherService $cuissonFetcher */
		$cuissonFetcher = $this->get( "cuissons" );
		$cuisson        = $cuissonFetcher->getCuissonForViande( $typeViande, $idCuisson );
		$cuisson->setTypeViande( $typeViande );

		$morceauRecommande = $morceauFetcher->getMorceauxForCuisson( $cuisson );

		return $this->render( $response, "QRCode/cuisson.html.twig", array(
			"morceau"             => $morceau,
			"cuisson"             => $cuisson,
			"morceauxRecommandes" => $morceauRecommande
		) );

	}
}