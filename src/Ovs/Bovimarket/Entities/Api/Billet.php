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

class Billet {
	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $id;
	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $contenu;

	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $titre;
	/**
	 * @var
	 * @Serializer\Type("double")
	 */
	protected $publication;
	/**
	 * @var
	 * @Serializer\Type("double")
	 */
	protected $debut;
	/**
	 * @var
	 * @Serializer\Type("double")
	 */
	protected $fin;
	/**
	 * @var
	 * @Serializer\Type("boolean")
	 * @Serializer\SerializedName("journeeEntiere")
	 */
	protected $journeeEntiere;
	/**
	 * @var
	 * @Serializer\Type("string")
	 * @Serializer\SerializedName("entiteId")
	 */
	protected $entiteId;
	/**
	 * @var
	 * @Serializer\Type("string")
	 */
	protected $type;

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
	public function getContenu() {
		return $this->contenu;
	}
	
	public function getExtrait()
	{
		$content = $this->getContenu() ;
		
		$content = strip_tags($content) ;
		$content = Utils::trunc($content, 100) ;
		
		return $content ; 
	}

	/**
	 * @param mixed $contenu
	 */
	public function setContenu( $contenu ) {
		$this->contenu = $contenu;
	}

	/**
	 * @return mixed
	 */
	public function getTitre() {
		return $this->titre;
	}

	/**
	 * @param mixed $titre
	 */
	public function setTitre( $titre ) {
		$this->titre = $titre;
	}

	/**
	 * @return mixed
	 */
	public function getPublication() {
		return $this->publication;
	}

	/**
	 * @param mixed $publication
	 */
	public function setPublication( $publication ) {
		$this->publication = $publication;
	}

	/**
	 * @return mixed
	 */
	public function getDebut() {
		return $this->debut;
	}

	/**
	 * @param mixed $debut
	 */
	public function setDebut( $debut ) {
		$this->debut = $debut;
	}

	/**
	 * @return mixed
	 */
	public function getFin() {
		return $this->fin;
	}

	/**
	 * @param mixed $fin
	 */
	public function setFin( $fin ) {
		$this->fin = $fin;
	}

	/**
	 * @return mixed
	 */
	public function getJourneeEntiere() {
		return $this->journeeEntiere;
	}

	/**
	 * @param mixed $journeeEntiere
	 */
	public function setJourneeEntiere( $journeeEntiere ) {
		$this->journeeEntiere = $journeeEntiere;
	}

	/**
	 * @return mixed
	 */
	public function getEntiteId() {
		return $this->entiteId;
	}

	/**
	 * @param mixed $entiteId
	 */
	public function setEntiteId( $entiteId ) {
		$this->entiteId = $entiteId;
	}

	/**
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

}