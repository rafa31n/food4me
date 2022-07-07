<?php
include 'libs/conexion.php';

session_start();

$cn = Database::connect();
$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $cn->prepare("SELECT * FROM reservaciones r 
INNER JOIN mesas m ON m.id_mesa = r.mesa_reservada  
INNER JOIN zonas z ON z.id_zona = m.zona 
INNER JOIN usuarios u ON u.id_usuario = r.usuario WHERE r.estado = 1");
$query->execute(array($_SESSION['id_usuario']));

$query2 = $cn->prepare("SELECT * FROM reservaciones r 
INNER JOIN mesas m ON m.id_mesa = r.mesa_reservada  
INNER JOIN zonas z ON z.id_zona = m.zona 
INNER JOIN usuarios u ON u.id_usuario = r.usuario WHERE r.estado = 2");
$query2->execute(array($_SESSION['id_usuario']));
Database::disconnect();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Food4me</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <script src="https://kit.fontawesome.com/81c2c05f29.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <ul id="menu">
                <li data-menuanchor="page1" class="logo"><a class="man" href="#page1"></a></li>
            </ul>

            <label for="toggler" class="icon"><i class="fas fa-bars"></i></label>
            <input type="checkbox" id="toggler" />
            <div class="links-wrapper active">
                <div id="fondoos" class="backdrop"></div>
                <label for="toggler" id="btncloser" class="close-btn"><i class="fas fa-times"></i></label>
                <ul id="menu" class="links">
                    <li data-menuanchor="page2"><a href="views/mesas.php">Mesas</a></li>
                    <li data-menuanchor="page3"><a href="zonas/index.php">Zonas</a></li>
                    <li data-menuanchor="page3"><a href="ver_reservaciones.php">Reservaciones</a></li>
                    <li data-menuanchor="page5"><a href="user.php">Usuarios</a></li>
                    <a class="btn btn-danger btn-lg" href="login/bd/logout.php" role="button">Cerrar Sesión</a>
                </ul>
            </div>
        </nav>
    </header>
    <br><br><br><br>

    <div class="contenedor">
        <?php
        # si hay un mensaje, mostrarlo
        if (isset($_GET["msj"])) { ?>
            <div id="alert" class="alert alert-info alert-dismissible fade show" role="alert">
                <?php echo $_GET["msj"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <h2>Reservaciones activas</h2>

        <div class="reservacion">
            <?php
            foreach ($query as $r) {
            ?>
                <form>
                    <label class="form-select label">Mesa reservada:</label>
                    <label class="form-select"><?php echo $r['mesa']; ?></label><br>
                    <label class="form-select label">Zona de la mesa:</label>
                    <label class="form-select"><?php echo $r['zona']; ?></label><br>
                    <label class="form-select label">Usuario que reservo:</label>
                    <label class="form-select"><?php echo $r['usuario']; ?></label><br>
                    <label class="form-select label">Fecha:</label>
                    <label class="form-select"><?php echo $r['fecha']; ?></label><br>
                    <label class="form-select label">Hora inicio:</label>
                    <label class="form-select"><?php echo $r['hora_inicio']; ?></label><br>
                    <label class="form-select label">Hora finalización:</label>
                    <label class="form-select"><?php echo $r['hora_finalizacion']; ?></label><br>
                    <label class="form-select label">Detalles:</label>
                    <label class="form-select"><?php echo $r['detalles']; ?></label><br>
                    <label class="form-select label">Fecha de creación:</label>
                    <label class="form-select"><?php echo $r['fecha_creacion']; ?></label><br>

                    <?php
                    echo '                               							
                        <a href="views/modificar_reservacion.php?id=' . $r['id_reservacion'] . '" class="btn btn-success">Modificar</a>
                        <a href="views/eliminar_reservacion.php?id=' . $r['id_reservacion'] . '" class="btn btn-danger">Cancelar</a>
                        ';
                    ?>
                </form>
            <?php } ?>
        </div>

        <h2>Reservaciones canceladas</h2>

        <div class="reservacion-c">
            <?php
            foreach ($query2 as $r) {
            ?>
                <form>
                    <label class="form-select label">Mesa reservada:</label>
                    <label class="form-select"><?php echo $r['mesa']; ?></label><br>
                    <label class="form-select label">Zona de la mesa:</label>
                    <label class="form-select"><?php echo $r['zona']; ?></label><br>
                    <label class="form-select label">Usuario que reservo:</label>
                    <label class="form-select"><?php echo $r['usuario']; ?></label><br>
                    <label class="form-select label">Fecha:</label>
                    <label class="form-select"><?php echo $r['fecha']; ?></label><br>
                    <label class="form-select label">Hora inicio:</label>
                    <label class="form-select"><?php echo $r['hora_inicio']; ?></label><br>
                    <label class="form-select label">Hora finalización:</label>
                    <label class="form-select"><?php echo $r['hora_finalizacion']; ?></label><br>
                    <label class="form-select label">Detalles:</label>
                    <label class="form-select"><?php echo $r['detalles']; ?></label><br>
                    <label class="form-select label">Fecha de creación:</label>
                    <label class="form-select"><?php echo $r['fecha_creacion']; ?></label><br>
                </form>
            <?php } ?>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>