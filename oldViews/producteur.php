<?php
  require_once __DIR__."/classes/Ovs/custom_loader.php";
  $idEntite=\Ovs\Utils\Utils::getIdEntite(false);
  if($idEntite) {
    $eleveur = \Ovs\Entities\Entite::find($idEntite);
  }else{
    $eleveur = \Ovs\Entities\Entite::findOneActiviteRandom("ELEVEUR");
  }

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
        <h1 class="IconeProducteur">Le producteur</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-4 col-xs-offset-4">
        <img src="<?php echo \Ovs\Entities\Entite::getImage($eleveur->photoResponsable); ?>" class="Photo" />
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <h3 class="text-center" style="padding:20px 0"><?php echo $eleveur->nomContact; ?></h3>
        <p><?php echo $eleveur->description; ?>
        </p>
      </div>
    </div>
    <div class="row">
     <div class="col-xs-6 col-xs-offset-3" style="padding:20px 0">
          <a href="boucher.php?id=<?php echo $eleveur->id; ?>" class="btn btn-vert" id="Rechercher" type="submit">Afficher</a>
      </div>
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>