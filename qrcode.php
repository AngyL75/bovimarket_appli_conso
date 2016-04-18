<?php

require_once __DIR__."/classes/Ovs/custom_loader.php";

\Ovs\Utils\Utils::saveTypeViande();

$morceauId=\Ovs\Utils\Utils::getIdMorceaux(false);
if($morceauId) {
    $morceau = \Ovs\Entities\Morceaux::find($morceauId);
}else{
    $morceau = \Ovs\Entities\Morceaux::findOneRandom();
    $morceauId=$morceau->id;
}


\Ovs\Utils\Utils::saveMorceau($morceauId);

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">
    
    <div id="close"><a href="carte.php">x</a></div>
    <div class="container">
      <div class="row">
          <div class="col-xs-4 col-xs-offset-4">
              <img src="<?php echo \Ovs\Utils\Utils::getImage($morceau->photo); ?>" alt="<?php echo $morceau->nom; ?>" class="Photo">
          </div>
          <div class="col-xs-12">
              <h1><?php echo $morceau->nom; ?></h1>
              <p><?php echo nl2br($morceau->description); ?></p>
          </div>
      </div>
      <div class="row" id="IconeQRcode">
        <div class="col-xs-10 col-xs-offset-1">
          <div class="row">
            <div class="col-xs-6 text-center">
              <a class="link IconeRecette" href="recettes.php?idMorceau=<?php echo $morceauId; ?>" data-color="#ffffff">
                Les recettes
              </a>
            </div>
            <div class="col-xs-6 text-center">
              <a class="link IconeProducteur" href="producteur.php" data-color="#ffffff">
                Le producteur
              </a>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 text-center">
              <a class="link IconeCuisson" href="cuisson.php?idMorceau=<?php echo $morceauId; ?>" data-color="#ffffff">
                La cuisson
              </a>
            </div>
            <div class="col-xs-6 text-center">
              <a class="link IconeMorceau" href="morceau.php?id=<?php echo $morceauId; ?>" data-color="#ffffff">
                Le morceau
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body>