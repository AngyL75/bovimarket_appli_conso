<!doctype html>
<html lang="fr">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">

    <div id="return"><a href="restaurant.php"><</a></div>
    <div id="close"><a href="carte.php">x</a></div>
        
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>
                    Réserver une table
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <form action="confirm.php">
                    <div class="btn-group dropdown">
                        <div class="clearfix">
                            <button type="button" class="btn dropdown-toggle choice-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <var>Jour</var>
                            </button>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <div class="clearfix">
                            <button type="button" class="btn dropdown-toggle choice-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <var>Heure</var>
                            </button>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <div class="clearfix">
                            <button type="button" class="btn dropdown-toggle choice-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <var>Nombre de personne</var>
                            </button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-vert">Réserver</button>
                </form>
            </div>
        </div>
        <div class="text-center" style="margin-top:50px;"><img src="images/troupeau.png" alt="" /></div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.js"></script>
<script>
    var calendar = $( ".datepicker").datepicker();
    calendar.datepicker("option", "onSelect", function(text, inst) {
        $("#datereservation").collapse('hide');
        $("#datereservation").prev().find("var").text(text);
    });
</script>
</body>
</html>