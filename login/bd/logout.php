<?php
session_start();
unset($_SESSION["s_usuario"]);
unset($_SESSION["s_rol"]);
unset($_SESSION["s_rol_rol"]);
session_destroy();
header("Location: ../../index.html");
