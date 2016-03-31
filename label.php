<?php
    require_once __DIR__."/classes/Ovs/custom_loader.php";

    $idEntite=\Ovs\Utils\Utils::getIdEntite(false);
    $label=\Ovs\Entities\Entite::find($idEntite);

    $boucher=\Ovs\Entities\Entite::findOneActiviteRandom("BOUCHER");
    $eleveur=\Ovs\Entities\Entite::findOneActiviteRandom("ELEVEUR");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="page" id="holder">
    <div class="Popup" style="width: 100%; color:#fff">
      <div id="close"><a href="carte.php">x</a></div>
      <div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
              <img class="Photo" src="<?php echo \Ovs\Entities\Entite::getImage($label->logo);?>" alt="..." />
            </div>
            <div class="col-xs-12">
                <h1><?php echo $label->name; ?></h1>
                <p id="Description"><?php echo $label->description; ?></p>
            </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <h3 style="text-align:center;padding:20px 0">Ils en font partie</h3>
          </div>
          <div class="col-xs-10 col-xs-offset-1 Recommande">
            <div class="col-xs-10">
              <div class="row">
                <div class="col-xs-2">
                    <div class="Tof">
                        <a class="link" href="boucher.php?id=<?php echo $boucher->id; ?>" data-color="#381b26">
                            <img src="<?php echo \Ovs\Entities\Entite::getImage($boucher->logo); ?>">
                        </a>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="Tof">
                        <a class="link" href="boucher.php?id=<?php echo $eleveur->id;?>" data-color="#381b26">
                            <img src="<?php \Ovs\Entities\Entite::getImage($eleveur->photoResponsable); ?>">
                        </a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body>