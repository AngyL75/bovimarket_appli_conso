<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/08/2016
 * Time: 17:10
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class CommandeCanal
{
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $nom;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("lieuCollecte")
     */
    protected $lieuCollecte;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLieuCollecte()
    {
        return $this->lieuCollecte;
    }

    /**
     * @param mixed $lieuCollecte
     */
    public function setLieuCollecte($lieuCollecte)
    {
        $this->lieuCollecte = $lieuCollecte;
        return $this;
    }


}