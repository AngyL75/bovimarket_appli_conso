<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/08/2016
 * Time: 16:34
 */

namespace Ovs\Bovimarket\Services\API;


use Ovs\Bovimarket\Entities\Api\Certification;

class CertificationFetcherService extends ApiFetcher
{

    public function getEndpoint()
    {
        return "certifications/";
    }

    public function getClass()
    {
        return Certification::class;
    }
}