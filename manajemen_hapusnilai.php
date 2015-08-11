<?php
//koneksi database
include "setting/koneksi.php";

if (isset($_GET['id_nilaimapel'])) {
	$id_nilaimapel = $_GET['id_nilaimapel'];
}else {
	die ("Gagal Menghapus. Siswa Belum diilih ! ");	
}


if (!empty($id_nilaimapel) && $id_nilaimapel != "") {
	$SQL = "delete from nilai_mapel where id_nilaimapel='$id_nilaimapel'"; 
 		if(! mysql_query($SQL)) { 
    		echo "Data tidak terhapus!<br>\n"; 
   		} 
   			header("location:index.php?hal=manajemen_lihatnilai");
   		} 
   
?>
