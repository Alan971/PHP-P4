<?php
// fonction de connection 
function connexion($id) {
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

    if(!isset($id)){
        $query = 'SELECT * FROM oeuvres';
    }
    else{
        $query = "SELECT * FROM oeuvres WHERE id = " .$id;
    }

    if (isset($query)){
        $ArtStatement = $mysqlClient ->prepare($query);
        $ArtStatement->execute();
        return $ArtStatement->fetchAll();
    }

}
?>