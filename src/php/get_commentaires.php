<?php
require("connectsql.php");

session_start();

if( isset($_GET['nom']) && !empty($_GET['nom']) ||
    isset($_GET['adresse']) && !empty($_GET['adresse']) ){
    $nom = $_GET['nom'];
    $adresse = $_GET['adresse'];
    $req = $bdd->prepare("SELECT c.IdCommentaire as id, u.nom AS nom, u.prenom AS prenom, c.DatePublication AS date, c.Note AS note, c.Commentaire  AS commentaire FROM Restaurant r INNER JOIN (commentaires c INNER JOIN utilisateurs u ON c.IdUser=u.IdUser) ON r.IdResto=c.IdResto WHERE r.NomResto=? AND r.Adresse=?;");
    if($req->execute(array(strtoupper($nom), strtoupper($adresse)))){
        $resultat = [];
        for($i = 0; $i < $req->rowCount(); $i++) {
            $line = $req->fetch();
            array_push($resultat, $line);
        }
        if(!empty($resultat)){
            echo json_encode($resultat);
        }
    }
}
else if(isset($_POST['note']) && !empty($_POST['note']) ||
    isset($_POST['commentaire']) && !empty($_POST['commentaire'])  ||
    isset($_POST['idRestaurant']) && !empty($_POST['idRestaurant']) ){
    echo($_POST['note']);
    echo($_POST['commentaire']);
    echo($_POST['idRestaurant']);
    $note = $_POST['note'];
    $commentaire = $_POST['commentaire'];
    $req = $bdd->prepare("
INSERT INTO commentaires(IdUser, IdResto, Commentaire, Note, DatePublication)
VALUES ((SELECT IdUser FROM utilisateurs u WHERE u.Nom=? AND u.prenom=?), ?, ?, ?, SYSDATE())");
    if($req->execute(array($_SESSION['nom'], $_SESSION['prenom'], $_POST['idRestaurant'], $_POST['commentaire'], $_POST['note']))){
        echo(true);
    }
    else{
        echo(false);
    }
    header('Location: ../index.html');
}
?>