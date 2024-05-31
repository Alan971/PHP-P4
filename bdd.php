<?php
// fonction de connection 
function connexion() {
    try {
        $mysqlClient = new PDO(
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
    return  $mysqlClient;
}
function appelDeBDD($id){
    $mysqlClient = connexion();
    // si on n'a pas d' ID alors on récupère toute la base sinon seulement le tableau correspondant à l'ID
    if(!isset($id)){
        $query = 'SELECT * FROM oeuvres';
    }
    else{
        $query = "SELECT * FROM oeuvres WHERE id = " .$id;
    }
    // demande SQL
    if (isset($query)){
        $ArtStatement = $mysqlClient ->prepare($query);
        $ArtStatement->execute();
        $artArray = $ArtStatement->fetchAll();
        // modification du tableau en fonction de la demande : 
        // Soit la demande est incohérente -> ID n'existe pas dans la base et donc le tableau n'existe pas
        // soit un tableau à une dimension 
        // sinon un tableau à deux dimensions
        if(isset($id) && !$artArray){
            return null;
        }
        elseif (isset($id)){
            return $artArray[0];
        }
        else { 
            return $artArray;
        }
    }
}

function ajoutOeuvre($nouvelleOeuvre){
    try {
        $mysqlClient = connexion();
        $query = "INSERT INTO `oeuvres` (`titre`, `description`, `artiste`, `image`) VALUES ('" . $nouvelleOeuvre['titre'] . "', '" . $nouvelleOeuvre['description'] . "', '" . $nouvelleOeuvre['artiste'] . "', '" . $nouvelleOeuvre['image'] . "')";
        $ArtStatement = $mysqlClient ->prepare($query);
        $ArtStatement->execute();
        $artArray = $ArtStatement->fetchAll();
        return 1;
    }
    catch(Exception $e) {
        die('erreur : ' . $e ->getMessage());
    }
}
?>