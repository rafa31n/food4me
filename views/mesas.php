<?php
include '../libs/conexion.php';

$cn = Database::connect();
$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $cn->prepare("SELECT * FROM zonas");
$query->execute();
$mesas = $cn->prepare("SELECT * FROM mesas m INNER JOIN zonas z ON m.zona = z.id_zona ORDER BY m.id_mesa");
$mesas->execute();
Database::disconnect();

session_start();

//Si nadie inció sesión vuelve a la pag de Login
if ($_SESSION["s_usuario"] === null) {
    header("Location: ../index.html");
} else {
    if ($_SESSION["s_idRol"] != 1) {
        header("Location: ../pagExtras.php");
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../public/css/mesas.css">
    <link rel="stylesheet" type="text/css" href="../public/css/index.css">
    <link rel="stylesheet" type="text/css" href="../public/css/nav.css">
    <link rel="stylesheet" type="text/css" href="../public/css/footer.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <script src="https://kit.fontawesome.com/81c2c05f29.js" crossorigin="anonymous"></script>
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

        <h3 class="mb-4">Mesas</h3>

        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nueva mesa</button>

        <?php
        # si hay un mensaje, mostrarlo
        if (isset($_GET["msj"])) { ?>
            <div id="alert" class="alert alert-info alert-dismissible fade show" role="alert">
                <?php echo $_GET["msj"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>


        <div class="table-responsive">
            <table id="actividades" class="table table-striped table-hover table-bordered table-sm shadow">
                <thead>
                    <tr class="table-dark">
                        <th>#</th>
                        <th>Nombre de mesa</th>
                        <th>Zona en la que se encuentra</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($mesas as $mesa) {
                    ?>
                        <tr>
                            <td><?php echo $mesa['id_mesa']; ?></td>
                            <td><?php echo $mesa['mesa']; ?></td>
                            <td><?php echo $mesa['zona']; ?></td>
                            <td>
                                <div class="d-grid gap-1 d-md-flex">
                                    <?php
                                    echo '                               							
                                    <a href="ver_mesa.php?id=' . $mesa["id_mesa"] . '" class="btn btn-primary">Ver</a>
                                    <a href="modificar_mesa.php?id=' . $mesa["id_mesa"] . '" class="btn btn-success">Modificar</a>
                                    <a href="eliminar_mesa.php?id=' . $mesa["id_mesa"] . '" class="btn btn-danger">Eliminar</a>
                                    ';
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo">Registra nueva mesa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../controllers/registrar_mesa.php" method="POST">
                        <div class="mb-3">
                            <label for="mesa" class="col-form-label">Nombre de la mesa:</label>
                            <input type="text" name="mesa" id="mesa" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="zona" class="col-form-label">Zona de la mesa:</label>
                            <select name="zona" id="zona" class="form-select">
                                <?php
                                foreach ($query as $row) {
                                ?>
                                    <option value="<?php echo $row['id_zona']; ?>"><?php echo $row['zona']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>