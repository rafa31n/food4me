<?php
include("../controllers/connection.php");
$con = connection();

$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);

$sql2 = "SELECT * FROM rol";
$query2 = mysqli_query($con, $sql2);
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
        </nav>
    </header>
    <br><br><br><br>

    <div class="contenedor">
        <br>
        <h2>Crear una cuenta</h2>
        <form action="../controllers/crear_cuenta.php" method="POST">
            <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre">
            <input type="text" class="form-control mb-3" name="apellidos" placeholder="Apellidos">
            <input type="text" class="form-control mb-3" name="username" placeholder="Username">
            <input type="password" class="form-control mb-3" name="password" placeholder="Password">
            <select name="rol" id="rol" class="form-select">
                <?php
                while ($row = mysqli_fetch_array($query2)) {
                ?>
                    <option value="<?php echo $row['id_rol'] ?>"><?php echo $row['rol'] ?></option>
                <?php
                }
                ?>
            </select><br>
            <input type="text" class="form-control mb-3" name="telefono" placeholder="Teléfono">
            <input type="text" class="form-control mb-3" name="email" placeholder="Email">
            <input type="text" minlength="9" maxlength="9" class="form-control mb-3" name="dui" placeholder="DUI">

            <input type="submit" class="btn btn-primary" placeholder="Nombre">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>