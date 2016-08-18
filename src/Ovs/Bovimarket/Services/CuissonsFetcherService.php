<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 18/08/2016
 * Time: 11:16
 */

namespace Ovs\Bovimarket\Services;


use Doctrine\Common\Collections\Criteria;
use Ovs\Bovimarket\Entities\Cuisson;
use Ovs\Bovimarket\Entities\Interfaces\Collection;
use Ovs\Bovimarket\Entities\Morceaux;
use Ovs\Bovimarket\Utils\TypeViande;

class CuissonsFetcherService extends JSONFetcher
{
    /** @var Collection */
    protected $cuissons;

    /**
     * RecettesFetcherService constructor.
     */
    public function __construct()
    {
        $this->objectClass = Cuisson::class;
        $this->cuissons = new Collection(array(), $this->objectClass);
    }

    protected function getUrlForViande($typeViande = null)
    {
        return "json://agneau/cuissons.json";
    }

    public function getCuissonsForViande($viande)
    {
        $objects = json_decode($this->get($this->getUrlForViande($viande)));
        $this->cuissons = new Collection($objects, $this->objectClass);
        return $this->cuissons;
    }

    public function getCuissonsForMorceau(Morceaux $morceaux)
    {
        $cuissons = $this->getCuissonsForViande($morceaux->getTypeViande());

        /** @var Cuisson $cuisson */
        foreach ($cuissons as $cuisson) {
            $morceauxCuisson =$cuisson->getMorceaux();
            if($morceauxCuisson->containsKey($morceaux->getTypeViande())){
                $morceauType =$morceauxCuisson->get($morceaux->getTypeViande());
                if(!in_array($morceaux->getId(),$morceauType)){
                    $cuissons->removeElement($cuisson);
                }
            }
        }

        $this->cuissons = $cuissons;

        return $this->cuissons;
    }
}