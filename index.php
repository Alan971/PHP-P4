<?php
    require 'header.php';
    // require 'oeuvres.php';
    require 'bdd.php';
?>
<? 
$i=NULL;
// $i=3;
$oeuvres=connexion($i);

//  if(isset($i)){
//     echo "<H2>Mise en avant d'un artiste : " . $ouvrage[0]['artiste'] . "</H2>";
//     echo"<img src=" . $ouvrage[0]['image'] ." alt=''>";
//     }
//     else {
//         echo"<H2>Mise en avant de l'oeuvre de : " . $ouvrage[0][1] . "</H2>";
//         echo"<img src=" . $ouvrage[1][4] ." alt=''>";
//     }
    ?>

<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>
