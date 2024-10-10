<?php
// require_once("../panel/dataBase/db.php");
require_once(__DIR__ . "/../dataBase/db.php");

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$stmt = $conx->prepare("DELETE FROM noticias WHERE id = ?");
$stmt->bind_param("i", $id);

$stmt->execute();
$stmt->close();

header("Location: ../publicaNoticias/index.php");
exit();
?>

