<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/08/2016
 * Time: 16:03
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class Produit
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
    protected $accroche;
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
     * @Serializer\Type("float")
     */
    protected $prix;
    /**
     * @var
     * @Serializer\Type("integer")
     */
    protected $stock;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("indicationPrix")
     */
    protected $indicationPrix;
    /**
     * @var
     * @Serializer\Type("ArrayCollection")
     * @Serializer\SerializedName("prixCanalList")
     */
    protected $prixCanaux;
    
    protected $quantite ;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Produit
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getQuantite()
    {
    	return $this->quantite;
    }
    
    /**
     * @param mixed $quantite
     * @return Produit
     */
    public function setQuantite($q)
    {
    	$this->quantite = $q;
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
     * @return Produit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccroche()
    {
        return $this->accroche;
    }

    /**
     * @param mixed $accroche
     * @return Produit
     */
    public function setAccroche($accroche)
    {
        $this->accroche = $accroche;
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
     * @return Produit
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
     * @return Produit
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     * @return Produit
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIndicationPrix()
    {
        return $this->indicationPrix;
    }

    /**
     * @param mixed $indicationPrix
     * @return Produit
     */
    public function setIndicationPrix($indicationPrix)
    {
        $this->indicationPrix = $indicationPrix;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrixCanaux()
    {
        return $this->prixCanaux;
    }

    /**
     * @param mixed $prixCanaux
     * @return Produit
     */
    public function setPrixCanaux($prixCanaux)
    {
        $this->prixCanaux = $prixCanaux;
        return $this;
    }



}