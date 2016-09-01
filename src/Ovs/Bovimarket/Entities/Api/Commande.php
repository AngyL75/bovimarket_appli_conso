<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/08/2016
 * Time: 17:02
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;
use Ovs\Bovimarket\Entities\Panier;

class Commande
{

    const ETAT_ACCEPTE="PAIEMENT_ACCEPTE";
    const ETAT_ATTENTE= "PAIEMENT_ATTENTE";
    const ETAT_REFUS = "PAIEMENT_REFUSE";
    const ETAT_LIVREE= "LIVREE";

    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $id;
    /**
     * @var
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("numeroCommande")
     */
    protected $numeroCommande;
    /**
     * @var
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("clientId")
     */
    protected $clientId;

    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("entiteId")
     */
    protected $entiteId;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("dateCommande")
     */
    protected $dateCommande;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("dateCollecte")
     */
    protected $dateCollecte;
    /**
     * @var
     * @Serializer\Type("Ovs\Bovimarket\Entities\Api\CommandeCanal")
     */
    protected $canal;
    /**
     * @var
     * @Serializer\Type("double")
     */
    protected $total;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("etatCommande")
     */
    protected $etatCommade;
    /**
     * @var
     * @Serializer\Type("ArrayCollection<Ovs\Bovimarket\Entities\Api\CommandeProduit>")
     * @Serializer\SerializedName("listeProduits")
     */
    protected $listeProduits;

    /**
     * Commande constructor.
     */
    public function __construct()
    {
        $this->etatCommade = Commande::ETAT_ATTENTE;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Commande
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroCommande()
    {
        return $this->numeroCommande;
    }

    /**
     * @param mixed $numeroCommande
     * @return Commande
     */
    public function setNumeroCommande($numeroCommande)
    {
        $this->numeroCommande = $numeroCommande;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     * @return Commande
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * @param mixed $dateCommande
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCollecte()
    {
        return $this->dateCollecte;
    }

    /**
     * @param mixed $dateCollecte
     * @return Commande
     */
    public function setDateCollecte($dateCollecte)
    {
        $this->dateCollecte = $dateCollecte;
        return $this;
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
     * @return Commande
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;
        return $this;
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
     * @return Commande
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEtatCommade()
    {
        return $this->etatCommade;
    }

    /**
     * @param mixed $etatCommade
     * @return Commande
     */
    public function setEtatCommade($etatCommade)
    {
        $this->etatCommade = $etatCommade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getListeProduits()
    {
        return $this->listeProduits;
    }

    /**
     * @param mixed $listeProduits
     * @return Commande
     */
    public function setListeProduits($listeProduits)
    {
        $this->listeProduits = $listeProduits;
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
     */
    public function setEntiteId($entiteId)
    {
        $this->entiteId = $entiteId;
    }

}