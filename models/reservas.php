<?php

class Reservas
{
    public function comprobarDisponibilidad($mesa, $fecha_reservacion, $hora_inicio, $hora_fin)
    {
        $cn = Database::connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $cn->prepare("SELECT * FROM reservaciones WHERE (hora_inicio BETWEEN ? AND ? OR hora_finalizacion BETWEEN ? AND ?) AND fecha = ? AND mesa_reservada = ?;");
        $query->execute(array($hora_inicio, $hora_fin, $hora_inicio, $hora_fin, $fecha_reservacion, $mesa));
        $count = $query->rowCount();
        Database::disconnect();
        if ($count > 0) {
            return "noDisponible";
        } else {
            return "disponible";
        }
    }

    public function reserva($mesa, $usuario, $fecha, $horaInicio, $horaFin, $detalles, $estado, $fecha_creacion)
    {
        $cn = Database::connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $cn->prepare("INSERT INTO reservaciones(mesa_reservada, usuario, fecha, hora_inicio, hora_finalizacion, estado, detalles, fecha_creacion) VALUES (?,?,?,?,?,?,?,?)");
        $query->execute(array($mesa, $usuario, $fecha, $horaInicio, $horaFin, $estado, $detalles, $fecha_creacion));
        Database::disconnect();
    }

    public function actualizar($fecha_reservacion, $hora_inicio, $hora_fin, $detalles, $id)
    {
        $cn = Database::connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $cn->prepare("UPDATE reservaciones SET fecha=?, hora_inicio=?, hora_finalizacion=?, detalles=? WHERE id_reservacion=?");
        $query->execute(array($fecha_reservacion, $hora_inicio, $hora_fin, $detalles, $id));
        Database::disconnect();
    }

    public function estado($estado, $id)
    {
        $cn = Database::connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $cn->prepare("UPDATE reservaciones SET estado=? WHERE id_reservacion=?");
        $query->execute(array($estado, $id));
        Database::disconnect();
    }
}
