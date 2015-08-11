<?php
//koneksi database
include "setting/koneksi.php";

if (isset($_GET['id_wali'])) {

	$id_wali = $_GET['id_wali'];
	
}else {

	die ("Error. Kode kelas belum dipilih! ");	
}


if (!empty($id_wali) && $id_wali != "") {

$SQL = "delete from walikelas where id_wali='$id_wali'"; 
 	if(! mysqli_query($con,$SQL)) { 
    	echo "Data tidak terhapus!<br>\n"; 
   	} 
    	header("location:index.php?hal=pengolhan_data_guruwalikelas");
   	} 
   
?>
