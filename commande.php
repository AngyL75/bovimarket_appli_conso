<?php
  require_once __DIR__."/classes/Ovs/custom_loader.php";

  use Ovs\Entities\Morceaux;
  $lengthDesc = 200;

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">
   
  

    <div id="return"><a href="boucher.php"><</a></div>
    <div id="close"><a href="carte2.php">x</a></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1>Liste des produits</h1>
        </div>
      </div>

      <?php
      $morceau = Morceaux::find(Morceaux::getIdForDecoupe("collier"));
      if($morceau):
      ?>
      <div class="row ListeStyle2">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-2">
              <div class="Tof"><img src="<?php echo \Ovs\Utils\Utils::getImage($morceau->photo); ?>" alt="..." /></div>
            </div>
            <div class="col-xs-6">
              <div class="Description" style="width:auto;">
                <p class="Nom"><?php echo $morceau->nom; ?></p>
                <p class"Desc"><?php echo substr($morceau->description,0,$lengthDesc); ?></p>
              </div>
            </div>
            <div class="col-xs-2">
              <p class="Prix text-right">18 €</p>
            </div>
            <div class="col-xs-2">
              <button class="btn btn-blanc Panier" type="submit"></button>
            </div>
          </div>
        </div>
      </div>

      <?php
      endif;
      $morceau = Morceaux::find(Morceaux::getIdForDecoupe("cotes-decouvertes"));
      if($morceau):
      ?>
      <div class="row ListeStyle2">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-2">
              <div class="Tof"><img src="<?php echo \Ovs\Utils\Utils::getImage($morceau->photo); ?>" alt="..." /></div>
            </div>
            <div class="col-xs-6">
              <div class="Description" style="width:auto;">
                <p class="Nom"><?php echo $morceau->nom; ?></p>
                <p class"Desc"><?php echo substr($morceau->description,0,$lengthDesc); ?></p>
              </div>
            </div>
            <div class="col-xs-2">
              <p class="Prix text-right">7 €</p>
            </div>
            <div class="col-xs-2">
              <button class="btn btn-blanc PanierSelect" type="submit"></button>
            </div>
          </div>
        </div>
      </div>

      <?php
      endif;
      $morceau = Morceaux::find(Morceaux::getIdForDecoupe("poitrine"));
      if($morceau):
      ?>
      <div class="row ListeStyle2">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-2">
              <div class="Tof"><img src="<?php echo \Ovs\Utils\Utils::getImage($morceau->photo); ?>" alt="..." /></div>
            </div>
            <div class="col-xs-6">
              <div class="Description" style="width:auto;">
                <p class="Nom"><?php echo $morceau->nom; ?></p>
                <p class"Desc"><?php echo substr($morceau->description,0,$lengthDesc); ?></p>
              </div>
            </div>
            <div class="col-xs-2 text-right">
              <p class="Prix">28 €</p>
            </div>
            <div class="col-xs-2">
              <button class="btn btn-blanc Panier" type="submit"></button>
            </div>
          </div>
        </div>
      </div>

      <?php
      endif;
      $morceau = Morceaux::find(Morceaux::getIdForDecoupe("gigot-raccourci"));
      if($morceau):
      ?>
      <div class="row ListeStyle2">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-2">
              <div class="Tof"><img src="<?php echo \Ovs\Utils\Utils::getImage($morceau->photo); ?>" alt="..." /></div>
            </div>
            <div class="col-xs-6">
              <div class="Description" style="width:auto;">
                <p class="Nom"><?php echo $morceau->nom; ?></p>
                <p class"Desc"><?php echo substr($morceau->description,0,$lengthDesc); ?></p>
              </div>
            </div>
            <div class="col-xs-2">
              <p class="Prix text-right">32 €</p>
            </div>
            <div class="col-xs-2">
              <button class="btn btn-blanc PanierSelect" type="submit"></button>
            </div>
          </div>
        </div>
      </div>

      <?php
      endif;
      $morceau = Morceaux::find(Morceaux::getIdForDecoupe("epaule"));
      if($morceau):
      ?>
      <div class="row ListeStyle2">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-2">
              <div class="Tof"><img src="<?php echo \Ovs\Utils\Utils::getImage($morceau->photo); ?>" alt="..." /></div>
            </div>
            <div class="col-xs-6">
              <div class="Description" style="width:auto;">
                <p class="Nom"><?php echo $morceau->nom; ?></p>
                <p class"Desc"><?php echo substr($morceau->description,0,$lengthDesc); ?></p>
              </div>
            </div>
            <div class="col-xs-2">
              <p class="Prix text-right">21 €</p>
            </div>
            <div class="col-xs-2">
              <button class="btn btn-blanc Panier" type="submit"></button>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <div class="row">
      <div class="col-xs-6 col-xs-offset-3">
        <form action="panier.php">
          <button class="btn btn-vert" id="Rechercher" type="submit" style="margin:30px 0">Afficher mon panier</button> 
        </form>
      </div>
    </div>
    </div>

    

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>


</body>
</html>


