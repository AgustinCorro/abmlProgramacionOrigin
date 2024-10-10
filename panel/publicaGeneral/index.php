<?php
require_once("../privadaUsuarios/validar.php");
//front end pricipal 
//menu categorias, noticias, usuarios, cerrar sesion
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Seleccione a que direccion del sistema quiere dirigirse</h1>
        <nav>
            <ul>
                <li><a href="../archivosFiltro/agregarNoticias.php">Agregar Noticias</a></li>
                <li><a href="../archivosFiltro/agregarCategorias.php">Agregar Categorias</a></li>
                <li><a href="../privadaUsuarios/listado.php">Usuarios</a></li>
                <li><a href="">Cerrar sesion</a></li>
                <li><a href="../publicaNoticias/index.php">Listado de Noticias</a></li>
                <li><a href="../../publica/listadoNoticias.php">Noticias vista publica</a></li>
            </ul>
        </nav>
    </header>
    <main>

    </main>
</body>
</html>