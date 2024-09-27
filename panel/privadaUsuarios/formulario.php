<?php

//si estamos trabajando con los mismo datos es preferible tener el insert y el update en el mismo archivo, con datos diferentes ya no porque van a tener diferentes funcionalidades

require_once("../dataBase/db.php");
require_once("validar.php");

$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
$fecha_creacion = isset($_POST["fecha_creacion"]) ? $_POST["fecha_creacion"] : date("Y-m-d H:i:s");
$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
$edad = isset($_POST["edad"]) ? $_POST["edad"] : 0;
$envio_formulario = isset($_POST["envio_formulario"]) ? $_POST["envio_formulario"] : 0;

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$idFormulario = isset($_POST["idFormulario"]) ? $_POST["idFormulario"] : "";


if($envio_formulario == "1"){
    
    $error = 0;
    $mensaje = "";

    if(empty($nombre)){
        $error = 1;
        $mensaje = "Por favor ingrese su nombre";
    }

    if(empty($fecha_creacion)){
        $error = 1;
        $mensaje = "Por favor ingrese la fecha de creacion";
    }
    
    if(empty($descripcion)){
        $error = 1;
        $mensaje = "Por favor ingrese su descripcion";
    }

    if(empty($edad)){
        $error = 1;
        $mensaje = "Por favor ingrese su edad";
    }

    if($error == 0){
        if($idFormulario == 0){
            $sql = "INSERT INTO usuarios (nombre, fecha_creacion, descripcion, edad)";
            $sql.= "VALUES (?, ?, ?, ?) "; 
            //importamos el sql como parametro para que no quede tan larga la consulta dentro del prepare
            $stmt = $conx->prepare($sql);
            $stmt->bind_param("sssi", $nombre, $fecha_creacion, $descripcion, $edad );
            $stmt->execute();
            $stmt->close();
        }else{
            $sql = "UPDATE usuarios SET nombre = ?, descripcion = ?, edad = ? WHERE id = ?";

            $stmt = $conx->prepare($sql);
            $stmt->bind_param("ssii", $nombre, $descripcion, $edad, $id);
            $stmt->execute();
            $stmt->close();
        };
        header("Location: listado.php");
        exit();
    }else{
        echo $mensaje;
    };
};

//ventaja trabajar con un solo archivo para tener menos errores, la princ desventajada trabajando con mas de un archivo es mantener mas de un archivo. otra desventaja es que se complejisa el codigo al haber tanto codigo.
//trabajar con mas de un archivo es cuando tenes que trabajar con mas de un archivo diferente 


//MODIFICADO DE ABM
$sql = "SELECT * FROM usuarios WHERE id = ?";

$stmt = $conx->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

//variable importante para verificar si existe o no
$usuario = $resultado->fetch_object();

//trabajamos con print_r para ver si esta bien hecho el code, el echo o serviria porque estamos trayendo el fetch_object 

$stmt->close();
//no existe
if($usuario === null){
$id = 0;
  $nombre = "";  
  $fecha_creacion = date("Y-m-d H:i:s");
  $descripcion = "";
  $edad = 0;
}else{
    $id = $usuario->id;
    $nombre = $usuario->nombre;
    $fecha_creacion = $usuario->fecha_creacion;
    $descripcion = $usuario->descripcion;
    $edad = $usuario->edad;
}


?>

<form method="POST">

    <input type="hidden" value="1" name="envio_formulario">

    <input type="hidden" name="id" value="<?php  ?>">

    <label>Ingrese su nombre</label>
    <input type="text" value="<?php echo $nombre ?>" name="nombre">
    <?php if($id == 0){ ?>
        <br><label>Ingrese su fecha de creacion</label><br>
        <input type="datetime-local" value="<?php echo $fecha_creacion ?>" name="fecha_creacion">
    <?php }else{ ?>
        <input type="hidden" value="<?php echo $fecha_creacion ?>" name="fecha_creacion">
    <?php } ?>

    <br><label>Ingrese su descripcion</label><br>
    <textarea name="descripcion"><?php echo $descripcion ?></textarea>

    <br><label for="">Inrese su edad</label><br>
    <input type="number" value="<?php echo $edad ?>" name="edad">

    <input type="submit">
    
</form>