<?php
include "../libs/conexion.php";
include "../models/reservas.php";

$id = trim($_POST['id_reservacion']);
$estado = 2;

$mesa_obj = new Reservas();
$mesa_obj->estado($estado, $id);

//print_r($estado);
//print_r($id);

header('Location: ../ver_misreservaciones.php');
