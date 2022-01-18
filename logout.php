<?php
    $idEscola = $_SESSION["idEscola"];
    session_start();
    session_destroy();
    header("location: index.php");
?>