<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 11:21
 */

namespace Ovs\Bovimarket\Services;


use Ovs\Bovimarket\Api\JSONFetcher;

class MorceauxFetcherService
{
    const BOEUF = "boeuf";
    const AGNEAU = "agneau";
    const PORC = "porc";
    const VEAU = "veau";

    public function getUrlForViande($typeViande = null)
    {
        switch ($typeViande) {
            case self::BOEUF:
                return "json://boeuf/listing_morceaux_boeufs.json";
                break;
            case self::AGNEAU:
            default:
                return "json://agneau/listing_morceaux_agneau.json";
                break;
        }
    }


    public function getMorceauxForViande($viande)
    {
        return json_decode(JSONFetcher::get($this->getUrlForViande($viande)));
    }
}