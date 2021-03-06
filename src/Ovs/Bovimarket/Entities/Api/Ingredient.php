<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/08/2016
 * Time: 10:54
 */

namespace Ovs\Bovimarket\Entities\Api;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\JsonDeserializationVisitor;


/**
 * Class Ingredient
 *
 */
class Ingredient
{
    protected $id;
    protected $nom;
    protected $categorie;
    protected $quantite;
    protected $certificationId;
    protected $certificationNom;
    protected $indicationPrix;

    /**
     * @param JsonDeserializationVisitor $visitor
     * @Serializer\HandlerCallback(direction="deserialization", format="json")
     */
    public function fromJson(JsonDeserializationVisitor $visitor,$obj)
    {
        $this->id=$obj["ingredient"]["id"];
        $this->nom=$obj["ingredient"]["nom"];
        $this->categorie=$obj["ingredient"]["categorie"];
        $this->quantite = $obj["quantite"];

        if(isset($obj["certification"])){
            $this->certificationId = $obj["certification"]["id"];
            $this->certificationNom = $obj["certification"]["nom"];
        }

        if(isset($obj["indicationPrix"])){
            $this->indicationPrix=$obj["indicationPrix"];
        }

        return $this;
    }

}