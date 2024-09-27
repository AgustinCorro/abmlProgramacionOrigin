<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$database = "base_de_datos_practica";

$conx = new mysqli($servidor, $usuario, $password, $database);

if($conx->connect_error){
    echo "error".$conx->connect_error;
}
?>