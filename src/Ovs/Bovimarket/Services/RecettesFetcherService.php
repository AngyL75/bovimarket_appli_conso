<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/08/2016
 * Time: 09:36
 */

namespace Ovs\Bovimarket\Services;


use Ovs\Bovimarket\Api\JSONFetcher;
use Ovs\Bovimarket\Entities\Interfaces\Collection;
use Ovs\Bovimarket\Entities\Morceaux;
use Ovs\Bovimarket\Entities\Recettes;
use Ovs\Bovimarket\Utils\TypeViande;

class RecettesFetcherService
{

    /** @var Collection  */
    protected $recettes;

    /**
     * RecettesFetcherService constructor.
     */
    public function __construct()
    {
        $this->recettes = new Collection(array(),Recettes::class);
    }

    protected function getUrlForViande($typeViande = null)
    {
        switch ($typeViande) {
            case TypeViande::BOEUF:
                return "json://boeuf/recettes.json";
                break;
            case TypeViande::AGNEAU:
            default:
                return "json://agneau/listing_recettes_agneau.json";
                break;
        }
    }

    public function getRecettesForViande($viande)
    {
        $objects  = json_decode(JSONFetcher::get($this->getUrlForViande($viande)));
        $this->recettes=new Collection($objects,Recettes::class);
        return $this->recettes;
    }

    public function getRecetteForMorceau(Morceaux $morceaux)
    {
        $recettes = $this->getRecettesForViande($morceaux->getTypeViande());
        $this->recettes = $recettes->findContaining("morceaux",$morceaux->getId());
        return $this->recettes;
    }
}