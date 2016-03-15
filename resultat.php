<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">

<div class="container">
    <div style="width: 100%; color:#fff">
        <div id="return"><a href="rechercher.php"><</a></div>
        <div id="close"><a href="carte2.php">x</a></div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>2 Résultats</h1>
                </div>
            </div>
            <div class="row">
                <div class="row ListeStyle2">
                  <div class="col-xs-12">
                    <a class="link" href="restaurant.php" data-color="#ffffff">
                      <div class="Tof2"><img src="images/resto2.png" alt="..." /></div>
                      <div class="Description" style="padding:40px 20px">
                        <div class="Nom col-xs-12">Restaurant Chez Camillou</div>
                      </div>
                    </a>
                  </div>
                </div>

                <div class="row ListeStyle2">
                  <div class="col-xs-12">
                    <a class="link" href="restaurant.php" data-color="#ffffff">
                      <div class="Tof2"><img src="images/resto2.png" alt="..." /></div>
                      <div class="Description" style="padding:40px 20px">
                        <div class="Nom col-xs-12">Restaurant Chez Camillou</div>
                      </div>
                    </a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="js/helper.js"></script>
<script src="js/app.js"></script>
<script>

        // mid scroll to hide partially map
        var resultsHeight = $("#resultats-carte").height();
        $("#resultats-carte").height(resultsHeight - 200);
        $("#resultats-carte").scrollTop(resultsHeight);


        var defaultLatLng = new google.maps.LatLng(45.1066656,4.0070101);
        drawMap(defaultLatLng);
        function drawMap(latlng) {
            var myOptions = {
                zoom: 9,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false
            };

            var map = new google.maps.Map(document.getElementById("cartographie"), myOptions);
            var infowindow = new google.maps.InfoWindow();

            google.maps.event.addListener(map, 'click', function() {
                infowindow.close();
            });

            var markers = [
                {
                    position: new google.maps.LatLng(45.1066656,4.0070101),
                    map: map,
                    icon: 'img/marqueur-mauve.png',
                    title: "Restaurant Vidal",
                    url: 'restaurant-vidal.html'
                },
                {
                    position: new google.maps.LatLng(45.1866656,4.0070101),
                    map: map,
                    icon: 'img/marqueur-mauve.png',
                    title: "Restaurant Chez Camillou",
                    url: 'restaurant-atrazic.html'
                },
                {
                    position: new google.maps.LatLng(44.9066656,4.3070101),
                    map: map,
                    icon: 'img/marqueur-mauve.png',
                    title: "Restaurant Vidal",
                    url: 'restaurant-vidal.html'
                },
                {
                    position: new google.maps.LatLng(45.3066656,4.0090101),
                    map: map,
                    icon: 'img/marqueur-vert.png',
                    title: 'Boucher Macraigne',
                    url: 'boucher-macraigne.html'
                },
                {
                    position: new google.maps.LatLng(45.2066656,4.3090101),
                    map: map,
                    icon: 'img/marqueur-vert.png',
                    title: 'Boucher Macraigne',
                    url: 'boucher-macraigne.html'
                },
                {
                    position: new google.maps.LatLng(45.7066656,4.1090101),
                    map: map,
                    icon: 'img/marqueur-vert.png',
                    title: 'Boucher Macraigne',
                    url: 'boucher-macraigne.html'
                }
            ];

            markers.forEach(function(marker) {
                var marker = new google.maps.Marker(marker);
                google.maps.event.addListener(marker, 'click', function() {
                    if (marker.url) {
                        infowindow.setContent('<a href="' + marker.url + '">' + marker.title + '</a>');
                    } else {
                        infowindow.setContent(marker.title);
                    }

                    infowindow.open(map, marker);
                });
            });

        }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>