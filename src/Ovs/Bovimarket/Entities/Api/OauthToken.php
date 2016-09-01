<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/08/2016
 * Time: 17:10
 */

namespace Ovs\Bovimarket\Entities\Api;


class OauthToken
{
    protected $token;
    protected $refreshToken;
    protected $expires;

    /**
     * OauthToken constructor.
     * @param $token
     * @param $refreshToken
     * @param $expires
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->refreshToken = "";

        if(!empty($this->refreshToken)) {
            $this->expires = time() + (24 * 60 * 60);
        }else{
            $this->expires = 0;
        }
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
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
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param int $expires
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;
    }




}