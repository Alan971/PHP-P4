<?php
require 'bdd.php';
// controle de l'existance de titre et artiste, controle de longueur du texte et de la présence d'une url
if(isset($_POST['titre']) && isset($_POST['artiste']) && strlen($_POST['description'])>3 && filter_var($_POST['image'],FILTER_VALIDATE_URL) ){
    // suppression des caractères potentiellement dangereux
    $controlData = $_POST;
    $controlData['titre'] = trim(htmlspecialchars($controlData['titre']));
    $controlData['artiste'] = trim(htmlspecialchars($controlData['artiste']));
    $controlData['description'] = trim(htmlspecialchars($controlData['description']));

    if(ajoutOeuvre($controlData)){
        $erreurForm = "l'enregistrement s'est bien passé";
    }
    else{
        $erreurForm = "une erreur est survenue";
    }


}
else{
    $erreurForm = "une erreur est survenue";
}
require 'header.php';
echo  $erreurForm . "<br>";
?>
