<?php
include "setting/koneksi.php";

// membaca kode matapelajaran yang akan diupdate
	$mapel 			= $_POST['mapel'];
	$kelas			= $_POST['kelas'];
	$id_ta  		= $_POST['id_ta'];
	$id_nilaimapel  = $_POST['id_nilaimapel'];
 
$nilai_arr1 = $_POST['ulangan_1'];
$nilai_arr2 = $_POST['ulangan_2'];
$nilai_arr3 = $_POST['uts'];
$nilai_arr4 = $_POST['uas'];
$nis = $_POST['nis'];
$nilai_akhir = $_POST['nilai_akhir'];
$a=0;
foreach($nilai_arr1 as $ulangan_1) {
	//validasi data cek apakah data sudah ada
	$query = mysqli_query("SELECT * FROM nilai_mapel WHERE  kd_mapel='$mapel' AND id_ta='$id_ta'  AND nis='$nis' AND id_nilaimapel='$id_nilaimapel'");
	$existing = mysqli_fetch_assoc($con,$query);
	// jika ada edit
	if ($existing) { 
		$sql = "UPDATE nilai_mapel SET ulangan_1='$ulangan_1', ulangan_2='$ulangan_2', uts='$uts', uas='$uas' 
		 		WHERE  kd_mapel='$mapel' AND id_ta='$id_ta' AND nis='$nis[$a]' AND id_nilaimapel='$id_nilaimapel'";
	}else{ 
		$sql = "INSERT INTO nilai_mapel(id_ta, nis,  kd_mapel, ulangan_1, ulangan_2, uts, uas) VALUES
		('$id_ta', '$nis[$a]',  '$mapel', '$ulangan_1', '$nilai_arr2[$a]', '$nilai_arr3[$a]', '$nilai_arr4[$a]')";

		$sql2= "INSERT INTO leger (id_ta, nis, kd_mapel, nilai ) VALUES ('$id_ta','$nis[$a]', '$mapel', '$nilai_akhir[$a]') ";
		$hasil1 = mysqli_query($con,$sql);
		$hasil2 = mysqli_query($con,$sql2);

		/*echo $sql."<br/>";
		echo $sql2;*/
	}
		$a++;
}
	header("location:index.php?hal=manajemen_inputnilai");
 
?>