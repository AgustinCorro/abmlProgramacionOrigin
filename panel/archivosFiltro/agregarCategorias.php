<?php

require_once("../dataBase/db.php");
require_once("../privadaUsuarios/validar.php");
$categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";

$stmt = $conx->prepare("INSERT INTO categorias (nombre) VALUES (?)");
$stmt->bind_param("s", $categoria);
$stmt->execute();
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
    <form method="POST">
        <label>Ingrese una categoria</label>
        <select name="categoria">
            <option value="deporte">Deporte</option>
            <option value="policiales">Policiales</option>
            <option value="politica">Politica</option>
            <option value="cultura">Cultura</option>
            <option value="accidentes">Accidentes</option>
        </select>
        <!-- <input type="text" placeholder="Agregar categoria"><br> -->
        <input type="submit" placeholder="Agregar">
    </form>
    <button><a href="../publicaGeneral/index.php">Volver al menu principal</a></button>
</body>
</html>