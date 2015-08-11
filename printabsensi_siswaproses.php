<?php session_start();
//koneksi database
include "setting/koneksi.php";

$id_ta    = $_POST['id_ta'];	
$kd_kelas = $_POST['kelas'];
$kd_mapel = $_POST['mapel'];	
			
?>

<html>
<head>
<script language="JavaScript">
	var gAutoPrint = true; // Tells whether to automatically call the print function
		function printSpecial(){
			if (document.getElementById != null){
	var html = '<HTML>\n<HEAD>\n';
			if (document.getElementsByTagName != null){
	var headTags = document.getElementsByTagName("head");
			if (headTags.length > 0)
				html += headTags[0].innerHTML;
					}
				html += '\n</HE>\n<BODY>\n';
	var printReadyElem = document.getElementById("printReady");
			if (printReadyElem != null){
				html += printReadyElem.innerHTML;
			}else {
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
		 	}else {
					alert("The print ready feature is only available if you are using an browser. Please update your browswer.");
		}
	}
</script>
<style type="text/css">
	.td-stylectakabsensi{
				border: 1px solid #000;
	}
	.thstylecetak{
				border: 1px;
	}
	.tabl-stylecetak-asbsensi{
			margin: 30px 0px 40px 88px;
			font-size: 15px;
		
	}	

</style>
<link rel="stylesheet" type="text/css" href="css/base_style.css"/>
</head>
<body>
<div id="tombl-kembali">
         <a href="javascript:window.history.back()">
         	<img src="images/icon/panah-kembali.png" width="40" height="40"></a>
</div>
    <div id="tombolprint">
         <a href="javascript:void(printSpecial())">
         	<img src="images/icon/Printer1.png" width="48" height="48" border="0"></a>
    </div>
	<div id="printReady"></p>
		<div id="wrapperprint-guru">
            <div id="contentprint-guru">	
				<table width="677" border="0" align="center" cellpadding="1" cellspacing="0">
					<tr>
					
						<th class="tdguru-cetak" width="677">
							<img src="images/icon/kop.png" width="677" height="105" align="right"/>
						</td>
		  			</tr>
				</table><p></p>	  
				<table width="677" border="0" align="center" cellpadding="1" cellspacing="0"> 
		    		<tr>
		        		<td class="tdguru-cetak" width="152">Tahun Ajaran</td>
		       		 	<td class="tdguru-cetak">: <?php
									$sql = "select ta from tahunajaran where id_ta='$id_ta'";
									$tampil = mysqli_query($con,$sql);
									$baris=mysqli_fetch_array($tampil);
									echo $baris['ta']; ?></td>

						<td class="tdguru-cetak" width="152">Semester</td>
		       		 	<td class="tdguru-cetak">: <?php
									$sql = "select semester from tahunajaran where id_ta='$id_ta'";
									$tampil = mysqli_query($con,$sql);
									$baris=mysqli_fetch_array($tampil);
									echo $baris['semester']; ?></td>
		    	    </tr>
					<tr>
		        		<td class="tdguru-cetak">Kelas</td>
		       		 	<td class="tdguru-cetak">: <?php 
									$sql = "select * from kelas where kd_kelas='$kd_kelas'";
									$tampil = mysqli_query($con,$sql);
									$baris=mysqli_fetch_array($tampil);
									echo $baris['kelas']; ?></td>
						<td class="tdguru-cetak">Mapel</td>
		       		 	<td class="tdguru-cetak">: <?php 
									$sql = "select * from mapel where kd_mapel='$kd_mapel'";
									$tampil = mysqli_query($con,$sql);
									$baris=mysqli_fetch_array($tampil);
									echo $baris['mapel']; ?></td>
		    		</tr>
				</table> <p></p>
				<table  width="677" border="0" class="tabl-stylecetak-asbsensi" align="center" cellpadding="1" cellspacing="0">
		    		<tr class="tb-stylectakabsensi">
				        <th class="td-stylectakabsensi" width="71">NIS</th>
						<th class="td-stylectakabsensi" width="250">Nama Siswa</th>
						<th class="td-stylectakabsensi" width="50">Sakit</th>
						<th class="td-stylectakabsensi" width="50">Izin</th>
				        <th class="td-stylectakabsensi" width="50">Alpha</th>
					</tr>
					<?php 
						$sql1 = "SELECT a.nis, c.nama_siswa, a.tgl_absen, a.keterangan
								, SUM(CASE WHEN a.keterangan='Izin' THEN 1 ELSE 0 END) Izin
								, SUM(CASE WHEN a.keterangan='Sakit' THEN 1 ELSE 0 END) Sakit
								, SUM(CASE WHEN a.keterangan='Alpha' THEN 1 ELSE 0 END) Alpha
								, SUM(CASE WHEN a.keterangan='Izin' THEN 1 ELSE 0 END) 
								+ SUM(CASE WHEN a.keterangan='Sakit' THEN 1 ELSE 0 END) 
								+ SUM(CASE WHEN a.keterangan='Alpha' THEN 1 ELSE 0 END) total

								FROM absensi a
								JOIN siswa c ON a.nis=c.nis
								JOIN kelas d ON a.kd_kelas=d.kd_kelas
								JOIN tahunajaran e ON e.id_ta=a.id_ta
								JOIN mapel m ON a.kd_mapel=m.kd_mapel
								WHERE d.kd_kelas='$_POST[kelas]' AND a.id_ta='$_POST[id_ta]' AND m.kd_mapel='$_POST[mapel]'
								GROUP BY c.nis";
						$result = mysqli_query($con,$sql1);
						while ($data = mysqli_fetch_array($result)){
					?>
							<tr>
								<td class="td-stylectakabsensi" align="center"><?php echo $data['nis']; ?></td>
								<td class="td-stylectakabsensi" align="center"><?php echo $data['nama_siswa'];?></td>
								<td class="td-stylectakabsensi" align="center"><?php echo $data['Sakit']; ?></td>
								<td class="td-stylectakabsensi" align="center"><?php echo $data['Izin'];?></td>
								<td class="td-stylectakabsensi" align="center"><?php echo $data['Alpha']; ?></td>
							</tr>
						<?php }?>  
				</table><p></p>
				<center><table width="677" border="0" cellpadding="2" cellspacing="0">
					<?php
						 $sql = "select * from guru where jabatan='Kepala Sekolah'";
								$tampil = mysqli_query($con,$sql);
								$baris=mysqli_fetch_array($tampil); 
					?>
				    <tr align="right">
						<td class="tdguru-cetak" width="455"></td>
				        <td class="tdguru-cetak" width="212" align="center">
				        	<p><strong>
				        <?php
							$array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
								  $bulan = $array_bulan[date('n')];
								    $tgl = date('j');
								    $thn = date('Y'); 
										echo "Yogyakarta, ".$tgl." ".$bulan." ".$thn;
						?><br />Kepala Sekolah</strong></p>
				        </td>
					</tr>
					<tr align="right">
						<td class="tdguru-cetak" width="455"></td>
				        <td class="tdguru-cetak" width="212" align="center">
				        	<br><br>
	        				<p><strong><?php echo $baris['gelar_dp'];  echo " "; echo $baris['nama']; echo " "; echo $baris['gelar_bk']; ?></strong>
	        				<br><strong><?php echo $baris['nip']?> </strong></p>
	        			</td>
	    			</tr>
				</table></center>
    	</div>
	</div>
</body>
</head> 
</html>
