<?php 

function copiaImagenes($ruta,$nombreImagen,$file){

$dest = $ruta . $nombreImagen;

    $archivo = $file;

  return  copy($archivo, $dest);	

}





 ?>


