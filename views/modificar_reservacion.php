<?php
$id = $_GET['id'];
include '../libs/conexion.php';
$cn = Database::connect();
$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $cn->prepare("SELECT * FROM reservaciones WHERE id_reservacion = ?");
$query->execute(array($id));
$data = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar mesa</title>
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
        <h3 class="mb-4">Modificar reservación</h3>

        <a class="btn btn-outline-secondary mb-4" href="../ver_misreservaciones.php">Regresar</a>

        <form action="../controllers/modificar_reservacion.php" method="POST">

            <div class="mb-3">
                <?php echo '<input type="hidden" class="form-control" name="id_reservacion" id="id_reservacion" value="' . $data["id_reservacion"] . '" readonly>'; ?>
            </div>

            <div class="form-group has-validation">
                <label for="fecha-reserva" class="form-label">Ingrese la fecha de su reserva</label>
                <?php echo '<input type="date" class="form-control" name="fecha-reserva" id="fecha-reserva" value="' . $data["fecha"] . '" required>'; ?>
            </div>
            <div class="form-group has-validation">
                <label for="hora-inicio" class="form-label">Ingrese la hora de inicio de su reserva</label>
                <?php echo '<input type="time" class="form-control" name="hora-inicio" id="hora-inicio" value="' . $data["hora_inicio"] . '" required>'; ?>
            </div>
            <div class="form-group has-validation">
                <label for="hora-fin" class="form-label">Ingrese la hora de finalización de su reserva</label>
                <?php echo '<input type="time" class="form-control" name="hora-fin" id="hora-fin" value="' . $data["hora_finalizacion"] . '" required>'; ?>
            </div>

            <div class=" form-group has-validation">
                <label for="detalles" class="form-label">Ingrese los detalles de su reserva</label>
                <?php echo '<textarea name="detalles" class="form-control" id="detalles" rows="3" placeholder="Este campo es opcional.">' . $data["detalles"] . '</textarea>'; ?>
            </div><br>

            <button type="submit" class="btn btn-success">Guardar</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>