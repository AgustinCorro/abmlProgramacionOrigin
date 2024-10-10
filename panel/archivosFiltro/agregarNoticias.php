<?php

require_once("../dataBase/db.php");
require_once("../privadaUsuarios/validar.php");
// $id = isset($_POST["id"]) ? $_POST ["id"] : 0;
$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
$fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : date("Y-m-d H:i:s");
$textoInformativo = isset($_POST["textoInformativo"]) ? $_POST["textoInformativo"]: "";
//$imagen ;
//$categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";

$idObligatorio = isset($_POST["idObligatorio"]) ? $_POST["idObligatorio"] : "0";
$idFormulario = isset($_POST["idFormulario"]) ? $_POST["idFormulario"] : "0";


if($idObligatorio == "1"){   
    $error = 0;

    if($error == 0){
        if($idFormulario == "1"){
            //consulta de agregar noticia
        $stmt = $conx->prepare("INSERT INTO noticias (titulo, descripcion, fecha, textoInformativo) VALUES (?, ?, ?, ?)");
    
        $stmt->bind_param("ssss" ,$titulo, $descripcion, $fecha, $textoInformativo);
        $stmt->execute();
        $stmt->close(); 
        }
        header("Location: ../publicaNoticias/index.php");
        exit();
    }
}


//TERMINA ETIQUETA DE PHP
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Agregue una nueva noticia</p>
    <div>
        <form action="agregarNoticias.php" method="POST">
            <input type="hidden" name="idObligatorio" value="1">
            <input type="hidden"  name="idFormulario" value="1">
            <input type="hidden" name="id" value="1">

            <label>Agregue titulo</label>
            <input type="text" placeholder="Titulo" name="titulo"><br>

            <label>Agregue una descrpcion</label>
            <input type="text" placeholder="Descricion" name="descripcion"><br>

            <label>Agregue fecha de la noticia</label>
            <input type="datetime-local" placeholder="Fecha" name="fecha"><br>

            <label>Indique texto de la noticia</label>
            <input type="text" placeholder="Texto" name="textoInformativo"><br>
            
            <label>Añadir imagen</label>
            <h5>añadir imagen</h5>

            <!-- <select name="categoria">
                <option value="deporte">Deportes</option>
                <option value="politica">Politica</option>
                <option value="accidentes">Accidentes</option>
                <option value="policiales">Policiales</option>
            </select> -->

            <input type="submit">
        </form>
        <button><a href="../publicaGeneral/index.php">Volver al menu principal</a></button>
    </div>
</body>
</html>