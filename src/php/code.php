<?php
require("connectsql.php");

$req = $bdd->prepare("SELECT * FROM `Utilisateurs`");
$req->execute();
for ($i = 0 ; $i < $req->rowCount() ; ++$i){
    $req_user = $req->fetch();
    $update = $bdd->prepare("UPDATE `Utilisateurs` SET `MotDePasse`=? WHERE `IdUser`=?");
    $update->execute(array(password_hash($req_user['MotDePasse'], PASSWORD_DEFAULT), $req_user['idUser']));
}
?>