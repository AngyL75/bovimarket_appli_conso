<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">
    
    <div id="close"><a href="carte.php">x</a></div>
    <div class="container">
      <div class="row">
          <div class="col-xs-4 col-xs-offset-4">
            <img class="Photo" src="images/collier.png" alt="..." />
          </div>
          <div class="col-xs-12">
              <h1>Collier d'agneau</h1>
              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo 
              inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur 
              aut odit aut fugit, sed quia consequuntur magni dolores.</p>
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
              <a class="link IconeProducteur" href="producteur.php" data-color="#ffffff">
                Le producteur
              </a>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 text-center">
              <a class="link IconeCuisson" href="cuisson.php" data-color="#ffffff">
                La cuisson
              </a>
            </div>
            <div class="col-xs-6 text-center">
              <a class="link IconeMorceau" href="morceau.php" data-color="#ffffff">
                Le morceau
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body>