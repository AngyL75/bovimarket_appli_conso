<?php require_once __DIR__."/classes/Ovs/custom_loader.php"; ?>

<?php
$idBoucher=\Ovs\Utils\Utils::getIdEntite();
$boucher=\Ovs\Entities\Entite::find($idBoucher);
\Ovs\Utils\Utils::saveEntite($idBoucher);
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
              <img class="Photo" src="<?php echo \Ovs\Entities\Entite::getImage($boucher->logo); ?>" alt="..." />
            </div>
            <div class="col-xs-12">
                <h1><?php echo $boucher->name; ?></h1>
                <p style="text-align: center">
                    <?php
                        echo \Ovs\Entities\Entite::getAdresse($boucher);
                    ?>
                </p>
            </div>
        </div>
          <div class="row">
              <div class="col-xs-10 col-xs-offset-1" id="Description">
                  <?php echo $boucher->description; ?>
              </div>
              <?php if(\Ovs\Entities\Entite::hasValidCertifs($boucher)): ?>
              <div class="col-xs-6 col-xs-offset-3 Recommande">
                  <div class="row">
                  <?php foreach($boucher->certifications as $certif): ?>
                      <?php

                      if(!$certif->valide){continue;}

                      $certification=\Ovs\Entities\Certifications::find($certif->certificationId);
                      $respCertif=\Ovs\Entities\Entite::find($certification->entiteId);
                      ?>
                      <div class="col-xs-3">
                          <div class="Tof">
                              <a class="link" href="label.php?id=<?php echo $respCertif->id; ?>" data-color="#381b26">
                                  <img src="<?php echo \Ovs\Entities\Entite::getimage($respCertif->logo);?>" />
                              </a>
                          </div>
                      </div>
                      <?php endforeach; ?>
                  </div>
              </div>
              <?php endif; ?>
          </div>

          <div class="row IconAction">
              <div class="col-xs-8 col-xs-offset-2">
              <ul class="row">
                  <li class="col-xs-3"><a class="IconItineraire" href="#"></a></li>
                  <li class="col-xs-3"><a class="IconAppeler" href="#"></a></li>
                  <li class="col-xs-3"><a class="IconFavoris select" href="#"></a></li>
                  <li class="col-xs-3"><a class="IconReseau" href="reseau.php"></a></li>
              </ul>
              </div>
          </div>

          <?php if(isset($boucher->abonnement) && isset($boucher->abonnement->options) && isset($boucher->abonnement->options->venteDirecte)): ?>
        <div class="row" style="padding:20px 0">
          <div class="col-xs-6 col-xs-offset-3">
            <form action="commande.php">
              <button class="btn btn-vert" id="Reserver" style="margin: 10px 0px;" type="submit">Liste des produits</button>
            </form>
          </div>
        </div>
          <?php endif; ?>
        <div class="row">
          <div class="col-xs-12">
            <h3 style="text-align:center;padding:20px 0">Ils recommandent</h3>
          </div>
          <div class="col-xs-10 col-xs-offset-1 Recommande">
            <div class="col-xs-10">
              <div class="row">
                  <div class="col-xs-2"><div class="Tof"><a class="link" href="ami.php" data-color="#381b26"><img src="images/perso1.png" /></a></div></div>
                  <div class="col-xs-2"><div class="Tof"><a class="link" href="ami.php" data-color="#381b26"><img src="images/perso2.png" /></a></div></div>
                  <div class="col-xs-2"><div class="Tof"><a class="link" href="ami.php" data-color="#381b26"><img src="images/perso3.png" /></a></div></div>
                  <div class="col-xs-2"><div class="Tof"><a class="link" href="ami.php" data-color="#381b26"><img src="images/perso4.png" /></a></div></div>
                  <div class="col-xs-2"><div class="Tof"><a class="link" href="ami.php" data-color="#381b26"><img src="images/perso5.png" /></a></div></div>
                  <div class="col-xs-2"><div class="Tof"><a class="link" href="ami.php" data-color="#381b26"><img src="images/perso6.png" /></a></div></div>
              </div>
            </div>
            <div class="col-xs-2"><div class="nombreplus">+ 23</div></div>
          </div>
        </div>
      </div>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>
  
</body>