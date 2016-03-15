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

  
      <div class="row ListeStyle2">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-2">
              <div class="Tof"><img src="images/nophoto.png" alt="..." /></div>
            </div>
            <div class="col-xs-6">
              <div class="Description" style="width:auto;">
                <p class="Nom">Quartier d'agneau</p>  
                <p class"Desc">Illud tamen clausos vehementer angebat quod captis navigiis, quae frumenta vehebant per flumen, Isauri quidem alimentorum c
                opiis adfluebant, ipsi vero solitarum rerum cibos iam consumendo inediae propinquantis aerumnas exitialis horrebant.</p>        
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
            <div class="col-xs-2">
              <p class="Prix text-right">7 €</p>
            </div>
            <div class="col-xs-2">
              <button class="btn btn-blanc PanierSelect" type="submit"></button>
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
                <p class="Nom">Souris d'agneau</p>  
                <p class"Desc">Illud tamen clausos vehementer angebat quod captis navigiis.</p>        
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
              <button class="btn btn-blanc PanierSelect" type="submit"></button>
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
                <p class="Nom">Epaule d'agneau</p>  
                <p class"Desc">Illud tamen clausos vehementer angebat quod captis navigiis, quae frumenta vehebant per.</p>        
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


