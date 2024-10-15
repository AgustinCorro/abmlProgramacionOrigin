<?php
require_once("../panel/dataBase/db.php");
$filtro = isset($_POST["filtro"]) ? $_POST["filtro"] : "";

$idCategoria = isset($_POST["idCategoria"]) ? $_POST["idCategoria"] : 0;

//var_dump($_POST);

if($filtro == 0 || $idCategoria == 0){
    $stmt = $conx->prepare("SELECT * FROM noticias");
    $stmt->execute();
    
    
    $resultadoSTMT = $stmt->get_result();
    $resultadoFinal = [];
    
    while ($fila = $resultadoSTMT->fetch_object()){
        $resultadoFinal[] = $fila;
    };
    
    $stmt->close();
}else{
    $sql = "SELECT N.id, N.titulo, N.imagen, N.fecha, N.descripcion FROM noticias N INNER JOIN categorias C ON (N.id_categoria = C.id) WHERE C.id = ?";
    //$sql = "SELECT N.id, N.titulo, N.fecha, N.descripcion FROM noticias_categorias NC INNER JOIN noticias N ON (N.id = NC.id_noticia) INNER JOIN categorias C ON (C.id = NC.id_categoria) WHERE C.id = ?";

    $stmt = $conx->prepare($sql);
    $stmt->bind_param("i",$idCategoria);
    $stmt->execute();

    $getStmtResult = $stmt->get_result();
    $resultadoGetStmtFinal = [];

    while($filaFiltro = $getStmtResult->fetch_object()){
        $resultadoGetStmtFinal[] = $filaFiltro;
    }

    $stmt->close();
}
////// otra consulta select

$stmt= $conx->prepare("SELECT * FROM categorias");

$stmt->execute();

$getStmt = $stmt->get_result();
$resultadoGetStmt = [];

while($fila = $getStmt->fetch_object()){
    $resultadoGetStmt[] = $fila;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../panel/style/listadoNoticias.css">
</head>
<body>
    <header>
        <h1>Tú ciudad!</h1>
    </header>
    <nav>
        <form action="listadoNoticias.php" method="POST">
            <h4>Filtrar noticias</h4>
            <input type="hidden" name="filtro" value="1">
            <select name="idCategoria">
                <option value="0">Mostrar todos</option>
                <?php foreach($resultadoGetStmt as $fila){  ?>
                    <option <?php echo ($fila->id == $idCategoria) ? 'selected' : '' ?> value="<?php echo $fila->id ?>"><?php echo $fila->nombre ?></option>
                <?php } ?>
            </select>
            <input class="button" type="submit" value="Filtrar">
        </form>
    </nav>
    <div class="container">
        <?php if($filtro == 0 || $idCategoria == 0){ ?>
            <?php foreach($resultadoFinal as $fila){ ?>
                <div>
                    <h2><?php echo $fila->titulo ?></h2>
                    <h4><?php echo $fila->descripcion ?></h4>
                    <img src="../panel/archivoImg/<?php echo $fila->imagen ?>">
                    <p><?php echo $fila->fecha ?></p> 
                    <!-- con el a veo el detalle de la noticia en detalle.php -->
                    <a href="../publica/detalle.php?id=<?php echo $fila->id ?>">Ver detalle</a>
                </div>  
            <?php } ?>
        <?php } else { ?>
            <?php foreach($resultadoGetStmtFinal as $filaFiltro){ ?>  
                <div>
                    <h2><?php echo $filaFiltro->titulo ?></h2>
                    <h4><?php echo $filaFiltro->descripcion ?></h4>
                    <img src="../panel/archivoImg/<?php echo $filaFiltro->imagen ?>">
                    <p><?php echo $filaFiltro->fecha ?></p> 
                    <!-- con el a veo el detalle de la noticia en detalle.php -->
                    <a href="../publica/detalle.php?id=<?php echo $filaFiltro->id ?>">Ver detalle</a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <button><a href="../publica/index.php">Volver al menu principal</a></button>
</body>
</html>