<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/08/2016
 * Time: 12:23
 */

namespace Ovs\Bovimarket\Services\Api;


use Ovs\Bovimarket\Api\Api;

class ApiFetcher
{
    /**
     * ApiFetcher constructor.
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }
}