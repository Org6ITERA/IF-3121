<?php
session_start();
include_once 'include/cls-vote.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>E-VOTING ITERA</title>
</head>

<body>
<div class="container">
  <?php 
  //inisialisasi user dan database serta connect yang akan login
  $user = new User();
  $newdb = new Database();
  $newdb->sambungMySQL();

  //inisialisasi request login
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    //login diambil dari database
    $login = $user->cek_login(mysql_real_escape_string($_POST['username']), mysql_real_escape_string($_POST['password']));
    //keadaan login pada 2 user yaitu admin dan pemvoting
    if($login){
      if($user->sesi()==1){
        header("location:masuk.php");
      }
      elseif($user->sesi()==2){
        header("location:masuk.php");
      }
      //keadaan salah login ID dan password
    }else{
      //popup pemberitahuan jika salah ID atau Password
      echo "
      <div class=\"alert alert-block\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
        <h4>LOGIN GAGAL!</h4>
        ID atau PASSWORD salah!
      </div>
      ";
    }
  }
  //dibawah ini HTML untuk tampilan
  ?>
  <form style="" method="post" name="login">
    <div class="form-group">
      <input type="text" class="form-control" name="username" id="username" placeholder="USERNAME">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" name="password" id="password" placeholder="PASSWORD">
    </div>

    <button type="submit" class="btn">Login</button>
    <button type="reset" class="btn">Reset</button>
  </form>

</div> <!-- /container -->

</body>
</html>
