<?php
require_once("../dataBase/db.php");
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
        header("Location: ../privadaUsuarios/listado.php");// cambie ruta sacar ../
        exit();
    }
}



//vardump ver que valor me devuelve una variable o un resultado
//var_dump($usuario);

?>


<form method="POST">
    <input type="email" name="email" placeholder="Inrese su mail" required>
    <input type="password" name="password" placeholder="Ingrese su contraseña" required>
    <input type="submit">
</form>