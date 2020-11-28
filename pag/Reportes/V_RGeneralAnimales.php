
<?php
header('Content-type: text/html; charset=utf8');
session_start();
require('../../metodos/conexion.php');
require_once('../../metodos/sesionIniciada.php');
?>
<?php
ob_end_clean();
ob_start();
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition:attachment;filename=Reporte_General_Animales.xls');

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<table border="1" >
 <thead>
 	<tr><th colspan="10" style="background-color: green;color:black;"><h1> Finca las huertas</h1></th></tr>
 	<tr><th colspan="10" style="background-color: green;color:black;"><h1> Reporte general de animales</h1></th></tr>
 	
 	<tr border="1">
	 	<th>Chapa/Nombre</th>
	 	<th>Padre</th>
	 	<th>Madre</th>
	 	<th>Sexo</th>
	 	<th>Fecha de nacimiento</th>
	 	<th>Peso de nacimiento</th>
	 	<th>estado descarte</th>
	 	<th colspan="2">Descripción descarte</th>
	 	<th>¿es vaca?</th>
 	</tr>
 </thead>
 <?php 
 $categoria = $_SESSION['modulo'];
 /*(SELECT NUMEROCHAPA FROM ANIMAL WHERE IDANIMAL = ANIMAL2.IDPADRE) CHAPAPADRE,
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
					ESVACA,
					CASE WHEN (ESVACA = 1 AND SEXO = 'HEMBRA') THEN 'SI' ELSE CASE WHEN (ESVACA = 0 AND SEXO = 'HEMBRA') THEN 'NO' ELSE 'NO APLICA'END END ESVACA1 ,
					CASE WHEN (ESTADODESCARTE = 1) THEN 'SI' ELSE 'NO' END ESTADODESCARTE1 

*/
 $sql = mysqli_query($conexion, "SELECT NUMEROCHAPA, 
 										(SELECT NUMEROCHAPA FROM ANIMAL WHERE IDANIMAL = ANIMAL2.IDPADRE) CHAPAPADRE,
										(SELECT NUMEROCHAPA FROM ANIMAL WHERE IDANIMAL = ANIMAL2.IDMADRE) CHAPAMADRE,
 										SEXO, 
 										FECHANACIMIENTO, 
 										PESONACIMIENTO, 
 										DESCRIPCIONMUERTE, 
 										CASE WHEN (ESVACA = 1 AND SEXO = 'HEMBRA') THEN 'SI' ELSE CASE WHEN (ESVACA = 0 AND SEXO = 'HEMBRA') THEN 'NO' ELSE 'NO APLICA'END END ESVACA1 ,
										CASE WHEN (ESTADODESCARTE = 1) THEN 'SI' ELSE 'NO' END ESTADODESCARTE1  
 										FROM ANIMAL  ANIMAL2
 										WHERE CATEGORIA = $categoria") ;
while ($fila = mysqli_fetch_array($sql)){



?>	

 <tbody>
 	<tr>
	 	<td ><?php echo $fila['NUMEROCHAPA'] ?></td>
	 	<td><?php echo $fila['CHAPAPADRE'] ?></td>
	 	<td><?php echo $fila['CHAPAMADRE'] ?></td>
	 	<td><?php echo $fila['SEXO'] ?></td>
	 	<td><?php echo $fila['FECHANACIMIENTO'] ?></td>
	 	<td><?php echo $fila['PESONACIMIENTO'] ?> Kg</td>
	 	<?php 
	 		if($fila['ESTADODESCARTE1'] == 'SI'){
		?>
				<td  style="background-color: red; color:white;"><?php echo $fila['ESTADODESCARTE1'] ?></td>
		<?php 
	 		}else{
	 	?>
	 			<td style="background-color: green;color:white;"><?php echo $fila['ESTADODESCARTE1'] ?></td>
	 	<?php 		
	 		} 
	 	?>
	 	<td colspan="2"><?php echo $fila['DESCRIPCIONMUERTE'] ?></td> 
	 	<td><?php echo $fila['ESVACA1'] ?></td>
	 </tr>
 </tbody>
 <?php }
  ?>
</table>
</body>



