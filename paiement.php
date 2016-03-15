<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">
   

  <div style="width: 100%;">
    <div id="return"><a href="recup.php"><</a></div>
    <div id="close"><a href="carte2.php">x</a></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1>Paiement</h1>
        </div>
      </div>

      <div class="row ListeStyle2">
        <div class="col-xs-4">
          <a href="#" class="IconPanier">Panier</a>
        </div>
        <div class="col-xs-4">
          <a href="#" class="IconRecup">Livraison</a>
        </div>
        <div class="col-xs-4">
          <a href="#" class="IconPaiementSelect">Paiement</a>
        </div>
      </div>
      <form>
        <div class="row ListeStyle2">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-1" style="padding:15px 0 20px 40px;">
                  <input type= "radio" name="tarif" value="jour">
              </div>  
              <div class="col-xs-11">
                <div class="Description" style="width:auto;">
                  <p class="Nom">Carte Bleue</p>        
                </div>
                <div class="FormPaiement" style="padding:8px;">
                <img src="images/carte.jpg" width="120" />
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="row ListeStyle2">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-1" style="padding:15px 0 20px 40px;">
                  <input type= "radio" name="tarif" value="jour">
              </div>  
              <div class="col-xs-6">
                <div class="Description" style="width:auto;">
                  <p class="Nom">Au retrait de ma commande</p>  
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <form action="validation.php">
            <button class="btn btn-vert" id="Rechercher" type="submit" style="margin:30px 0">Valider mon mode de paiement</button> 
          </form>
        </div>
      </div>

    </div>

    
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>


</body>
</html>


