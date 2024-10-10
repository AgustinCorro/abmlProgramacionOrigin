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

// if($editarFormulario == "1"){
    
//     $error = 0;
//     $mensaje = "";

//     if(empty($titulo)){
//         $error = 1;
//         $mensaje = "Por favor ingrese su titulo";
//     }

//     if(empty($descripcion)){
//         $error = 1;
//         $mensaje = "Por favor ingrese la descripcion";
//     }
    
//     if(empty($fecha)){
//         $error = 1;
//         $mensaje = "Por favor ingrese su fecha";
//     }

//     if($error == 0){
//         if($idFormulario == 1){
//             $stmt = $conx->prepare("UPDATE noticias SET titulo = ?, descripcion = ?,  textoInformativo = ?, fecha = ? WHERE id = ?");
//             $stmt->bind_param("ssssi", $titulo, $descripcion, $textoInformativo, $fecha, $id);
//             $stmt->execute();
//             $stmt->close();
//         }
//     }else{
//         echo $mensaje;
//     }
//     if ($stmt->affected_rows > 0) {
//         echo "Actualización exitosa.";
//     } else {
//         echo "No se realizó ninguna actualización. Revisa los datos.";
//     }
    
//     header("Location: ../../publica/index.php");
//     exit();
// };

$stmt = $conx->prepare("SELECT * FROM noticias WHERE id = ?");
$stmt->bind_param("i", $id);

$stmt->execute();

$resultadoSTMT = $stmt->get_result();
$resultadoFinal = [];

while ($fila = $resultadoSTMT->fetch_object()){
    $resultadoFinal[] = $fila;
};

$stmt->close();
            

// if($editarFormulario == "1"){
//     $mensaje = "";
//     $stmt = $conx->prepare("UPDATE noticias SET titulo = ?, descripcion = ?,  textoInformativo = ?, fecha = ? WHERE id = ?");
//     $stmt->bind_param("ssssi", $titulo, $descripcion, $textoInformativo, $fecha, $id);

//     $stmt->execute();
//     $stmt->close();
//     header("Location: ../../publica/index.php");
//     exit();
// }
// }else{
//     echo $mensaje = "Por favor verifique estar editando los campos sin que queden exactamente igual";
// }


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
        <form method="POST">
            <input type="hidden" value="1" name="editarFormulario">
            <input type="hidden" name="idFormulario" value="1">
            <input type="hidden" name="id" value="<?php echo $fila->id; ?>">

            <label>Agregue titulo</label>
            <input type="text" value="<?php echo $fila->titulo ?>" name="titulo" ><br>

            <label>Agregue una descrpcion</label>
            <input type="text" value="<?php echo $fila->descripcion?> " name="descripcion"><br>

            
            <label>Indique texto de la noticia</label>
            <input type="text" value="<?php echo $fila->textoInformativo ?>" name="textoInformativo"><br>
            
            <label>Agregue fecha de la noticia</label>
            <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i:s', strtotime($fila->fecha)); ?>" name="fecha"><br>

            <label>Añadir imagen</label>
            <h5>añadir imagen</h5>

            <!-- <select name="categoria">
                <option value="deporte">Deportes</option>
                <option value="politica">Politica</option>
                <option value="accidentes">Accidentes</option>
                <option value="policiales">Policiales</option>
            </select> -->

            <input type="submit" value="Editar">
        </form>
    </div>
    <?php } ?>
</body>
</html>