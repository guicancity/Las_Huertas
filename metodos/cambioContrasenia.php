<?php 
include("conexion.php");
if (!empty($_POST)) {
	$datos = 0;
	$contrasenia = $_POST['txtContrasenia'];
	$idUsuario = $_POST['txtIdUsuario'];


	$sql = "UPDATE USUARIO SET PASSWORD = '$contrasenia' WHERE IDUSUARIO = $idUsuario ";
	$ejecuta = mysqli_query($conexion,$sql);

	if ($ejecuta) {
		$datos = 1;
    }
echo $datos;
}
?>