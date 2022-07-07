<?php
$id = $_GET['id'];
include '../libs/conexion.php';
$cn = Database::connect();
$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $cn->prepare("SELECT * FROM mesas m INNER JOIN zonas z ON m.zona = z.id_zona WHERE m.id_mesa = ?");
$query->execute(array($id));
$data = $query->fetch(PDO::FETCH_ASSOC);

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
        <h3 class="mb-4">Ver mesa</h3>

        <a class="btn btn-outline-secondary mb-4" href="mesas.php">Regresar</a>

        <form action="../controllers/eliminar_mesa.php" method="POST">
            <div class="mb-3">
                <label for="id" class="col-form-label">#:</label>
                <?php echo '<input class="form-control" name="id_mesa" id="id_mesa" value="' . $data["id_mesa"] . '" readonly>'; ?>
            </div>

            <div class="mb-3">
                <label for="mesa" class="col-form-label">Nombre de la mesa:</label>
                <?php echo '<input class="form-control" name="mesa" id="mesa" value="' . $data["mesa"] . '" readonly>'; ?>
            </div>

            <div class="mb-3">
                <label for="zona" class="col-form-label">Zona en la que se encuentra:</label>
                <?php echo '<input class="form-control" name="zona" id="zona" value="' . $data["zona"] . '" readonly>'; ?>
            </div>

            <button class="btn btn-danger">Eliminar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>