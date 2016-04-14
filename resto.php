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
    <div id="return"><a class="link" href="javascript:history.go(-1)" data-color="#ffffff"><</a></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-3 col-xs-offset-1">
          <img class="Photo" src="<?php echo \Ovs\Entities\Entite::getImage($resto->logo);?>" alt="..." />
        </div>
        <div class="col-xs-6">
            <h1><?php echo $resto->name; ?></h1>
            <p style="text-align:center;"><?php echo \Ovs\Entities\Entite::getAdresse($resto); ?></p>
        </div>
      </div>
      <div class="row IconAction">
        <div class="col-xs-8 col-xs-offset-2">
          <ul class="row">
            <li class="col-xs-3"><a class="IconItineraire" href="#"></a></li>
            <li class="col-xs-3"><a class="IconAppeler" href="#"></a></li>
            <li class="col-xs-3"><a class="IconFavoris" href="#"></a></li>
            <li class="col-xs-3"><a class="IconReseau" href="reseau.php"></a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12" id="Description">
            <p><?php echo $resto->description; ?></p>
        </div>
      <?php if(isset($boucher->abonnement) && isset($boucher->abonnement->options) && isset($boucher->abonnement->options->venteDirecte)): ?>
          <div class="col-xs-6 col-xs-offset-3">
            <form action="commande.php">
              <button class="btn btn-2 btn-blanc" id="Reserver" style="margin: 10px 0px;" type="submit">Vente à emporter</button>
            </form>
          </div>
      <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <p id="Date">Date : <input type="text" value="" name="date2" id="champ_date2" size="12" maxlength="10"></p>
          <div id="calendarMain2"></div>
        </div>
      </div>

      <div class="row" id="menuTable">
        <?php
        \Ovs\Entities\Menu::renderMenu();
        ?>
      </div>
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
  <script src="js/jsSimpleDatePickr.js"></script>
  <script src="js/jsSimpleDatePickrInit.js"></script>
  <script type="text/javascript">
    //<![CDATA[
    calInit("calendarMain2", "8 mai 2018", "champ_date2", "jsCalendar", "day", "selectedDay");
    //]]>
  </script>
</body>