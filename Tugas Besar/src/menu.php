<ul class="nav">
<?php
include_once 'include/cls-vote.php';
$user = new User();
//keadaan login dengan menggunakan sesi (hak akses)
//sesi 1 adalah admin
if($user->sesi()==1){ ?>
	<li><a href="?mod=datapemilih"><i class="icon-book icon-white"></i> Pemilih Tetap</a></li>
	<li><a href="?mod=kandidatcalon"><i class="icon-book icon-white"></i> Kandidat Calon</a></li>
	<li><a href="?mod=perolehansuara"><i class="icon-book icon-white"></i> Hasil Perolehan Suara</a></li>
	<li><a href="?mod=logout"><i class="icon-off icon-white"></i> Logout</a></li>
<?php }
//sesi 2 adalah user pemvoting
elseif($user->sesi()==2){
	echo "<li><a href=\"?mod=pemilihan\"><i class=\"icon-th-large icon-white\"></i> PEMILU</a></li>";
	echo "<li><a href=\"?mod=logout\"><i class=\"icon-off icon-white\"></i> LOGOUT</a></li>";
}
?>
</ul>
<div class="btn-group pull-right">
	<button class="btn btn-primary"><i class="icon-user icon-white"></i> <?php echo $_SESSION['nama']; ?></button>
</div>