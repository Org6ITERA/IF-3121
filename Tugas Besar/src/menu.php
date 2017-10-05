
<?php
include_once 'include/cls-vote.php';
$user = new User();
//keadaan login dengan menggunakan sesi (hak akses)
//sesi 1 adalah admin


	if($user->sesi()==1){ ?>
		
		 <div id="navi">
	          <nav>          
				<a href="?mod=datapemilih"><i class="icon-book icon-white"></i> Pemilih Tetap</a>
				<a href="?mod=kandidatcalon"><i class="icon-book icon-white"></i> Kandidat Calon</a>
				<a href="?mod=perolehansuara"><i class="icon-book icon-white"></i> Hasil Perolehan Suara</a>
	          </nav> 
	        </div>
	          
	<?php }
	//sesi 2 adalah user pemvoting
	elseif($user->sesi()==2){
		echo "<li><a href=\"?mod=pemilihan\"><i class=\"icon-th-large icon-white\"></i> PEMILU</a></li>";
		echo "<li><a href=\"?mod=logout\"><i class=\"icon-off icon-white\"></i> LOGOUT</a></li>";
	}
	?>