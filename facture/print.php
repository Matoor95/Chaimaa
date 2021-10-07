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



//connexion bd



$invid = intval($_GET['numero_fact']);
$cnx = connecter_db();
$sql = "select e.nom, e.prenom, e.tel, l.lang_prix, l.nom_lang,i.date_inscris,f.numero_fact, f.date from inscris i JOIN etudiant e on i.id_etudiant=e.id_etudiant join langues l on i.id=l.id join facture f on f.id_etudiant=e.id_etudiant where f.numero_fact=?";
$query = $cnx->prepare($sql);
$query->bindParam(':invid', $invid, PDO::PARAM_STR);
$query->execute([$invid]);

$results = $query->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture numero <?= $_GET['numero_fact'] ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <style>
        .body-main {
            background: #ffffff;
            border-bottom: 15px solid #1E1F23;
            border-top: 15px solid #1E1F23;
            margin-top: 30px;
            margin-bottom: 30px;
            padding: 40px 30px !important;
            position: relative;
            box-shadow: 0 1px 21px #808080;
            font-size: 10px
        }

        .main thead {
            background: #1E1F23;
            color: #fff
        }

        .img {
            height: 100px
        }

        h1 {
            text-align: center
        }

        @media print {
            a {
                display: none !important;
            }
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="page-header">
            <h1>Invoice Template </h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 body-main">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4"> <img class="img" alt="Invoce Template" src="../dist/img/sagnsema.jpeg" /> </div>
                            <div class="col-md-8 text-right">
                                <h4 style="color:#5c486a"><strong>sagnsema Design</strong></h4>
                                <p> Dakar cite cse, 11000, Sénégal</p>
                                <p>TEL: +221 77 503 44 08</p>
                                <p>sagnsema@gmail.com</p>
                            </div>
                        </div> <br />
                        <div class="row">
                            <?php foreach ($results as $f) { ?>
                                <div class="col-md-12 text-center">
                                    <h2>FACTURE</h2>
                                    <h5>#0000<?= $f['numero_fact'] ?>DM0</h5>
                                </div>
                        </div> <br />
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h5>Nom et prenom</h5>
                                        </th>
                                        <th>
                                            <h5>Prix</h5>
                                        </th>
                                        <th>Modele</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="col-md-9"><?= $f['nom'] ?> <?= $f['prenom'] ?></td>
                                        <td class="col-md-3"></i> <?= $f['lang_prix'] ?> cfa</td>
                                        <td class="col-md-3"></i> <?= $f['nom_lang'] ?></td>

                                        
                                    </tr>

                                    <!-- <tr>
                                       
                                        <td>
                                            <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> 500 </strong> </p>
                                            <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> 82,900</strong> </p>
                                            <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> 3,000 </strong> </p>
                                            <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> 79,900</strong> </p>
                                        </td>
                                    </tr> -->
                                    <tr style="color: #F81D2D;">
                                        <td class="text-right">
                                            <h4><strong>Total:</strong></h4>
                                        </td>
                                        <td class="text-left">
                                            <h4><strong><?=$f['lang_prix']?></strong> CFA</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="col-md-12">
                                <p><b>Date :</b><?=$f['date']?></p> <br />
                                <p><b>Signature</b></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <a href="#" onclick="window.print()" class="btn btn-success">Imprimer</a>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js	"></script>
</body>

</html>