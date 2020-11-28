<?php 
session_start();
require('../metodos/conexion.php');
require_once('../metodos/sesionIniciada.php');
require_once('menu.php');
 ?>
 <!DOCTYPE html>
 <html>
   <head>
   <?php 
  include_once("../metodos/links.php");
  ?>  
    <title>Las huertas || Configuración</title>
  </head>
   <body>
 <?php 
          $porPagina = 5;

          if(isset($_GET['pagina2'])){
            $pagina =  $_GET['pagina2'];

          }else{
            $pagina = 1;
          }

          $empieza = ($pagina - 1) * $porPagina;

        ?>
        
  <div class="row">
  	<div class=" col-lg-6 col-12">
  		<div class="row">
       
  			<div class="col-md-12 col-lg-12 text-center">
          <h3>Imagenes de Inicio de sesión</h3></div>
  			</div>

  			<div class="row ">
  				<div class="col-md-2">
            <button  data-toggle="modal" data-target="#modalInsert" class="btn btn-success m-2">Nueva imagen </button>
          </div>
  			</div>

        
  		      <table class="table table-striped table-responsive">
            			<thead>
            				<tr>
            					<th><h5>titulo</h5></th>
            					<th><h5 >descripción</h5></th>
            					<th><h5>Imagen</h5></th>
            					<th><h5>Actualizar</h5></th>
            					<th><h5>Eliminar</h5></th>

            				</tr>
            			</thead>
            			<tbody>
                    <?php 
                      $sql = mysqli_query($conexion,"SELECT * FROM PRINCIPALSLIDER LIMIT $empieza, $porPagina");
                      while ($fila = mysqli_fetch_array($sql)){
                          $idSlider = $fila['IDPRINCIPALSLIDER'];
                          $imagen = $fila['IMAGEN'];
                          $titulo = $fila['TITULO'];
                          $descripcion = $fila['DESCRIPCION'];
                    ?>
            				<tr>
            					<td><b class="titulo"><?php echo $titulo ?></b></td>
            					<td><p class="descripcion"><?php echo $descripcion?></p></td>
            					<td class="align-middle"><img class="responsive-img imagen" width="175" src="<?php echo $imagen ?>"> </td>
            					<td class="align-middle"> <button class="btn btn-warning actualizar" data-toggle="modal" data-target="#modalUpdate<?php echo $fila['IDPRINCIPALSLIDER']?>" >Actualizar</button> </td>
            					<td class="align-middle"><a onclick="javascript:return confirm('¿Está seguro de eliminar el registro?')" class="btn btn-danger" 
            						   href="Configuracion.php?Eliminar=<?php echo $idSlider;?>">Eliminar</a> </td>
            				</tr>

                      <?php include('ModalUpdate.php');  } ?>

            			</tbody>
  		      </table>

            <div class="row">
              <div class="col ">
                  <ul class="pagination justify-content-center">
                  <?php 
                    $query = mysqli_query($conexion,"SELECT * FROM PRINCIPALSLIDER");
                    $totalRegistros = mysqli_num_rows($query);
                    $totalPagina = ceil($totalRegistros / $porPagina);
                     ?>
                  <li class="page-item"> <a class="page-link" href="Configuracion.php?pagina2=1">Primera</a></li>
                     <?php 
                    

                     for ($i=1; $i <= $totalPagina ; $i++) { 
                      
                        if ($i == $pagina) { ?>

                         <li class="page-item active "><a class="page-link  >" href="Configuracion.php?pagina2=<?php echo $i ?>"><?php echo $i ?></a></li> 
                        <?php  }else{
                        ?>
                          <li class="page-item"><a class="page-link >" href="Configuracion.php?pagina2=<?php echo $i ?>"><?php echo $i ?></a></li> 
                     <?php } } ?>
                  <li class="page-item "> <a class="page-link" href="Configuracion.php?pagina2=<?php echo $totalPagina ?>">Última</a></li>
                </ul>
                <div class="col text-right">
                  <h6>Página <b><?php echo $pagina ?></b> de <b><?php echo $totalPagina ?>
                </div>
              </div>
    </div>
  	</div>

  <div class="col-lg-12 col-12 ml-5">
    <div class="row justify-content-md-center">

      
    <form method="POST" action="Configuracion.php" class="border mt-4">
      <div class="col-md-12 text-center">
        <h3>Cambio de contraseña</h3>
      </div>
      <div class="col-md-12 mt-3">
        <label for="txtPassActual">Contraseña actual</label>
        <input type="password" class="form-control rounded" name="txtPassActual">
      </div>
      <div class="col-md-12">
        <label for="txtPassActual">Contraseña nueva</label>
        <input type="password" class="form-control rounded" name="txtPassNueva">
      </div>
      <div class="col-md-12 text-center mt-4 mb-4">
        <button type="submit" class="btn btn-success" name="btnCambiaPassword">Cambiar contraseña</button>
      </div>
    </form>
    </div>
  </div>

  </div>




  <?php

  //INICIO Elimina imagen del slider
  if(isset($_GET['Eliminar'])){
  $idBorrar = $_GET['Eliminar'];
  $sqlEliminar = mysqli_query($conexion,"DELETE FROM PRINCIPALSLIDER WHERE IDPRINCIPALSLIDER = ".$idBorrar);

  	if($sqlEliminar){
  		echo "<script> alert ('La imagen a sido eliminada') </script>";
  		echo "<script> window.open ('Configuracion.php','_self') </script>";

  	}else{
  		echo "<script> alert ('Error al eliminar la imagen, intente más tarde.') </script>";
  		echo "<script> window.open ('Configuracion.php','_self') </script>";

  	}
  	
  }
  //FIN Elimina imagen del slider

  //INICIO inserta imagen slider 

  if (isset($_POST['btnInsertaImagen'])) { 
    $titulo = $_POST['txtTitulo'];
    $descripcion = $_POST['txtDescripcion'];
    $nombreImagen = $_FILES['imagen']['name'];

    $dest = "../img/". $nombreImagen;
    $archivo = $_FILES['imagen']['tmp_name'];

    
  if(move_uploaded_file($archivo, $dest)){

    echo "<script> alert('Imagen copiada con éxito');
            </script> ";

    $sqlActualiza = "INSERT INTO PRINCIPALSLIDER(TITULO,DESCRIPCION,IMAGEN) VALUES('".$titulo."','".$descripcion."','../img/".$nombreImagen."')" ;
    $ejecutar = mysqli_query($conexion, $sqlActualiza) or die (mysqli_error());
    if($ejecutar){
       echo "<script> alert('¡¡Registro insertado exitosamente!!');
            </script> ";  
       echo "<script>window.open('Configuracion.php','_self');
        </script>";
    }else{
      echo "<script> alert('Error al insertar');
            </script> ";  
      echo "<script>window.open('Configuracion.php','_self');
        </script>"; 
    }        
    }else{
     echo "<script> alert('Error al cargar la imagen');
            </script> ";
    }
    
    

  }
  //FIN inserta imagen slider

  // INICIO Actualizar Slider 

  if(isset($_POST['btnActualizaImagen'])){
    $idPrincipalSlider = $_POST['txtidPrincipalSlider'];
    $titulo =$_POST['txtTitulo'];
    $descripcion =$_POST['txtDescripcion'];
    $imagen =$_FILES['txtimagen']['name'];

    $sql = mysqli_query($conexion,"UPDATE PRINCIPALSLIDER SET TITULO = '".$titulo."', DESCRIPCION = '".$descripcion."', IMAGEN = '".$imagen."' WHERE IDPRINCIPALSLIDER =".$idPrincipalSlider);  
    if($sql){
       echo "<script> alert('¡¡Registro Actualizado exitosamente!!');
            </script> ";  
       echo "<script>window.open('Configuracion.php','_self');
        </script>";
    }else{
      echo "<script> alert('Error al Actualizar');
            </script> ";  
      echo "<script>window.open('Configuracion.php','_self');
        </script>"; 
    }

  }
  //FIN Actualizar slider 

  //INICIO Cambio de contraseña
  if(isset($_POST['btnCambiaPassword'])){

    
    $sql = mysqli_query($conexion,"SELECT IDUSUARIO, PASSWORD FROM USUARIO WHERE IDUSUARIO = ".$_SESSION['idUsuario']);
    $idPersona = '';
    $password = '';
    while ($fila = mysqli_fetch_array($sql)){
      $idPersona = $fila['IDUSUARIO'];
      $password = $fila['PASSWORD'];
    }
    if($_POST['txtPassActual'] === $password ){
     $sqlinsert = mysqli_query($conexion,"UPDATE USUARIO SET PASSWORD = '".$_POST['txtPassNueva']."'WHERE IDUSUARIO =".$idPersona);
      if($sqlinsert){
        echo "<script> alert('¡¡Contraseña Actualizado exitosamente!!');
             </script> ";  
        echo "<script>window.open('Configuracion.php','_self');
         </script>";
     }
    }else {
      echo "<script> alert('La contaseña no coincide con la antigua');
      </script> ";
    }


  }
  //FIN cambio de contraseña
  ?>

  <!--INICIO modal de inserción-->
  <div class="modal fade" id="modalInsert"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Agregar nueva imagen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="Configuracion.php" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col">
                      <label for="txtTitulo">Título</label>
                      <input type="text" class="form-control" name="txtTitulo">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <label for="textarea2">Descripción</label>
                      <textarea id="textarea2" class="form-control"  name="txtDescripcion"></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mt-4">
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Seleccione imagen</label>
                          <input type="file" class="form-control-file" name="imagen" id="imagen">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col text-center">
                      <input  type="submit" name="btnInsertaImagen" class="btn btn-success" value="Insertar">
                    </div>
                  </div> 
                </form>
            </div>
              </div>
          </div>
        </div>
    </div>
  <!--FINAL modal de inserción-->



 </body>
</html>



