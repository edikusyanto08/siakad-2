<?php
//koneksi database
include "setting/koneksi.php";

if (isset($_GET['id_jadwalharian'])) {
	$id_jadwalharian = $_GET['id_jadwalharian'];
}else{
	die ("Error. Kode kelas belum dipilih! ");	
}


if (!empty($id_jadwalharian) && $id_jadwalharian != "") {
	$SQL = "delete from jadwalharian where id_jadwalharian='$id_jadwalharian'"; 
 	if(! mysqli_query($con,$SQL)){ 
    	 echo "Data tidak terhapus!<br>\n"; 
   } 
    	 header("location:index.php?hal=pengolhan_data_jadwalharian");
   } 
   
?>
