<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 09:10
 */

namespace Ovs\Bovimarket\Controller;


use Ovs\Bovimarket\Entities\Entite;
use Ovs\SlimUtils\Controller\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class MapController extends BaseController
{
    public function indexAction(Request $request,Response $response,$args)
    {
        $entites = Entite::findAll();
        return $this->render($response,"Home/map.html.twig",array("entites"=>$entites));
    }
}