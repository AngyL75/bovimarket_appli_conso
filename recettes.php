<?php

require_once __DIR__."/classes/Ovs/custom_loader.php";

$idMorceaux=getIdMorceaux(1);
$recettes=\Ovs\Entities\Recettes::findAllFor(array("morceaux"=>$idMorceaux));

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche">

  <div id="return"><a href="qrcode.php"><</a></div>
  <div id="close"><a href="carte2.php">x</a></div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
          <h1 class="IconeRecette">Les recettes</h1>
      </div>
    </div>
    <?php
    foreach ($recettes as $recette):
    ?>
    <div class="row ListeStyle2">
      <div class="col-xs-12">
        <a class="link" href="carre-agneau-thym.php" data-color="#ffffff">
          <div class="Tof2"><img src="images/nophoto.png" alt="..." /></div>
          <div class="Description" style="padding:40px 20px">
            <div class="Nom col-xs-12"><?php echo $recette->titre; ?></div>
            <div class="col-xs-6 sablier">
              <?php echo $recette->temps_preparation; ?>
            </div>
            <div class="col-xs-6 difficulte moyen">
              <?php echo $recette->difficulte; ?>
            </div>
          </div>
        </a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>