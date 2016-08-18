<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder" style="width:769px;max-width:769px;">

  <div id="return"><a href="qrcode.php"><</a></div>
  <div id="close"><a href="carte2.php">x</a></div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="IconeMorceau">Le morceau</h1>
      </div>
    </div>
    <div class="row">
      <img src="images/agneau8.png" width="100%" usemap="#Map" />
      <map name="Map">
        <area shape="poly" coords="175,281,166,250,176,207,191,176,236,157,259,172,272,213,278,261,250,247,231,246,197,256,191,264" href="agneau-selle.php">
        <area shape="poly" coords="351,156,411,154" href="#">
        <area shape="poly" coords="302,266,282,266,275,206,262,166,245,155,289,162,344,175,340,209,345,226,312,268" href="agneau-filet.php">
        <area shape="poly" coords="279,279,251,349,188,331,188,313,179,286,207,258,244,253,265,260,279,280" href="agneau-gigot.php">
        <area shape="poly" coords="464,327,430,326,354,329,268,314,280,288,281,267,385,278,454,271,456,298" href="agneau-poitrine.php">
        <area shape="poly" coords="451,267,368,276,314,268,344,240,389,237,453,235" href="agneau-hautdecote.php">
        <area shape="poly" coords="397,179,351,174,343,205,346,236,397,235,393,203,397,181" href="agneau-cotes.php">
        <area shape="poly" coords="467,219,457,233,458,258,449,287,465,302,468,332,506,323,532,297,531,229,508,214,489,214,467,219" href="agneau-epaule.php">
        <area shape="poly" coords="577,188,551,232,518,203,500,165,518,152,530,131,553,169,577,188" href="morceau.php">
        <area shape="poly" coords="399,180,470,181,494,169,512,207,543,234,528,272,531,228,505,209,465,217,456,228,400,232,400,205,398,187" href="agneau-cotedecouverte.php">
      </map>
      <div class="col-xs-12">
        <h3 class="text-center" style="padding:20px 0">Gigot raccourci</h3>
        <p>Mox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit 
        in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius in malis tantum civilibus vigilasse.
        Cum autem bella moverentur externa, accidisse plerumque luctuosa, icto post haec foedere gentium ritu perfectaque sollemnitate 
        imperator Mediolanum ad hiberna discessit.
        </p>
      </div>
    </div>
    <div class="row" id="IconeQRcode">
      <div class="col-xs-10 col-xs-offset-1">
        <div class="row">
          <div class="col-xs-6 text-center">
            <a class="link IconeRecette" href="recettes.php" data-color="#ffffff">
              Les recettes
            </a>
          </div>
          <div class="col-xs-6 text-center">
            <a class="link IconeCuisson" href="cuisson.php" data-color="#ffffff">
              La cuisson
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>