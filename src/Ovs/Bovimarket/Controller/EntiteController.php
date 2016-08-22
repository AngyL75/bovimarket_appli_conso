<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 22/08/2016
 * Time: 16:21
 */

namespace Ovs\Bovimarket\Controller;


use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Ovs\SlimUtils\Controller\BaseController;

class EntiteController extends BaseController
{
    public function showEntiteAction(Request $request, Response $response, $args)
    {
        return $this->render($response,"entites/detail.html.twig");
    }
}