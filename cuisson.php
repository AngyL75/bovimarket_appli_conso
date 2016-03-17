<?php

require_once __DIR__ . "/classes/Ovs/custom_loader.php";

$morceauId = getIdMorceaux(false);

$morceau = \Ovs\Entities\Morceaux::find($morceauId);
$cuissons = \Ovs\Entities\Cuisson::findAllFor(array("morceaux" => $morceauId));

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include('inc/head.php') ?>

</head>
<body class="pageblanche" id="holder">

<div id="return"><a href="qrcode.php"><</a></div>
<div id="close"><a href="carte2.php">x</a></div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="IconeCuisson">La cuisson</h1>
            <p>Le <?php echo $morceau->nom; ?> est une viande à
                <?php foreach ($cuissons as $i=>$cuisson):?>
                <a class="link" href="detail_cuisson.php?idCuisson=<?php echo $cuisson->id;?>" data-color="#ffffff"><?php echo $cuisson->nom; ?></a>
                    <?php if($i < count($cuissons)-2): ?>
                        ,
                        <?php elseif($i < count($cuissons)-1): ?>
                        ou à
                    <?php endif; ?>
                <?php endforeach; ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="row">
                <?php
                foreach ($cuissons as $cuisson) {
                    ?>
                    <div class="col-xs-6">
                        <a class="IconBouillir text-center" href="detail_cuisson.php?idCuisson=<?php echo $cuisson->id;?>">
                            <?php echo $cuisson->nom; ?>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p><?php echo $morceau->conseils_cuisson; ?></p>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/main.js"></script>

</body>