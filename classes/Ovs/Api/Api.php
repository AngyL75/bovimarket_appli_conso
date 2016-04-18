<?php

namespace Ovs\Api;

/** */
define("API_URL","http://51.254.44.168:8080/bovimarket/");
define("TOKEN",'Authorization: Bearer 52a453ac-70e0-43ee-a59d-9af10eed4a9f');
/**
 * Config POUR SHUTTLE
define("API_URL","http://172.22.33.2:8080/bovimarket/");
define("TOKEN",'Authorization: Bearer d8d22d3e-342a-4910-abe4-cce0eee6f7e8');
 */

/**
 * Created by PhpStorm.
 * User: david
 * Date: 15/03/2016
 * Time: 09:09
 */
class Api
{

    public static function getBaseApiUrl()
    {
        return static::getBaseUrl()."api/";
    }

    public static function getBaseUrl()
    {
        if(isset($_SESSION["api_url"])){
            return $_SESSION["api_url"];
        }else {
            return API_URL;
        }
    }

    public static function get($url)
    {
        if(strpos($url,"http")!==false) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                TOKEN
            ));

            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }elseif(strpos($url,"json://")!==false){
            return self::getLocal($url);
        }
        return json_encode(array());
    }

    private static function getJsonDir()
    {
        return __DIR__."/../Resources/jsons/";
    }

    protected static function getLocal($url)
    {
        $jsonDir=self::getJsonDir();
        $file=str_replace("json://","",$url);
        if(substr($file,-5)!=".json"){
            $file.=".json";
        }
        $file=$jsonDir.$file;
        if(file_exists($file)){
            return file_get_contents($file);
        }
        return json_encode(array());
    }
}