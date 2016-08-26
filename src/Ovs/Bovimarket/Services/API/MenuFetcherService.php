<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/08/2016
 * Time: 10:59
 */

namespace Ovs\Bovimarket\Services\API;


use Ovs\Bovimarket\Entities\Api\Menu;
use Ovs\Bovimarket\Entities\Api\MenuPlanning;
use Ovs\Bovimarket\Entities\Interfaces\Collection;

class MenuFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "menus/{entiteId}";
    }

    public function getClass()
    {
        return Menu::class;
    }

    public function getPlanning($idEntite, $date)
    {

        $dateTab = explode("-", $date);
        if (count($dateTab) == 0) {
            return;
        }
        $dateDebut = new \DateTime($date);
        $dateFin = clone $dateDebut;
        $dateFin = $dateFin->add(new \DateInterval("P1D"));

        $dateDebut = $dateDebut->getTimestamp();
        $dateFin = $dateFin->getTimestamp();

        $response = $this->api->get("menus/plannings",
            array(
                "query" => array(
                    "entiteId"  => $idEntite,
                    "dateDebut" => $dateDebut * 1000,
                    "dateFin"   => $dateFin * 1000
                )
            )
        );

        $body=(string)$response->getBody();
        $planning = new Collection(json_decode($body),MenuPlanning::class);
        $this->setEndpointParams(array("entiteId"=>$idEntite));
        /** @var MenuPlanning $menu */
        foreach ($planning as $id =>$menu) {
            $idMenu = $menu->getMenuId();
            $menuComp = $this->find($idMenu);
            $menu->setMenu($menuComp);
        }

        return $planning;

    }
}