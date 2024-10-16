<?php

require_once("../dataBase/db.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
$fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : date("Y-m-d H:i:s");
$textoInformativo = isset($_POST["textoInformativo"]) ? $_POST["textoInformativo"]: "";
$idFormulario = isset($_POST["idFormulario"]) ? $_POST["idFormulario"] : 0;

$editarFormulario = isset($_POST["editarFormulario"]) ? $_POST["editarFormulario"] : 0;

if($editarFormulario == "1"){
    $error = 0;
    if($idFormulario == 1){
        $stmt = $conx->prepare("UPDATE noticias SET titulo = ?, descripcion = ?,  textoInformativo = ?, fecha = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $titulo, $descripcion, $textoInformativo, $fecha, $id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: ../publicaNoticias/index.php");
    exit();
}


$stmt = $conx->prepare("SELECT * FROM noticias WHERE id = ?");
$stmt->bind_param("i", $id);

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
    <link rel="stylesheet" href="../style/editarNoticia.css">
</head>
<body>
    <?php foreach($resultadoFinal as $fila){ ?>
    <div>
        <form method="POST">
            <input type="hidden" value="1" name="editarFormulario">
            <input type="hidden" name="idFormulario" value="1">
            <input type="hidden" name="id" value="<?php echo $fila->id; ?>">

            <label>Agregue titulo</label>
            <input type="text" value="<?php echo $fila->titulo ?>" name="titulo" ><br>

            <label>Agregue una descrpcion</label>
            <input type="text" value="<?php echo $fila->descripcion?> " name="descripcion"><br>

            
            <label>Indique texto de la noticia</label>
            <textarea type="text" value="<?php echo $fila->textoInformativo ?>" name="textoInformativo"></textarea>
            
            <label>Agregue fecha de la noticia</label>
            <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i:s', strtotime($fila->fecha)); ?>" name="fecha"><br>

            <input type="submit" value="Editar">
        </form>
    </div>
    <?php } ?>
    <button><a href="../publicaNoticias/index.php">Volver al listado</a></button>
</body>
</html>