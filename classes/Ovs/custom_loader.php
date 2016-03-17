<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 17/03/2016
 * Time: 12:25
 */
session_start();
require_once __DIR__."/../../vendor/autoload.php";

function getIdMorceaux($default=1){
    if(isset($_GET["idMorceau"])){
        $idMorceaux=$_GET["idMorceau"];
    }else{
        if(isset($_SESSION["morceau_id"])){
            $idMorceaux=$_SESSION["morceau_id"];
        }else {
            $idMorceaux = $default;
        }
    }
    return $idMorceaux;
}

function getIdCuisson($default=1){
    if(isset($_GET["idCuisson"])){
        $idCuisson=$_GET["idCuisson"];
    }else{
        $idCuisson=$default;
    }
    return $idCuisson;
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

function saveMorceau($id){
    $_SESSION["morceau_id"]=$id;
}

function resetSession(){
    session_destroy();
}