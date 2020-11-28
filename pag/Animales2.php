<?php 
date_default_timezone_set('America/Bogota');

session_start();
require_once('../metodos/sesionIniciada.php');
require('../metodos/conexion.php');
require_once('menu.php');

?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	include_once("../metodos/links.php");
	?>
	<title>Las Huertas | Animales</title>
	<script>
		$(function(){
var contenido = '';

		contenido += '<tr>';
		contenido += '<td> Jeisson</td>';
		contenido += '<td> Fernando</td>';
		contenido +=' <tr>';
		contenido += '<tr>';
		contenido += '<td> Luis</td>';
		contenido += '<td> Guevara</td>';
		contenido +=' <tr>';
		
		$('#animalesActivos').append(contenido);
		$('#animalesActivos').show('fast');


		});
		

	</script>

</head>
<body>
<div class="container-fluid">

	<div class="row">
			<div class="col text-center mt-4">
				<h3><b>Registro total de animales por especie</b></h3>
			</div>
		</div>
	



	<table class="table table-striped table-bordered" id="animalesActivos">
	<th>CHAPA/NOMBRE</th>
					<th>PADRE</th>
					<th>MADRE</th>
					<th>SEXO</th>
					<th>FECHA DE NACIMIENTO</th>
					<th>PESO DE NACIMIENTO</th>
					<th>ESTADO DESCARTE</th>
					<th>DESCRIPCIÓN MUERTE</th>
					<?php if ($_SESSION['modulo'] == 1){
						echo'<th>¿ES VACA?</th>';
					}						
					?>
					<th>¿EN PRODUCCIÓN?</th>
					
					<th class="text-center">ACTUALIZAR/PRODUCCIÓN</th>
					<th>HISTORIAL</th>
					<th>ELIMINAR</th>
		
	</table>
</div>

	

</body>
</html>