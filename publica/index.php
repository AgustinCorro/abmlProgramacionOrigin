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
    <a href="../publica/detalle.php">
    </a>
    <div>
        <?php foreach($resultadoFinal as $fila){ ?>
        <h2><?php echo $fila->titulo ?></h2>
        <h4><?php echo $fila->descripcion ?></h4>
        <p><?php echo $fila->fecha?></p>
        <?php } ?>
    </div>  
</body>
</html>