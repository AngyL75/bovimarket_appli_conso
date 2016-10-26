<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/10/2016
 * Time: 10:39
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class Allergene {
	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $id;

	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $nom;

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getNom() {
		return $this->nom;
	}

	/**
	 * @param mixed $nom
	 */
	public function setNom( $nom ) {
		$this->nom = $nom;
	}
}