<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 27/09/2016
 * Time: 09:53
 */

namespace Ovs\Bovimarket\Services\API;


use Ovs\Bovimarket\Entities\Api\Billet;

class BilletFetcherService extends ApiFetcher {

	public function getEndpoint() {
		return "billets/{idEntite}";
	}

	public function getClass() {
		return Billet::class;
	}
}