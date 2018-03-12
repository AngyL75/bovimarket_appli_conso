<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/08/2016
 * Time: 10:42
 */

namespace Ovs\Bovimarket\Controller;


use Aura\Session\Segment;
use Ovs\Bovimarket\Entities\Api\Utilisateur;
use Ovs\Bovimarket\Services\API\UtilisateurFetcherService;
use Ovs\Bovimarket\Utils\Session;
use Ovs\Bovimarket\Utils\UserManager;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class BilletsController extends BaseController
{
	public function listAction(Request $request, Response $response, $args)
    {
    	$entiteFetcher = $this->get('entites');
    	$billetFetcher = $this->get('billets');
    	
    	$entites = array() ;
    	$favs = $this->getSession($request)->get(Session::favoris) ;
    	
    	foreach ($favs as $fav)
    	{
	    	$id = $fav->id ;
	    	
	    	/** @var Entite $entite */
	    	$entite = $entiteFetcher->find($id);
	    	
	        $billetFetcher->setEndpointParams(array('idEntite' => $id));
	        $billets = $billetFetcher->findAll();
	        
	        if(count($billets))
	        {
	        	array_push($entites, array('infos' => $entite, 'billets' => $billets)) ;
	        }
    	}
    	
    	return  $this->render($response,"Billets/list.html.twig",array(
            "entites" => $entites
        ));
    }
}