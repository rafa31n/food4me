<?php

include("connection.php");
$con = connection();

$id = $_GET["id"];

$sql = "DELETE FROM usuarios WHERE id_usuario ='$id'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: ../user.php");
} else {
}
