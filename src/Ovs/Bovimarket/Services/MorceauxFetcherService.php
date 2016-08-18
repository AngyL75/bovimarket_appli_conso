<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 11:21
 */

namespace Ovs\Bovimarket\Services;


use Ovs\Bovimarket\Api\JSONFetcher;
use Ovs\Bovimarket\Entities\Interfaces\Collection;
use Ovs\Bovimarket\Entities\Morceaux;
use Ovs\Bovimarket\Entities\Recettes;
use Ovs\Bovimarket\Utils\TypeViande;

class MorceauxFetcherService
{
    protected $morceaux;

    public function __construct()
    {
        $this->morceaux=new Collection(array(),Morceaux::class);
    }

    protected function getUrlForViande($typeViande = null)
    {
        switch ($typeViande) {
            case TypeViande::BOEUF:
                return "json://boeuf/listing_morceaux_boeufs.json";
                break;
            case TypeViande::AGNEAU:
            default:
                return "json://agneau/listing_morceaux_agneau.json";
                break;
        }
    }


    public function getMorceauxForViande($viande)
    {
        $objects  = json_decode(JSONFetcher::get($this->getUrlForViande($viande)));
        $this->morceaux=new Collection($objects,Morceaux::class);
        return $this->morceaux;
    }

    /**
     * @param Recettes $recette
     * @return mixed
     */
    public function getMorceauxForRecette($recette)
    {
        $objects  = json_decode(JSONFetcher::get($this->getUrlForViande($recette->getTypeViande())));
        $this->morceaux=new Collection($objects,Morceaux::class);

        return $this->morceaux->findIn("id",$recette->getMorceaux());
    }
}