<?php 
	session_start();
	require_once('conexion.php');

	if (isset($_POST['txtemail'])) {
		$txtemail = addslashes($_POST['txtemail']); 
		$txtpassword = addslashes($_POST['txtpassword']); 
		$consulta = "SELECT PERSONAS.NUMERODOCUMENTO, PERSONAS.NOMBRE1,PERSONAS.NOMBRE2,PERSONAS.APELLIDO1,PERSONAS.APELLIDO2, USUARIO.IDUSUARIO, USUARIO.NOMBRE,USUARIO.PASSWORD,USUARIO.ROL,USUARIO.NOMBREROL FROM PERSONAS INNER JOIN USUARIO ON USUARIO.IDPERSONA =PERSONAS.IDPERSONAS WHERE NOMBRE='".$txtemail."' AND PASSWORD= BINARY'".$txtpassword."'";


		$sql = mysqli_query($conexion, $consulta);
		$res = mysqli_fetch_assoc($sql);
		$num = mysqli_num_rows($sql);
		

		if ($num != 0) {
			echo ' <script>window.open("../pag/Modulo.php","_self");</script>';
		  	//header('Location: ../pag/Modulo.php');
		  	$_SESSION['idUsuario']=$res['IDUSUARIO'];
			$_SESSION['numeroDocumento']=$res['NUMERODOCUMENTO'];
			$_SESSION['nombre1']=$res['NOMBRE1'];
			$_SESSION['nombre2']=$res['NOMBRE2'];
			$_SESSION['apellido1']=$res['APELLIDO1'];
	 		$_SESSION['apellido2']=$res['APELLIDO2'];
			$_SESSION['correo']=$res['NOMBRE'];
			$_SESSION['rol']=$res['ROL'];
			$_SESSION['nombreRol']=$res['NOMBREROL'];
			$_SESSION['iniciosesion'] = 1;
			$_SESSION['modulo']= 2;
		  } else {
		  	$_SESSION['Error']="¡Correo o contraseña incorrecto!";
		  	echo ' <script>window.open("../pag/Login.php","_self");</script>';
		  }
	}
 ?>