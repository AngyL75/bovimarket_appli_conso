<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="page" id="holder">
  <div id="ami1" class="Popup favoris" style="width: 100%; color:#fff">
    <div id="close"><a href="carte2.php">x</a></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
          <img class="Photo" src="images/perso1.png" alt="..." />
        </div>
        <div class="col-xs-12" style="text-align:center;">
            <h1>Jean Bidule</h1>
            <p>Amis depuis le 21 août 2015</p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <h3 class="IconeFavoris">Ses Favories</h3>
        </div>
        <div class="col-xs-12 col-sm-6">
          <a class="link" href="boucher.php" data-color="#381b26">
            <div class="Tof"><img src="images/ex.png" alt="..." /></div>
            <div class="Description">
              <p class="Nom">Boucherie du centre</p>
              <p class="Fonction">Boucher</p>
            </div>
          </a>
        </div>
        <div class="col-xs-12 col-sm-6">
          <a class="link" href="resto.php" data-color="#381b26">
            <div class="Tof"><img src="images/resto.png" alt="..." /></div>
            <div class="Description">
              <p class="Nom">Titre</p>
              <p class="Fonction">Restaurant</p>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <button class="btn btn-vert" id="Supprimer">Retirer de la liste de mes amis</button>
        </div>
      </div>
      <div class="row">
        
      </div>
    </div>
  </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>