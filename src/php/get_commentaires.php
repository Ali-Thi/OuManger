<?php
require("connectsql.php");

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
?>