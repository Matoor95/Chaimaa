<?php 



define('BASE', $_SERVER['DOCUMENT_ROOT']);
// echo BASE;
// print_r(BASE);
include(BASE."/chaimaa/function.php");
try {


$nom=$_POST['nom'];
$prix=$_POST['lang_prix'];
$cnx=connecter_db();

$r=$cnx->prepare("insert into langues (nom_lang, lang_prix) values(?,?)");
$r->execute([$nom,$prix]);
    //code...
} catch (PDOException $e) {
    echo "Erreur d'ajout de la facture   ".$e->getMessage() ;
}
header("location:lsl.php?m=done");



?>