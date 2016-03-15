<!doctype html>
<html lang="fr">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">

    <div id="return"><a href="rechercher-zones.php"><</a></div>
    <div id="close"><a href="carte.php">x</a></div>
        
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center" id="TitreRecherche">
                    Vous recherchez
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <div class="col-xs-4 text-center IconRecherche">
                    <a href="#">
                        <i class="fa fa-location-arrow"></i> 
                        <p>Autour de moi</p>
                    </a>
                </div>
                <div class="col-xs-4 text-center IconRecherche">
                    <a href="#">
                        <i class="fa fa-map-marker"></i> 
                        <p>Villes</p>
                    </a>
                </div>
                <div class="col-xs-4 text-center selected IconRecherche">
                    <a href="#">
                        <i class="fa fa-globe"></i> 
                        <p>Auvergne</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <form class="recherche" action="resultat.php">
                    <div class="clearfix">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle choice-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <var>Type de viande</var>
                            </button>
                            <ul class="dropdown-menu">
                                <li>Boeuf</li>
                                <li>Veau</li>
                                <li>Agneau</li>
                                <li>Porc</li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle choice-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <var>Qualité</var>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="clearfix">Agneau de Lozère <a href="#" class="btn btn-white pull-right"><i class="fa fa-info-circle"></i></a></li>
                                <li class="clearfix">Boeuf Fin Gras de Mézenc <a href="#" class="btn btn-white pull-right"><i class="fa fa-info-circle"></i></a></li>
                                <li class="clearfix">Boeuf Salers LR <a href="#" class="btn btn-white pull-right"><i class="fa fa-info-circle"></i></a></li>
                                <li class="clearfix">Boeuf Bio de Haut-Marne <a href="#" class="btn btn-white pull-right"><i class="fa fa-info-circle"></i></a></li>
                                <li class="clearfix">Boeuf Blonde des Combrailles <a href="#" class="btn btn-white pull-right"><i class="fa fa-info-circle"></i></a></li>
                                <li class="clearfix">Porc de Haute-Loire  <a href="#" class="btn btn-white pull-right"><i class="fa fa-info-circle"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="btn-group dropdown" id="activitesSelect">
                            <button type="button" class="btn dropdown-toggle choice-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <var>Activité</var>
                            </button>
                            <ul class="dropdown-menu">
                                <li>Restaurants</li>
                                <li>Bouchers</li>
                                <li>Eleveurs</li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix hide" data-activites="Restaurants">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle choice-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <var>Allergènes</var>
                            </button>
                            <ul class="dropdown-menu">
                                <li>Sans gluten</li>
                                <li>Sans crustacé</li>
                                <li>Sans oeuf</li>
                                <li>Sans poisson</li>
                                <li>Sans arachide</li>
                                <li>Sans soja</li>
                                <li>Sans lait</li>
                                <li>Sans trace de fruit à coques</li>
                                <li>Sans céleri</li>
                                <li>Sans moutarde</li>
                                <li>Sans graines de sésame</li>
                                <li>Sans anhydride sulfureux ou sulfites</li>
                                <li>Sans lupin</li>
                                <li>Sans mollusques</li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix hide" data-activites="Restaurants">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle choice-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <var>Diététique</var>
                            </button>
                            <ul class="dropdown-menu">
                                <li>Hypocalorique</li>
                                <li>Sans sel</li>
                                <li>Végétarien</li>
                                <li>Sans sucre ajouté</li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix hide" data-activites="Bouchers Restaurants">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle choice-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <var>Rituels</var>
                            </button>
                            <ul class="dropdown-menu">
                                <li>Halal</li>
                                <li>Casher</li>
                            </ul>
                        </div>
                    </div>
                    <button class="btn btn-vert" id="Rechercher" type="submit">Rechercher</button> 
                </form>
            </div>
            <div class="text-center"><img src="images/troupeau.png" alt="" /></div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        $("form.recherche .dropdown-menu li").click(function (e) {
            $(this).parent().parent().find("button var").text($(this).text());
        });
        $("#activitesSelect .dropdown-menu li").click(function (e) {
            $("form.recherche > div[data-activites]").addClass("hide");
            var activite = $(this).text();
            $("form.recherche > div[data-activites~='"+activite+"']").toggleClass("hide");
        });
    </script>


</body>
</html>