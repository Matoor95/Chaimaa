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


try {

    //connexion bd
    $cnx = connecter_db();

    // preparation de la requete sql
    $r = $cnx->prepare("select * from langues order by nom_lang ");
    //execution de la requete 
    $r->execute();
    $langue =  $r->fetchAll();
} catch (PDOException $e) {
    echo "Erreur e selection des langues  " . $e->getMessage();
}

try {

    //connexion bd


    $cnx = connecter_db();

    // preparation de la requete sql
    $r = $cnx->prepare("select * from etudiant ");
    //execution de la requete 
    $r->execute();
    $etudiants =  $r->fetchAll();
} catch (PDOException $e) {
    echo "Erreur e selection des etudiant   " . $e->getMessage();
}

try {




    //connexion bd
    $cnx = connecter_db();

    // preparation de la requete sql
    $r = $cnx->prepare("select e.*, l.*,a.* from etudiant e join inscris i on e.id_etudiant=i.id_etudiant join  langues l on l.id=i.id join absence a on a.id_etudiant=e.id_etudiant");
    //execution de la requete 
    $r->execute();
    $etudiant = $r->fetchAll();
} catch (PDOException $e) {
    echo "Erreur     " . $e->getMessage();
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

    <title>Gesformation</title>

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
    <div class="wrapper" style="overflow-x: hidden;">

        <!-- Navbar -->
        <?php
        include_once "header.php";

        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!-- <h1 class="m-0 text-dark"> </h1> -->
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
            <section class="container">
                <!--lien vers la page d'ajoute d'utilisateur-->
                <!-- <a href="#" class="btn btn-large btn-info" id="bouton_ajouter">
                    <i class="fas fa-plus"></i> &nbsp; Ajouter un client
                </a> -->
                <div class="row">

                    <div class="col-md-12 col-xs-12">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#etudiant">
                            Ajouter une absence
                        </button>
                        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modifier une absence </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="post" action="update.php">
                                            <!--creation de la form avec la met hod post-->
                                            <div class="mb-3">
                                                <input type="hidden" name="id_etudiant" id="id_etudiant">
                                            </div>
                                            <div class="mb-3">
                                                nom: <input type="text" name="nom" id="nom" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                Prenom: <input type="text" name="prenom" id="prenom" class=" form-control">
                                            </div>
                                            <div class="mb-3">
                                                date: <input type="date" name="date_abs" id="date" class=" form-control">
                                            </div>
                                            <div class="mb-3 text-center">
                                                <button type="submit" class="btn btn-primary col-md-6">Modifier</button>
                                            </div>

                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>




                        <!-- Modal -->
                        <div class="modal fade" id="etudiant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter une absence </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="post" action="store.php">
                                            <!--creation de la form avec la met hod post-->
                                            <div class="mb-3">
                                                Etudiant: <select name="id_etudiant" id="id_etudiant" class="form-control" required>
                                                    <option value="" selected>....</option>
                                                    <?php
                                                    foreach ($etudiants as $e) { ?>

                                                        <option value="<?= $e['id_etudiant'] ?>"><?= $e['nom'] ?> <?=$e['prenom']?></option>

                                                        <?php  } ?>F

                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                Date: <input type="date" name="date" id="date" class="form-control">
                                            </div>

                                            <div class="mb-3 text-center">
                                                <button class="btn btn-primary col-md-6">Valider</button>
                                            </div>

                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>




                <div class="col-md-12 col-xs-12">
                    <h3 class="text-center my-5  text-primary">
                        Liste des absences
                    </h3>
                    <table class="table table-tripped" id="matar">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">nom</th>
                                <th scope="col">prenom</th>
                                <th scope="col">date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($etudiant as $p) { ?>
                                <tr>
                                <td scope="row"><?= $p['id_etudiant'] ?></td>
                                    <td scope="row"><?= $p['nom'] ?></td>
                                    <td scope="row"><?= $p['prenom'] ?></td>
                                    <td scope="row"><?= $p['date_abs'] ?></td>
                                    <td><a class="btn btn-sm btn-danger" href="delete.php?id=<?= $p['id_etudiant'] ?>" onclick="return confirm('voulez vous supprimer ?')"><i class="fas fa-trash"></i></a></td>
                                    <td> <button type="button" class="btn btn-success editbtn" data-bs-toggle="modal"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>


            </section>


        </div>









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
    include_once "../include/script.php";

    ?>
    <script>
        $(document).ready(function() {
            $('#matar').DataTable({

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

                // autoWidth: false,

            });
        });

        $(document).ready(function() {

            $('.editbtn').on('click', function() {

                $('#edit').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id_etudiant').val(data[0]);
                $('#nom').val(data[1]);
                $('#prenom').val(data[2]);
                $('#date').val(data[3]);
            });
        });
    </script>
</body>

</div>