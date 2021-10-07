<?php 
define('BASE', $_SERVER['DOCUMENT_ROOT']);
// echo BASE;
// print_r(BASE);
include(BASE."/chaimaa/function.php");
try{

    // recuperer les donnees du formulaires (par leurs name )
       // recuperer les donnees du formulaires (par leurs name )
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $adresse = $_POST['adresse'];
    $cin = $_POST['cin'];
    $tel = $_POST['tel'];
    $id = $_POST['langue_id'];
    //upload du fichier 
    //connexion a la bd
    
    $cnx = connecter_db();
    //inserer les donnees dans la base de données
    $r=$cnx->prepare("insert into etudiant (nom,prenom,email,adresse,cin,tel) values(?,?,?,?,?,?)");
    //execution de la requete 
    $r->execute([$nom,$prenom,$email,$adresse,$cin,$tel]);
    $id_etd=$cnx->lastInsertId();
    $r=$cnx->prepare("insert into inscris (id,id_etudiant) values(?,?)");
    //execution de la requete 
    $r->execute([$id,$id_etd]);

}catch (PDOException $e) {
    echo "Erreur d'ajout de la etd   ".$e->getMessage() ;
}
header("location:home.php?m=done")

?>