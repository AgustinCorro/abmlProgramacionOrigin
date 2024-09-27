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
        <form action="index.php" method="POST">
            <label>Agregue titulo</label>
            <input type="text" placeholder="Titulo" name="titulo"><br>

            <label>Agregue una descrpcion</label>
            <input type="text" placeholder="Descricion" name="descripcion"><br>

            <label>Agregue fecha de la noticia</label>
            <input type="text" placeholder="Fecha" name="fecha"><br>

            <label>Indique texto de la noticia</label>
            <input type="text" placeholder="Texto" name="texto"><br>
            
            <label>Añadir imagen</label>
            <h5>añadir imagen</h5>
        </form>
    </div>
</body>
</html>