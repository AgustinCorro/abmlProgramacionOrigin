<?php
require_once("../panel/dataBase/db.php");

$tituloABuscar = isset($_POST["tituloABuscar"]) ? $_POST["tituloABuscar"] : "";
$filtroInput = isset($_POST["filtroInput"]) ? $_POST["filtroInput"] : 0;

if ($filtroInput == 1 && !empty($tituloABuscar)) {
    $tituloABuscar = trim($tituloABuscar);
    $tituloABuscar = "%".$tituloABuscar."%";
    $sql = "SELECT N.id, N.titulo, N.descripcion, N.imagen, N.fecha FROM noticias N WHERE titulo LIKE ? ";
    $stmt = $conx->prepare($sql);

    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $conx->error;
    }

    $stmt->bind_param("s", $tituloABuscar);
    $stmt->execute();

    $getStmtResultNews = $stmt->get_result();
    $resultadoGetStmtFinalNew = [];

    while ($filaFiltro = $getStmtResultNews->fetch_object()) {
        $resultadoGetStmtFinalNew[] = $filaFiltro;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../panel/style/listadoNoticias.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Tú ciudad!</h1>
    </header>
    <div class="container">
        <?php if (empty($resultadoGetStmtFinalNew)) { ?>
            <p>No se encontraron resultados para el título buscado.</p>
        <?php } else { ?>
            <?php foreach($resultadoGetStmtFinalNew as $filaFiltro){ ?>
                <div>
                    <h2><?php echo utf8_decode($filaFiltro->titulo) ?></h2>
                    <h4><?php echo $filaFiltro->descripcion ?></h4>
                    <img src="../panel/archivoImg/<?php echo $filaFiltro->imagen ?>">
                    <p><?php echo $filaFiltro->fecha ?></p>
                    <a href="../publica/detalle.php?id=<?php echo $filaFiltro->id ?>">Ver detalle</a>
                </div>  
            <?php } ?>
        <?php } ?>
    </div>
    <button><a href="../publica/listadoNoticias.php">Volver al listado completo</a></button>
</body>
</html>
