<?php
//koneksi daid_tabase
include "setting/koneksi.php";

if (isset($_GET['id_ta'])) {
		$id_ta = $_GET['id_ta'];
	}
	
if (!empty($id_ta) && $id_ta != "") {

$SQL = "delete from tahunajaran where id_ta='$id_ta'"; 

 	if(! mysqli_query($con,$SQL)) { 
    	echo "Data tidak terhapus!<br>\n"; 
   	} 
    	header("location:index.php?hal=mastertahunajaran");
   	}   
?>
