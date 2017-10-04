<?php
class Database{
	private $dbHost="localhost"; //nama server
	private $dbUser="root"; //username database
	private $dbPass=""; //password database
	private $dbName="evotingdb"; //nama database

	//Fungsi menyambungkan MYSQL
	function sambungMySQL() {
		mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
		mysql_select_db($this->dbName) or die ("Database Tidak Ditemukan di Server");
	}
}

//kelas User
class User{
	//Fungsi Pengecekan Login
	function cek_login($username, $password) {
		$kriptpassword = md5($password); //kriptografi password agar aman
		$result = mysql_query("SELECT * FROM login WHERE username='$username' AND password='$kriptpassword'"); //pemanggilan database
		$user_data = mysql_fetch_array($result); //pengambilan data MySQL (query disimpan ke array)
		$nmr_rows = mysql_num_rows($result); //nomor baris
		if ($nmr_rows == 1) {
			$_SESSION['login'] = TRUE;
			$_SESSION['id'] = $user_data['id_login'];
			$_SESSION['nama'] = $user_data['nama'];
            $_SESSION['username'] = $user_data['username'];
			$_SESSION['level'] = $user_data['level'];
			return TRUE;
		}
		else {
		  return FALSE;
		}
	}

	function sesi(){
		return $_SESSION['level']; 
	} function get_login(){
		return $_SESSION['login']; 
	} function logout(){
		$_SESSION['login'] == FALSE;
		session_destroy();
	}
}

//kelas data pemilih
class DataPemilih {
	//fungsi menampilkan seluruh data pemilih / pemvoting
	function tampilPemilihSemua(){
		$db = mysql_query("SELECT * FROM login WHERE level=2 ORDER BY id_login DESC");
		while($row=mysql_fetch_array($db))
		  $data[]=$row;
	    return $data;
	}
	//fungsi menambahkan data pemilih / pemvoting
	function tambahDataPemilih($username, $nama, $password, $nim, $prodi, $level){
		$db = "INSERT INTO login SET username='$username', nama='$nama', password='$password', nim='$nim', prodi='$prodi', level='$level'";
		return mysql_query($db);
	}
	//fungsi menghapus data pemilih / pemvoting
	function deleteDataPemilih($id){
		$db = "DELETE FROM login WHERE id_login='".$id."'";
		return mysql_query($db);
	}
	//fungsi membaca data pemilih / pemvoting dari database
	function bacaDataPemilih($field, $id){
		$db = mysql_query("SELECT * FROM login WHERE id_login='$id'");
		$data = mysql_fetch_array($db);
		if($field == 'id_login') return $data['id_login'];
		elseif($field == 'username') return $data['username'];
		elseif($field == 'nama') return $data['nama'];
		elseif($field == 'password') return $data['password'];
		elseif($field == 'nim') return $data['nim'];
		elseif($field == 'prodi') return $data['prodi'];
	}
	//fungsi update data dengan password pemilih / pemvoting 
	function updateDataPemilih($username, $nama, $password, $nim, $prodi, $id){
		$db = "UPDATE login SET username='$username', nama='$nama', password='$password', nim='$nim', prodi='$prodi' WHERE id_login='$id'";
		return mysql_query($db);
	}
	//fungsi update data pemilih
	function updateDataPemilih2($username, $nama, $nim, $prodi, $id){
		$db = "UPDATE login SET username='$username', nama='$nama', nim='$nim', prodi='$prodi' WHERE id_login='$id'";
		return mysql_query($db);
	}
}

//kelas data kandidat
class DataKandidat{
	//menampilkan seluruh kandidat
	function tampilKandidatSemua(){
		$db = mysql_query("SELECT * FROM kandidat ORDER BY id_kandidat ASC");
		while($row=mysql_fetch_array($db))
		  $data[]=$row;
	    return $data;
	}
	//fungsi menambahkan data kandidat
	function tambahDataKandidat($nama_kandidat, $visi, $misi, $image){
		$db = "INSERT INTO kandidat SET nama_kandidat='$nama_kandidat', visi='$visi', misi='$misi', foto='$image'";
		return mysql_query($db);
	}
	//fungsi update data kandidat foto
	function updateDataKandidatFoto($nama_kandidat, $visi, $misi, $image, $id){
		$db = "UPDATE kandidat SET nama_kandidat='$nama_kandidat', visi='$visi', misi='$misi', foto='$image' WHERE id_kandidat='$id'";
		return mysql_query($db);
	}
	//fungsi update data kandidat keseluruhan
	function updateDataKandidat($nama_kandidat, $visi, $misi, $id){
		$db = "UPDATE kandidat SET nama_kandidat='$nama_kandidat', visi='$visi', misi='$misi' WHERE id_kandidat='$id'";
		return mysql_query($db);
	}
	//fungsi menghapus data kandidat
	function deleteDataKandidat($id){
		$db = "DELETE FROM kandidat WHERE id_kandidat='".$id."'";
		return mysql_query($db);
	}
	//fungsi membaca data kandidat
	function bacaDataKandidat($field, $id){
		$db = mysql_query("SELECT * FROM kandidat WHERE id_kandidat='$id'");
		$data = mysql_fetch_array($db);
		if($field == 'id_kandidat') return $data['id_kandidat'];
		elseif($field == 'nama_kandidat') return $data['nama_kandidat'];
		elseif($field == 'visi') return $data['visi'];
		elseif($field == 'misi') return $data['misi'];
		elseif($field == 'foto') return $data['foto'];
	}
	//fungsi memilih kandidat
	function pilihKandidat($id_kandidat,$id_login,$waktu,$poin){
		$db = "INSERT INTO voting SET id_kandidat='$id_kandidat', id_login='$id_login', waktu='$waktu', poin='$poin'";
		return mysql_query($db);
	}
	//fungsi untuk validasi pilihan
	function validasiPilihKandidat($session){
		$db = mysql_query("SELECT * FROM voting WHERE id_login='$session'");
		return mysql_num_rows($db);
	}
}

