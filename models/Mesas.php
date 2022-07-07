<?php

class Mesas
{
    public function store($mesa, $zona)
    {
        $cn = Database::connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $cn->prepare("INSERT INTO mesas(mesa, zona) VALUES(?, ?)");
        $query->execute(array($mesa, $zona));
        Database::disconnect();
    }

    public function actualizar($mesa, $zona, $id)
    {
        $cn = Database::connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $cn->prepare("UPDATE mesas SET mesa=?, zona=? WHERE id_mesa=?");
        $query->execute(array($mesa, $zona, $id));
        Database::disconnect();
    }

    public function eliminar($id)
    {
        $cn = Database::connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $cn->prepare("DELETE FROM mesas WHERE id_mesa = ?");
        $query->execute(array($id));
        Database::disconnect();
    }
}
