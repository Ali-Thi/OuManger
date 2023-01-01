<?php
session_start();
if($_SESSION['connecte']) {
    echo json_encode([$_SESSION['nom'], $_SESSION['prenom']]);
}
elseif (isset($_SESSION['erreur'])){
    echo json_encode([false,$_SESSION['erreur']]);
    session_destroy();
}
?>
