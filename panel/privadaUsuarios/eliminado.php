<?php 
//dato controlado es cuando v a tener siempre el mismo valor. no hay peligro de inyeccion sql
// 19:38 diferencias entre include, etc.
require_once("../dataBase/db.php");
require_once("validar.php");
$id = isset($_POST["id"]) ? $_POST["id"] : 0;

//UPDATE usuarios SET eliminado = 1

$stmt = $conx->prepare("DELETE FROM usuarios WHERE id = ?");

$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: listado.php"); //redirecciona al archivo que pongamos despjues del location.
exit();
?>