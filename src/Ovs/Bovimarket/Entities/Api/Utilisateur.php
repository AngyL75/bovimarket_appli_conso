<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/08/2016
 * Time: 11:34
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class Utilisateur
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
    protected $email;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("firstName")
     */
    protected $firstName;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("lastName")
     */
    protected $lastName;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $telephone;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $photo;
    /**
     * @var
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("hideTelephone")
     */
    protected $hideTelephone;
    /**
     * @var
     * @Serializer\Type("Ovs\Bovimarket\Entities\Api\Adresse")
     */
    protected $adresse;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("entiteFavoris")
     */
    protected $entiteFavoris;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("dateNaissance")
     */
    protected $dateNaissance;
    /**
     * @var
     * @Serializer\Type("string")
     * @Serializer\SerializedName("miniBio")
     */
    protected $miniBio;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $password;

    /**
     * Utilisateur constructor.
     */
    public function __construct()
    {
        //$this->id= time()+rand(0,time());
        //$this->id= 1;
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
     * @return Utilisateur
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return Utilisateur
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return Utilisateur
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     * @return Utilisateur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
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
     * @return Utilisateur
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHideTelephone()
    {
        return $this->hideTelephone;
    }

    /**
     * @param mixed $hideTelephone
     * @return Utilisateur
     */
    public function setHideTelephone($hideTelephone)
    {
        $this->hideTelephone = $hideTelephone;
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
     * @return Utilisateur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntiteFavoris()
    {
        return $this->entiteFavoris;
    }

    /**
     * @param mixed $entiteFavoris
     * @return Utilisateur
     */
    public function setEntiteFavoris($entiteFavoris)
    {
        $this->entiteFavoris = $entiteFavoris;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     * @return Utilisateur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMiniBio()
    {
        return $this->miniBio;
    }

    /**
     * @param mixed $miniBio
     * @return Utilisateur
     */
    public function setMiniBio($miniBio)
    {
        $this->miniBio = $miniBio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



    public static function fromForm($formValues)
    {
        $user = new self();
        $user->setFirstName($formValues["prenom"]);
        $user->setLastName($formValues["nom"]);
        $user->setEmail($formValues["email"]);
        $user->setPassword($formValues["password"]);

        if(isset($formValues["id"])){
            $user->setId($formValues["id"]);
        }

        if(isset($formValues["displayTelephone"])){
            $user->setHideTelephone($formValues["displayTelephone"]!="on");
        }else{
            $user->setHideTelephone(true);
        }

        if(isset($formValues["adresse"])) {
            $formValues=$formValues["adresse"];
            $adresse = new Adresse();
            $adresse->setAdresse($formValues["adresse"]);
            $adresse->setCodePostal($formValues["code_postal"]);
            $adresse->setVille($formValues["ville"]);
            $user->setAdresse($adresse);
        }
        return $user;
    }

}