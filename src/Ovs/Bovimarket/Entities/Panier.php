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

    /**
     * @var
     */
    protected $vendeur;

    /**
     * @var
     */
    protected $paiement;

    /**
     * @var
     */
    protected $canal;

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

    /**
     * @return mixed
     */
    public function getCanal()
    {
        return $this->canal;
    }

    /**
     * @param mixed $canal
     * @return Panier
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;
        return $this;
    }



    public function isEmpty()
    {
        return count($this->getLignes())==0;
    }


    public function add(Produit $produit, $qte = 1, $idEntite = 0)
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
        
        $produit->setQuantite($ligne["qte"]) ;
        
        $ligne["prix"] = $produit->getPrix();
        $ligne["produit"] = $produit;
        $ligne["id_entite"] = $idEntite;
        $this->lignes[$produit->getId()] = $ligne;
        $this->calculTotal();
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
        $this->calculTotal();
    }

    public function calculTotal()
    {
        $total = 0;
        foreach ($this->getLignes() as $produit) {
            $total+=(intval($produit["qte"])*intval($produit["prix"]));
        }
        $this->total = $total;
        return $total;
    }
    
    public function getQuantiteTotal()
    {
    	$qty = 0;
    	foreach ($this->getLignes() as $produit)
    	{
    		$qty += intval($produit["qte"]) ;
    	}
    	
    	return $qty;
    }

    /**
     * @return mixed
     */
    public function getPaiement()
    {
        return $this->paiement;
    }

    /**
     * @param mixed $paiement
     * @return $this
     */
    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;
        return $this;
    }



}