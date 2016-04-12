<?php

require_once __DIR__."/classes/Ovs/custom_loader.php";

$idMorceaux=\Ovs\Utils\Utils::getIdMorceaux(1);
$recettes=\Ovs\Entities\Recettes::findAllFor(array("morceaux"=>$idMorceaux));

$classes=array(
    0=>"neutre",
    1=>"facile",
    2=>"moyen",
    3=>"difficile",
    4=>"expert"
);

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
        <a class="link" href="detail_recette.php?idRecette=<?php echo $recette->id; ?>" data-color="#ffffff">
          <div class="Tof2"><img src="<?php echo \Ovs\Utils\Utils::getImage($recette->photo);?>" alt="..." /></div>
          <div class="Description" style="padding:40px 20px;width: 80% !important;">
            <div class="Nom col-xs-12"><?php echo $recette->titre; ?></div>
            <div class="col-xs-4 sablier">
              <?php echo $recette->temps_preparation; ?>
            </div>
            <div class="col-xs-4 cuisson">
              <?php echo $recette->temps_cuisson; ?>
            </div>
            <div class="col-xs-4 difficulte <?php echo $classes[$recette->difficulte]; ?>"></div>
          </div>
        </a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>