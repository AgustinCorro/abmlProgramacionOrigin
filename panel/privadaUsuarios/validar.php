<?php
@session_start();

if(!isset($_SESSION["id"]) || empty($_SESSION["id"])){
    //no estoy validado
    header("Location: ../login.php");
    exit();
}

?>