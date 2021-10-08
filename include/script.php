 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

 <!-- Bootstrap 4 -->
 <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- DataTables -->
 <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

 <!-- <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
 <!-- AdminLTE App -->
 <script src="../dist/js/adminlte.min.js"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="../dist/js/demo.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <?php
   if (isset($_SESSION['message1'])) { ?>
    <script>
       swal({
          title: "<?= $_SESSION['message1'] ?>",
          //  text: "You clicked the button!",
          icon: "<?= $_SESSION['status'] ?>",
          button: "ok",
       });
    </script>
 <?php
      unset($_SESSION['message1']);
   }
   ?>