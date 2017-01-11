<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/08/2016
 * Time: 16:21.
 */

namespace Ovs\Bovimarket\Controller;

use Ovs\Bovimarket\Entities\Api\Certification;
use Ovs\Bovimarket\Entities\Api\Entite;
use Ovs\Bovimarket\Entities\Interfaces\Collection;
use Ovs\Bovimarket\Services\API\BilletFetcherService;
use Ovs\Bovimarket\Services\API\CertificationFetcherService;
use Ovs\Bovimarket\Services\Api\EntiteFetcherService;
use Ovs\Bovimarket\Services\API\MenuFetcherService;
use Ovs\Bovimarket\Utils\Region;
use Ovs\Bovimarket\Utils\Utils;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class EntiteController extends BaseController
{

	private function getCertifications(Entite $entite){
		$certifs=null;
		$idsCertif = array();
		/** @var CertificationFetcherService $certifFetcher */
		$certifFetcher = $this->get('certifications');


		foreach ($entite->getCertifications() as $certification) {
			if ($certification['valide']) {
				$idsCertif[] = $certification['certificationId'];
			}
		}

		if (count($idsCertif) > 0) {
			$retApi = $certifFetcher->getApi()->get('certifications/liste', array(
				'query' => array(
					'ids' => implode(',', $idsCertif),
				),
			));
			$body = (string) $retApi->getBody();
			$certifs = $certifFetcher->unserialize($body, Certification::class);
		}

		return $certifs;
	}

	private function getMembres($filiere){
		/** @var CertificationFetcherService $certifFetcher */
		$certifFetcher = $this->get('certifications');
		/** @var EntiteFetcherService $entiteFetcher */
		$entiteFetcher = $this->get('entites');

		$certifications = $certifFetcher->getApi()->get("certifications",array(
			"query"=>array(
				"entiteId"=>$filiere->getId()
			)
		));
		$body = (string)$certifications->getBody();
		$certifications = $certifFetcher->unserialize($body);
		$certifsIds = $certifications->getKeys();

		$membres = $entiteFetcher->getApi()->get("entites",array(
			"query"=>array(
				"certificationsIds"=>implode(",",$certifsIds)
			)
		));
		$body = (string)$membres->getBody();
		$membres = $entiteFetcher->unserialize($body);

		return $membres;
	}

    public function showDetailAction(Request $request, Response $response, $args)
    {
	    $membres=array();
	    /** @var EntiteFetcherService $entiteFetcher */
	    $entiteFetcher = $this->get('entites');
        /** @var Entite $entite */
        $entite = $entiteFetcher->find($args['id']);

        /** @var MenuFetcherService $menuFetcher */
        $menuFetcher = $this->get('menus');
        $menuFetcher->setEndpointParams(array('entiteId' => $args['id']));
        $menus = $menuFetcher->findAll();

        $template = 'Entites/detail.html.twig';
        if ($entite->getActivite() == 'RESTAURANT'){
            $template = 'Entites/detail_restaurant.html.twig';
        }elseif ($entite->getActivite() == 'RESTAURATION_COLLECTIVE'){
	        $template = 'Entites/detail_restaurant_collectif.html.twig';
        }
        $certifs = $this->getCertifications($entite);

        $presence = array() ;
        
        $day = date('w');
		$time = strtotime('-'.$day.' days');
		
		for($d = 0 ; $d < 7 ; $d++)
		{
			$r = mt_rand (0, 2) ;
			
			$day = substr($this->formatDate($time, '%A'), 0, 1) ;
			array_push($presence, array('time' => $time, 'day' => date('Y-m-d', $time), 'today' => date('Y-m-d') == date('Y-m-d', $time), 'label' => $day . '<br/>' . date('j/m', $time), 'presence' => $r)) ;
			
			$time += (3600 * 26) ;
		}
		
		
        if($entite->getActivite() == "FILIERE")
        {
        	$membres=$this->getMembres($entite);
        }

        /** @var BilletFetcherService $billetFetcher */
        $billetFetcher = $this->get('billets');
        $billetFetcher->setEndpointParams(array('idEntite' => $args['id']));
        $billets = $billetFetcher->findAll();
        $billetFetcher->setEndpointParams(array('idEntite' => $args['id'].'/presse'));
        $presse = $billetFetcher->findAll();

        return $this->render($response, $template, array(
            'entite' => $entite,
            'menus' => $menus,
        	'presence' => $presence,
            'certifs' => $certifs,
            'blog' => $billets,
            'presse' => $presse,
	        'membres'=>$membres
        ));
    }

    public function getMenuAction(Request $request, Response $response, $args)
    {
        $idEntite = $args['id'];
        $date = $args['date'];

        /** @var EntiteFetcherService $entiteFetcher */
        $entiteFetcher = $this->get('entites');
        $entite = $entiteFetcher->find($idEntite);

        /** @var MenuFetcherService $menuFetcher */
        $menuFetcher = $this->get('menus');
        //On triche un peu pour construire une url type /menus/plannings
        $menus = array();

        if ($entite->getActivite() == 'RESTAURATION_COLLECTIVE') {
            $menus = $menuFetcher->getPlanning($idEntite, $date);
        } elseif ($entite->getActivite() == 'RESTAURANT') {
            $menuFetcher->setEndpointParams(array('entiteId' => $idEntite));
            $menus = $menuFetcher->findAll();
        }

        return $this->render($response, 'Block/menu.html.twig', array(
            'planning' => $menus,
        ));
    }

    public function searchMapAction(Request $request, Response $response, $args)
    {
        return $this->render($response, 'Entites/search_map.html.twig');
    }

    public function searchAction(Request $request, Response $response, $args)
    {
        $region = null;

        /** @var CertificationFetcherService $certifFetcher */
        $certifFetcher = $this->get('certifications');

        $parsedBody = $request->getParsedBody();

        if (isset($parsedBody['region']) && $region = $parsedBody['region']) {
            $this->getSession($request)->set('region', $region);
        }

        if (!$region) {
            $region = $this->getSession($request)->get('region');
        }

        if ($region) {
            $region = Region::CODE[$region];
        }

        if (!$region) {
            return $response->withRedirect($this->get('router')->pathFor('app.entite.search_map'));
        }

        $certifications = $certifFetcher->findAll();

        return $this->render($response, 'Entites/search.html.twig', array(
            'region' => $region,
            'certifications' => $certifications,
        ));
    }

    public function doSearchAction(Request $request, Response $response, $args)
    {
        $parsedBody = $request->getParsedBody();
        $fetcher = $this->get('entites');

        if ($request->isPost() && isset($parsedBody['search_form'])) {
            $criteres = $parsedBody['search_form'];
            $results = $fetcher->findBy($criteres);
        } else {
            return $response->withRedirect($this->get('router')->pathFor('app.entite.search_form'));
        }

        return $this->render($response, 'Entites/results.html.twig', array(
            'results' => $results,
        ));
    }

    public function getCertificationsAction(Request $request, Response $response, $args)
    {
        $viande = $args['viande'];

        /** @var CertificationFetcherService $certifFetcher */
        $certifFetcher = $this->get('certifications');
        $certifications = $certifFetcher->findAll();
        if ($viande) {
            $certifications = $certifications->findContaining('categoriesIngredients', $viande);
        }

        return $this->render($response, 'Block/certifications.html.twig', array(
            'certifications' => $certifications,
        ));
    }

	public function reserverTableAction( Request $request, Response $response, $args ) {
		return $this->render($response,"Entites/table.html.twig");
    }

	public function reservationSuccessAction( Request $request, Response $response, $args ) {
		return $this->render($response,"Entites/reservation_ok.html.twig");
    }
}
