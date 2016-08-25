<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/08/2016
 * Time: 16:35
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class Certification
{
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
    protected $categorie;
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
    protected $logo;
    /**
     * @var
     * @Serializer\Type("array")
     * @Serializer\SerializedName("categoriesIngredients")
     */
    protected $categoriesIngredients;
    /**
     * @var
     * @Serializer\Type("array")
     * @Serializer\SerializedName("especeAnimal")
     */
    protected $especeAnimal;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $url;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Certification
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
     * @return Certification
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     * @return Certification
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntiteId()
    {
        return $this->entiteId;
    }

    /**
     * @param mixed $entiteId
     * @return Certification
     */
    public function setEntiteId($entiteId)
    {
        $this->entiteId = $entiteId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     * @return Certification
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoriesIngredients()
    {
        return $this->categoriesIngredients;
    }

    /**
     * @param mixed $categoriesIngredients
     * @return Certification
     */
    public function setCategoriesIngredients($categoriesIngredients)
    {
        $this->categoriesIngredients = $categoriesIngredients;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEspeceAnimal()
    {
        return $this->especeAnimal;
    }

    /**
     * @param mixed $especeAnimal
     * @return Certification
     */
    public function setEspeceAnimal($especeAnimal)
    {
        $this->especeAnimal = $especeAnimal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return Certification
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

}