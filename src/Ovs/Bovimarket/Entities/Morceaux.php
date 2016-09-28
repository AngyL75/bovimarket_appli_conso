<?php

namespace Ovs\Bovimarket\Entities;

use JMS\Serializer\Annotation as Serializer;
use Ovs\Bovimarket\Entities\Interfaces\Searchable;
use Ovs\Bovimarket\Utils\Utils;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 15/03/2016
 * Time: 09:38
 */
class Morceaux
{

    const BOEUF = "boeuf";
    const AGNEAU = "agneau";
    const PORC = "porc";
    const VEAU = "veau";


    /**
     * @Serializer\Type("integer")
     */
    protected $id;
    /**
     * @Serializer\Type("string")
     */
    protected $nom;

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $typeViande;

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $identifiantMap;

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $photo;

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $description;

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $conseilsCuisson;

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $conseilsAchat;

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $conseilsConservation;

    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $cuissons;

    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $recettes;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Morceaux
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Morceaux
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeViande()
    {
        return $this->typeViande;
    }

    /**
     * @param mixed $typeViande
     * @return Morceaux
     */
    public function setTypeViande($typeViande)
    {
        $this->typeViande = $typeViande;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdentifiantMap()
    {
        return $this->identifiantMap;
    }

    /**
     * @param mixed $identifiantMap
     * @return Morceaux
     */
    public function setIdentifiantMap($identifiantMap)
    {
        $this->identifiantMap = $identifiantMap;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     * @return Morceaux
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Morceaux
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConseilsCuisson()
    {
        return $this->conseilsCuisson;
    }

    /**
     * @param mixed $conseilsCuisson
     * @return Morceaux
     */
    public function setConseilsCuisson($conseilsCuisson)
    {
        $this->conseilsCuisson = $conseilsCuisson;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConseilsAchat()
    {
        return $this->conseilsAchat;
    }

    /**
     * @param mixed $conseilsAchat
     * @return Morceaux
     */
    public function setConseilsAchat($conseilsAchat)
    {
        $this->conseilsAchat = $conseilsAchat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConseilsConservation()
    {
        return $this->conseilsConservation;
    }

    /**
     * @param mixed $conseilsConservation
     * @return Morceaux
     */
    public function setConseilsConservation($conseilsConservation)
    {
        $this->conseilsConservation = $conseilsConservation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCuissons()
    {
        return $this->cuissons;
    }

    /**
     * @param mixed $cuissons
     * @return Morceaux
     */
    public function setCuissons($cuissons)
    {
        $this->cuissons = $cuissons;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecettes()
    {
        return $this->recettes;
    }

    /**
     * @param mixed $recettes
     * @return Morceaux
     */
    public function setRecettes($recettes)
    {
        $this->recettes = $recettes;
        return $this;
    }


    public function getPhotoPath()
    {
        return Utils::getImage($this->typeViande . "/morceaux/" . $this->photo);
    }


    public function oldgetImageDecoupe()
    {
        switch ($this->typeViande) {
            case self::AGNEAU:
                return Utils::getImage($this->getDecoupeAgneau());
                break;
            case self::BOEUF:
                return Utils::getImage($this->getDecoupeBoeuf());
                break;
        }
    }

    public function getImageDecoupe()
    {
        return Utils::getImage($this->typeViande."/decoupes/".$this->typeViande.".jpg");
    }

    public function renderMap()
    {
        switch ($this->typeViande) {
            case self::AGNEAU:
                include_once Utils::getResourcesDir() . "/views/map_agneau.php";
                break;
            case self::BOEUF:
                include_once Utils::getResourcesDir() . "/views/map_boeuf.php";
                break;
        }
    }

}