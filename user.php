<?php
include("controllers/connection.php");
$con = connection();

$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);

$sql2 = "SELECT * FROM rol";
$query2 = mysqli_query($con, $sql2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/css/nav.css">
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

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h1>Crear usuario</h1>
                <form action="controllers/insert_user.php" method="POST">
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
            <div class="col-md-8">
                <h2>Usuarios</h2>
                <div class="table-responsive">


                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered table-sm shadow">
                            <thead class="table-success table-striped">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Rol</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>DUI</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <th><?php echo $row['id_usuario'] ?></th>
                                        <th><?php echo $row['nombre'] ?></th>
                                        <th><?php echo $row['apellidos'] ?></th>
                                        <th><?php echo $row['username'] ?></th>
                                        <th><?php echo $row['password'] ?></th>
                                        <th><?php echo $row['rol'] ?></th>
                                        <th><?php echo $row['telefono'] ?></th>
                                        <th><?php echo $row['email'] ?></th>
                                        <th><?php echo $row['dui'] ?></th>
                                        <th><a href="views/update.php?id=<?php echo $row['id_usuario'] ?>" class="btn btn-info">Editar</a></th>
                                        <th><a href="controllers/delete_user.php?id=<?php echo $row['id_usuario'] ?>" class="btn btn-danger">Eliminar</a></th>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>