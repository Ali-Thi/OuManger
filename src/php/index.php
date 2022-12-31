<?php

session_start();

require 'connectsql.php';

$_SESSION['connecte'] = false;

if(isset($_POST['inscription_submit'])){
    if(isset($_POST['inscription_nom']) && !empty($_POST['inscription_nom']) &&
        isset($_POST['inscription_prenom']) && !empty($_POST['inscription_prenom']) &&
        isset($_POST['inscription_email']) && !empty($_POST['inscription_email']) &&
        isset($_POST['inscription_mdp']) && !empty($_POST['inscription_mdp'])){
            $nom = htmlspecialchars($_POST['inscription_nom']);
            $prenom = htmlspecialchars($_POST['inscription_prenom']);
            $email = $_POST['inscription_email'];
            $motdepasse = $_POST['inscription_mdp'];

            $req = $bdd->prepare("INSERT INTO Utilisateurs(Email, MotDePasse, Nom, Prenom) VALUES(?,?,?,?)");
            if($req->execute(array($email, $motdepasse, $nom, $prenom))){
                console.log($req->fetch());
                $_SESSION['connecte'] = true;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
            }
    }
}

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
            }
        }
    }
}

header('Location: ../index.html');
?>
