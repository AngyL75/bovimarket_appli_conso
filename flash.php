<?php
    require_once __DIR__."/classes/Ovs/custom_loader.php";
    \Ovs\Utils\Utils::resetSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder" style="background:#dddddd;">
    
    <div id="close"><a href="carte.php">x</a></div>
    <div class="container">
      <div class="row">
          <div class="col-xs-6">
            <a href="qrcode.php?typeViande=agneau"><img class="Photo" src="images/barquette1.jpg" alt="..." /></a>
          </div>
          <div class="col-xs-6">
            <a href="qrcode.php"><img class="Photo" src="images/barquette2.jpg" alt="..." /></a>
          </div>
          <div class="col-xs-6">
            <a href="qrcode.php"><img class="Photo" src="images/barquette3.jpg" alt="..." /></a>
          </div>
          <div class="col-xs-6">
            <a href="qrcode.php?typeViande=boeuf"><img class="Photo" src="images/barquette4.jpg" alt="..." /></a>
          </div>
      </div>
      
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body>