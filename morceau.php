<?php

  require_once __DIR__."/classes/Ovs/custom_loader.php";

  $idMorceau=\Ovs\Utils\Utils::getIdMorceaux();
  $morceau=\Ovs\Entities\Morceaux::find($idMorceau);

\Ovs\Utils\Utils::saveMorceau($idMorceau);
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder" style="width:769px;max-width:769px;">

  <div id="return"><a href="qrcode.php"><</a></div>
  <div id="close"><a href="carte2.php">x</a></div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="IconeMorceau">Le morceau</h1>
      </div>
    </div>
    <div class="row">
      <?php
      \Ovs\Entities\Morceaux::renderMapForMorceau($morceau);
      ?>
      <div class="col-xs-12">
        <h3 class="text-center" style="padding:20px 0"><?php echo $morceau->nom; ?></h3>
        <p><?php echo nl2br($morceau->description); ?>
        </p>
      </div>
      <div class="col-xs-12">
        <h3 class="text-center" style="padding:20px 0">Conseil Achat</h3>
        <p><?php echo nl2br($morceau->conseils_achat); ?>
        </p>
      </div>
      <div class="col-xs-12">
        <h3 class="text-center" style="padding:20px 0">Conseil Conservation</h3>
        <p><?php echo nl2br($morceau->conseils_conservation); ?>
        </p>
      </div>
    </div>
    <div class="col-xs-12">
      <h3 class="text-center" style="padding:20px 0">Conseil cuisson</h3>
      <p><?php echo nl2br($morceau->conseils_cuisson); ?>
      </p>
    </div>
    <div class="row" id="IconeQRcode">
      <div class="col-xs-10 col-xs-offset-1">
        <div class="row">
          <div class="col-xs-6 text-center">
            <a class="link IconeRecette" href="recettes.php?idMorceau=<?php echo $morceau->id; ?>" data-color="#ffffff">
              Les recettes
            </a>
          </div>
          <div class="col-xs-6 text-center">
            <a class="link IconeCuisson" href="cuisson.php?idMorceau=<?php echo $morceau->id; ?>" data-color="#ffffff">
              La cuisson
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>