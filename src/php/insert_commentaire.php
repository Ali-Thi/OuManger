<?php
require("connectsql.php");

session_start();

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data["note"]) && !empty($data["note"]) || isset($data["commentaire"]) || (isset($data["idRestaurant"]) && !empty($data["idRestaurant"]))) {
    $req = $bdd->prepare("
INSERT INTO Commentaires(IdUser, IdResto, Commentaire, Note, DatePublication)
VALUES ((SELECT IdUser FROM Utilisateurs u WHERE u.Nom=? AND u.prenom=?), ?, ?, ?, SYSDATE())");
    $req->execute(array($_SESSION['nom'], $_SESSION['prenom'], $data["idRestaurant"], $data["commentaire"], $data["note"]));
}
?>