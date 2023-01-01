<?php

session_start();

require 'connectsql.php';

$_SESSION['connecte'] = false;

if(isset($_POST['inscription_submit'])) {
    if (isset($_POST['inscription_nom']) && !empty($_POST['inscription_nom']) &&
        isset($_POST['inscription_prenom']) && !empty($_POST['inscription_prenom']) &&
        isset($_POST['inscription_email']) && !empty($_POST['inscription_email']) &&
        isset($_POST['inscription_mdp']) && !empty($_POST['inscription_mdp'])) {
        $nom = htmlspecialchars($_POST['inscription_nom']);
        $prenom = htmlspecialchars($_POST['inscription_prenom']);
        $email = $_POST['inscription_email'];
        $motdepasse = $_POST['inscription_mdp'];

        $req = $bdd->prepare("INSERT INTO Utilisateurs(Email, MotDePasse, Nom, Prenom) VALUES(?,?,?,?)");
        if ($req->execute(array($email, $motdepasse, $nom, $prenom))) {
            console . log($req->fetch());
            $_SESSION['connecte'] = true;
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
        }
        else{
            $_SESSION['erreur'] = "Erreur interne";
        }
    }
}

header('Location: ../index.html');
?>
