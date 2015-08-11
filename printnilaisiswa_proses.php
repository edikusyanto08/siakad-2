<?php session_start();
//koneksi database
include "setting/koneksi.php";

$kd_kelas = $_POST['kelas'];
$id_ta    = $_POST['id_ta'];
$kd_mapel = $_POST['mapel'];
			
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
			} else {
					alert("The print ready feature is only available if you are using an browser. Please update your browswer.");
		}
	}
</script>
<style type="text/css">
		.tb-style-nilai{
			border:1px solid #000;
			font-family: Arial,sans-serif;
		}
		.thstyle-cetak{
			border: 1px solid #000;

		}
		.td-stylenilai{
			border:1px solid #000;
			font-size: 14px;
		}
		.td-stylenilainoberder{
			border:none;
			font-family: Arial,sans-serif;
			font-size: 14px;
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
	<div id="wrapper-kelas">
		<div id="box-nilai">
			<div id="content-nilai">
				<table width="677" border="0" align="center" cellpadding="1" cellspacing="0">
					<tr>
						<td class="td-stylenilainoberder" width="130" align="right" >
						<td class="td-stylenilainoberder" width="677">
							<img src="images/icon/kop.png" width="677" height="105" align="right"/>
						</td>
		   			</tr>
				</table><br>	  
				<table width="677" border="0" align="center" cellpadding="4" cellspacing="0"> 
			    	<tr>
						<td class="td-stylenilainoberder" >Kelas</td>
				        <td class="td-stylenilainoberder" >:
				        	<?php 
								$sql 	= "select kelas from kelas where kd_kelas='$kd_kelas'";
								$tampil = mysqli_query($con,$sql);
								$baris 	= mysqli_fetch_array($tampil);
									echo $baris['kelas']; 
							?>
						</td>
				        <td class="td-stylenilainoberder"  width="152">Mata Pelajaran</td>
				        <td class="td-stylenilainoberder" >:
				        	<?php
								$sql  	= "select mapel from mapel where kd_mapel='$kd_mapel'";
								$tampil = mysqli_query($con,$sql);
								$baris 	= mysqli_fetch_array($tampil);
									echo $baris['mapel']; 
							?>
						</td>
				    </tr>
				    <tr>
						<td class="td-stylenilainoberder" width="152">Tahun Ajaran</td>
				        <td class="td-stylenilainoberder">: 
				        	<?php 
								$sql 	= "select ta from tahunajaran where id_ta='$id_ta'";
								$tampil = mysqli_query($con,$sql);
								$baris 	= mysqli_fetch_array($tampil);
									echo $baris['ta']; 
							?>
						</td>
						<td class="td-stylenilainoberder" width="152">Semester</td>
				    	<td class="td-stylenilainoberder">:
				    	<?php 
								$sql 	= "select semester from tahunajaran where id_ta='$id_ta'";
								$tampil = mysqli_query($con,$sql);
								$baris 	= mysqli_fetch_array($tampil);
									echo $baris['semester']; 
							?>	
				    </tr>
				</table><br>
				<table  width="677" border="0" class="tb-style-nilai"  align="center" cellpadding="2" cellspacing="0">
			    	<tr class="" tb-style-nilai>
				        <th class="thstyle-cetak" width="25">NO</th>
						<th class="thstyle-cetak" width="71">NIS</th>
						<th class="thstyle-cetak" width="250">Nama</th>
						<th class="thstyle-cetak" width="75">Nilai</th>
				        <th class="thstyle-cetak" width="75">Predikat</th>
			    	</tr>
					<?php 
						$sql1 = "SELECT * FROM leger a
								 LEFT JOIN anggota_kelas ak ON a.nis=ak.nis
								 JOIN siswa b ON a.nis=b.nis
								 JOIN kelas c ON ak.kd_kelas=c.kd_kelas
								 JOIN mapel d ON a.kd_mapel=d.kd_mapel
								 WHERE c.kd_kelas='$kd_kelas' AND a.id_ta='$id_ta' AND d.kd_mapel='$kd_mapel' AND ak.id_ta='$id_ta'";
					$result1 = mysqli_query($con,$sql1);
					$no=0;
					while($data1 = mysqli_fetch_array($result1)){
					//setting fungsi nilai akhir KKM
					 	$akhir=$data1['nilai'];

					if (($akhir <100) and ($akhir >=75)) {
					 		$huruf="Lulus";
					}else{
							$huruf="Tidak Lulus";
						 }
					?>
					<tr>
						<td class="td-stylenilai" align="center"><?php $no++; echo $no; ?></td>
						<td class="td-stylenilai" align="center"><?php echo $data1['nis']; ?></td>
						<td class="td-stylenilai" align="center"><?php echo $data1['nama_siswa'];?></td>
						<td class="td-stylenilai" align="center"><?php echo $data1['nilai']; ?></td>
						<td class="td-stylenilai" align="center"><?php echo $huruf; ?></td>
		 		<?php } ?>
					</tr>
					</table><br>
			<center><table width="677" border="0" cellpadding="2" cellspacing="0">
			<?php 
				$sql 	= "select nama,nip,gelar_dp,gelar_bk from guru where jabatan='Kepala Sekolah'";
				$tampil = mysqli_query($con,$sql);
				$baris 	= mysqli_fetch_array($tampil); 
			?>
    			<tr align="right">
					<td class="td-stylenilainoberder" width="405"></td>
			        <td class="td-stylenilainoberder" width="262" align="center">
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
					<td class="td-stylenilainoberder" width="405"></td>
        			<td class="td-stylenilainoberder" width="262" align="center">
        			<br><br>
        			<p><strong><?php echo $baris['gelar_dp'];  echo " "; echo $baris['nama']; echo " "; echo $baris['gelar_bk']; ?></strong>
        			<br><strong><?php echo $baris['nip']?> </strong></p>
        			</td>
   				</tr>
				</tr></center>
				</table>
		</div>
	</div>
</div>
</body>
</head> 
</html>
    	