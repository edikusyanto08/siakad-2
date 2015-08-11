<?php
//koneksi database
include "setting/koneksi.php";

if (isset($_GET['kd_kelas'])) {
	$kd_kelas = $_GET['kd_kelas'];
}else {
	die ("Error. Kode kelas belum dipilih! ");	
}


if (!empty($kd_kelas) && $kd_kelas != "") {
	$SQL = "delete from kelas where kd_kelas='$kd_kelas'"; 
 		if(! mysqli_query($con,$SQL)) { 
    		echo "Data tidak terhapus!<br>\n"; 
   		} 
   			header("location:index.php?hal=masterkelas");
   		} 
   
?>
