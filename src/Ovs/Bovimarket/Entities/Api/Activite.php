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

class Activite {
	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $famille;
	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $filiere;

	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $nom;
	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $produits;
	
	/**
	 * @return string
	 */
	public function getFamille()
	{
		return $this->famille;
	}
	
	public function __get($n)
	{
		if($n == 'id') return $this->famille ;
		
		return parent::__get($n);
	}
	
	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->famille;
	}

	/**
	 * @return string
	 */
	public function getFiliere()
	{
		return $this->filiere;
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
	public function getProduits()
	{
		return $this->produits;
	}
}