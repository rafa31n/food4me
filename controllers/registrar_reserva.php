<?php
include "../libs/conexion.php";
include "../models/reservas.php";

if (!empty($_POST)) {
    date_default_timezone_set('America/El_Salvador');

    $mesa = trim($_POST['mesa']);
    $usuario = trim($_POST['username']);
    $fecha_reservacion = trim($_POST['fecha-reserva']);
    $hora_inicio = trim($_POST['hora-inicio']);
    $hora_fin = trim($_POST['hora-fin']);
    $detalles = trim($_POST['detalles']);
    $estado = 1;

    $completa = date("Y-m-d H:i:s");

    $reservas = new Reservas();
    $validacion = $reservas->comprobarDisponibilidad($mesa, $fecha_reservacion, $hora_inicio, $hora_fin);

    if ($validacion == "noDisponible") {
        header('Location: ../realizarReserva.php?msj=Ya hay una mesa reservada en ese horario.');
    } else {
        if ($validacion == "disponible") {
            $reservas->reserva($mesa, $usuario, $fecha_reservacion, $hora_inicio, $hora_fin, $detalles, $estado, $completa);
            header('Location: ../ver_misreservaciones.php?msj=Mesa guardada correctamentes');
        }
    }
}
