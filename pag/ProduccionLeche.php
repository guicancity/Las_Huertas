<?php 
session_start();
require('../metodos/conexion.php');
require_once('../metodos/sesionIniciada.php');
require_once('menu.php');
 ?>

  <!DOCTYPE html>
 <html>
 <head>
    <?php 
	include_once("../metodos/links.php");
	?>
    <title>Las huertas || Producción de leche</title>
    
</head>
 <body>
 	<div class="container">
 		<form method="POST" action="ProduccionLeche.php" onSubmit="if(!confirm('¿Desea continuar? verifique los datos antes de aceptar')){return false;}">
 			<div class="row">
 				<div class="col text-center mt-4">
 					<h3><b>Registro diario de leche</b></h3>
 				</div>
 			</div>
			 <div class="row">
			 	<div class="col-sm-1 col-lg-3 mb-5 mt-4">
			 		<label>Seleccione la fecha</label>
			 		<input type="date" class="form-control" required="" name="txtfecha">
			 	</div>
			 </div>
			 	<table class="table table-bordered">

					<thead>
						<tr>

							<th>Chapa de la vaca</th>
							<th>Cantidad (Lt)</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$sql = mysqli_query($conexion,"SELECT ANIMAL2.IDANIMAL,(SELECT ANIMAL.NUMEROCHAPA FROM ANIMAL WHERE ANIMAL.IDANIMAL = ANIMAL2.IDANIMAL) NUMEROCHAPA FROM ANIMAL ANIMAL2 WHERE CATEGORIA = 1 AND SEXO = 'HEMBRA' AND ESTADODESCARTE <> 1 AND ESVACA = 1 AND PRODUCCION = 'SI'");
								?>
								<?php
								$i = 1;
							while ($fila = mysqli_fetch_array($sql)){
								$idanimal = $fila['IDANIMAL'];
								$numeroChapa = $fila['NUMEROCHAPA'];

						 ?>
						<tr>
							<input type="hidden" class="form-control" value="<?php echo $idanimal?>" name="idAnimal<?php echo $i ?>">
							<td><input type="text" class="form-control" disabled="" value="<?php echo $numeroChapa?>"></td>
							<td><input type="number" class="form-control" value="0" name="cantidad<?php echo $i  ?>"></td>
						</tr>
						<?php $i = $i +1;	} ?>
						
					</tbody>
				</table>
				
				<div class="row">
					<div class="col text-center mb-5">
						<button class="btn btn-success btn-lg" name="insertaLeche">Insertar</button>
					</div>
				</div>
		</form>


<hr>
		<div class="row">
			<div class="col mt-5 mb-5">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Total diario (Lt)</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$sql = mysqli_query($conexion,"SELECT FECHA,SUM(CANTIDAD) CANTIDADDIA FROM PRODUCCIONLECHE GROUP BY FECHA ORDER BY FECHA DESC");
								?>
								<?php
							while ($fila = mysqli_fetch_array($sql)){
								$fecha = $fila['FECHA'];
								$cantidadDia = $fila['CANTIDADDIA'];

						 ?>
						<tr>
							<td> <?php echo $fecha ?></td>
							<td><?php echo $cantidadDia ?> Lt</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


<?php 
if(isset($_POST['insertaLeche'])){
	$totalRegistros = $i - 1 ; 
	$fecha = $_POST['txtfecha'];
	for ($r = 1 ; $r <= $totalRegistros; $r++){

		$idanimalv= $_POST['idAnimal'.$r];
		$cantidadv= $_POST['cantidad'.$r];
		$final[$r]= "('".$fecha."',".$idanimalv.", ".$cantidadv.")";
	}
	$finalfinal ="";
	for($f = 1; $f<=$totalRegistros;$f++){
		if ($f < $totalRegistros) {
			$finalfinal = $finalfinal. $final[$f].",";
		
		}else{
			$finalfinal = $finalfinal. $final[$f];
		}		
	}
	$sql1 = "SELECT * FROM PRODUCCIONLECHE WHERE FECHA = '$fecha'";
	$sqlfecha = mysqli_query($conexion,"SELECT * FROM PRODUCCIONLECHE WHERE FECHA = '$fecha'");
	$num = mysqli_num_rows($sqlfecha);
	if($num > 0){
		echo '
				<script>  
					toastr.error("la fecha '.$fecha.' ya se encuentra registrada", "Error!");
		            window.setTimeout(function(){
	        			window.open("ProduccionLeche.php","_self");
	    			}, 2000);
	      	    </script>';
	}else {
		$sql=mysqli_query($conexion,"INSERT INTO PRODUCCIONLECHE(FECHA,IDANIMAL,CANTIDAD) VALUES ". $finalfinal);	
		if($sql){
			echo '
			<script>  
				toastr.success("Registro realizado con éxito", "Correcto!");
				window.setTimeout(function(){
					window.open("ProduccionLeche.php","_self");
				}, 1000);
			</script>';
		}else{
			echo '
			<script>  
				toastr.error("Error al realizar el registro", "Error!");
				window.setTimeout(function(){
					window.open("ProduccionLeche.php","_self");
				}, 1000);
			</script>';
		}
	}

}
?>
</body>
 </html>