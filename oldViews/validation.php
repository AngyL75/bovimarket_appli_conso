<!doctype html>
<html lang="fr">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">

    <div id="close"><a href="carte.php">x</a></div>
        
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>
                    Commande terminé
                </h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3 text-center">
                Votre paiement a bien été envoyée.
            </div>
        </div>
        
        <div class="text-center" style="margin-top:50px;"><img src="images/troupeau.png" alt="" /></div>

        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <form action="boucher.php">
                    <button class="btn btn-vert" id="Rechercher" type="submit" style="margin:30px 0">Retour</button> 
                </form>
            </div>
        </div>
    </div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>

</body>
</html>