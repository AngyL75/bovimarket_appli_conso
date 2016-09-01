<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 19/08/2016
 * Time: 16:19
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class Adresse
{

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $adresse;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("complementAdresse")
     */
    protected $complementAdresse;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("codePostal")
     */
    protected $codePostal;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $ville;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("villeId")
     */
    protected $villeId;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $pays;
    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $location;

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     * @return Adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComplementAdresse()
    {
        return $this->complementAdresse;
    }

    /**
     * @param mixed $complementAdresse
     * @return Adresse
     */
    public function setComplementAdresse($complementAdresse)
    {
        $this->complementAdresse = $complementAdresse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     * @return Adresse
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVilleId()
    {
        return $this->villeId;
    }

    /**
     * @param mixed $villeId
     * @return Adresse
     */
    public function setVilleId($villeId)
    {
        $this->villeId = $villeId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     * @return Adresse
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return Adresse
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

}