<?php
  require_once __DIR__."/classes/Ovs/custom_loader.php";

  $idEntitie=\Ovs\Utils\Utils::getIdEntite(false);
  $resto=\Ovs\Entities\Entite::find($idEntitie);
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="page" >

  <div style="width: 100%; color:#fff">
    <div id="close"><a href="carte2.php">x</a></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
          <img class="Photo" src="<?php echo \Ovs\Entities\Entite::getImage($resto->logo);?>" alt="..." />
        </div>
        <div class="col-xs-12">
            <h1><?php echo $resto->name; ?></h1>
            <p style="text-align:center;"><?php echo \Ovs\Entities\Entite::getAdresse($resto); ?></p>
        </div>
      </div>
      <div class="row IconAction">
        <div class="col-xs-6 col-xs-offset-3">
          <ul class="row">
            <li class="col-xs-4"><a class="IconItineraire" href="#"></a></li>
            <li class="col-xs-4"><a class="IconAppeler" href="#"></a></li>
            <li class="col-xs-4"><a class="IconFavoris select" href="#"></a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12" id="Description">
            <p><?php echo $resto->description; ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <form action="reseau.php">
            <button class="btn btn-vert" style="margin:30px 0 10px" type="submit">Voir son réseau</button> 
          </form>
        </div>
        <div class="col-xs-6 col-xs-offset-3">
          <button class="btn btn-2" style="margin:10px 0 50px"><i class="fa fa-calendar" style="color:#8cae08; padding-right:30px;"></i> Lundi 26 octobre 2017</button>
        </div>
      </div>

        <?php
          \Ovs\Entities\Menu::renderMenu();
        ?>
        <div class="row">
          <div class="col-xs-12">
            <h3 style="text-align:center;padding:20px 0">Ils recommandent</h3>
          </div>
          <div class="col-xs-10 col-xs-offset-1 Recommande">
            <div class="col-xs-10">
              <div class="row">
                <div class="Tof"><a class="link" href="ami.php" data-color="#381b26"></a></div>
                <div class="Tof"><a class="link" href="ami.php" data-color="#381b26"></a></div>
                <div class="Tof"><a class="link" href="ami.php" data-color="#381b26"></a></div>
                <div class="Tof"><a class="link" href="ami.php" data-color="#381b26"></a></div>
                <div class="Tof"><a class="link" href="ami.php" data-color="#381b26"></a></div>
                <div class="Tof"><a class="link" href="ami.php" data-color="#381b26"></a></div>
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