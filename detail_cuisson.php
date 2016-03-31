<?php
  require_once __DIR__ . "/classes/Ovs/custom_loader.php";

  $idCuisson=\Ovs\Utils\Utils::getIdCuisson(1);
  $cuisson=\Ovs\Entities\Cuisson::find($idCuisson);

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">

  <div id="return"><a href="cuisson.php"><</a></div>
  <div id="close"><a href="carte2.php">x</a></div>
  <div class="container">
    <div class="row">
      <div class="col-xs-4 col-xs-offset-4">
        <img class="Photo" src="<?php echo \Ovs\Utils\Utils::getImage($cuisson->cuisson_photo); ?>" alt="..." />
      </div>
      <div class="col-xs-12">
        <h1><?php echo $cuisson->nom;?></h1>
        <p><?php echo nl2br($cuisson->description); ?></p>
        <h3>
          Quelques conseils et astuces : 
        </h3>
        <?php echo nl2br($cuisson->conseils_astuces);?>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>