//kelas hasil
class Hasil{
	//fungsi menampilkan hasil 
	function tampilHasilSemua($id){
		$db = mysql_query("SELECT a.*, b.username, b.nim, b.prodi FROM voting a left join login b on a.id_login=b.id_login WHERE id_kandidat='$id'");
		while($row=mysql_fetch_array($db))
		  $data[]=$row;
	    return $data;
	}
	//fungsi mereset ulang voting
	function reset() {
		$db = "TRUNCATE TABLE `voting`";
		return mysql_query($db);
	}
	//fungsi jumlah suara dalam voting
	function jumlahSuaraVoting($id_kandidat){
		$db = mysql_query("SELECT SUM(poin) as jumlah FROM voting WHERE id_kandidat='$id_kandidat'");
		$row = mysql_fetch_array($db);
		return $row;
	}
}

//kelas Validasi pemvotingan
class VotingValidasi{
	function __construct(){}
	function xss($str){
		$str = htmlspecialchars($str);
		return $str;
	}
	function sql($str){
		$rms = array("'","`","=",'"',"@","<",">","*");
		$str = str_replace($rms, '', $str);
		$str = stripcslashes($str);
		$str = htmlspecialchars($str);
		return $str;
	}
}

// fungsi merubah date ke bahasa indonesia
function DateToIndo($date) { 
   // CovertBulan sebagai array yang menyimpan nama bulan dalam bahasa Indonesia
	$ConvertBulan = array("Januari", "Februari", "Maret",
   						"April", "Mei", "Juni",
   						"Juli", "Agustus", "September",
   						"Oktober", "November", "Desember");
	$tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
	$bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
	$tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
	$result = $tgl . " " . $ConvertBulan[(int)$bulan-1] . " ". $tahun;
	return($result);
}

//fungsi untuk menambahkan gambar
function UploadImages($fupload_name){
  //direktori gambar
  $vdir_upload = "img/kandidat/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $imageType = $_FILES["fupload"]["type"];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  switch($imageType) {
    case "image/gif":
      $im_src=imagecreatefromgif($vfile_upload);
      break;
      case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
      $im_src=imagecreatefromjpeg($vfile_upload);
      break;
      case "image/png":
    case "image/x-png":
      $im_src=imagecreatefrompng($vfile_upload);
      break;
  }

  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi besar 400 pixel
  //Set ukuran gambar hasil perubahan

  $dst_width = 300;
  $dst_height = 325;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  switch($imageType) {
    case "image/gif":
        imagegif($im,$vdir_upload.$fupload_name);
      break;
      case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
        imagejpeg($im,$vdir_upload.$fupload_name);
      break;
      case "image/png":
    case "image/x-png":
        imagepng($im,$vdir_upload.$fupload_name);
      break;
  }

  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im2);
}

//fungsi mengupload logo
function UploadLogo($fupload_name){
  //direktori Logo
  $vdir_upload = "asset/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $tipe_file   = $_FILES['fupload']['type'];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload) or die(mysql_error());
}

//fungsi poin memberi poin pada Username
function get_poin($poin) {
    if ($poin == 'IF') {
        return '1';
    } elseif ($poin == 'TG') {
        return '1';
    } elseif ($poin == 'GT') {
        return '1';
    } elseif ($poin == 'FI') {
        return '1';
    }elseif ($poin == 'MA') {
        return '1';
    }elseif ($poin == 'KI') {
        return '1';
    }elseif ($poin == 'BI') {
        return '1';
    }elseif ($poin == 'EL') {
        return '1';
    }elseif ($poin == 'PWK') {
        return '1';
    }elseif ($poin == 'TM') {
        return '1';
    }elseif ($poin == 'TL') {
        return '1';
    }elseif ($poin == 'AR') {
        return '1';
    }
}

function seo_title($s) {
    $c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
    $s = str_replace($d, '', $s);
    $s = strtolower(str_replace($c, '-', $s));
    return $s;
}
?>
