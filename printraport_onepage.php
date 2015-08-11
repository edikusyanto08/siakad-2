<?php session_start();
//koneksi database
include "setting/koneksi.php";

	$nis =$_GET['nis'];
	$ta  =$_GET['id_ta'];
?>

<html>
<head>
	<script language="JavaScript">
		var gAutoPrint = true; // Tells whether to automatically call the print function
			function printSpecial() {
				if (document.getElementById != null) {
					var html = '<HTML>\n<HEAD>\n';
				if (document.getElementsByTagName != null) {
					var headTags = document.getElementsByTagName("head");
				if (headTags.length > 0)
						html += headTags[0].innerHTML;
				}
						html += '\n</HE>\n<BODY>\n';
		var printReadyElem = document.getElementById("printReady");
				if (printReadyElem != null) {
						html += printReadyElem.innerHTML;
				}else{
									
						alert("Could not find the printReady function");
				return;
				}
						html += '\n</BO>\n</HT>';
					var printWin = window.open("","printSpecial");
						printWin.document.open();
						printWin.document.write(html);
						printWin.document.close();
					if (gAutoPrint)
						printWin.print();
					}else{
						alert("The print ready feature is only available if you are using an browser. Please update your browswer.");
						}
				}

</script>
<style type="text/css">
	/*custom css prin*/
	.style-raport{
				border:none;
				font-size: 14px;
	}
	.style-indent{
				font-size: 14px;

	}
	.td-styleborder{
				border:1px solid #000;
				font-size: 14px;

	}

</style>

<link rel="stylesheet" type="text/css" href="css/base_style.css"/>
</head>
<body>
<div id="tombl-kembali">
         <a href="index.php?hal=printraport_siswa">
            <img src="images/icon/panah-kembali.png" width="40" height="40"></a>
