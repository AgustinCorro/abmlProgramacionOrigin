<?php
require_once("../panel/dataBase/db.php");

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$stmt = $conx->prepare("SELECT * FROM noticias WHERE id = ?");

$stmt->bind_param("s", $id);

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
            <!-- <p><?php echo $fila->fecha ?></p> -->
            <p><?php echo $fila->textoInformativo ?></p>
        </div>  
    <?php }; ?>
    <button><a href="../publica/listadoNoticias.php">Volver al listado</a></button>
</body>
</html>