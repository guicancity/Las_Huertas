<?php 
if(!isset($_SESSION)) 
{
	session_start(); 
} 
require('../metodos/conexion.php');
require('../metodos/sesionIniciada.php');
require('menu.php');
 ?>
 <!DOCTYPE html>
 <html>
<head>
<?php 
    include_once("../metodos/links.php");
    ?>
    <title>Las huertas || Peso</title>
</head>
 <body>
 	<div class="container">
        <form  method="POST">
            <div class="row">
                <div class="col-10 text-center mt-4">
                    <h3>Registro de peso de animales</h3>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-3 text-right">
                    <h5> Seleccione el animal:</h5>
                </div>
                <div class="col-6">
                <select name="sltIdAnimal" class="custom-select" >
                <?php 
                $categoria = $_SESSION['modulo'];
                $sql = mysqli_query($conexion,"SELECT IDANIMAL, NUMEROCHAPA,SEXO FROM ANIMAL WHERE ESTADODESCARTE <> 1 AND CATEGORIA = $categoria");
                
                while($ejecuta = mysqli_fetch_array($sql)){
                    ?> 
                        <option value="<?php echo $ejecuta['IDANIMAL'] ?>">Chapa: <?php echo $ejecuta['NUMEROCHAPA'] ?> Sexo: <?php echo $ejecuta['SEXO'] ?></option> 
                    <?php

                }            
                ?>
                </select>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-3 text-right">
                <h5>Seleccione la fecha:</h5>
                </div>
                <div class="col-6">
                <input type="date" required="" class="form-control"name="txtFecha" >
                </div>
            </div>
            <div class="row my-4">
                <div class="col-3 text-right">
                <h5>Peso:</h5>
                </div>
                <div class="col-6">
                <input type="number" required="" class="form-control"name="txtPeso" >
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-10 text-center mt-4">
                    <button name="btnAgregar" class="btn btn-success btn-lg">Agregar</button>
                </div>
            </div>
        </form>           
    </div>


    <?php if (isset($_POST['btnAgregar'])) {
        $idAnimal = $_POST['sltIdAnimal'];
        $fecha = $_POST['txtFecha'];
        $peso = $_POST['txtPeso'];

        $slq = mysqli_query($conexion,"INSERT INTO PESOANIMAL (IDANIMAL,FECHACONTROL,PESOKG) VALUES($idAnimal,'$fecha',$peso)");
	if($slq){
        
		echo '
				<script>  
					toastr.success("Registro insertado con éxito", "Correcto!");
		            window.setTimeout(function(){
	        			window.open("Animales.php","_self");
	    			}, 1000);
	      	    </script>';
  	}else{
    	echo '
				<script>  
					toastr.error("Error al realizar el registro", "Error!");
		            window.setTimeout(function(){
	        			window.open("Peso.php","_self");
	    			}, 1000);
	      	    </script>'; 
  	}	


    } ?>
 
 </body>
 </html>
