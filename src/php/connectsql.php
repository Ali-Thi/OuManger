<?php
$hostname = "mysql-pj-web-pb.alwaysdata.net";
$base= "pj-web-pb_database";
$loginBD= "pj-web-pb";
$passBD="My_Sql_pjweb";

try {
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$base.';charset=utf8;charset=utf8mb4',$loginBD,$passBD);
//    echo("connexion réussi\n");
} catch (PDOException $e) {
    echo "échec de la connexion à la base de donn�es : ".$e;
    die();
}

?>
