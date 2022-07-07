<?php
include("connection.php");
$con = connection();

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$username = $_POST['username'];
$password = $_POST['password'];
$rol = $_POST['rol'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$dui = $_POST['dui'];

$sql = "INSERT INTO usuarios (`nombre`, `apellidos`, `username`, `password`, `rol`, `telefono`, `email`, `dui`)
VALUES('$nombre','$apellidos','$username','$password','$rol','$telefono','$email','$dui')";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: ../user.php");
}
