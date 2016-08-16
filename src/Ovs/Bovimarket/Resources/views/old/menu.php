<div class="col-xs-10 col-xs-offset-1 ListeStyle2">
    <div class="Tof2"><a href="#"><img src="images/salade-nicoise.jpg" alt="..." /></a></div>
    <div class="Description">
        <p class="Intitule">Entrée</p>
        <p class="Nom">Salade Niçoise</p>
        <p class="Fonction">Spécialité culinaire célèbre de Nice aujourd'hui répandue dans le monde entier.</p>
    </div>
</div>
<div class="col-xs-10 col-xs-offset-1 ListeStyle2">
    <div class="Tof2"><a class="link" href="/detail_recette.php?idRecette=<?php echo $recette->id; ?>" data-color="#381b26"><img src="<?php echo \Ovs\Bovimarket\Utils\Utils::getImage($recette->photo); ?>" alt="..." style="width: auto!important;"/></a></div>
    <div class="Description">
        <p class="Intitule">Plat</p>
        <p class="Nom"><?php echo $recette->titre; ?></p>
        <div class="Liste">
            <div class="row">
                <div class="col-xs-6">
                    <p class="Ingredient"><?php echo ucwords($recette->type_viande); ?></p>
                    <p class="Producteur">Ferme de <?php echo $eleveur->nomContact; ?></p>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="Tof"><a class="link" href="boucher.php?id=<?php echo $eleveur->id; ?>" data-color="#381b26"><img src="<?php echo \Ovs\Bovimarket\Entities\Entite::getImage($eleveur->photoResponsable); ?>"></a></div>
                        <div class="Tof"><a class="link" href="label.php?id=<?php echo $filiere->id; ?>" data-color="#381b26"><img src="<?php echo \Ovs\Bovimarket\Entities\Entite::getImage($filiere->logo); ?>"></a></div>
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
        <p class="Nom">Panna Cotta</p>
        <p class="Fonction">Recette de crème, de lait et de sucre, nappée de coulis de framboise</p>
    </div>
</div>
