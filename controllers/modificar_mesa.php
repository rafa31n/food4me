<?php
include "../libs/conexion.php";
include "../models/Mesas.php";

if (!empty($_POST)) {
    $id = trim($_POST['id_mesa']);
    $mesa = trim($_POST['mesa']);
    $zona_mesa = trim($_POST['zona']);

    $mesa_obj = new Mesas();
    $mesa_obj->actualizar($mesa, $zona_mesa, $id);

    header('Location: ../views/mesas.php?msj=Mesa actualizada correctamentes');
}
