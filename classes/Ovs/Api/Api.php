<?php

namespace Ovs\Api;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 15/03/2016
 * Time: 09:09
 */
class Api
{

    public static function get($url)
    {
        if(strpos($url,"http")!==false) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
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