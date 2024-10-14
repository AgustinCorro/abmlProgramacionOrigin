<?php
require_once("../dataBase/db.php");

//Carpeta
$carpetaASubir = "uploads/";
//nombre del archivo
$rutaFinal = $carpetaASubir . $_FILES["upload"]["name"];

$id = isset($_POST["id"]) ? $_POST["id"] : 0;

//$tamañoImagen = get_image_size($_FILES["upload"]["tmp_name"]);

// if($_FILES["upload"]["tmp_name"] > ((1024 *1024) * 10)){
//     echo "Tu imagen se excede del tamaño permitido";
//     exit();
// }

// if($mimeType !== "image/png"){
//     echo "Tu imagen no es valida";
//     exit();
// }


if(move_uploaded_file($_FILES["upload"]["tmp_name"], $rutaFinal)){
    $sql = "UPDATE noticias SET imagen = ? WHERE id = ?";

    $stmt = $conx->prepare($sql);
    $stmt->bind_param("si", $rutaFinal, $id);
    $stmt->execute();
    $stmt->close();

}else{
    echo "Error al subir el archivo seleccionado";
}

header("Location: ../publicaNoticias/index.php");
die();

?>