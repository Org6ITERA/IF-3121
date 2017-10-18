<?php
error_reporting(0);
session_start();
include_once 'include/cls-vote.php';

//inisialisasi user dan database serta connect yang akan login
$newdb = new Database();
$newdb->sambungMySQL();
$user = new User();
$iduser = $_SESSION['id'];

if (!$user->get_login()){
  header("location:index.php");
}
if ($_GET['mod'] == 'logout'){
$user->logout();
  header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Evoting ITERA</title>

    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="asset/css/docs.css" rel="stylesheet">
    <script src="asset/js/jquery-latest.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/homestyle.css">
    <link rel="stylesheet" type="text/css" href="./css/dataPemilihStyle.css">
  </head>
  
  <body>
    <header style="margin-top: -60px;">
          <div class="container">
            <div id="logo">
              <h1>E-VOTE</h1>
            </div>
            <nav>
              <div id="loginSign">
                <li><a href="?mod=logout"><i class="icon-off icon-white"></i> Logout</a></li>
                <li><a href="#" data-toggle="modal" data-target="#register-modal"><?php echo $_SESSION['nama']; ?></a></li>
              </div>
            </nav>
          </div>
        </header>

    
      <?php include 'menu.php'; ?>
    <div class="container">
    <?php include 'isi.php'; ?>
     </div>

     <div style="width: 400px; height: 400px;"></div>

  <footer  style="margin-bottom: -60px;">
      <p>Selamat Datang di WEB VOTING ORG6ITERA. Junjung Tinggi "LUBERJURDIL" 
      <?php echo substr($_SESSION['username'], 0, 1); ?><br/>
      </p>
  </footer>

    <!-- /container -->
<script src="datatables/jquery-1.10.2.min.js"></script> <!-- Memasukkan plugin jQuery -->
<script src="datatables/jquery.dataTables.js"></script> <!-- Memasukkan file jquery.dataTables.js -->
<script>
$(document).ready(function() {
    $('#datatable').dataTable( {
        "pagingType": "full_numbers"
    } ); // Menjalankan plugin DataTables pada id contoh. id contoh merupakan tabel yang kita gunakan untuk menampilkan data
} );
</script>
  </body>
</html>
