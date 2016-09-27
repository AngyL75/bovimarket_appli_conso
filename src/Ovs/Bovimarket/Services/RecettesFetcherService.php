<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/08/2016
 * Time: 09:36
 */

namespace Ovs\Bovimarket\Services;


use Ovs\Bovimarket\Entities\Interfaces\Collection;
use Ovs\Bovimarket\Entities\Morceaux;
use Ovs\Bovimarket\Entities\Recettes;
use Ovs\Bovimarket\Utils\TypeViande;

class RecettesFetcherService extends JSONFetcher {

	/** @var Collection */
	protected $recettes;

	/**
	 * RecettesFetcherService constructor.
	 */
	public function __construct() {
		$this->objectClass = Recettes::class;
		$this->recettes    = new Collection( array(), $this->objectClass );
	}

	protected function getUrlForViande( $typeViande = null ) {
		switch ( $typeViande ) {
			case TypeViande::BOEUF:
				return "json://boeuf/recettes.json";
				break;
			case TypeViande::AGNEAU:
				return "json://agneau/recettes.json";
				break;
			case TypeViande::VEAU:
				return "json://veau/recettes.json";
				break;
			case TypeViande::PORC:
				return "json://porc/recettes.json";
				break;
		}
	}

	public function getRecettesForViande( $viande ) {
		$objects        = json_decode( $this->get( $this->getUrlForViande( $viande ) ) );
		$this->recettes = new Collection( $objects, $this->objectClass );

		return $this->recettes;
	}

	public function getRecettesForMorceau( Morceaux $morceaux ) {
		$recettes       = $this->getRecettesForViande( $morceaux->getTypeViande() );
		$this->recettes = $recettes->findContaining( "morceaux", $morceaux->getId() );

		return $this->recettes;
	}

	public function getRecetteForMorceau( Morceaux $morceaux, $id ) {
		$recettes = $this->getRecettesForMorceau( $morceaux );

		return $recettes->find( $id );
	}
}