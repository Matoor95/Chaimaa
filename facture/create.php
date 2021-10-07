

<?php
define('BASE', $_SERVER['DOCUMENT_ROOT']);
// echo BASE;
// print_r(BASE);
include(BASE . "/chaimaa/function.php");
start_session();


if (checker($_SESSION['email'], $_SESSION['password']) == false) {
    header("location:../index.php?cn=no");
    die();
}
?>
<?php
//requete pour ajouter facture a un clients
try {

    //connexion bd
    $cnx = connecter_db();

    // preparation de la requete sql
    $r = $cnx->prepare("select * from etudiant order by nom ");
    //execution de la requete 
    $r->execute();
    $etudiant =  $r->fetchAll();
} catch (PDOException $e) {
    echo "Erreur e selection des etudiant   " . $e->getMessage();
}
//requete pour afficher les client avec les données de la facture 

try {

    //connexion bd
    $cnx = connecter_db();

    // preparation de la requete sql
    $r = $cnx->prepare("select * from etudiant, inscris,langues, facture  where etudiant.id_etudiant=inscris.id_etudiant and inscris.id=langues.id and etudiant.id_etudiant=facture.id_etudiant");
    //execution de la requete 
    $r->execute();
    $facture =  $r->fetchAll();
} catch (PDOException $e) {
    echo "Erreur e selection des clients   " . $e->getMessage();
}



?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>GesCOuture</title>

    <!-- Font Awesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <!-- Navbar -->
        <?php
        include_once "header.php";

        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1 class="m-0 text-dark">Ajouter une facture </h1>
                <!-- /.col -->
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                </ol>
                <!-- /.col -->
                <!-- /.row -->
                <!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <!--lien vers la page d'ajoute d'utilisateur-->
                <!-- <a href="#" class="btn btn-large btn-info" id="bouton_ajouter">
                    <i class="fas fa-plus"></i> &nbsp; Ajouter un client
                </a> -->



                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <form action="store.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Date de la facture</label>
                                <input type="date" name="date_facture" id="date_facture" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">etudiant</label>
                                <select  name="id_etudiant" id="id_etudiant" required>
                                    <option value="" selected>....</option>
                                    <?php
                                    foreach ($etudiant as $c) { ?>

                                        <option value="<?= $c['id_etudiant'] ?>"><?= $c['nom'] ?>  <?= $c['prenom'] ?></option>

                                    <?php  } ?>


                                </select>

                            </div>

                            <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                     </div> -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
                <div class="col-md-12 col-xs-12">




                    <table class="table table-bordered" id="facture" widh="100">
                        <thead>
                            <tr>
                                <th scope="col">Num Facture</th>
                                <th scope="col">Date de la facture</th>
                                <th scope="col">nom prenom</th>
                                <th scope="col">tele</th>
                                <th scope="col">Prix</th>
                                <th scope="col">email</th>
                                <th class="text-center"><i class="fas fa-print"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($facture as $ligne) {
                                $total = $total +   $ligne['lang_prix'];
                            ?>
                                <tr>
                                    <td scope="col"><?= $ligne['numero_fact'] ?></td>
                                    <td scope="col"><?= $ligne['date'] ?></td>
                                    <td scope="col"><?= $ligne['nom'] ?> <?= $ligne['prenom'] ?></td>
                                    <td scope="col"><?= $ligne['tel'] ?></td>
                                    <td scope="col"><?= $ligne['email'] ?></td>
                                    <td scope="col"><?= $ligne['lang_prix'] ?></td>
                                    
                                    <td scope="col"><a target="_blanck" href="print.php?numero_fact=<?= $ligne['numero_fact']; ?>"><i class="fa fa-print"></i> </a></td>


                                </tr>
                            <?php } ?>

                        </tbody>

                    </table>

                </div>
            </section>








            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php
        include_once "footer.php";

        ?>
    </div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <?php
    include('script.php');

    ?>
    <script>
        $(document).ready(function() {
            $('#facture').DataTable({

                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                order: [],
                info: true,
                responsive: true,
                autoWidth: false,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",

                // autoWidth: false,

            });
        });
    </script>
</body>

</div>