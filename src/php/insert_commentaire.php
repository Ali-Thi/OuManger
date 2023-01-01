<?php
require("connectsql.php");

session_start();

if (isset($_POST['note']) && !empty($_POST['note']) ||
    isset($_POST['commentaire']) && !empty($_POST['commentaire']) ||
    isset($_POST['idRestaurant']) && !empty($_POST['idRestaurant'])) {
    $note = $_POST['note'];
    $commentaire = $_POST['commentaire'];
    $req = $bdd->prepare("
INSERT INTO Commentaires(IdUser, IdResto, Commentaire, Note, DatePublication)
VALUES ((SELECT IdUser FROM Utilisateurs u WHERE u.Nom=? AND u.prenom=?), ?, ?, ?, SYSDATE())");
    $req->execute(array($_SESSION['nom'], $_SESSION['prenom'], $_POST['idRestaurant'], $_POST['commentaire'], $_POST['note']));
}
header('Location: ../index.html');
?>