<?php 
define('BASE', $_SERVER['DOCUMENT_ROOT']);
// echo BASE;
// print_r(BASE);
include(BASE."/chaimaa/function.php");
start_session();

try{

    // recuperer les donnees du formulaires (par leurs name )
    $etudiant_id=$_POST['id_etudiant'];
    $date=$_POST['date'];
   
   
    //connexion bd
    $cnx = connecter_db();
    
    
    // preparation de la requete sql
    $r=$cnx->prepare("insert into absence (date_abs,id_etudiant) values(?,?)");
    //execution de la requete 
    $r->execute([$date,$etudiant_id]);
    $_SESSION['message1']="Absence  ajoutée avec succés";
    $_SESSION['status']="success";
    // header("location:create.php");
}catch (PDOException $e) {
    echo "Erreur d'ajout de la facture   ".$e->getMessage() ;
}
header("location:create.php");

?>

