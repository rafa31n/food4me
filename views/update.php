<?php
include("../controllers/connection.php");
$con = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id_usuario='$id'";
$query = mysqli_query($con, $sql);

$row = mysqli_fetch_array($query);

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
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <title>Editar usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
    <br><br><br><br><br>
    <div class="container mt-5">
        <h2>Modificar usuario</h2>
        <form action="../controllers/edit_user.php" method="POST">
            <label for="id" class="form-label">Id:</label>
            <input type="text" class="form-control mb-3" name="id" value="<?php echo $row['id_usuario']  ?>" readonly>
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control mb-3" name="nombre" value="<?php echo $row['nombre'] ?>">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" class="form-control mb-3" name="apellidos" value="<?php echo $row['apellidos'] ?>">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control mb-3" name="username" value="<?php echo $row['username'] ?>">
            <label for="rol" class="form-label">Rol:</label>
            <input type="number" min="1" max="99" class="form-control mb-3" name="rol" value="<?php echo $row['rol'] ?>">
            <label for="telefono" class="form-label">Teléfono]:</label>
            <input type="text" class="form-control mb-3" name="telefono" value="<?php echo $row['telefono'] ?>">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control mb-3" name="email" value="<?php echo $row['email'] ?>">
            <label for="dui" class="form-label">DUI:</label>
            <input type="text" minlength="9" maxlength="9" class="form-control mb-3" name="dui" value="<?php echo $row['dui'] ?>">

            <input type="submit" class="btn btn-primary btn-block" value="Actualizar">
        </form>
    </div>
</body>

</html>