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
        return Utils::getImage($this->typeViande."/morceaux/".$this->photo);
    }



    public function getImageDecoupe()
    {
        switch ($this->typeViande) {
            case self::AGNEAU:
                return $this->getDecoupeAgneau();
                break;
            case self::BOEUF:
                return $this->getDecoupeBoeuf();
                break;
        }
    }

    private function getDecoupeAgneau()
    {
        $images = array(
            "1"  => "agneau1.png",
            "2"  => "agneau5.png",
            "3"  => "agneau6.png",
            "5"  => "agneau7.png",
            "7"  => "agneau9.png",
            "8"  => "agneau8.png",
            "9"  => "agneau3.png",
            "10" => "agneau4.png",
            "11" => "agneau2.png"
        );
        return "/images/" . $images[$this->id];
    }

    private function getDecoupeBoeuf()
    {
        $images = array(
            "28" => "boeuf1.jpg",
            "1"  => "boeuf2.jpg",
            "33" => "boeuf3.jpg",
            "31"=> "boeuf4.jpg",
            "29" => "boeuf5.jpg",
            "30"=> "boeuf6.jpg",
            "32" => "boeuf7.jpg",
            "2" => "boeuf8.jpg",
            "26" => "boeuf9.jpg",
            "25" => "boeuf10.jpg",
            "3" => "boeuf11.jpg",
            "5" => "boeuf12.jpg",
            "22" => "boeuf13.jpg",
            "24" => "boeuf14.jpg",
            "23" => "boeuf15.jpg",
            "21" => "boeuf16.jpg",
            "20" => "boeuf17.jpg",
            "18" => "boeuf18.jpg",
            "10" => "boeuf19.jpg",
            "10" => "boeuf20.jpg",
            "9" => "boeuf21.jpg",
            "10" => "boeuf22.jpg",
            "9" => "boeuf23.jpg",
            "19" => "boeuf24.jpg",
            "6" =>"boeuf25.jpg",
            "7" => "boeuf26.jpg",
        );

        if(!isset($images[$this->id])){
            $images[$this->id]= "boeuf0.jpg";
        }
        return "/images/" . $images[$this->id];
    }

    public function getIdForDecoupe($decoupe, $type = self::AGNEAU)
    {
        switch ($type) {
            case self::AGNEAU:
                $decoupes = array(
                    "selle"             => "7",
                    "filet"             => "5",
                    "collier"           => "1",
                    "cotes-decouvertes" => "2",
                    "cotes-secondaires" => "3",
                    "gigot-raccourci"   => "8",
                    "poitrine"          => "9",
                    "haut-cote"         => "10",
                    "epaule"            => "11"
                );
                break;
            case self::BOEUF: {
                $decoupes = array(
                    "gros-poitrine" => "28",
                    "collier" => "1",
                    "jumeau-pot-feu"=>"33",
                    "jumeau-biftek" => "31",
                    "macreuse-biftek" => "29",
                    "paleron"=>"30",
                    "macreuse-pot-feu" => "32",
                    "basse-cote"=>"2",
                    "poitrine"=>"26",
                    "plat-cote"=>"25",
                    "entrecote"=>"3",
                    "faux-filet"=>"5",
                    "bavette-aloyau"=>"22",
                    "flanchet"=>"24",
                    "bavette-flanchet"=>"23",
                    "hampe"=>"21",
                    "onglet"=>"20",
                    "gite"=>"18",
                    "tranche"=>"10",
                    "araignee"=>"10",
                    "noix-gite"=>"9",
                    "merlan"=>"10",
                    "rond-gite"=>"9",
                    "aiguillette"=>"19",
                    "filet"=>"6",
                    "rumstek"=>"7"
                );
                break;
            }
            default:
                $decoupes = array();
                break;
        }

        return (isset($decoupes[$decoupe]))?$decoupes[$decoupe]:"";
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