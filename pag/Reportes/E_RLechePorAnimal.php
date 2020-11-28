
<?php
header('Content-type: text/html; charset=utf8');
session_start();
require('../../metodos/conexion.php');
require_once('../../metodos/sesionIniciada.php');

ob_end_clean();
ob_start();
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition:attachment;filename=Reporte_individual_leche.xls');
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
    	.td{
    		font-size: 20px;
    		text-align: right;
    	}
    	.th{
    	font-size: 28px;
    		text-align: center;	
    	}
    </style>
</head>
<body>
	<?php
		$categoria = $_SESSION['modulo'];
		$idAnimal = $_GET['HistorialAnimal'];
		$sql2 = mysqli_query($conexion,"SELECT MAX(A.NUMEROCHAPA) CHAPA FROM PRODUCCIONLECHE PL INNER JOIN ANIMAL A ON PL.IDANIMAL = A.IDANIMAL WHERE PL.IDANIMAL = 4 ORDER BY PL.FECHA;");
		$sql = mysqli_query($conexion, "SELECT A.NUMEROCHAPA, PL.FECHA, PL.CANTIDAD FROM PRODUCCIONLECHE PL INNER JOIN ANIMAL A ON PL.IDANIMAL = A.IDANIMAL WHERE PL.IDANIMAL = $idAnimal ORDER BY PL.FECHA DESC ") ;
		$num = mysqli_num_rows($sql);
		$ejecuta = mysqli_fetch_assoc($sql2);
		if ($num == 0) {
	?>
			<table>
				 <tbody>
				 	<tr>
					 	<th colspan="5" style="font-size: 50px; color: red;" >NO SE ENCUENTRÓ NINGÚN REGISTRO</th>
					 </tr>
				 </tbody>
			</table>
	<?php 
	 	}else{
	 ?>
			<table border="1" >
			 <thead>
			 	<tr>
			 		<th colspan="10">
			 			<h1> Finca las huertas</h1>
			 		</th>
			 	</tr>
			 	<tr>
			 		<th colspan="10">
			 			<h2> 
			 				Reporte de peso de leche para el animal: <b><?php echo $ejecuta['CHAPA'] ?></b>
			 			</h2>
			 		</th>
			 	</tr>
			 	
			 	<tr border="1">
				 	<th colspan="5" class="th">Fecha de control</th>
				 	<th colspan="5" class="th">Peso</th>
			 	</tr>
			 </thead>
 	<?php 
 		while ($fila = mysqli_fetch_array($sql)){
	?>	
			 <tbody>
			 	<tr>
				 	<td colspan="5" class="td"><?php echo $fila['FECHA'] ?></td>
				 	<td colspan="5" class="td"><?php echo $fila['CANTIDAD'] ?> Lt</td>
				 </tr>
			 </tbody>
 	<?php 
 		}
 	?>
			</table>


	<?php 
		}
	?>
</body>
</html>

