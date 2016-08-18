<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 11:21
 */

namespace Ovs\Bovimarket\Services;


use Ovs\Bovimarket\Entities\Cuisson;
use Ovs\Bovimarket\Entities\Interfaces\Collection;
use Ovs\Bovimarket\Entities\Morceaux;
use Ovs\Bovimarket\Entities\Recettes;
use Ovs\Bovimarket\Utils\TypeViande;

class MorceauxFetcherService extends JSONFetcher
{
    protected $morceaux;


    public function __construct()
    {
        $this->objectClass = Morceaux::class;
        $this->morceaux=new Collection(array(),$this->objectClass);
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
        $objects  = json_decode($this->get($this->getUrlForViande($viande)));
        $this->morceaux=new Collection($objects,$this->objectClass);
        return $this->morceaux;
    }

    public function getMorceauForViande($viande, $id)
    {
        $morceaux = $this->getMorceauxForViande($viande);
        return $morceaux->find($id);
    }

    /**
     * @param Recettes $recette
     * @return mixed
     */
    public function getMorceauxForRecette($recette)
    {
        $objects  = json_decode($this->get($this->getUrlForViande($recette->getTypeViande())));
        $this->morceaux=new Collection($objects,$this->objectClass);

        return $this->morceaux->findIn("id",$recette->getMorceaux());
    }

    /**
     * @param Cuisson $cuisson
     * @return mixed
     */
    public function getMorceauxForCuisson($cuisson)
    {
        $objects  = json_decode($this->get($this->getUrlForViande($cuisson->getTypeViande())));
        $this->morceaux=new Collection($objects,$this->objectClass);


        return $this->morceaux->findIn("id",$cuisson->getMorceauxIds());
    }
}