<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/03/2016
 * Time: 12:15
 */

namespace Ovs\Bovimarket\Entities\Interfaces;
use Ovs\Bovimarket\Api\Api;

abstract class Searchable
{
    public static function getUrl()
    {
        return "";
    }
    
    public static function find($id)
    {
        $objects=static::findAll();
        foreach ($objects as $object) {
            if($object->id==$id){
                return $object;
            }
        }
    }

    public static function findAll()
    {
        /*$result=Api::get(static::getUrl());
        $objects=json_decode($result);
        return $objects;*/
    }

    public static function findOneRandom()
    {
        $objects=static::findAll();
        if(is_array($objects)) {
            $nbMax = count($objects) - 1;
            return $objects[rand(0, $nbMax)];
        }
        return null;
    }


    public static function findAllFor($criteria = array())
    {
        $results=array();
        $objects=static::findAll();
        foreach ($objects as $object) {
            foreach ($criteria as $key => $value) {
                $objValue=$object->$key;
                if(is_array($objValue)){
                    if(in_array($value,$objValue)){
                        $results[]=$object;
                    }
                }else {
                    if ($objValue == $value) {
                        $results[] = $object;
                    }
                }
            }
        }
        return $results;
    }
}