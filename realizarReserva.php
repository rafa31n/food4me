<?php
include 'libs/conexion.php';

session_start();

$cn = Database::connect();
$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $cn->prepare("SELECT * FROM zonas");
$query->execute();

$query2 = $cn->prepare("SELECT * FROM mesas");
$query2->execute();
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
    <link rel="stylesheet" type="text/css" href="public/css/footer.css">
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
                    <li data-menuanchor="page1"><a href="pagExtras.php">Inicio</a></li>
                    <li data-menuanchor="page2"><a href="realizarReserva.php">Reservar</a></li>
                    <a class="btn btn-danger btn-lg" href="login/bd/logout.php" role="button">Cerrar Sesión</a>
                </ul>
            </div>
        </nav>
    </header>


    <section class="form">
        <?php
        # si hay un mensaje, mostrarlo
        if (isset($_GET["msj"])) { ?>
            <div id="alert" class="alert alert-info alert-dismissible fade show" role="alert">
                <?php echo $_GET["msj"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <h2>Formulario de reservación</h2>
        <a class="btn btn-outline-secondary mb-4" href="ver_misreservaciones.php">Ver mis reservaciones</a>

        <form action="controllers/registrar_reserva.php" method="POST">
            <div class="form-group">
                <label for="zona">Seleccione la zona que desee:</label>
                <select name="zona" class="form-control" id="zona" required>
                    <option selected>Elije una opción</option>
                    <?php
                    foreach ($query as $zona) {
                    ?>
                        <option value="<?php echo $zona['id_zona']; ?>" id="zona"><?php echo $zona['zona']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="mesa">Seleccione la mesa que desee:</label>
                <select name="mesa" class="form-control" id="mesa" required>
                    <option selected>Elije una opción</option>
                    <?php
                    foreach ($query2 as $mesa) {
                    ?>
                        <option value="<?php echo $mesa['id_mesa']; ?>" id="mesa" class="<?php echo $mesa['zona']; ?>"><?php echo $mesa['mesa']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group has-validation">
                <input name="username" type="hidden" class="form-control" id="username" value="<?php echo $_SESSION["id_usuario"]; ?>" readonly>
            </div>
            <div class="form-group has-validation">
                <label for="fecha-reserva">Ingrese la fecha de su reserva</label>
                <input name="fecha-reserva" type="date" class="form-control" id="fecha-reserva" required>
            </div>
            <div class="form-group has-validation">
                <label for="hora-inicio">Ingrese la hora de inicio de su reserva</label>
                <input name="hora-inicio" type="time" class="form-control" id="hora-inicio" required>
            </div>
            <div class="form-group has-validation">
                <label for="hora-fin">Ingrese la hora de finalización de su reserva</label>
                <input name="hora-fin" type="time" class="form-control" id="hora-fin" required>
            </div>

            <div class=" form-group has-validation">
                <label for="detalles">Ingrese los detalles de su reserva</label>
                <textarea name="detalles" class="form-control" id="detalles" rows="3" placeholder="Este campo es opcional."></textarea>
            </div>
            <div class="col-12">
                <button name="btnReservar" class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </section>
    <br>
    <script>
        document.getElementById("zona").onchange = function() {

            let selector = document.getElementById('zona');
            let value = selector[selector.selectedIndex].value;

            let nodeList = document.getElementById("mesa").querySelectorAll("option");

            nodeList.forEach(function(option) {

                if (option.classList.contains(value)) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }

            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>