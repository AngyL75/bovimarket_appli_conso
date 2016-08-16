<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">
   

    <div id="return"><a href="commande.php"><</a></div>
    <div id="close"><a href="carte2.php">x</a></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1>Mon panier</h1>
        </div>
      </div>

      <div class="row ListeStyle2">
        <div class="col-xs-4">
          <a href="#" class="IconPanierSelect">Panier</a>
        </div>
        <div class="col-xs-4">
          <a href="#" class="IconRecup">Livraison</a>
        </div>
        <div class="col-xs-4">
          <a href="#" class="IconPaiement">Paiement</a>
        </div>
      </div>

      <div class="row ListeStyle2">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-2">
              <div class="Tof"><img src="images/nophoto.png" alt="..." /></div>
            </div>
            <div class="col-xs-6">
              <div class="Description" style="width:auto;">
                <p class="Nom">Côtelettes d'agneau</p>  
                <p class"Desc">Illud tamen clausos vehementer angebat quod captis navigiis, quae frumenta vehebant per.</p>        
              </div>
            </div>
            <div class="col-xs-2 text-right">
              <p class="Prix">7 €</p>
            </div>
            <div class="col-xs-2">
              <div class="Supprimer"><a href="#"></a></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row ListeStyle2">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-2">
              <div class="Tof"><img src="images/nophoto.png" alt="..." /></div>
            </div>
            <div class="col-xs-6">
              <div class="Description" style="width:auto;">
                <p class="Nom">Gigot d'agneau</p>  
                <p class"Desc">Illud tamen clausos vehementer angebat quod captis navigiis, quae frumenta vehebant per flumen, Isauri quidem alimentorum c 
                opiis adfluebant.</p>        
              </div>
            </div>
            <div class="col-xs-2">
              <p class="Prix text-right">32 €</p>
            </div>
            <div class="col-xs-2">
              <div class="Supprimer"><a href="#"></a></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-2 col-xs-offset-6">
          <div class="Description" style="width:auto;padding:25px">
            <p class="Nom">Total</p>  
          </div>
        </div>
        <div class="col-xs-2 text-right" style="padding:0 25px">
          <p class="Prix">39 €</p>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <form action="recup.php">
            <button class="btn btn-vert" id="Rechercher" type="submit" style="margin:30px 0">Valider mon panier</button> 
          </form>
        </div>
      </div>


    
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>


</body>
</html>


