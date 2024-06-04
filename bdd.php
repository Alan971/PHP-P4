<?php
// fonction de connection 
function connexion() {
    try {
        $db = new PDO(
            // mysql est le nom du container docker
            //root et dbroot sont les login et mdp
            'mysql:host=mysql;dbname=artbox;charset=utf8',
            'root',
            'dbroot'
        );
    }
    //en cas d'erreur on affiche le message et on arrête tout
    catch(Exception $e) {
        die('erreur : ' . $e ->getMessage());
    }
    return  $db;
}

function getOeuvres(){
    $db = connexion();
    $query = 'SELECT * FROM oeuvres';
    $ArtStatement = $db ->prepare($query);
    $ArtStatement->execute();
    return $ArtStatement->fetchAll();
}

function getOeuvre($id){
    $db = connexion();
    $query = "SELECT * FROM oeuvres WHERE id = ?";
    $ArtStatement = $db ->prepare($query);
    $ArtStatement->execute([$id]);
    $artArray = $ArtStatement->fetchAll();
    if(!$artArray){
        return null;
    }
    return $artArray[0];
}

function addOeuvre($nouvelleOeuvre){
    try {
        $db = connexion();
        $query = "INSERT INTO `oeuvres` (`titre`, `description`, `artiste`, `image`) VALUES (?,?,?,?)";
        $ArtStatement = $db->prepare($query);

        $ArtStatement->execute([$nouvelleOeuvre['titre'] , $nouvelleOeuvre['description'] , $nouvelleOeuvre['artiste'] , $nouvelleOeuvre['image']]);
        $artArray = $ArtStatement->fetchAll();
        return $db->lastInsertId();
    }
    catch(Exception $e) {
        die('erreur : ' . $e ->getMessage());
    }
}
     