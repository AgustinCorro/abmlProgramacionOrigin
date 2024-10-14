<?php

require_once("../dataBase/db.php");
require_once("../privadaUsuarios/validar.php");
$categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";

$idObligatorio = isset($_POST["idObligatorio"]) ? $_POST["idObligatorio"] : "0";
$idFormulario = isset($_POST["idFormulario"]) ? $_POST["idFormulario"] : "0";

if($idObligatorio == "1"){
    $error = 0;
    $mensaje = "";

    if(empty($categoria)){
        $error = 1;
        $mensaje = "Por favor inrgese una categoria";
    }

    if($error == 0){
        if($idFormulario == "1"){
            $stmt = $conx->prepare("INSERT INTO categorias (nombre) VALUES (?)");
            $stmt->bind_param("s", $categoria);
            $stmt->execute();
            $stmt->close();
        }
    }else{
        echo $mensaje;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="agregarCategorias.php" method="POST">
        <input type="hidden" name="idObligatorio" value="1">
        <input type="hidden"  name="idFormulario" value="1">

        <label>Ingrese una categoria</label>
        <input name="categoria" type="text" placeholder="Agregar categoria"><br>
        <input type="submit" placeholder="Agregar">
    </form>
    <button><a href="../publicaGeneral/index.php">Volver al menu principal</a></button>
</body>
</html>