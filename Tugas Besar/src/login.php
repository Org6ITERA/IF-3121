<?php require_once('Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO login (username, nama, password, `level`, email) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['level'], "double"),
                       GetSQLValueString($_POST['email'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_koneksi, $koneksi);
$query_login = "SELECT * FROM login ORDER BY `level` ASC";
$login = mysql_query($query_login, $koneksi) or die(mysql_error());
$row_login = mysql_fetch_assoc($login);
$totalRows_login = mysql_num_rows($login);
session_start();
include_once 'include/cls-vote.php';
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = "masuk.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_koneksi, $koneksi);
  	
  $LoginRS__query=sprintf("SELECT username, password, level FROM login WHERE username=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $koneksi) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'level');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html >
<head>
<link rel="shortcut icon" href="images/logo.png">
  <meta charset="UTF-8">
  <title>Login-Sign Up</title>
  
  
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>

      <link rel="stylesheet" href="css/style.css">

  
      <style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-size: 24px;
}
.style2 {font-size: 16px}
-->
      </style>
</head>

<body>
<form name="form4" method="post" action="">
</form>
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
  <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
			  <div class="group">
  <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
                      <label for="label" class="label">Username </label>
                      <input name="username" type="text" class="input" id="label">
                      <p>
                        <label for="label2" class="label">Password</label>
                        <input name="password" type="password" class="input" id="label2" data-type="password">
</p>
                      <div class="group">
                        <label for="label2" class="label"></label>
</div>
                      <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                      </div>
                      <div class="group">
                        <input type="submit" class="button" value="Sign In">
                      </div>
                      <p>'<br>
                      </p>
			    </form>
				
                  <form action="" method="post" name="form2" class="style1">
                    <div align="center"><a href="index.php" class="style2">HOME</a>                    </div>
                  </form>
                  
                  
                  <p>&nbsp;</p>
			  </div>
			  <div class="group">
				  <label for="pass" class="label"></label>
			  </div>
				<div class="hr"></div>
				<div class="foot-lnk"></div>
			</div>
<div class="sign-up-htm">
<form name="form5" method="post" action="">
  <div class="group">
    <label for="user" class="label"></label>
  </div>
  </form>
<div class="group">
  <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
    <table align="center">
      <tr valign="baseline">
        <td width="84" height="33" align="right" nowrap>Username:</td>
        <td width="219"><input type="text" name="username" value="" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td height="35" align="right" nowrap>Nama:</td>
        <td><input type="text" name="nama" value="" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td height="35" align="right" nowrap>Password:</td>
        <td><input type="password" name="password" value="" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td height="32" align="right" nowrap>Level:</td>
        <td><select name="level">
            <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Admin</option>
          </select>
        </td>
      </tr>
      <tr valign="baseline">
        <td height="31" align="right" nowrap>Email:</td>
        <td><input type="text" name="email" value="" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td height="54" align="right" nowrap>&nbsp;</td>
        <td><input type="submit" value="Sign Up"></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form3">
  </form>
  <p>&nbsp;</p>
  <label for="user" class="label"></label>
</div>
<div class="group"></div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div>
		</div>
	</div>
</div>
  
  
</body>
</html>
<?php
mysql_free_result($login);
?>
