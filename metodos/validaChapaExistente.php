<?php 

include('conexion.php');
if (!empty($_POST)) {
	$respuesta = 0;
	$numeroChapa = $_POST['txtNumeroChapa'];
	$modulo = $_POST['txtModulo'];

	$sql = "SELECT * FROM ANIMAL WHERE CATEGORIA = '$modulo' AND NUMEROCHAPA = '$numeroChapa' ";
	$ejecuta = mysqli_query($conexion, $sql);

	$row = mysqli_num_rows($ejecuta);
	if($row >0){
		$respuesta = 1;
	}

	echo $respuesta;
}

?> 