<?php
session_start();

//Si nadie inció sesión vuelve a la pag de Login
if ($_SESSION["s_usuario"] === null) {
	header("Location: index.html");
} else {
	if ($_SESSION["s_idRol"] != 2) {
		session_destroy();
		header("Location: index.html");
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Food4Me</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	<script src="https://kit.fontawesome.com/81c2c05f29.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="public/css/index.css">
	<link rel="stylesheet" type="text/css" href="public/css/nav.css">
	<link rel="stylesheet" type="text/css" href="public/css/footer.css">
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
					<li data-menuanchor="page1"><a href="pagExtras.php">Inicio</a></li>
					<li data-menuanchor="page2"><a href="realizarReserva.php">Reservar</a></li>
					<a class="btn btn-danger btn-lg" href="login/bd/logout.php" role="button">Cerrar Sesión</a>
				</ul>
			</div>
		</nav>
	</header>

	<div class="Todo">
		<div class="mision-vision" id="conocenos">
			<div class="title">
				<h1>Bienvenid@ <?php echo $_SESSION["s_usuario"]; ?></h1>
				<h1>Conoce más de nosotros</h1>
			</div>

			<div class="container-cards">
				<div class="card">
					<h4>Misión</h4>
					<div class="cambiar">
						<a href="#modal1" class="vermodal" data-toggle="modal">
							<div class="btn">
								Ver más
							</div>
						</a>
					</div>
				</div>

				<div class="card">
					<h4>Visión</h4>
					<div class="cambiar">
						<a href="#modal2" class="vermodal" data-toggle="modal">
							<div class="btn">
								Ver más
							</div>
						</a>
					</div>
				</div>

			</div>
		</div>


		<div class="contact">
			<h1 class="title">Contáctanos</h1>
			<h2 class="title2">Envíanos un comentario</h2>
			<form class="form">
				<div>
					<label for="nombre" class="form-label">Nombre</label>
					<input type="text" name="nombre" id="" class="input form-control">
				</div>

				<div>
					<label for="apellido" class="form-label">Apellido</label>
					<input type="text" name="apellido" id="" class="input form-control">
				</div>

				<div>
					<label for="email" class="form-label">Email</label>
					<input type="text" name="email" id="" class="input form-control">
				</div>

				<div>
					<label for="contrasena" class="form-label">Número de teléfono</label>
					<input type="number" id="Nombre" min="1" name="nombre" placeholder="(+503)" required class="input form-control">
				</div>
				<div>
					<label for="apellido" class="form-label">Opiniones / sugerencias</label>
					<textarea class="input form-control"></textarea>
				</div>
				<div>
					<input type="submit" value="Enviar" name="Enviar" class="btn">
				</div>
			</form>
		</div>
	</div>



	<!-- MODALS -->
	<!-- Cambiar Nombre -->
	<div class="modals">
		<div class="awesome-modal" id="modal1"><a class="close-icon" href="#close"></a>
			<h1 class="title">Nuestra misión</h1>
			<p>Somos una empresa dedicada a brindar momentos inolvidables y servicios gastronómicos de alta calidad; ponemos todo nuestro “amor” y máximo empeño en beneficio de nuestros clientes; desarrollamos nuestro servicio a partir de los talentos y los valores de nuestros colaboradores, somos una empresa que día a día lucha por desarrollar mejores condiciones laborales y un mejor nivel de vida para nuestros colaboradores y sus familias, en beneficio de la organización. </p>
		</div>
	</div>
	<!-- Compartir -->
	<div class="modals">
		<div class="awesome-modal" id="modal2"><a class="close-icon" href="#close"></a>
			<h1 class="title">Nuestra visión</h1>
			<p>Ser reconocidos por brindar a nuestros clientes sensaciones agradables y momentos felices. Posicionarnos en el corazón de las familias y de todos los que nos visitan. Contribuir y aportar nuestro granito de arena, para generar un El Salvador feliz y en paz; que brinde un mejor futuro a nuestras próximas generaciones.</p>
		</div>
	</div>

	<!-- FOOTER -->
	<div class="footer-contenedor">
		<div class="social-media">
			<nav>
				<a href="#">
					<img src="https://i.postimg.cc/SxprfYTY/facebook.png" alt="Facebook">
				</a>
				<a href="#">
					<img src="https://i.postimg.cc/W4NwQLP2/instagram.png" alt="Instagram">
				</a>
				<a href="#">
					<img src="https://i.postimg.cc/s2T4z6V5/youtube.png" alt="YouTube">
				</a>
				<a href="#">
					<img src="https://i.postimg.cc/vZLvq8kq/pinterest.png" alt="Pinterest">
				</a>
			</nav>
		</div>
		<br>
		<div class="copyright">
			<p>Food4me Restaurante</p>
			<p>© copyright 2022</p>
			<p>Derechos Reservados UDB.</p>
		</div>
		<br>
		<a class="top" href="#top"><img src="https://i.postimg.cc/nrDLzgZg/arrow-up.png" alt="Top"></a>
	</div>
</body>

</html>