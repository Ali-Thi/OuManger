<?php
require("connectsql.php");

if( isset($_GET['nom']) && !empty($_GET['nom']) ||
    isset($_GET['adresse']) && !empty($_GET['adresse']) ){
    $nom = $_GET['nom'];
    $adresse = $_GET['adresse'];
    $req = $bdd->prepare("SELECT IdResto AS id, Note as note FROM Restaurants r WHERE r.NomResto=? AND r.Adresse=?;");
    if($req->execute(array(strtoupper($nom), strtoupper($adresse)))){
        if($req->rowCount() === 0){
            $req_insert = $bdd->prepare("INSERT INTO Restaurants(NomResto, Adresse, Note) VALUES(?, ?, null)");
            if($req_insert->execute(array(strtoupper($nom), strtoupper($adresse))) && $req->execute(array(strtoupper($nom), strtoupper($adresse))) && $req->rowCount() > 0){
                echo json_encode($req->fetch());
            }
        } else{
            echo json_encode($req->fetch());
        }
    }
}
?>