<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 11:25
 */

namespace Ovs\Bovimarket\Api;


class JSONFetcher
{
    public static function getJsonDir()
    {
        return __DIR__."/../../../../web/jsons/";
    }

    public static function get($url)
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