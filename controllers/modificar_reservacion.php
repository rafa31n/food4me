<?php
include "../libs/conexion.php";
include "../models/reservas.php";

if (!empty($_POST)) {
    $id = trim($_POST['id_reservacion']);
    $fecha_reservacion = trim($_POST['fecha-reserva']);
    $hora_inicio = trim($_POST['hora-inicio']);
    $hora_fin = trim($_POST['hora-fin']);
    $detalles = trim($_POST['detalles']);

    $mesa_obj = new Reservas();
    $mesa_obj->actualizar($fecha_reservacion, $hora_inicio, $hora_fin, $detalles, $id);

    header('Location: ../ver_misreservaciones.php');
}
