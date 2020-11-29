<?php 
session_start();

include('conexion.php');
$accion = $_POST['accion'];
$modulo = $_POST['modulo'];

switch ($accion) {
	case 'insertaAnimal':

	if (!empty($_POST)) {
		$idPadre = $_POST['sltIdPadre'];
		$idMadre = $_POST['sltIdMadre'];
		$numeroChapa = strtoupper($_POST['txtNumeroChapa']);
		$Sexo = $_POST['sltSexo'];
		$fechaNacimiento = $_POST['txtFechaNacimiento'];
		$pesoNacimiento = $_POST['txtPesoNacimiento'];

		if($modulo==1){
			$valorEsVaca = 0;
		}else{
			$valorEsVaca =1;
		}
		$slq = mysqli_query($conexion,"INSERT INTO ANIMAL (IDPADRE,IDMADRE,NUMEROCHAPA,CATEGORIA,SEXO,FECHANACIMIENTO,PESONACIMIENTO,DESCRIPCIONMUERTE,ESTADODESCARTE,ESVACA,PRODUCCION) VALUES(".$idPadre.",".$idMadre.",'".$numeroChapa."',".$modulo.",'".$Sexo."','".$fechaNacimiento."',".$pesoNacimiento.",'',0,$valorEsVaca,'NO')");
		echo $slq; 

	}
	break;

	case 'registraPurga':
	if (!empty($_POST)) {
		$idAnimal = $_POST['idAnimal'];
		$purga = $_POST['purga'];
		$fecha = $_POST['fecha'];
		$dosisAplicada = $_POST['dosisAplicada'];
		$sintomas = $_POST['sintomas'];

		$sql = mysqli_query($conexion,"INSERT INTO SANIDADANIMAL(IDANIMAL,IDPRODUCTOS,FECHA,DOSISAPLICADA,SINTOMAS) VALUES($idAnimal,$purga,'$fecha','$dosisAplicada','$sintomas')");
		if ($sql) {
			echo 1;
		}
	}
	break;

	case 'registraVacuna':
	if (!empty($_POST)) {
		$idAnimal = $_POST['idAnimal'];
		$purga = $_POST['purga'];
		$fecha = $_POST['fecha'];
		$dosisAplicada = $_POST['dosisAplicada'];
		$sintomas = $_POST['sintomas'];

		$sql = mysqli_query($conexion,"INSERT INTO SANIDADANIMAL(IDANIMAL,IDPRODUCTOS,FECHA,DOSISAPLICADA,SINTOMAS) VALUES($idAnimal,$purga,'$fecha','$dosisAplicada','$sintomas')");
		if ($sql) {
			echo 1;
		}
	}
	break;
	case 'registraVitaminas':
	if (!empty($_POST)) {
		$idAnimal = $_POST['idAnimal'];
		$purga = $_POST['purga'];
		$fecha = $_POST['fecha'];
		$dosisAplicada = $_POST['dosisAplicada'];
		$sintomas = $_POST['sintomas'];

		$sql = mysqli_query($conexion,"INSERT INTO SANIDADANIMAL(IDANIMAL,IDPRODUCTOS,FECHA,DOSISAPLICADA,SINTOMAS) VALUES($idAnimal,$purga,'$fecha','$dosisAplicada','$sintomas')");
		if ($sql) {
			echo 1;
		}
	}

	break;
	case 'Actualizaproduccion':
	if (!empty($_POST)) {
		$sqlActualizarProduccion = mysqli_query($conexion,"UPDATE ANIMAL SET PRODUCCION = '".$_POST['sltProduccion']."' WHERE IDANIMAL = ".$_POST['txtidAnimal']);
		if($sqlActualizarProduccion){
			echo 1;
		}else{ 
			$error = mysqli_error($conexion);
			echo '
			<script>  
			toastr.error("Error al actualizar, verifique los datos", "Error!");
			window.setTimeout(function(){
				window.open("Animales.php","_self");
				}, 2500);
				</script>';
			}	
		}
		break;
		case 'seleccionaAnimalesActivos':
		if(!empty($_POST)){
			$sqlAnimal = "SELECT * FROM ANIMAL WHERE ESTADODESCARTE = '0'";
			$eje = mysqli_query($conexion,$sqlAnimal);
			$ejecuta = mysqli_fetch_array($eje);
			$ejecuta3 = mysqli_fetch_assoc($eje);
			echo json_encode($ejecuta);

		}
		break;
		default:
		echo 0;
		break;
	}



	?>

