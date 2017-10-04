<?php 
session_start();
//error_reporting();
include_once '../../include/cls-vote.php';
$user = new User();
$newdb = new Database();
$newdb->sambungMySQL();
if (!$user->get_login()) {
	header("location:index.php");
}else{
	$mod = $_GET['mod'];
	$act = $_GET['act'];
	$validasi = new VotingValidasi;
	$pem = new DataPemilih();

	if ($mod=='datapemilih' AND $act=='delete') {
		$id = $validasi->sql($_GET['kode']);
		$db = $pem->deleteDataPemilih($id);
		if($db){
			header('location:../../masuk.php?mod='.$mod);
		}else{
			echo mysql_error();
		}
	}
}
?>