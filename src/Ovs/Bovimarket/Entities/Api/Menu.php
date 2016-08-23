<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/08/2016
 * Time: 10:51
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class Menu
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
    protected $description;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $photo;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("entiteId")
     */
    protected $entiteId;
    /**
     * @var
     * @Serializer\Type("array<Ovs\Bovimarket\Entities\Api\Ingredient>")
     */
    protected $ingredients;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Menu
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
     * @return Menu
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     * @return Menu
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return Menu
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
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
     * @return Menu
     */
    public function setEntiteId($entiteId)
    {
        $this->entiteId = $entiteId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredients
     * @return Menu
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
        return $this;
    }


}