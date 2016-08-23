<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 21/03/2016
 * Time: 10:34
 */

namespace Ovs\Bovimarket\Entities\Api;


use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Ovs\Bovimarket\Api\Api;
use Ovs\Bovimarket\Entities\Interfaces\Searchable;
use Ovs\Bovimarket\Utils\Utils;

class Entite
{

    //region Properties
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $id;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $type;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $name;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $description;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $charte;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $motPresident;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $historique;
    /**
     * @var
     * @Serializer\Type("Ovs\Bovimarket\Entities\Api\Adresse")
     */
    protected $adresse;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $siren;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $codeNaf;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $formeJuridique;
    /**
     * @var
     * @Serializer\Type("DateTime")
     */
    protected $dateImmatriculationRCS;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $capitalSocial;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $nomContact;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $telephoneContact;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $siteWeb;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $numeroTVA;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $logo;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $photoResponsable;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $photoEquipe;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $activite;
    /**
     * @var
     * @Serializer\Type("ArrayCollection")
     */
    protected $abonnement;
    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $fichiersValidation;
    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $cercles;
    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $contacts;
    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $membres;
    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $groupes;
    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $certifications;
    /**
     * @var
     * @Serializer\Type("array")
     */
    protected $concours;
    //endregion


    //region Getters/Setters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Entite
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Entite
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Entite
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Entite
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharte()
    {
        return $this->charte;
    }

    /**
     * @param mixed $charte
     * @return Entite
     */
    public function setCharte($charte)
    {
        $this->charte = $charte;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMotPresident()
    {
        return $this->motPresident;
    }

    /**
     * @param mixed $motPresident
     * @return Entite
     */
    public function setMotPresident($motPresident)
    {
        $this->motPresident = $motPresident;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHistorique()
    {
        return $this->historique;
    }

    /**
     * @param mixed $historique
     * @return Entite
     */
    public function setHistorique($historique)
    {
        $this->historique = $historique;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     * @return Entite
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * @param mixed $siren
     * @return Entite
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodeNaf()
    {
        return $this->codeNaf;
    }

    /**
     * @param mixed $codeNaf
     * @return Entite
     */
    public function setCodeNaf($codeNaf)
    {
        $this->codeNaf = $codeNaf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormeJuridique()
    {
        return $this->formeJuridique;
    }

    /**
     * @param mixed $formeJuridique
     * @return Entite
     */
    public function setFormeJuridique($formeJuridique)
    {
        $this->formeJuridique = $formeJuridique;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateImmatriculationRCS()
    {
        return $this->dateImmatriculationRCS;
    }

    /**
     * @param mixed $dateImmatriculationRCS
     * @return Entite
     */
    public function setDateImmatriculationRCS($dateImmatriculationRCS)
    {
        $this->dateImmatriculationRCS = $dateImmatriculationRCS;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCapitalSocial()
    {
        return $this->capitalSocial;
    }

    /**
     * @param mixed $capitalSocial
     * @return Entite
     */
    public function setCapitalSocial($capitalSocial)
    {
        $this->capitalSocial = $capitalSocial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomContact()
    {
        return $this->nomContact;
    }

    /**
     * @param mixed $nomContact
     * @return Entite
     */
    public function setNomContact($nomContact)
    {
        $this->nomContact = $nomContact;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelephoneContact()
    {
        return $this->telephoneContact;
    }

    /**
     * @param mixed $telephoneContact
     * @return Entite
     */
    public function setTelephoneContact($telephoneContact)
    {
        $this->telephoneContact = $telephoneContact;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * @param mixed $siteWeb
     * @return Entite
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroTVA()
    {
        return $this->numeroTVA;
    }

    /**
     * @param mixed $numeroTVA
     * @return Entite
     */
    public function setNumeroTVA($numeroTVA)
    {
        $this->numeroTVA = $numeroTVA;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     * @return Entite
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhotoResponsable()
    {
        return $this->photoResponsable;
    }

    /**
     * @param mixed $photoResponsable
     * @return Entite
     */
    public function setPhotoResponsable($photoResponsable)
    {
        $this->photoResponsable = $photoResponsable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhotoEquipe()
    {
        return $this->photoEquipe;
    }

    /**
     * @param mixed $photoEquipe
     * @return Entite
     */
    public function setPhotoEquipe($photoEquipe)
    {
        $this->photoEquipe = $photoEquipe;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * @param mixed $activite
     * @return Entite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAbonnement()
    {
        return $this->abonnement;
    }

    /**
     * @param mixed $abonnement
     * @return Entite
     */
    public function setAbonnement($abonnement)
    {
        $this->abonnement = $abonnement;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFichiersValidation()
    {
        return $this->fichiersValidation;
    }

    /**
     * @param mixed $fichiersValidation
     * @return Entite
     */
    public function setFichiersValidation($fichiersValidation)
    {
        $this->fichiersValidation = $fichiersValidation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCercles()
    {
        return $this->cercles;
    }

    /**
     * @param mixed $cercles
     * @return Entite
     */
    public function setCercles($cercles)
    {
        $this->cercles = $cercles;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param mixed $contacts
     * @return Entite
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMembres()
    {
        return $this->membres;
    }

    /**
     * @param mixed $membres
     * @return Entite
     */
    public function setMembres($membres)
    {
        $this->membres = $membres;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroupes()
    {
        return $this->groupes;
    }

    /**
     * @param mixed $groupes
     * @return Entite
     */
    public function setGroupes($groupes)
    {
        $this->groupes = $groupes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCertifications()
    {
        return $this->certifications;
    }

    /**
     * @param mixed $certifications
     * @return Entite
     */
    public function setCertifications($certifications)
    {
        $this->certifications = $certifications;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConcours()
    {
        return $this->concours;
    }

    /**
     * @param mixed $concours
     * @return Entite
     */
    public function setConcours($concours)
    {
        $this->concours = $concours;
        return $this;
    }
    //endregion

    public function getLatLng()
    {
        if(isset($this->adresse)){
            if($this->adresse->getLocation())
            {
                return $this->adresse->getLocation();
            }
        }
        return null;
    }

    public function getLat()
    {
        if($latLng = $this->getLatLng()){
            $lat = (string)$latLng[0];
            $lat = str_replace(",",".",$lat);
            return $lat;
        }
        return 0;
    }

    public function getLng()
    {
        if($latLng = $this->getLatLng()){
            $lng = (string)$latLng[1];
            $lng = str_replace(",",".",$lng);
            return $lng;
        }
        return 0;
    }

    public function getOptions()
    {
        return $this->getAbonnement()->get("options");
    }

    public function getAdresseString()
    {
        $adresseStr="";
        if($this->adresse) {
            $adresse = $this->adresse;
            $adresseStr .= $adresse->adresse;
            if ($adresse->complementAdresse) {
                $adresseStr .= " - " . $adresse->complementAdresse;
            }
            $adresseStr .= " - " . $adresse->codePostal . " " . ucwords($adresse->ville);
        }
        return $adresseStr;
    }


    public function hasValidCertifs()
    {
        foreach($this->certifications as $certif):
            if($certif->valide){return true;}
        endforeach;
        return false;
    }

    public function getIcon()
    {
        return Utils::getIconForActivite($this->activite);
    }

    public function getAdresseComplete()
    {
        /** @var Adresse $adresse */
        $adresse = $this->getAdresse();

        return $adresse->getAdresse()." ".$adresse->getComplementAdresse()." ".$adresse->getCodePostal()." ".$adresse->getVille();
    }

    public function hasVenteDirecte()
    {
        $options = $this->getOptions();
        return $options["venteDirecte"]!=0;
    }
}