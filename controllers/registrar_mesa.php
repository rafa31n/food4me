<?php
include "../libs/conexion.php";
include "../models/Mesas.php";

if (!empty($_POST)) {
    $mesa = trim($_POST['mesa']);
    $zona_mesa = trim($_POST['zona']);

    $mesa_obj = new Mesas();
    $mesa_obj->store($mesa, $zona_mesa);

    header('Location: ../views/mesas.php?msj=Mesa guardada correctamentes');
}
