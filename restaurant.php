<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="page" id="holder">

<div id="return"><a href="resultat.php"><</a></div>
  <div style="width: 100%; color:#fff">
    <div id="close"><a href="carte2.php">x</a></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
          <img class="Photo" src="images/resto2.png" alt="..." />
        </div>
        <div class="col-xs-12">
            <h1>Restaurant Chez Camillou</h1>
            <p style="text-align:center;">Avenue Michel-Ange - 63000 Clermont-Ferrand</p>
        </div>
      </div>
      <div class="row IconAction">
        <div class="col-xs-6 col-xs-offset-3">
          <ul class="row">
            <li class="col-xs-4"><a class="IconItineraire" href="#"></a></li>
            <li class="col-xs-4"><a class="IconAppeler" href="#"></a></li>
            <li class="col-xs-4"><a class="IconFavoris" href="#"></a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo 
            inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur 
            aut odit aut fugit, sed quia consequuntur magni dolores.</p>
        </div>
      </div>

       <div class="row" style="padding:20px 0">
        <div class="col-xs-6 col-xs-offset-3">
          <form action="table.php">
            <button class="btn btn-vert" id="Reserver" type="submit">Réserver une table</button> 
          </form>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 text-center" style="padding-top:50px;">
            <h3>Ses plats</h3>
        </div>
      </div>

      <div class="row ListeStyle2">
        <div class="col-xs-10 col-xs-offset-1">
          <a class="link" href="carre-agneau-thym.php" data-color="#ffffff">
            <div class="Tof2"><img src="images/carre-agneau.png" alt="..." /></div>
            <div class="Description" style="padding:40px 20px">
              <div class="Nom col-xs-12">Carré d'agneau à la crème de thym</div>
            </div>
          </a>
        </div>
      </div>

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