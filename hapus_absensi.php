<?php
//koneksi database
include "setting/koneksi.php";

	if (isset($_GET['id_absen'])) {
		$id_absen = $_GET['id_absen'];

	}else {

	 die ("Error. ID absensi belum dipilih! ");	

	}

if (!empty($id_absen) && $id_absen != "") {
	$query = "delete from absensi where id_absen='$id_absen'"; 
 		if(! mysqli_query($con,$query)) { 
   		 	echo "Data tidak terhapus!<br>\n"; 
   		} 
    		header("location:index.php?hal=pengolhan_data_absensi");
} 
   
?>
