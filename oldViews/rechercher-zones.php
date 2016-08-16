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
                <h1 class="text-center" id="TitreRecherche">
                    Sélectionnez votre région
                </h1>
            </div>
        </div>

        <form class="recherche" action="rechercher.php">
            <div class="text-center" id="carte-france">
                <img src="images/fond-carte.png" width="440px">
                <img class="auvergne hide" width="440px" src="images/fond-auvergne.png" style="position:absolute;left:50%;margin-left:-220px;">
            </div>
            <div class="col-xs-8 col-xs-offset-2">
                <button type="submit" class="btn btn-vert" id="Valider">Valider</button>
            </div>
        </form>
        <div class="text-center"><img src="images/troupeau.png" alt="" /></div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.js"></script>
<script>
    $("#carte-france").click(function (e) {
        e.preventDefault();
        $(".auvergne").toggleClass("hide");
    });
    $("form.recherche .dropdown-menu li").click(function (e) {
        $(this).parent().parent().find("button var").text($(this).text());
    });
</script>
</body>
</html>