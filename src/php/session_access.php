<?php
session_start();
if($_SESSION['connecte']) {
    echo json_encode([$_SESSION['nom'], $_SESSION['prenom']]);
}
?>
