<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require('../metodos/conexion.php');
require('../metodos/sesionIniciada.php');
require('menu.php');
 ?>
<!DOCTYPE html>
<html>
<head>
    <?php 
	include_once("../metodos/links.php");
	?>	
    <title>Las huertas || Historial</title>
    
</head>
<body>
<?php 
$sql = mysqli_query($conexion, "SELECT IDANIMAL, 
														  (SELECT NUMEROCHAPA FROM ANIMAL WHERE IDANIMAL = ANIMAL2.IDPADRE) CHAPAPADRE,
														  (SELECT NUMEROCHAPA FROM ANIMAL WHERE IDANIMAL = ANIMAL2.IDMADRE) CHAPAMADRE,
														  IDPADRE,
														  IDMADRE,
														  NUMEROCHAPA,
														  CATEGORIA,
														  SEXO,
														  FECHANACIMIENTO,
														  PESONACIMIENTO,
														  DESCRIPCIONMUERTE,
														  ESTADODESCARTE,
														  CASE WHEN (ESTADODESCARTE = 1) THEN 'SI' ELSE 'NO' END ESTADODESCARTE1 
												  FROM ANIMAL ANIMAL2 WHERE CATEGORIA = ".$_SESSION['modulo']." AND IDANIMAL = ". $_GET['HistorialAnimal']);
$fila = mysqli_fetch_array($sql);
 ?>	
<div class="container">
	<div class="row">
		<div class="col">
			<h2 class="text-center" ><b>Historial animal</b></h2>
		</div>
	</div>
	
	<div class="row">
		<div class="col mt-2 mb-3">
			<h4><b>Datos generales</b></h4>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<label for="">Numero de chapa</label>
			<input type="text" value="<?php echo $fila['NUMEROCHAPA']?>" disabled="" class="form-control" name="">
		</div>
		<div class="col">
			<label for="">Sexo</label>
			<input type="text" value="<?php echo $fila['SEXO']?>" disabled="" class="form-control" name="">
		</div>
	</div>
	<div class="row">
		<div class="col">
			<input type="hidden" name="txtIdAnimal">
			<label for="">Padre</label>
			<input type="text" value="<?php echo $fila['CHAPAPADRE']?>" disabled="" class="form-control" name="">
		</div>
		<div class="col">
			<label for="">Madre</label>
			<input type="text" value="<?php echo $fila['CHAPAMADRE']?>" disabled="" class="form-control" name="">
		</div>
	</div>				
	<div class="row">
		<div class="col">
			<label for="">Fecha de nacimiento</label>
			<input type="text" value="<?php echo $fila['FECHANACIMIENTO']?>"  disabled="" class="form-control" name="">
		</div>
		<div class="col">
			<label for="">Peso de nacimineto</label>
			<input type="text" value="<?php echo $fila['PESONACIMIENTO']?>"  disabled="" class="form-control" name="">
		</div>
	</div>
	<div class="row">
		<div class="col">
			<label for="">Descripción de muerte</label>
			<textarea class="form-control"  disabled=""> <?php echo $fila['DESCRIPCIONMUERTE']?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<label for="">Estado de descarte</label>
			<input type="text" value="<?php echo $fila['ESTADODESCARTE1']?>"  disabled="" class="form-control" name="">
		</div>
	</div>

		<div class="dropdown-divider mt-5"></div>

		<?php include('TablaHistorialPeso.php');

		 
			if($_SESSION['modulo'] == 1){
				include('TablaHistorialLeche.php');
			}
			include('TablaSanidadAnimal.php');

		 ?>

</div>



</body>
</html>



			
				