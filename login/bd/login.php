<?php
session_start();
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$consulta = "SELECT usuarios.rol AS idRol, rol.rol AS rol, usuarios.id_usuario AS id_user FROM usuarios JOIN rol ON usuarios.rol = rol.id_rol WHERE username='$usuario' AND password='$password' ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if ($resultado->rowCount() >= 1) {
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuario"] = $usuario;
    $_SESSION["s_idRol"] = $data[0]["idRol"];
    $_SESSION["s_rol_descripcion"] = $data[0]["rol"];
    $_SESSION["id_usuario"] = $data[0]["id_user"];
} else {
    $_SESSION["s_usuario"] = null;
    $data = null;
}

//envio el array final el formato json a AJAX
print json_encode($data);
$conexion = null;
