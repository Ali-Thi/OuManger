<?php

session_start();

require 'connectsql.php';

$_SESSION['connecte'] = false;

if(isset($_POST['connexion_submit'])){
    if( isset($_POST['connexion_email']) && !empty($_POST['connexion_email']) ||
        isset($_POST['connexion_mdp']) && !empty($_POST['connexion_mdp']) ){
        $email = $_POST['connexion_email'];
        $req = $bdd->prepare("SELECT * FROM Utilisateurs WHERE email = ?");
        if($req->execute(array($email))) { // Je crée un objet de type PDO qui contient le résultat de la requête
            $nbUtilisateur = $req->rowCount(); // Retourne le nombre de ligne reçu de la requête
            if ($nbUtilisateur == 1) {
                $req_user = $req->fetch();
                if ($req_user["MotDePasse"] == $_POST['connexion_mdp']) {
                    $_SESSION['connecte'] = true;
                    $_SESSION['nom'] = $req_user['Nom'];
                    $_SESSION['prenom'] = $req_user['Prenom'];
                }
            } else {
                $_SESSION['erreur'] = "Utilisateurs inconnus";
            }
        }
    }
}

header('Location: ../index.html');
?>
