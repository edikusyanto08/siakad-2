<?php
//koneksi database
include "setting/koneksi.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}else {
	die ("Error. Kode Anggota belum dipilih! ");	
}


if (!empty($id) && $id != "") {
$SQL = "delete from anggota_kelas where id_anggota_kelas='$id'"; 
 	if(mysqli_query($con,$SQL)) { 
    	echo "Data tidak terhapus!<br>\n"; 
   } 
   		header("location:index.php?hal=pengolhan_data_lihatanggotakls");
   } 
   
?>
