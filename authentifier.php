

<?php 
include ('include/script.php');
?>
<?php
define('BASE', $_SERVER['DOCUMENT_ROOT']);
include(BASE."/chaimaa/function.php");
$login=$_POST["email"];
$Pass=md5($_POST["password"]);
if(checker($login,$Pass)){
    header("location:home.php");
    die();
}else{
    // header("location:index.php?cn=no");
}
