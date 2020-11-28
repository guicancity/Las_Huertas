
<?php
header('Content-type: text/html; charset=utf8');
session_start();
require('../../metodos/conexion.php');
require_once('../../metodos/sesionIniciada.php');

ob_end_clean();
ob_start();
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition:attachment;filename=Reporte_individual_peso.xls');
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
		$sql = mysqli_query($conexion, "SELECT PA.IDPESOANIMAL, PA.IDANIMAL, PA.FECHACONTROL, PA.PESOKG, A.NUMEROCHAPA,A.SEXO,A.IDPADRE,A.IDMADRE FROM PESOANIMAL PA INNER JOIN ANIMAL A ON PA.IDANIMAL = A.IDANIMAL WHERE PA.IDANIMAL = $idAnimal ORDER BY PA.FECHACONTROL DESC ") ;
		$num = mysqli_num_rows($sql);
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
			 				Reporte de peso del animal <b><?php echo '001' ?></b>
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
				 	<td colspan="5" class="td"><?php echo $fila['FECHACONTROL'] ?></td>
				 	<td colspan="5" class="td"><?php echo $fila['PESOKG'] ?> Kg</td>
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

