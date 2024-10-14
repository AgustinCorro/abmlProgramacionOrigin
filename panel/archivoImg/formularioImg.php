<?php
require_once("../dataBase/db.php");
$id = isset($_GET["id"]) ? $_GET["id"] : 0;

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
</head>
<body>
    <?php foreach($resultadoFinal as $fila){ ?>
    <form action="subir.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $fila->id ?>" name="id">
        <input type="file" name="upload" accept=".png">
        <input type="submit" value="Subir">
    </form>
    <?php } ?>
</body>
</html>