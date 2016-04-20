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
      <img src="images/boeuf2.jpg" width="100%" usemap="#Map" />
      <map name="Map">
        <area shape="poly" coords="123,210,141,152,170,139,184,116,234,115,271,125,277,138,274,174,266,196,235,199,206,198,183,213,141,203,122,210" href="boeuf-rumsteck.php">
        <area shape="poly" coords="260,217,218,219,186,212,206,198,264,196,260,219" href="boeuf-filet.php">
        <area shape="poly" coords="244,265,216,218,262,219" href="boeuf-_.php">
        <area shape="poly" coords="242,266,144,241,142,205,218,217" href="boeuf-merlan.php">
        <area shape="poly" coords="124,209,122,246,137,290,157,295,144,241,142,202" href="boeuf-ronddegite.php">
        <area shape="poly" coords="144,241,157,294,189,298,186,252" href="boeuf-gitealanoix.php">
        <area shape="poly" coords="192,298,207,256,185,253,190,298" href="boeuf-araigne.php">
        <area shape="poly" coords="236,282,220,296,193,296,206,258,241,264" href="boeuf-tranche.php">
        <area shape="poly" coords="206,364,165,360,145,349,151,324,138,292,178,296,220,295,217,335" href="boeuf-gite.php">
        <area shape="poly" coords="338,130,270,126,274,167,262,211,251,248,327,249,345,191,345,157" href="boeuf-faux-filet.php">
        <area shape="poly" coords="291,250,262,264,240,272,251,249,281,248" href="boeuf-onglet.php">
        <area shape="poly" coords="289,249,321,249,278,274,254,282,234,285,238,273,263,265" href="boeuf-hampe.php">
        <area shape="poly" coords="257,339,217,324,218,300,235,288,264,278,299,262,268,290,259,313" href="boeuf-bavette.php">
        <area shape="poly" coords="330,362,308,362,255,338,255,315,263,302,313,312,320,339" href="boeuf-flanchet.php">
        <area shape="poly" coords="266,301,312,312,316,277,327,247,294,263,273,285,266,293" href="boeuf-bavette.php">
        <area shape="poly" coords="336,130,345,166,344,200,329,247,408,242,392,203,386,170,401,126" href="boeuf-entrecotes.php">
        <area shape="poly" coords="407,242,418,270,431,320,355,316,313,310,315,278,326,250,328,245,384,243" href="boeuf-plat-de-cotes.php">
        <area shape="poly" coords="442,337,332,361,312,314,362,317,430,321" href="boeuf-poitrine.php">
        <area shape="poly" coords="411,172,434,218,455,316,430,316,405,241,391,195,387,168" href="boeuf-macreuse-bifteck.php">
        <area shape="poly" coords="400,127,471,118,491,137,503,162,450,168,386,167" href="boeuf-bassecotes.php">
        <area shape="poly" coords="414,171,434,219,439,239,482,240,477,194,469,165,415,168" href="boeuf-paleron.php">
        <area shape="poly" coords="470,167,478,198,481,239,507,237,510,194,501,163" href="boeuf-macreuse-pot-au-feu.php">
        <area shape="poly" coords="439,241,454,317,471,317,491,310,482,239,453,239" href="boeuf-jumeau-bifteck.php">
        <area shape="poly" coords="482,238,489,314,507,303,509,239" href="boeuf-jumeau-pot-au-feu.php">
        <area shape="poly" coords="473,118,502,163,509,203,509,239,562,241,570,228,559,203,552,171,552,148,565,123,562,103,533,96,504,115" href="boeuf-collier.php">
        <area shape="poly" coords="507,237,507,302,501,330,550,340,567,321,572,298,584,276,578,250,558,242" href="boeuf-gros-bout-de-poitrine.php">
      </map>

      <div class="col-xs-12">
        <h3 class="text-center" style="padding:20px 0">Collier</h3>
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