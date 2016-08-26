<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/08/2016
 * Time: 15:41
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

/**
 * Class MenuPlanning
 */
class MenuPlanning
{
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $id;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("menuId")
     */
    protected $menuId;

    protected $menu;

    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("createurId")
     */
    protected $createurId;
    /**
     * @var
     * @Serializer\Type("double")
     * @Serializer\SerializedName("dateDebut")
     */
    protected $dateDebut;
    /**
     * @var
     * @Serializer\Type("double")
     * @Serializer\SerializedName("dateFin")
     */
    protected $dateFin;
    /**
     * @var
     * @Serializer\Type("integer")
     */
    protected $capacite;
    /**
     * @var
     * @Serializer\Type("ArrayCollection<Ovs\Bovimarket\Entities\Api\Ingredient>")
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
     * @return MenuPlanning
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMenuId()
    {
        return $this->menuId;
    }

    /**
     * @param mixed $menuId
     * @return MenuPlanning
     */
    public function setMenuId($menuId)
    {
        $this->menuId = $menuId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateurId()
    {
        return $this->createurId;
    }

    /**
     * @param mixed $createurId
     * @return MenuPlanning
     */
    public function setCreateurId($createurId)
    {
        $this->createurId = $createurId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     * @return MenuPlanning
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     * @return MenuPlanning
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * @param mixed $capacite
     * @return MenuPlanning
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;
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
     * @return MenuPlanning
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param mixed $menu
     * @return MenuPlanning
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
        return $this;
    }



}