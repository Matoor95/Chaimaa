<?php 
define('BASE', $_SERVER['DOCUMENT_ROOT']);
// echo BASE;
// print_r(BASE);
include(BASE."/chaimaa/function.php");
fermer_session();
 header("location:index.php");

 ?>
 