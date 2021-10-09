
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
$date = $_POST['date_abs'];
$cnx=connecter_db();

$r=$cnx->prepare("UPDATE etudiant   JOIN  absence   ON etudiant.id_etudiant = absence.id_etudiant SET etudiant.nom ='$fname',etudiant.prenom ='$lname',absence.date_abs ='$date'
WHERE etudiant.id_etudiant='$id'");
$r->execute([$id,$fname,$lname,$date]);
$_SESSION['message1']="mise à jour  avec succés";
$_SESSION['status']="success";
 header("location:create.php");

}

catch (PDOException $e) {
    //throw $th;
    echo "erreur de modif ".$e->getMessage();

}

?>
