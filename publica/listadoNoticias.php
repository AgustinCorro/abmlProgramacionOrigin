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
    <?php foreach($resultadoFinal as $fila){ ?>
        <div>
            <h2><?php echo $fila->titulo ?></h2>
            <h4><?php echo $fila->descripcion ?></h4>
            <p><?php echo $fila->fecha ?></p> 
            <!-- con el a veo el detalle de la noticia en detalle.php -->
            <a href="../publica/detalle.php?id=<?php echo $fila->id ?>">Ver detalle</a>
        </div>  
        <?php } ?>
        <br>
        <button><a href="../publica/index.php">Volver al menu principal</a></button>
</body>
</html>