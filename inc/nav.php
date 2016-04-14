<?php require_once __DIR__."/../classes/Ovs/custom_loader.php"; ?>

<?php
$idBoucher="5612cc931c394253439bc257";
$boucher=\Ovs\Entities\Entite::find($idBoucher);

$idResto = "56a750a01efa456c7c7c5c2c";
$resto = \Ovs\Entities\Entite::find($idResto);

?>
<ul id="navs">
  <li class="nav1"><a href="#"></a></li>
  <li class="nav2"><a class="link" href="autour.php" data-color="#381b26"></a></li>
  <li class="nav3"><a class="link" href="flash.php" data-color="#ffffff"></a></li>
  <li class="nav4"><a class="link" href="rechercher-zones.php" data-color="#ffffff"></a></li>
</ul>

<nav id="menu">
  <ul> 
    <li><h2>Navigation</h2></li>
    <li>
      <a class="link" href="carte.php" data-color="#fff">
        <span class="Chiffre">01</span>
        <p>Bouchers</p>
      </a>
    </li>
    <li>
      <a class="link" href="carte2.php" data-color="#fff">
        <span class="Chiffre">02</span>
        <p>Mes restaurants</p></a>
    </li>         
  </ul>
</nav>

<nav class="favoris" id="favoris">
  <ul> 
    <li><h2>Favoris</h2></li>
    <li>
      <a class="link" href="boucher.php?id=<?php echo $idBoucher; ?>" data-color="#381b26">
        <div class="Tof"><img src="<?php echo \Ovs\Entities\Entite::getImage($boucher->logo); ?>" alt="..." /></div>
        <div class="Description">
          <p class="Nom" style="color:#fff !important;"><?php echo $boucher->name; ?></p>
          <p class="Fonction">Boucher</p>
        </div>
      </a>
    </li>
    <li>
      <a class="link" href="resto.php?id=<?php echo $idResto; ?>" data-color="#381b26">
        <div class="Tof"><img src="<?php echo \Ovs\Entities\Entite::getImage($resto->logo); ?>" alt="..." /></div>
        <div class="Description">
          <p class="Nom" style="color:#fff !important;"><?php echo $resto->name; ?></p>
          <p class="Fonction">Restaurant</p>
        </div>
      </a>
    </li>         
  </ul>
</nav>

<nav id="amis">
  <ul> 
    <li><h2>Amis</h2></li>
    <li>
      <a class="link" href="ami.php" data-color="#381b26">
        <div class="Tof"><img src="images/perso1.png" alt="..." /></div>
        <div class="Description">
          <p class="Nom" style="color:#fff !important;">Jean Bidule</p>
        </div>
      </a>
    </li>     
  </ul>
  <button class="btn btn-vert" id="Ajouter">Ajouter un ami</button> 
</nav>