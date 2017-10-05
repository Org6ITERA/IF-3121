<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
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
	$pem = new DataKandidat();

	if ($mod=='pemilihan' AND $act=='pilih') {
		$id_kandidat = $validasi->sql($_GET['kode']);
		$id_login = $_SESSION['id'];
		$waktu = date("Y-m-d")." ".date("H:i:s");
		$poin = get_poin(substr($_SESSION['username'], 0, 1));
		$db = $pem->pilihKandidat($id_kandidat,$id_login,$waktu,$poin);
		if($db){
			header('location:../../masuk.php?mod='.$mod);
		}else{
			echo mysql_error();
		}
	}
}
?>
