<?php

//baja logica = ejecutar un update como tal. una baja de base de datos que no es una eliminacion sino una modificacion. y de una logica se puede acceder pero el usuario no puede volver a verlo.
//baja fisica = se elimina un registro de la base de datos a traves de un delete.
// diferencia las fisica una vez eliminado no se puede acceder osea se pierde el registro 
// columna  booleana para ver si mi registro esta eliminado o no en el registro fisico. 

//UPDATE usuarios SET eliminado = 1 WHERE id = 22; LOGICO.
//DELETE FROM usuarios WHERE id = 22; FISICO.

require_once("../dataBase/db.php");
require_once("validar.php");
//PASO 1 PREPARA LA CONSULTA

$edad = isset($_GET["edad"]) ? $_GET["edad"] : 0;

$stmt = $conx->prepare("SELECT * FROM usuarios WHERE eliminado = 0"); //agregar el where de eliminado = 0;
//PASO 1,5
// Enteros = i
// String = s
// Decimales = d
//$stmt->bind_param("i", $edad);

//PASO 2 EJECUTAR LA CONSULTA
$stmt->execute();

//SI ESTAMOS TRABAJANDO CON UN SELECT, AL TRAER LOS VALORES DEBEMOS GUARDARLOS EN UNA VARIABLE, POSIBLEMENTE UN ARRAY.
$resultadoSTMT = $stmt->get_result();

$nuestroResultado = [];

while ($fila = $resultadoSTMT->fetch_object()){
    $nuestroResultado[] = $fila;
}

$stmt->close();
// foreach($nuestroResultado as $fila){
//     echo $fila->nombre."<br>";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/usuarios.css">
</head>
<body>

    <a href="formulario.php">Nuevo usuario</a><br>

    <!-- <form>
        <input type="number" name="edad" placeholder="Ingrese una edad">
        <input type="submit">
    </form> -->

    <h3>Tabla de mi base de datos (traidos mediante un SELECT)</h3>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Fecha de creacion</th>
                <th>Descripcion</th>
                <th>Edad</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($nuestroResultado as $fila) { ?>
                <tr>
                    <td> <?php echo $fila->id ?> </td>
                    <td> <?php echo $fila->nombre ?> </td>
                    <td> <?php echo $fila->fecha_creacion ?> </td>
                    <td> <?php echo $fila->descripcion ?> </td>
                    <td> <?php echo $fila->edad ?> </td>
                    <td>
                        <a href="formulario.php?id=<?php echo $fila->id ?>">Editar usuario</a>
                        <form action="eliminado.php" method="POST">
                            <input type="hidden" value="<?php echo $fila->id ?>" name="id">
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a class="menu "href="../publicaGeneral/index.php">Volver al menu principal</a>
</html>