</div>
    <div id="tombolprint">
         <a href="javascript:void(printSpecial())">
            <img src="images/icon/Printer1.png" width="48" height="48" border="0"></a>
    </div>
	<div id="printReady"></p>
		 <div id="wrapperprint-guru">
            <div id="contentprint-guru">
				<table width="677"  align="center" cellpadding="2" cellspacing="0" c>
					<tr>
						<td class="style-raport" width="130" align="right" ></td>
						<td class="style-raport" width="677">
							<img src="images/icon/kop.png" width="677" height="105" align="right"/>
						</td>
		   			</tr>
				</table><br>
				<table border="0" align="center" class="style-indent" width="677"> 
					<?php 
					  	$sql="SELECT a.nilai, ak.id_ta, b.nis, b.nama_siswa, c.kelas, d.mapel,
					  	 d.jenis_mapel, d.kd_mapel, d.kkm, e.ta, e.semester
								FROM leger a
								LEFT JOIN anggota_kelas ak ON a.nis=ak.nis
								LEFT JOIN siswa b ON a.nis=b.nis
								LEFT JOIN kelas c ON ak.kd_kelas=c.kd_kelas
								LEFT JOIN mapel d ON a.kd_mapel=d.kd_mapel
								LEFT JOIN absensi ab ON d.kd_mapel=ab.kd_mapel
								LEFT JOIN tahunajaran e ON a.id_ta=e.id_ta
								WHERE b.nis='$nis' AND a.id_ta='$ta' AND ak.id_ta='$ta' 
								ORDER BY d.jenis_mapel ASC, d.mapel ASC";
						// $sql = "SELECT * FROM leger WHERE nis='$nis' AND id_ta='$id_ta'";
						$no=1;
						$result = mysqli_query($con,$sql);
						if ($result === FALSE) {
							die(mysql_error);
						}
						while($siswa = mysqli_fetch_array($result)) {
					?>
					
					<?php 
						$nama_sekolah="SMP Negeri 2 Godean";
						$alamat_sekolah="Sidomoyo Godean Sleman";
					?>

					<tr>
						<td class="style-raport">Nama Sekolah</td>
						<td class="style-raport">: <?php echo $nama_sekolah;?></td>
						<td class="style-raport">Kelas</td>
						<td class="style-raport">: <?php echo $siswa['kelas'];?></td>
					</tr>
					<tr>
						<td class="style-raport">Alamat </td>
						<td class="style-raport">: <?php echo $alamat_sekolah;?></td>
						<td class="style-raport">Semester</td>
						<td class="style-raport">: <?php echo $siswa['semester'];?></td>
					</tr>
					<tr>
						<td class="style-raport">Nama</td>
						<td class="style-raport">: <?php echo $siswa['nama_siswa'];?></td>
						<td class="style-raport">Tahun Pelajaran</td>
						<td class="style-raport">: <?php echo $siswa['ta'];?></td>
					</tr>			
					<tr>
						<td class="style-raport">Nis</td>
						<td class="style-raport">: <?php echo $siswa['nis'];?></td>
					</tr>
				</table><p></p>     
				<table width="677" align="center" class="style-indent"  border="0" cellpadding="1" cellspacing="0">
					<tr> 
				        <th class="td-styleborder" width="30" align="center">No</th>
						<th class="td-styleborder" width="200" align="center">Mata Pelajaran</th>
						<th class="td-styleborder" width="75">KKM</th>
				        <th class="td-styleborder" width="100">Nilai</th>
						<th class="td-styleborder" width="100">Deskripsi Kemajuan Belajar</th>
					</tr>
						<?php
							$nilaiakhir=$siswa['nilai'];

							if (($nilaiakhir<100) and ($nilaiakhir>=80)) {
										$huruf="LULUS";
									}elseif ((80>$nilaiakhir) and ($nilaiakhir>=75)) {
										$huruf="LULUS";
									}elseif ((75>$nilaiakhir) and ($nilaiakhir>=55)) {
										$huruf="TIDAK LULUS";
									}elseif ((55>$nilaiakhir) and ($nilaiakhir>=25)) {
										$huruf="TIDAK LULUS";
									}elseif ((25>$nilaiakhir) and ($nilaiakhir>0)) {
										$huruf="TIDAK LULUS";
									}else{
										$huruf="TIDAK LULUS";
									}
					?>

					<tr>
				    	<td class="td-styleborder" align="center"><?php echo $no; $no++; ?></td>
						<td class="td-styleborder" align="center"><?php echo $siswa['mapel']; ?></td>
						<td class="td-styleborder" align="center"><?php echo $siswa['kkm']; ?></td>
						<td class="td-styleborder" align="center"><?php echo $siswa['nilai']; ?></td>
						<td class="td-styleborder" align="center"><?php echo $huruf; ?></td>
					</tr>
					<div class="content-nilaiclearfix">
					</div>	
					<!--     //medefinisikan jenis mapel yang ditampilkan -->
					<?php
							$jenis_mapel = '';
							while($mp = mysqli_fetch_array($result)){
								if ($jenis_mapel != $mp['jenis_mapel']  ) {
									echo '<tr><td colspan="5"><b>'.$mp[''].'<b></td></tr>';
									$jenis_mapel = $mp['jenis_mapel'];
								}
					?>
					<tr style="margin-top:-20px;">
				    	<td class="td-styleborder" align="center"><?php echo $no; ?></td>
						<td class="td-styleborder" align="center"><?php echo $mp['mapel']; ?></td>
						<td class="td-styleborder" align="center"><?php echo $mp['kkm']; ?></td>
						<td class="td-styleborder" align="center"><?php echo $mp['nilai']; ?></td>
					</td>
						<!--     //medefinisikan nilai predikat -->
						<?php
								 $nilaiakhir=$mp['nilai'];

									if (($nilaiakhir<100) and ($nilaiakhir>=80)) {
										$huruf="LULUS";
									}elseif ((80>$nilaiakhir) and ($nilaiakhir>=75)) {
										$huruf="LULUS";
									}elseif ((75>$nilaiakhir) and ($nilaiakhir>=55)) {
										$huruf="TIDAK LULUS";
									}elseif ((55>$nilaiakhir) and ($nilaiakhir>=25)) {
										$huruf="TIDAK LULUS";
									}elseif ((25>$nilaiakhir) and ($nilaiakhir>0)) {
										$huruf="TIDAK LULUS";
									}else{
										$huruf="TIDAK LULUS";
									}
						?>
							
					
							<td class="td-styleborder" align="center"><?php echo $huruf; ?></td>
							<?php $no++; } ?>
						</tr>
					</table><br>
			<table border="0" align="center" width="677"  cellpadding="1" cellspacing="0"> 
				<?php 
					$sql1 = "SELECT a.nis, c.nama_siswa, a.tgl_absen
							, SUM(CASE WHEN a.keterangan='Izin' THEN 1 ELSE 0 END) Izin
							, SUM(CASE WHEN a.keterangan='Sakit' THEN 1 ELSE 0 END) Sakit
							, SUM(CASE WHEN a.keterangan='Alpha' THEN 1 ELSE 0 END) Alpha
							, SUM(CASE WHEN a.keterangan='Izin' THEN 1 ELSE 0 END) 
							+ SUM(CASE WHEN a.keterangan='Sakit' THEN 1 ELSE 0 END) 
							+ SUM(CASE WHEN a.keterangan='Alpha' THEN 1 ELSE 0 END) total
							FROM absensi a
							JOIN siswa c ON a.nis=c.nis
						WHERE a.nis='$_GET[nis]'";
						$result = mysqli_query($con,$sql1);
						while($absen = mysqli_fetch_array($result)){
				?>
				<tr>
					<td class="td-styleborder" colspan="3"><strong>Ketidakhadiran</strong></td>
				</tr>
				<tr>
	        		<td class="td-styleborder"  width="200" rowspan="4">Ketidakhadiran</td>
				</tr>
				<tr>
					<td class="td-styleborder"  width="75">Sakit</td>
					<td class="td-styleborder"  width="75"><?php echo $absen['Sakit'];?> Hari</td>
				</tr>
				<tr>
	        		<td class="td-styleborder"  width="100">Izin</td>
					<td class="td-styleborder" width="100"><?php echo $absen['Izin'];?> Hari</td>
				</tr>
				<tr>
					 <td class="td-styleborder" width="100">Alpha</td>     
					 <td class="td-styleborder" width="100"><?php echo $absen['Alpha'];?> Hari</td>
				</tr>
		<?php } ?>
			</table><br>	  
			<table width="677" border="0" align="center" cellpadding="2" cellspacing="0">
			    <tr>
					<td class="style-raport" width="212" align="center">
			        	<p><strong>
			        	<?php
							$sql = "SELECT * FROM guru g
									INNER JOIN kelas k	
									ON g.nip=k.nip 
									WHERE g.nip=k.nip";
							$tampil = mysqli_query($con,$sql);
							$y=mysqli_fetch_array($tampil);
						?>
					<br />Kepala Sekolah</strong></p>
			        </td>
       				<td class="style-raport" width="212" align="center">
        				<p><strong>
        				<?php
							$sql = "select * from guru where jabatan='Kepala Sekolah'";
							$tampil = mysqli_query($con,$sql);
							$baris=mysqli_fetch_array($tampil);
							
							$array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
							$bulan = $array_bulan[date('n')];
							$tgl = date('j');
							$thn = date('Y'); 
							echo "Yogyakarta, ".$tgl." ".$bulan." ".$thn;
							?>
						<br />Wali Kelas</strong></p>
        			</td>
				</tr>
				<tr>
			        <td class="style-raport" width="212" align="center">
			        	<br><br>
			        	<p><strong><?php echo $baris['gelar_dp'];  echo " "; echo $baris['nama']; echo " "; echo $baris['gelar_bk']; ?></strong><br><strong>
			        		<?php echo $baris['nip']?> </strong></p>
			        </td>
					<td class="style-raport" width="212" align="center">
			        	<br><br>
			        	<p><strong><?php echo $y['gelar_dp'];  echo " "; echo $y['nama']; echo " "; echo $y['gelar_bk']; ?></strong><br><strong>
			        		<? echo $y['nip']?> </strong></p>
			        </td>
			    </tr>
			</table>
	</div>
		<p align="center">
		<!-- <a href="javascript:void(printSpecial())">
			<img src="images/icon/Printer1.png" width="48" height="48" border="0"></a> -->
</body>
 <?php  }?>
</head>
</html>