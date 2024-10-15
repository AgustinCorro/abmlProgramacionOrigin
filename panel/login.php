<?php
require_once("../panel/dataBase/db.php");
//iniciar sesion
@session_start();

$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

if(!empty($email) && !empty($password)){
    $stmt = $conx->prepare("SELECT * FROM administradores WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
        
    $resultado = $stmt->get_result();
    
    $stmt->close();
    
    $usuario = $resultado->fetch_object();
    
    if($usuario === NULL){
        echo "Usuario o contraseña incorrecta";
    }else{
        //iniciar session
        $_SESSION["id"] = $usuario->id;  
        header("Location: ../panel/publicaGeneral/index.php");// cambie ruta sacar ../
        exit();
    }
}



//vardump ver que valor me devuelve una variable o un resultado
//var_dump($usuario);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body class="body">
    <form class="form" method="POST">
        <label>Ingrese su mail</label>
        <input type="email" name="email" placeholder="Mail" required>
        <label>Ingrese su contraseña</label>
        <input type="password" name="password" placeholder="Contraseña" required>
        <input class="button" type="submit">
    </form>
</body>
</html>
