<h1>Liste des restaurants</h1>
<?php
foreach  ($listeRestos as $unResto) {
    $lesPhotos = getPhotosByIdR($unResto->getIdR());
    ?>
    <div class="card">
        <div class="photoCard">
            <?php if (count($lesPhotos) > 0) { ?>
                <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
            <?php } ?>


        </div>
        <div class="descrCard"><?php echo "<a href='./?action=detail&idR=" . $unResto->getIdR() . "'>" . $unResto->getNomR() . "</a>"; ?>
            <br />
            <?= $unResto->getNumAdrR() ?>
            <?= $unResto->getVoieAdrR() ?>
            <br />
            <?= $unResto->getCpR() ?>
            <?= $unResto->getVilleR() ?>
        </div>
        <div class="tagCard">
            <ul id="tagFood">		
            </ul>
        </div>
    </div>
<?php }
?>


