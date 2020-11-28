<?php 
include("conexion.php");
if (!empty($_POST)) {
	

	$datos = null;
	$correo = $_POST['txtCorreo'];
	$telefono = $_POST['txtTelefono'];
	$cedula = $_POST['txtCedula'];
	$sql = "SELECT U.IDUSUARIO IDUSUARIO1, 
	U.NOMBRE, 
	P.NUMERODOCUMENTO,
	P.TELEFONO
	FROM USUARIO U 
	INNER JOIN PERSONAS P 
	ON U.IDPERSONA = P.IDPERSONAS 
	WHERE U.NOMBRE = '$correo' 
	AND P.NUMERODOCUMENTO = '$cedula'  
	AND P.TELEFONO = '$telefono'";

	$ejecuta = mysqli_query($conexion,$sql);
	$ejecuta2 = mysqli_fetch_assoc($ejecuta);
	$idusuario = $ejecuta2['IDUSUARIO1'];
	$nombre = $ejecuta2['NOMBRE'];
	$row = mysqli_num_rows($ejecuta);
	if ($row > 0) {
		$datos = ['idusuario'=> $idusuario,'nombre'=>$nombre];
	}			
	echo json_encode($datos);
	
	
}
?>