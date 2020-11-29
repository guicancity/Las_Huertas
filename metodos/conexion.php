<?php 
	$servidor = "localhost";
	$base = "SISTEMALASHUERTAS";
	$usuario = "root";
	$password = "";

	$conexion = mysqli_connect($servidor, $usuario, $password) or die ("Error de conxion");
	$db = mysqli_select_db($conexion, $base) or die ("Error de base de datos");
	mysqli_query( $conexion,"SET NAMES 'utf8'");	   
 ?>