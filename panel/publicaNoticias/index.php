<?php
require_once("../dataBase/db.php");
require_once("../privadaUsuarios/validar.php");

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
    <div style="display: flex;">
        <?php foreach($resultadoFinal as $fila){ ?>
            <div style="width: 250px;">
                <h2><?php echo $fila->titulo ?></h2>
                <h4><?php echo $fila->descripcion ?></h4>
                <img src="../archivoImg/<?php echo $fila->imagen ?>">
                <p><?php echo $fila->fecha ?></p> 
                <!-- con el a veo el detalle de la noticia en detalle.php -->
                <!-- <a href="../publica/detalle.php?id=<?php //echo $fila->id ?>">Ver detalle</a> -->
                <!-- con el form mando por get el id de mi noticia para que en eliminar.php me tome ese id y con el delete from elimine el registro de la base de datos -->
                <form action="../eliminarNoticia/eliminar.php" method="GET">
                    <input type="hidden" value="<?php echo $fila->id ?>" name="id">
                    <input type="submit" value="Eliminar noticia">
                </form>
                <form action="../editarNoticia/editar.php" method="POST">
                    <input type="hidden" value="<?php echo $fila->id ?>" name="id">
                    <input type="hidden" value="<?php echo $fila->titulo ?>" name="titulo">
                    <input type="hidden" value="<?php echo $fila->descripcion ?>" name="descripcion">
                    <input type="hidden" value="<?php echo $fila->textoInformativo ?>" name="textoInformativo">
                    <input type="hidden" value="<?php echo $fila->fecha ?>" name="fehca">
                    <input type="submit" value="Editar noticia">
                </form>
                <button><a href="../archivoImg/formularioImg.php?id=<?php echo $fila->id ?>">Cargar imagen</a></button>
            </div>
        <?php } ?>
    </div>  
        <br>
        <button><a href="../publicaGeneral/index.php">Volver al menu principal</a></button>
</body>
</html>