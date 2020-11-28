<?php
session_start();
require('../metodos/conexion.php');
require_once('../metodos/sesionIniciada.php');
?>

<!DOCTYPE html>
<html>

<head>
	<?php 
	include_once("../metodos/links.php");
	?>	
	<title>Las huertas || Módulo</title>
</head>
<body>
	<div class="row ">
		<div class="col ">
			
			

			<form method="POST" action="Modulo.php">
				<div class="row ">
					<div class="col text-center mt-4 mb-5">
						<h3><b>Seleccione el módulo a cargar</b> </h3>
					</div>
				</div>
				<div class="row justify-content-md-center">
					<div class="col-md-3 mb-5">
						<select name="selModulo" class="custom-select">	
							<option value="1">Vacas</option>
							<option value="2">Ovejas</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col text-center">
						<button class="btn color-teal-button btn-lg text-white" name="btnIngresar">Ingresar <i class="fa fa-arrow-right"></i></button>
					</div>
				</div>			
			</form>
		</div>
	</div>

	
	


	<?php
	if(isset($_POST['btnIngresar'])) {	
		$valorModulo =0;
		if(empty($_POST['selModulo'])){
			$valorModulo = 1;
		}else{
			$valorModulo = $_POST['selModulo'];
		}

		$_SESSION['modulo']= $valorModulo;
		echo "<script>window.open('Animales.php','_self')</script>";
	} ?>


	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

	<script type="text/javascript" src="../css/fontawesome/js/all.js"></script>
</body>
</html>