<?php
include_once 'include/cls-vote.php';
$user = new User();
if (!$user->get_login()){
	header("location:index.php");
}
	//keadaan jika pindah halaman pada link yg sama / mod
	$mod=htmlentities(@$_GET['mod']);
	$halaman="./app/$mod/$mod.php";

	if(!file_exists($halaman) || empty($mod)){
		include "wellcome.php";
	}
	else{
		include "$halaman";
	}
?>