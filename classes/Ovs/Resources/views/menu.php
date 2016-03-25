<div class="col-xs-10 col-xs-offset-1 ListeStyle2">
    <div class="Tof2"><a href="#"><img src="images/nophoto.png" alt="..." /></a></div>
    <div class="Description">
        <p class="Intitule">Entrée</p>
        <p class="Nom">Nom du plat</p>
        <p class="Fonction">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo</p>
    </div>
</div>
<div class="col-xs-10 col-xs-offset-1 ListeStyle2">
    <div class="Tof2"><a class="link" href="/detail_recette.php?id=<?php echo $recette->id; ?>" data-color="#381b26"><img src="<?php echo \Ovs\Utils\Utils::getImage($recette->photo); ?>" alt="..." style="width: auto!important;"/></a></div>
    <div class="Description">
        <p class="Intitule">Plat</p>
        <p class="Nom"><?php echo $recette->titre; ?></p>
        <div class="Liste">
            <div class="row">
                <div class="col-xs-6">
                    <p class="Ingredient"><?php echo ucwords($recette->type_viande); ?></p>
                    <p class="Producteur">Ferme de Jean Bidule</p>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="Tof"><a class="link" href="boucher.php?id=<?php echo $eleveur->id; ?>" data-color="#381b26"><img src="<?php echo \Ovs\Entities\Entite::getImage($eleveur->photoResponsable); ?>"></a></div>
                        <div class="Tof"><a class="link" href="label.php" data-color="#381b26"><img src="images/label.png"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-10 col-xs-offset-1 ListeStyle2">
    <div class="Tof2"><a href="#"><img src="images/dessert.png" alt="..." /></a></div>
    <div class="Description">
        <p class="Intitule">Dessert</p>
        <p class="Nom">Nom du plat</p>
        <p class="Fonction">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo</p>
    </div>
</div>
