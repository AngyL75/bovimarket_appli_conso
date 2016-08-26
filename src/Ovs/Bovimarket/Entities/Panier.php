<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/08/2016
 * Time: 12:11
 */

namespace Ovs\Bovimarket\Entities;


use JMS\Serializer\Annotation as Serializer;
use Ovs\Bovimarket\Entities\Api\Produit;

class Panier
{
    /**
     * @var array
     * @Serializer\Type("array")
     */
    protected $lignes;
    /**
     * @var
     * @Serializer\Type("float")
     */
    protected $total;
    /**
     * @var
     * @Serializer\Type("boolean")
     */
    protected $validé;

    public function __construct()
    {
        $this->lignes=array();
    }


    /**
     * @return mixed
     */
    public function getLignes()
    {
        return $this->lignes;
    }

    /**
     * @param mixed $lignes
     */
    public function setLignes($lignes)
    {
        $this->lignes = $lignes;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getValidé()
    {
        return $this->validé;
    }

    /**
     * @param mixed $validé
     */
    public function setValidé($validé)
    {
        $this->validé = $validé;
    }

    public function add(Produit $produit, $qte = 1)
    {
        if ($ligne=$this->getLigneProduit($produit->getId())) {
            $ligne["qte"] += $qte;
        } elseif ($qte > 0) {
            $ligne = array(
                "qte" => $qte,
            );
        } else {
            $ligne = array(
                "qte" => 1,
            );
        }
        $ligne["prix"] = $produit->getPrix();
        $ligne["produit"] = $produit;
        $this->lignes[$produit->getId()] = $ligne;
    }

    public function getLigneProduit($idProduit)
    {
        if (isset($this->lignes[$idProduit]) && $ligne = $this->lignes[$idProduit]) {
            return $ligne;
        }else{
            return null;
        }
    }

    public function remove($idProduit, $qte = 0)
    {
        $ligne = $this->getLigneProduit($idProduit);
        if(!$ligne){
            return;
        }else{
            /** @var Produit $produit */
            $produit=$ligne["produit"];
        }

        if ($qte == 0) {
            if (isset($this->lignes[$produit->getId()])) {
                unset($this->lignes[$produit->getId()]);
            }
        } else {
            $this->add($produit, $qte * (-1));
        }
    }

}