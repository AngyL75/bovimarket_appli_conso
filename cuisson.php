<?php

require_once __DIR__."/classes/Ovs/custom_loader.php";

$morceauId=getIdMorceaux(1);

$cuissons=\Ovs\Entities\Cuisson::findAllFor(array("morceaux"=>$morceauId));

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">

  <div id="return"><a href="qrcode.php"><</a></div>
  <div id="close"><a href="carte2.php">x</a></div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
          <h1 class="IconeCuisson">La cuisson</h1>
          <p>Le collier est une viande à <a class="link" href="bouillir.php" data-color="#ffffff">bouillir</a> ou à <a class="link" href="braise.php" data-color="#ffffff">braisé</a>.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-8 col-xs-offset-2">
        <div class="row">
          <div class="col-xs-6">
            <a class="IconBouillir text-center" href="bouillir.php">
              Bouillir
            </a>
          </div>  
          <div class="col-xs-6">
            <a class="IconBraise text-center" href="braise.php">
              Braisé
            </a>
          </div> 
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <p>D’une manière générale, le collier doit mijoter, c’est-à-dire cuire à petit feu et très longtemps. Il faut ainsi plonger entièrement 
        la viande dans un liquide et la cuire longuement à petit frémissements.</p>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>