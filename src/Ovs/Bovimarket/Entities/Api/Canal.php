<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/08/2016
 * Time: 10:49
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class Canal
{
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $id;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("entiteId")
     */
    protected $entiteId;
    /**
     * @var
     * @Serializer\Type("array")
     * @Serializer\SerializedName("typeCanal")
     */
    protected $typeCanal;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $url;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $nom;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $logo;
    /**
     * @var
     * @Serializer\Type("array<Ovs\Bovimarket\Entities\Api\Creneau>")
     * @Serializer\SerializedName("horaireListe")
     */
    protected $horaires;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("lieuDistribution")
     */
    protected $lieu;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("conditionEngagement")
     */
    protected $conditions;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Canal
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Canal
     */
    public function setEntiteId($entiteId)
    {
        $this->entiteId = $entiteId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeCanal()
    {
        return $this->typeCanal;
    }

    /**
     * @param mixed $typeCanal
     * @return Canal
     */
    public function setTypeCanal($typeCanal)
    {
        $this->typeCanal = $typeCanal;
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
     * @return Canal
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * @return Canal
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     * @return Canal
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHoraires()
    {
        return $this->horaires;
    }

    /**
     * @param mixed $horaires
     * @return Canal
     */
    public function setHoraires($horaires)
    {
        $this->horaires = $horaires;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     * @return Canal
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @param mixed $conditions
     * @return Canal
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;
        return $this;
    }

}