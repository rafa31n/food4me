<?php
include "../libs/conexion.php";
include "../models/Mesas.php";

$id = trim($_POST['id_mesa']);

$mesa_obj = new Mesas();
$mesa_obj->eliminar($id);

header('Location: ../views/mesas.php?msj=Mesa eliminada correctamentes');
