<?php require('../../metodos/conexion.php');
?>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="../../css3/materialize.css" type="text/css">	 
	
</head>
<title>ella</title>
<body>
	<?php 
	$sql = mysqli_query($conexion,"SELECT RAZONSOCIAL, DIRECCION, TELEFONO, NIT, LOGO FROM DATOSEMPRESA");
	$ejecutar = mysqli_fetch_assoc($sql);
	 ?>

	<table class="table striped">

		<tbody>
			<tr>
				<td><img src="../../img/img_001_banner.jpg" alt="" width="195px" height="135px"></td>
				<td>   </td>
				<td class="bg-info p-4"><b><?php echo $ejecutar['RAZONSOCIAL'] ?></b><br>
					<b>Dirección: </b> <?php echo $ejecutar['DIRECCION']?><br>
					<b>Telefono: </b> <?php echo $ejecutar['TELEFONO']?><br>
					<b>Nit: </b> <?php echo $ejecutar['NIT']  ?>

				</td>
			</tr>
		</tbody>
	</table>
	<?php 

	 ?>
</body>
</html>