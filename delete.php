<?php 

define('BASE', $_SERVER['DOCUMENT_ROOT']);
// echo BASE;
// print_r(BASE);
include(BASE . "/chaimaa/function.php");
start_session();
try{

    // recuperer les donnees depuis le lien 
  $id=$_GET['id'];
//    echo "id est $id";
print_r($id);


//    exit();
    //connexion bd
    
    $cnx=connecter_db();
    
    // preparation de la requete sql
    $r=$cnx->prepare("delete from etudiant where id_etudiant=?");
    //execution de la requete 
    $r->execute([$id]);
   
    header("location:home.php");
}catch (PDOException $e) {
    header("location:home.php");
    // echo "  erreur de suppression du produit  ".$e->getMessage() ;
}

?>