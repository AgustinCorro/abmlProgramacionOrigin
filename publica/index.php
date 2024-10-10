<?php
require_once("../panel/dataBase/db.php");

$stmt = $conx->prepare("SELECT * FROM noticias");
$stmt->execute();


$resultadoSTMT = $stmt->get_result();
$resultadoFinal = [];

while ($fila = $resultadoSTMT->fetch_object()){
    $resultadoFinal[] = $fila;
};

$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <a href="../publica/listadoNoticias.php">Ir al listado de noticias</a>
        <br>
        <a href="../panel/login.php">Ingresar como administrador</a>
    </div>
</body>
</html>
