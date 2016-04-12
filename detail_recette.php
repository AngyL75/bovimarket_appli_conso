<?php
    require_once(__DIR__."/classes/Ovs/custom_loader.php");

$idRecette=\Ovs\Utils\Utils::getIdRecette(false);
$recette=\Ovs\Entities\Recettes::find($idRecette);


$classes=array(
    0=>"neutre",
    1=>"facile",
    2=>"moyen",
    3=>"difficile",
    4=>"expert"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">
    <div id="return"><a class="link" href="javascript:history.go(-1)" data-color="#ffffff"><</a></div>
    <div id="close"><a href="carte.php">x</a></div>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
              <img class="Photo" src="<?php echo \Ovs\Utils\Utils::getImage($recette->photo); ?>" alt="..." />
            </div>

            <div class="col-xs-12">
                <h1><?php echo $recette->titre; ?></h1>
                <p><?php echo $recette->descriptif_introduction; ?></p>
            </div>
        </div>
        <div class="row" style="padding:20px 0">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="col-xs-4 sablier">
                    <?php echo $recette->temps_preparation; ?>
                </div>
                <div class="col-xs-4 cuisson">
                    <?php echo $recette->temps_cuisson; ?>
                </div>
                <div class="col-xs-4 difficulte <?php echo $classes[$recette->difficulte]; ?>"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <h3 style="padding:30px 0">Ingrédients (<?php echo $recette->portion; ?>)</h3>
                <div class="text-left" style="padding-left: 30px">
                    <b>Ingrédients :</b>
                        <ul>
                        <?php
                            foreach($recette->ingredients as $ingredient):
                                echo "<li>".$ingredient."</li>";
                            endforeach;
                        ?>
                        </ul>
                        <?php if(isset($recette->ingredients_sauce) && $recette->ingredients_sauce): ?>
                        <b>Pour la sauce :</b>
                        <ul>
                            <?php foreach($recette->ingredients_sauce as $ingredient): ?>
                                <li><?php echo $ingredient; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <h3 style="padding:30px 0">Préparation</h3>
                <div class="text-justify">
                    <p>
                        <?php echo nl2br($recette->instructions_preparation); ?>
                    </p>
                    <?php if($recette->instructions_dressage): ?>
                    <p><strong>Dressage</strong></p>
                    <p>
                        <?php echo nl2br($recette->instructions_dressage); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <button class="btn btn-vert" id="Video" type="submit" style="margin:40px 0 0px">Recette en vidéo</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="padding-top:50px;padding-bottom:20px;">
            <div class="col-xs-12">
                <h3>Les morceaux recommandés</h3>
            </div>
        </div>
        <div class="row">
                    <?php
                    foreach($recette->morceaux as $morceauId):
                        $morceau=\Ovs\Entities\Morceaux::find($morceauId);
                        ?>
                        <div class="row ListeStyle2">
                            <div class="col-xs-12">
                                <a class="link" href="morceau.php?idMorceau=<?php echo $morceau->id; ?>" data-color="#ffffff">
                                    <div class="Tof2"><img src="<?php echo \Ovs\Utils\Utils::getImage($morceau->photo); ?>" alt="..." /></div>
                                    <div class="Description" style="padding:40px 20px">
                                        <div class="Nom col-xs-12"><?php echo $morceau->nom; ?></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
            <div class="row ListeStyle2">
                <div class="col-xs-12">
                    <a class="link" href="qrcode.php" data-color="#ffffff">
                        <div class="Tof2"><img src="images/collier.png" alt="..." /></div>
                        <div class="Description" style="padding:40px 20px">
                            <div class="Nom col-xs-12">Collier d'agneau</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.js"></script>

</body>
</html>