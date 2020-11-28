<?php 
session_start();

require_once('../metodos/conexion.php');
$sql = mysqli_query($conexion,'SELECT * FROM PRINCIPALSLIDER');


?>
<!DOCTYPE html>
<head>
  <?php 
  include_once("../metodos/links.php");
 
  ?>  
  <title>Las huertas || Login</title>
</head>
<body>
  <div class="center color-teal mb-2">
    <div class="col-md-12 text-center p-4">
      <h3 class="text-white"><b>FINCA LAS HUERTAS</b></h3>
    </div>


  </div>

  <div class="row">
    <div class="col-md-9">

      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php 
          while($fila = mysqli_fetch_array($sql)){
            $idActual =  $fila['IDPRINCIPALSLIDER'];
            $sqlmin = mysqli_query($conexion,'SELECT MIN(IDPRINCIPALSLIDER) IDMINIMO FROM PRINCIPALSLIDER WHERE IDPRINCIPALSLIDER');
            $ejecuta = mysqli_fetch_assoc($sqlmin);
            $idMinimo = $ejecuta['IDMINIMO'];

            $imagen = $fila['IMAGEN'];
            $titulo =$fila['TITULO'];
            $descripcion = $fila['DESCRIPCION'];
            if ($idMinimo == $idActual) {
              $active = "active";
            }else{
              $active = "";
            }
            ?>
            <div class="carousel-item <?php echo $active ?>">
              <img src="<?php echo $imagen ?>" class="d-block " width="100%" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5><?php echo $titulo ?></h5>
                <p><?php echo $descripcion ?></p>
              </div>
            </div>
            <?php 
          }
          ?>
        </div>
      </div>
    </div>


    <!--INICIO Formulario login-->
    <div class="col-md-3 pt-4 ">
      <div class="row">
        <div class="col-md-12 text-center">
          <h5 class="">Inicio de sesión</h5>
        </div>
      </div>
      <form method="post" class="pt-5 border shadow rounded" action="../metodos/validaLogin.php">
        <div class="col-auto mb-5">
          <label for="txtemail" class="sr-only">Correo electronico</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-envelope"></i></div>
            </div>

            <input id="txtemail" name="txtemail" required="" type="email" placeholder="Correo electrónico" class="form-control validate">
          </div>
        </div>
        <div class="col-auto mb-5">
          <label for="txtpassword" class="sr-only">Contraseña</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-lock"></i></div>
            </div>
            <input id="txtpassword" name="txtpassword" type="password" placeholder="Contraseña" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 text-center">
            <?php
            if(isset($_SESSION["Error"])){
              $error = $_SESSION["Error"]; ?>
              <div class="alert alert-danger" role="alert">
                <small ><?php echo $error ?></small>
              </div>

            <?php } ?>
          </div>
        </div> 

        <div class="row">
          <div class="col-md-12 text-center">
            <button type="submit" class="btn color-teal-button text-white">ingresar <i class="fa fa-sign-in-alt"></i> </button>

          </div>
          <div class="col-md-12 text-center pb-5 ">
            <small><a href="../metodos/recuperarContrasenia.php"> ¿olvidó su contraseña?</a></small>
          </div>
        </div>
      </form>
      <button onclick="muestraAlerta();" class="btn btn-success ">ingresar <i class="fa fa-sign-in-alt"></i> </button>
    </div>
    <!--FIN Formulario login-->
    <!-- Enlace para abrir el modal -->
<!-- Modal -->

  </div>

  <script type="text/javascript">
    
$('.carousel').carousel({
  interval: 4000,
  pause: "hover"
});
$(function(){
preparar();
});
</script>





</body>
</html>

<?php 
unset($_SESSION["Error"])
?>