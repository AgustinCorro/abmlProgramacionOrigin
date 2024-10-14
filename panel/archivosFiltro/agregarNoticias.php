<?php

require_once("../dataBase/db.php");
require_once("../privadaUsuarios/validar.php");
// $id = isset($_POST["id"]) ? $_POST ["id"] : 0;
$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
$fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : date("Y-m-d H:i:s");
$textoInformativo = isset($_POST["textoInformativo"]) ? $_POST["textoInformativo"]: "";
//$imagen ;
$categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";

$idObligatorio = isset($_POST["idObligatorio"]) ? $_POST["idObligatorio"] : "0";
$idFormulario = isset($_POST["idFormulario"]) ? $_POST["idFormulario"] : "0";


if($idObligatorio == "1"){   
    $error = 0;
    $mensaje = "";

    if(empty($titulo)){
        $error = 1;
        $mensaje = "Por favor ingrese un titulo para la noticia";
    }
    if(empty($descripcion)){
        $error = 1;
        $mensaje = "Por favor ingrese una descripcion de la noticia";
    }
    if(empty($fecha)){
        $error = 1;
        $mensaje = "Por favor ingrese la fecha de la noticia";
    }
    if(empty($textoInformativo)){
        $error = 1;
        $mensaje = "Por favor ingrese el texto informativo de la noticia";
    }
    //agregar el empty de la imagen

    if(empty($categoria)){
        $error = 1;
        $mensaje = "Por favor seleccione la categoria correspondiente de la noticia";
    }

    if($error == 0){
        if($idFormulario == "1"){
            //consulta de agregar noticia
        $stmt = $conx->prepare("INSERT INTO noticias (titulo, descripcion, fecha, textoInformativo, id_categoria) VALUES (?, ?, ?, ?, ?)");
    
        $stmt->bind_param("ssssi" ,$titulo, $descripcion, $fecha, $textoInformativo, $categoria);
        $stmt->execute();
        $stmt->close(); 
        }
        header("Location: ../publicaNoticias/index.php");
        exit();
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
            <?php 
                //AGREGUE EL SELECT PARA FILTRAR POR ID_CATEGORIA EN LATABLA DE NOTICIAS, HACER EL INSERT CABIAR ESTRUCTURA DE LA TABLA Y CAMBIAR LA CONSULTA EN EL LISTADO DE NOTICIAS 
                $stmt= $conx->prepare("SELECT * FROM categorias");
                $stmt->execute();
                $result = $stmt->get_result();
                $resultFinal = [];

                while($filas = $result->fetch_object()){
                    $resultFinalGet[] = $filas;
                }
                $stmt->close();
            ?>
            <select name="categoria">
                <option value="0">Categorias</option>
                <?php foreach($resultFinalGet as $filas){  ?>
                    <option value="<?php echo $filas->id ?>" ><?php echo $filas->nombre ?></option>
                <?php } ?>
            </select>

            <input type="submit">
        </form>
        <button><a href="../publicaGeneral/index.php">Volver al menu principal</a></button>
    </div>
</body>
</html>