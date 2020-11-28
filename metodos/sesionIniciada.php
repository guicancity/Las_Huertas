<?php
	if($_SESSION['iniciosesion'] != 1){
		echo "<script> alert('Usted no tiene una sesión iniciada');
	          </script> ";
		echo ' <script>window.open("../pag/Login.php","_self");</script>';

	}
?>


