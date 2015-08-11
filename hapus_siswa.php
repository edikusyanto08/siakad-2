<?php
//koneksi database
include "setting/koneksi.php";

if (isset($_GET['nis'])) {
	$nis = $_GET['nis'];
}else {
	die ("Error. Nomor Induk Siswa belum dipilih! ");	
}


if (!empty($nis) && $nis != "") {
$SQL = "delete from siswa where nis='$nis'"; 
 	if(! mysqli_query($con,$SQL)) { 
    	echo "Data tidak terhapus!<br>\n"; 
    } 
    	header("location:index.php?hal=mastersiswa");
    } 
   
?>
