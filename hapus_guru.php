<?php
//koneksi database
include "setting/koneksi.php";

if (isset($_GET['nip'])) {
	$nip = $_GET['nip'];
}else {
	die ("Error. Nomor Induk Siswa belum dipilih! ");	
}


if (!empty($nip) && $nip != "") {
$SQL = "delete from guru where nip='$nip'"; 
 	if(! mysqli_query($con,$SQL)) { 
   		echo "Data tidak terhapus!<br>\n"; 
   	} 
    	header("location:index.php?hal=masterguru");
   	} 
   
?>
