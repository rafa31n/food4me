<?php
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
	<meta charset="utf-8">
	<title>Ver informacion de la Zona</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/menu.style.css">
	<link rel="stylesheet" href="css/dashboard.css">
	<link rel="stylesheet" href="../css/icomoon/style.css">
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
					<li data-menuanchor="page2"><a href="../views/mesas.php">Mesas</a></li>
					<li data-menuanchor="page3"><a href="index.php">Zonas</a></li>
					<li data-menuanchor="page3"><a href="../ver_reservaciones.php">Reservaciones</a></li>
					<li data-menuanchor="page5"><a href="../user.php">Usuarios</a></li>
					<a class="btn btn-danger btn-lg" href="../login/bd/logout.php" role="button">Cerrar Sesión</a>
				</ul>
			</div>
		</nav>
	</header>
	<br><br><br><br><br><br><br>

	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-offset-2 col-md-8">
						<h1>Mostrar información de la Zona</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-offset-2 col-md-8">
				<div class="row">
					<div class="col-md-offset-2 col-md-8">
						<a href="index.php" class="btn btn-default">Retroceder</a>
					</div>
				</div>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#ID</th>
							<th class="text-center">Nombre de la Zona</th>
							<th class="text-center">Cantidad de Mesas</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!empty($_GET)) {
							//echo $_GET['id'];
							include 'connection.php';
							$cn =  Database::connect();
							$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$query = $cn->prepare("SELECT * FROM zonas where id_zona = ?");
							$query->execute(array($_GET['id']));
							$data = $query->fetch(PDO::FETCH_ASSOC);
							echo '
	<tr>
		<td class="text-center">' . $data["id_zona"] . '</td>
		<td class="text-center">' . $data["zona"] . '</td>
		<td class="text-center">' . $data["cantidad_mesas"] . '</td>

	</tr>
';
						} else {
							echo "nada ha venido";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>