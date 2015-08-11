<?php
//koneksi database
include "setting/koneksi.php";

if (isset($_GET['kd_mapel'])) {
	$kd_mapel = $_GET['kd_mapel'];
}else{
	die ("Error. Kode kelas belum dipilih! ");	
}


	if (!empty($kd_mapel) && $kd_mapel != "") {
	$SQL = "delete from mapel where kd_mapel='$kd_mapel'"; 
 	if(! mysqli_query($con,$SQL)){ 
    	 echo "Data tidak terhapus!<br>\n"; 
   } 
    	 header("location:index.php?hal=mastermappel");
   } 
   
?>
