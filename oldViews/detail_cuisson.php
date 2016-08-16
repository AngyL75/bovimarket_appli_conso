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
    <div class="row" style="padding-top:50px;">
      <div class="col-xs-12">
        <h3>Les morceaux à <?php echo $cuisson->nom; ?></h3>
      </div>
    </div>

    <?php $typeViande = \Ovs\Utils\Utils::getTypeViande(); ?>
    <?php if(isset($cuisson->morceaux->$typeViande)){
          $morceaux = $cuisson->morceaux->$typeViande;
      }
      ?>
    <?php foreach($morceaux as $morceauId): ?>

    <?php
      $morceau = \Ovs\Entities\Morceaux::find($morceauId);
      if(!isset($morceau)) continue;
    ?>
    <div class="row">
      <div class="row ListeStyle2">
        <div class="col-xs-12">
          <a class="link" href="morceau.php?idMorceau=<?php echo $morceau->id; ?>" data-color="#ffffff">
            <div class="Tof2"><img src="<?php echo \Ovs\Utils\Utils::getImage($morceau->photo) ?>" alt="..." /></div>
            <div class="Description" style="padding:40px 20px">
              <div class="Nom col-xs-12"><?php echo $morceau->nom; ?></div>
            </div>
          </a>
        </div>
      </div>
    </div>
      <?php endforeach; ?>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>