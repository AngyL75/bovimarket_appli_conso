<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder" style="padding:0">
   
  <div id="page">
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
        <div id="Carte" class="Choix"><a href="carte2.php">Carte</a></div>
        <div id="Liste" class="Choix select"><a href="liste.php">Liste</a></div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="row ListeStyle2" style="padding:150px 0 10px">
        <div class="col-xs-10 col-xs-offset-1">
          <a class="link" href="boucher.php" data-color="#ffffff">
            <div class="Tof2"><img src="images/ex.png" alt="..." /></div>
            <div class="Description" style="padding:40px 20px">
              <p class="Nom col-xs-12">Boucherie du centre</p>
              <p class="Fonction">
                Boucher
              </p>
            </div>
          </a>
        </div>
      </div>
      <div class="row ListeStyle2" style="padding:10px 0">
        <div class="col-xs-10 col-xs-offset-1">
          <a class="link" href="boucher.php" data-color="#ffffff">
            <div class="Tof2"><img src="images/resto.png" alt="..." /></div>
            <div class="Description" style="padding:40px 20px">
              <p class="Nom col-xs-12">Titre</p>
              <p class="Fonction">
                Restaurant
              </p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

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


</body>
</html>


