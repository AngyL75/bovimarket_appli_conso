<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/08/2016
 * Time: 10:50
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class Creneau
{
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $jour;
    /**
     * @var
     * @Serializer\Type("double")
     * @Serializer\SerializedName("heureDebut")
     */
    protected $debut;
    /**
     * @var
     * @Serializer\Type("double")
     * @Serializer\SerializedName("heureFin")
     */
    protected $fin;

    /**
     * @return mixed
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param mixed $jour
     * @return Creneau
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @param mixed $debut
     * @return Creneau
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * @param mixed $fin
     * @return Creneau
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
        return $this;
    }


}