
<?php
define('BASE', $_SERVER['DOCUMENT_ROOT']);
// echo BASE;
// print_r(BASE);
include(BASE . "/chaimaa/function.php");
start_session();


if (checker($_SESSION['email'], $_SESSION['password']) == false) {
    header("location:index.php?cn=no");
    die();
}
?>


<?php 

try {
    //code...

$id = $_POST['id_etudiant'];   
$fname = $_POST['nom'];
$lname = $_POST['prenom'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];
$cin = $_POST['cin'];
$tel = $_POST['tel'];
$id_langue=$_POST['langue_id'];
$cnx=connecter_db();

$r=$cnx->prepare("UPDATE etudiant   JOIN  inscris   ON etudiant.id_etudiant = inscris.id_etudiant SET etudiant.nom ='$fname',etudiant.prenom ='$lname',etudiant.adresse ='$adresse',etudiant.tel ='$tel',etudiant.email ='$email',etudiant.cin ='$cin', 
inscris.id ='$id_langue'
WHERE etudiant.id_etudiant='$id'");
$r->execute([$id,$fname,$lname,$email,$adresse,$cin,$tel,$id_langue]);
$_SESSION['message1']="mise à jour  avec succés";
$_SESSION['status']="success";
 header("location:home.php");

}

catch (PDOException $e) {
    //throw $th;
    echo "erreur de modif ".$e->getMessage();

}

?>
