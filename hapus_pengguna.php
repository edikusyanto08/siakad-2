<?php
//koneksi database
include "setting/koneksi.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}else {
	die ("Error. Username belum  dipilih! ");	
}


if (!empty($id) && $id != "") {
$datapengguna = "delete from user where id='$id'"; 
 	if(! mysqli_query($con,$datapengguna))  { 
    	echo "Data tidak terhapus!<br>\n"; 
   } 
    	header("location:index.php?hal=masterpengguna");
   } 
   
?>
