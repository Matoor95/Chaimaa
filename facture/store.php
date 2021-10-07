<?php 
define('BASE', $_SERVER['DOCUMENT_ROOT']);
// echo BASE;
// print_r(BASE);
include(BASE."/chaimaa/function.php");
start_session();

try{

    // recuperer les donnees du formulaires (par leurs name )
    $datefacture=$_POST['date_facture'];
    $etudiant_id=$_POST['id_etudiant'];
   
    //connexion bd
    $cnx = connecter_db();
    
    
    // preparation de la requete sql
    $r=$cnx->prepare("insert into facture(date,id_etudiant) values(?,?)");
    //execution de la requete 
    $r->execute([$datefacture,$etudiant_id]);
    // header("location:create.php");
    // $_SESSION['message1']="facture  ajoutée avec succés";
    // $_SESSION['status']="success";
    header("location:create.php");
}catch (PDOException $e) {
    echo "Erreur d'ajout de la facture   ".$e->getMessage() ;
}
header("location:create.php");

?>

