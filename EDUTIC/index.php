<?php
	include './intranet/services/LoginServicio.php';

	if (isset($_POST['username']) && isset($_POST['pass'])){
		$loginService = new LoginServicio();
		$row = $loginService->login($_POST['username'], $_POST['pass']);
		if (isset($row)) {
			session_start();
			$_SESSION["user"] = $row;
			//header('Location: ./intranet/User_Administrativo/GestionInfraestructura.php');
		}
		if ($_SESSION['user']['COD_ROL'] == '1') {
			header('Location: ./intranet/User_Super/SuperUser.php');
		}
		if ($_SESSION['user']['COD_ROL'] == '2') {
			header('Location: ./intranet/User_Directivo/userDirectivo.php');
		}
		if ($_SESSION['user']['COD_ROL'] == '3') {
			header('Location: ./intranet/User_Administrativo/GestionInfraestructura.php');
		}
		if ($_SESSION['user']['COD_ROL'] == '4') {
			header('Location: ./intranet/User_Docente/UserDocente.php');
		}
		if ($_SESSION['user']['COD_ROL'] == '5') {
			header('Location: ./intranet/User_Alumno/UserAlumno.html');
		}
		if ($_SESSION['user']['COD_ROL'] == '6') {
			header('Location: ./intranet/User_Representante/UserRepresentanteAsistencias.php');
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>EduTic</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="image" type="image/png" href="./images/logolobo.png"/>

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('./images/bg-03.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" role="form" action="index.php" method= "post">
					<span class="login100-form-logo">
						<i class="fa fa-user"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						EduTic
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Ingresar Codigo de Usuario">
						<input class="input100" type="text" name="username" placeholder="Codigo de Usuario">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Ingresar contraseña">
						<input class="input100" type="password" name="pass" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<!--<div class="selectUser">
						<p for="users" class="users1">Escoja un usuario:</p>
						<select name="rol" id="users" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
							<option value= "seleccion" disabled selected> >Tipo Usuario</option>
							<option value="./Intranet/User_Super/SuperUser.html">Super Usuario</option>
							<option value="./Intranet/User_Directivo/userDirectivo.html">Directivo</option>
							<option value="./Intranet/User_Administrativo/userAdministrativo.html">Administrativo</option>
							<option value="./Intranet/User_Docente/UserDocente.html">Docente</option>
							<option value="./Intranet/User_Alumno/UserAlumno.html">Estudiante</option>
							<option value="./Intranet/User_Representante/UserRepresentante.html">Representante</option>
						</select>
					</div>-->
					<br>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Ingresar
						</button>
					</div>

					<div class="text-center p-t-50">
						<a class="txt1 interlineado" href="./Intranet/Gestion_Password/GestionPass.html">
							¿Olvidó su contraseña?
						</a><br>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>