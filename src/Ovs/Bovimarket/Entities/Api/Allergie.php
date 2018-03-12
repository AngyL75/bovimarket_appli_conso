<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 27/09/2016
 * Time: 09:54
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;
use Ovs\Bovimarket\Utils\Utils;

class Allergie {
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
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $description;
	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $exemple;
	
	/**
	 * @var
	 * @Serializer\Type("ArrayCollection")
	 */
	protected $exclusions;
	
	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getNom()
	{
		return $this->nom;
	}
	
	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * @return string
	 */
	public function getExemple()
	{
		return $this->exemple;
	}
}