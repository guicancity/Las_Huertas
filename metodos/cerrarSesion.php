 <?php
session_start();
$_SESSION['iniciosesion'] = 0;
echo "<script>window.open('../pag/Login.php','_self')</script>";
?>