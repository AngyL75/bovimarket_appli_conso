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
          <img class="Photo" src="images/resto.png" alt="..." />
        </div>
        <div class="col-xs-12">
            <h1>Titre restaurant</h1>
            <p style="text-align:center;">Avenue Michel-Ange - 63000 Clermont-Ferrand</p>
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
        <div class="col-xs-12">
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo 
            inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur 
            aut odit aut fugit, sed quia consequuntur magni dolores.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <button class="btn btn-vert" id="Calendar"><i class="fa fa-calendar" style="color:#fff; padding-right:30px;"></i> Lundi 26 octobre 2017</button>
        </div>
      </div>

        <div class="col-xs-10 col-xs-offset-1 ListeStyle2">
          <div class="Tof2"><a href="#"><img src="images/nophoto.png" alt="..." /></a></div>
          <div class="Description">
            <p class="Intitule">Entrée</p>
            <p class="Nom">Nom du plat</p>
            <p class="Fonction">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo</p>
          </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1 ListeStyle2">
          <div class="Tof2"><a class="link" href="carre-agneau-thym.php" data-color="#381b26"><img src="images/carre-agneau.png" alt="..." /></a></div>
          <div class="Description">
            <p class="Intitule">Plat</p>
            <p class="Nom">Carré d’agneau à la crème de thym</p>
            <div class="Liste">
              <div class="row">
                <div class="col-xs-6">
                  <p class="Ingredient">Agneau</p>
                  <p class="Producteur">Ferme de Jean Bidule</p>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="Tof"><a class="link" href="olivier-maurin.php" data-color="#381b26"><img src="images/olivier-maurin.jpg"></a></div>
                    <div class="Tof"><a class="link" href="label.php" data-color="#381b26"><img src="images/label.png"></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1 ListeStyle2">
          <div class="Tof2"><a href="#"><img src="images/dessert.png" alt="..." /></a></div>
          <div class="Description">
            <p class="Intitule">Dessert</p>
            <p class="Nom">Nom du plat</p>
            <p class="Fonction">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo</p>
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