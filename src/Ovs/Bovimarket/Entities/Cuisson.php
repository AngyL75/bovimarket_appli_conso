<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/03/2016
 * Time: 12:23
 */

namespace Ovs\Bovimarket\Entities;


use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Ovs\Bovimarket\Entities\Interfaces\Searchable;
use Ovs\Bovimarket\Utils\Utils;

class Cuisson
{

    /**
     * @var
     * @Serializer\Type("integer")
     */
    protected $id;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $typeViande;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $nom;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $cuissonPhoto;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $cuissonLogo;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $description;
    /**
     * @var ArrayCollection
     * @Serializer\Type("ArrayCollection<string,string>")
     * @Serializer\SerializedName("specificite")
     */
    protected $conseilsAstuces;
    /**
     * @var
     * @Serializer\Type("ArrayCollection<string,array>")
     */
    protected $morceaux;
    /**
     * @var
     * @Serializer\Type("ArrayCollection<string,array>")
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
     * @return Cuisson
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Cuisson
     */
    public function setTypeViande($typeViande)
    {
        $this->typeViande = $typeViande;
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
     * @return Cuisson
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCuissonPhoto()
    {
        return $this->cuissonPhoto;
    }

    /**
     * @param mixed $cuissonPhoto
     * @return Cuisson
     */
    public function setCuissonPhoto($cuissonPhoto)
    {
        $this->cuissonPhoto = $cuissonPhoto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCuissonLogo()
    {
        return $this->cuissonLogo;
    }

    /**
     * @param mixed $cuissonLogo
     * @return Cuisson
     */
    public function setCuissonLogo($cuissonLogo)
    {
        $this->cuissonLogo = $cuissonLogo;
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
     * @return Cuisson
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConseilsAstuces($typeViande)
    {
        return $this->conseilsAstuces->get($typeViande);
    }

    /**
     * @param mixed $conseilsAstuces
     * @return Cuisson
     */
    public function setConseilsAstuces($conseilsAstuces)
    {
        $this->conseilsAstuces = $conseilsAstuces;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getMorceaux()
    {
        return $this->morceaux;
    }

    /**
     * @param mixed $morceaux
     * @return Cuisson
     */
    public function setMorceaux($morceaux)
    {
        $this->morceaux = $morceaux;
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
     * @return Cuisson
     */
    public function setRecettes($recettes)
    {
        $this->recettes = $recettes;
        return $this;
    }

    public function getLogoPath()
    {
        return Utils::getImage($this->cuissonLogo);
    }

    public function getPhotoPath(){
        return Utils::getImage($this->cuissonPhoto);
    }

    /**
     * @return mixed|null
     */
    public function getMorceauxIds()
    {
        return $this->getMorceaux()->get($this->getTypeViande());
    }
}