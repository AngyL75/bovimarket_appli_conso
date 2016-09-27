<?php

namespace Ovs\Bovimarket\Entities;
use JMS\Serializer\Annotation as Serializer;
use Ovs\Bovimarket\Utils\Utils;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 15/03/2016
 * Time: 10:41
 */
class Recettes
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
    protected $titre;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $photo;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $tempsPreparation;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $tempsCuisson;
    /**
     * @var
     * @Serializer\Type("integer")
     */
    protected $difficulte;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $descriptifIntroduction;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $portion;
    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $ingredients;

    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $ingredientsSauce;

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $instructionsPreparation;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $instructionDressage;
    /**
     * @var
     * @Serializer\Type("array")
     * @Serializer\SerializedName("morceaux_alternatifs")
     */
    protected $morceaux;
    /**
     * @var
     * @Serializer\Type("integer")
     */
    protected $cuisson;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Recettes
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
     * @return Recettes
     */
    public function setTypeViande($typeViande)
    {
        $this->typeViande = $typeViande;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     * @return Recettes
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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
     * @return Recettes
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempsPreparation()
    {
        return $this->tempsPreparation;
    }

    /**
     * @param mixed $tempsPreparation
     * @return Recettes
     */
    public function setTempsPreparation($tempsPreparation)
    {
        $this->tempsPreparation = $tempsPreparation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempsCuisson()
    {
        return $this->tempsCuisson;
    }

    /**
     * @param mixed $tempsCuisson
     * @return Recettes
     */
    public function setTempsCuisson($tempsCuisson)
    {
        $this->tempsCuisson = $tempsCuisson;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDifficulte()
    {
        return $this->difficulte;
    }

    /**
     * @param mixed $difficulte
     * @return Recettes
     */
    public function setDifficulte($difficulte)
    {
        $this->difficulte = $difficulte;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptifIntroduction()
    {
        return $this->descriptifIntroduction;
    }

    /**
     * @param mixed $descriptifIntroduction
     * @return Recettes
     */
    public function setDescriptifIntroduction($descriptifIntroduction)
    {
        $this->descriptifIntroduction = $descriptifIntroduction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPortion()
    {
        return $this->portion;
    }

    /**
     * @param mixed $portion
     * @return Recettes
     */
    public function setPortion($portion)
    {
        $this->portion = $portion;
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
     * @return Recettes
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstructionsPreparation()
    {
        return $this->instructionsPreparation;
    }

    /**
     * @param mixed $instructionsPreparation
     * @return Recettes
     */
    public function setInstructionsPreparation($instructionsPreparation)
    {
        $this->instructionsPreparation = $instructionsPreparation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstructionDressage()
    {
        return $this->instructionDressage;
    }

    /**
     * @param mixed $instructionDressage
     * @return Recettes
     */
    public function setInstructionDressage($instructionDressage)
    {
        $this->instructionDressage = $instructionDressage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMorceaux()
    {
        return $this->morceaux;
    }

    /**
     * @param mixed $morceaux
     * @return Recettes
     */
    public function setMorceaux($morceaux)
    {
        $this->morceaux = $morceaux;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCuisson()
    {
        return $this->cuisson;
    }

    /**
     * @param mixed $cuisson
     * @return Recettes
     */
    public function setCuisson($cuisson)
    {
        $this->cuisson = $cuisson;
        return $this;
    }

    public function getPhotoPath()
    {
        return Utils::getImage($this->typeViande."/recettes/".$this->photo);
    }

    /**
     * @return mixed
     */
    public function getIngredientsSauce()
    {
        return $this->ingredientsSauce;
    }

    /**
     * @param mixed $ingredientsSauce
     * @return $this
     */
    public function setIngredientsSauce($ingredientsSauce)
    {
        $this->ingredientsSauce = $ingredientsSauce;
        return $this;
    }

    public function getDifficulteClass()
    {
        $classes=array(
            0=>"neutre",
            1=>"facile",
            2=>"moyen",
            3=>"difficile",
            4=>"expert"
        );
        return $classes[$this->difficulte];
    }
}