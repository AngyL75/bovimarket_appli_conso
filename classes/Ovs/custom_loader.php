<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/03/2016
 * Time: 12:25
 */

require_once __DIR__."/../../vendor/autoload.php";

function getIdMorceaux($default=1){
    if(isset($_GET["idMorceau"])){
        $idMorceaux=$_GET["idMorceau"];
    }else{
        $idMorceaux=$default;
    }
    return $idMorceaux;
}

function getResourcesDir(){
    return __DIR__."/Resources/";
}

function getWebPathOfDir($dir){
    $realDir=realpath($dir);
    $baseDir=__DIR__."/../../";
    $baseDir=realpath($baseDir);
    $realDir=str_replace($baseDir,"",$realDir);
    return $realDir;
}

function getImage($image){
    $resDir=getResourcesDir();
    return getWebPathOfDir($resDir)."/images/".$image;
}