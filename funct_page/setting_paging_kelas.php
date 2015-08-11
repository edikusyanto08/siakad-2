<?php
class Paging {
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas) {
		if(empty($_GET[halaman])){
			$posisi=0;
			$_GET[halaman]=1;
		}else{
			$posisi = ($_GET[halaman]-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas) {

		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";
		// Link First dan Previous
		if ($halaman_aktif > 1){
			$link_halaman .= " <a href=index.php?hal=masterkelas&a=$_GET[a]&halaman=1><font face=verdana size=1 color=#000000><< First</a> | ";
		}	
			if (($halaman_aktif-1) > 0) {
				$previous = $halaman_aktif-1;
				$link_halaman .= "<a href=index.php?hal=masterkelas&a=$_GET[a]&halaman=$previous><font face=verdana size=1 color=#000000>< Previous</a> | ";
		}

		// Link halaman 1,2,3, ...
		for ($i=1; $i<=$jmlhalaman; $i++){
			if ($i == $halaman_aktif){
				$link_halaman .= "<font face=verdana size=1 color=#FF0000><b>$i</b> | ";
			}else{
				$link_halaman .= "<a href=index.php?hal=masterkelas&a=$_GET[a]&halaman=$i>$i</a><font face=verdana size=1 color=#FF0000> | ";
			}
				$link_halaman .= " ";
		}	

		// Link Next dan Last
		if ($halaman_aktif < $jmlhalaman){
			$next=$halaman_aktif+1;
			$link_halaman .= " <a href=index.php?hal=masterkelas&a=$_GET[a]&halaman=$next><font face=verdana size=1 color=#000000>Next ></a> ";
		}
		if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman != 0)){
			$link_halaman .= " | <a href=index.php?hal=masterkelas&a=$_GET[a]&halaman=$jmlhalaman><font face=verdana size=1color=#000000>Last >></a> ";
		}
		return $link_halaman;
	}
}
?>
