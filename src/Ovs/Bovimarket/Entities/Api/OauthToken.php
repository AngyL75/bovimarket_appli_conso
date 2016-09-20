<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/08/2016
 * Time: 17:10
 */

namespace Ovs\Bovimarket\Entities\Api;


use JMS\Serializer\Annotation as Serializer;

class OauthToken
{
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $accessToken;
    /**
     * @var
     * @Serializer\Type("string")
     */
    protected $refreshToken;
    /**
     * @var
     * @Serializer\Type("integer")
     * @Serializer\Accessor(setter="setExpiresIn")
     */
    protected $expiresIn;

    protected $expiresAt;

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->accessToken = $token;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
        $this->expiresAt = time()+$expiresIn;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param mixed $expiresAt
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    public function isExpired()
    {
        return $this->expiresAt < time();
    }

}