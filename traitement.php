<?php
require 'bdd.php';
// controle de l'existance de titre et artiste, controle de longueur du texte et de la présence d'une url
if(isset($_POST['titre']) && isset($_POST['artiste']) && strlen($_POST['description'])>3 && filter_var($_POST['image'],FILTER_VALIDATE_URL) ){
    // suppression des caractères potentiellement dangereux
    $controlData = $_POST;
    $controlData['titre'] = trim(htmlspecialchars($controlData['titre']));
    $controlData['artiste'] = trim(htmlspecialchars($controlData['artiste']));
    $controlData['description'] = trim(htmlspecialchars($controlData['description']));

    // enregistrement de la donnée
    $nouvelID = addOeuvre($controlData);
    if(isset($nouvelID)){
        // ne fonctionne pas alors que la page est vide du coup j'utilise le javascript
        // header('location : oeuvre.php?id=' . $nouvelID);
        $lienVersOeuvre = "oeuvre.php?id=" . $nouvelID;
        echo "<script>window.location.href='" . $lienVersOeuvre ."';</script>";
        echo "l'enregistrement " . $nouvelID ." s'est bien passé";
    }
    else{
        require 'header.php';
        echo "une erreur est survenue";
    }
}
else{
    require 'header.php';
    echo "une erreur est survenue";
}
