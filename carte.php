<?php

require_once __DIR__."/classes/Ovs/custom_loader.php";
$entites=\Ovs\Entities\Entite::findAllFor(array("activite"=>"BOUCHER"));
include ("index.php");exit();
?>


<?php
/*****
 *
 * PLUS APPELE
 *
 ******/
?>

<?php session_start();session_destroy(); ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="home" id="holder">
    <div id="page" style="overflow:hidden;">
      <div class="header" id="Menu1">
        <a href="#menu"></a>
      </div>

      <div class="header" id="Menu2">
        <a href="#favoris"></a>
      </div>

      <div class="header" id="Menu3">
        <a href="#amis"></a>
      </div>

      <?php include ('inc/nav.php') ?>

      <div id="content">
        <div id="Choix">
          <div id="Carte" class="Choix select"><a href="carte2.php">Carte</a></div>
          <div id="Liste" class="Choix"><a href="liste.php">Liste</a></div>
        </div>

        <div id="Adresse1">
          <div class="pin boucher"><a class="link" href="boucher.php" data-color="#381b26"></a></div>
          <div class="pulse"></div>
        </div>
        <!--<div id="Adresse2">
          <div class="pin resto"><a class="open-popup" href="#popup1"></a></div>
          <div class="pulse"></div>
        </div>-->
        <div id="map"></div>
      </div>
    </div>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $('body').addClass('loaded');
        }, 3000);
    });
    alsolike(
      "RWBQRM", "Flexbox Products interaction",
      "aOQddB", "Open & Close Animation",
      "wBOder", "Subtle Icons hover effect"
    );
  </script>
  <script type="text/javascript" src="js/jquery.mmenu.all.min.js"></script>
  <script type="text/javascript">
     jQuery(document).ready(function( $ ) {
        $("nav#menu").mmenu({
          "extensions": [
              "pagedim-black"
           ]
        });
     });
  </script>
  <script type="text/javascript">
     jQuery(document).ready(function( $ ) {
        $("nav#favoris").mmenu({
           "extensions": [
              "pagedim-black"
           ]
        });
     });
  </script>

  <script type="text/javascript">
     jQuery(document).ready(function( $ ) {
        $("nav#amis").mmenu({
           "extensions": [
              "pagedim-black"
           ],
           "offCanvas": {
              "position": "right"
           }
        });
     });
  </script>
  <script type="text/javascript">
    (function(){
      var ul=$("#navs"),li=$("#navs li"),i=li.length,n=i-1,r=140;
      ul.click(function(){
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
          for(var a=0;a<i;a++){
            li.eq(a).css({
              'transition-delay':""+(100*a)+"ms",
              '-webkit-transition-delay':""+(200*a)+"ms",
              'left':(r*Math.cos(90/n*a*(Math.PI/90))),
              'top':(-r*Math.sin(90/n*a*(Math.PI/90))) 
            });
          }
        }else{
          li.removeAttr('style');
        }
      });
    })($);
  </script>
  <script src="js/main.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
      google.maps.event.addDomListener(window, 'load', init);
      function init() {
        var mapOptions = {
            zoom: 15,
            center: new google.maps.LatLng(45.7833, 3.0833),
            styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(45.7833, 3.0833),
            map: map,
            title: 'Snazzy!'
        });
      }
    </script>


</body>
</html>


