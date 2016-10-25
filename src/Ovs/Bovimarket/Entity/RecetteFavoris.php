<?php

namespace Ovs\Bovimarket\Entity;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="RecetteFavorisRepository")
 * @\Doctrine\ORM\Mapping\Table(name="recette_favoris")
 */
class RecetteFavoris {

	/**
	 * @var
	 * @\Doctrine\ORM\Mapping\Id()
	 * @\Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
	 * @\Doctrine\ORM\Mapping\Column(type="integer",name="id")
	 */
	protected $id;

	/**
	 * @var
	 * @\Doctrine\ORM\Mapping\Column(name="recette_id",type="integer")
	 */
	protected $recetteId;

	/**
	 * @var
	 * @\Doctrine\ORM\Mapping\Column(name="recette_type", type="string", length=255)
	 */
	protected $recetteType;

	/**
	 * @var
	 * @\Doctrine\ORM\Mapping\Column(name="user_id",type="integer")
	 */
	protected $userId;

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
	public function getRecetteId() {
		return $this->recetteId;
	}

	/**
	 * @param mixed $recetteId
	 */
	public function setRecetteId( $recetteId ) {
		$this->recetteId = $recetteId;
	}

	/**
	 * @return mixed
	 */
	public function getUserId() {
		return $this->userId;
	}

	/**
	 * @param mixed $userId
	 */
	public function setUserId( $userId ) {
		$this->userId = $userId;
	}

	/**
	 * @return mixed
	 */
	public function getRecetteType() {
		return $this->recetteType;
	}

	/**
	 * @param mixed $recetteType
	 */
	public function setRecetteType( $recetteType ) {
		$this->recetteType = $recetteType;
	}

}