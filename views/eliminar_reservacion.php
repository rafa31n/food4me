<?php
include '../libs/conexion.php';

session_start();
$id = $_GET['id'];
$cn = Database::connect();
$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $cn->prepare("SELECT * FROM reservaciones WHERE id_reservacion = ?");
$query->execute(array($id));
$data = $query->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver mesa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../public/css/mesas.css">
    <link rel="stylesheet" type="text/css" href="../public/css/nav.css">
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <!-- <h3 class="logo">MANTECH</h3> -->
            <ul id="menu">
                <li data-menuanchor="page1" class="logo"><a class="man" href="#page1"></a></li>
            </ul>

            <label for="toggler" class="icon"><i class="fas fa-bars"></i></label>
            <input type="checkbox" id="toggler" />
            <div class="links-wrapper active">
                <div id="fondoos" class="backdrop"></div>
                <label for="toggler" id="btncloser" class="close-btn"><i class="fas fa-times"></i></label>
                <ul id="menu" class="links">
                    <li data-menuanchor="page2"><a href="mesas.php">Mesas</a></li>
                    <li data-menuanchor="page3"><a href="../zonas/index.php">Zonas</a></li>
                    <li data-menuanchor="page3"><a href="../ver_reservaciones.php">Reservaciones</a></li>
                    <li data-menuanchor="page5"><a href="../user.php">Usuarios</a></li>
                    <a class="btn btn-danger btn-lg" href="../login/bd/logout.php" role="button">Cerrar Sesión</a>
                </ul>
            </div>
        </nav>
    </header>
    <br><br><br><br>

    <div class="contenedor">
        <h3 class="mb-4">Cancelar reservación</h3>

        <a class="btn btn-outline-secondary mb-4" href="../ver_misreservaciones.php">Regresar</a>

        <form action="../controllers/eliminar_reservacion.php" method="POST">

            <div class="mb-3">
                <?php echo '<input type="hidden" class="form-control" name="id_reservacion" id="id_reservacion" value="' . $data["id_reservacion"] . '" readonly>'; ?>
            </div>
            <h2>¿Seguro que deseas eliminar esta reservación: <?php echo $data['id_reservacion']; ?>?</h2>
            <br>
            <div class="col-12">
                <button name="btnReservar" class="btn btn-danger" type="submit">Cancelar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>