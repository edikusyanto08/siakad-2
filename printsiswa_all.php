<?php session_start();
//koneksi database
include "setting/koneksi.php";

	$kd_kelas = $_GET['kd_kelas'];	
	$id_ta 	  = $_GET['id_ta'];
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
	.tdstyling-siswa{
			border:none;

	}
	.postion-box{
			margin: 0px 0px 0px 176px;
			width: 74%;
	}
	.styling-fonts{
			font-family: Arial,sans-serif;
	}
	.th-stylebox{
			border: 1px solid #000;
	}
	.td-stylebox{
			border: 1px solid #000;
			text-align: center;
			font-size: 15px;
			font-family: Arial,sans-serif;
	}
	.td-styleboxnone{
			border: none;
			font-family: Arial,sans-serif;
			
	}
	.styling-fonttitle{
			font-size: 15px;
			font-family: Arial,sans-serif;
			text-align: center;
			margin: -20px 0px 5px 0px;
	}
	.content-headerlap{
			width: 100%;
	}	
	.isi-headerlap{
	}
	#tombl-kembali{
			margin: 0px 0px 0px 0px;
			width: 20%;
			padding: 10px 0px 0px 18%;
			display: block;
			display: block;
	}				
	#tombolprint{
			width: 20%;
			height: 56px;
			float: right;
			margin: -39px 24px 0px 0px;
	}
	.styling-fonttop{
			font-family: Arial,sans-serif;
			margin: 0px 0px 0px 26px;
			text-align: center;
			font-weight: bold;
	}
	.styling-fontdown{
			font-family: Arial,sans-serif;
			margin: 0px 0px 0px 28px;
			text-align: center;
			font-weight: normal;
			font-size: 102%;
	}
	.styling-tableguru{
			font-family: Arial,sans-serif;
			font-size: 12px;
			text-align: center;
	}
	.styling-fonttitle{
			font-size: 15px;
			font-family: Arial,sans-serif;
			text-align: center;
			margin: -20px 0px 5px 0px;
	}
	.styling-fontkepsek{
			font-family: Arial,sans-serif;
			font-size: 13px;
	}
	.postion-img{
			margin: 0px 0px 0px 310px;
			display: inline-block;
	}

</style>
<!-- <link rel="stylesheet" type="text/css" href="css/base_style.css"/> -->
</head>
<body style="background: #fff;">
<div id="tombl-kembali">
	<a href="index.php?hal=laporan_siswa">
        <img src="images/icon/Arrow-Right.png" width="40" height="40"></a></div>
    <div id="tombolprint">
         <a href="javascript:void(printSpecial())" target="">
         	<img src="images/icon/hp-printer.png" width="48" height="48" border="0"></a></div>	
	<div id="printReady"></p>
<!-- 	<div class="postion-box" -->
		<div class="content header">
		<div class="postion-img">
			<img src="images/icon/kop large.png" style="width: 675px;"></img></div>
			<hr width="1060">
		  	<hr width="1060" style="margin-top: -7px; margin-bottom: 49px;">
		</div>
		<table width="1000" border="0" align="center" cellpadding="1" cellspacing="0" >
            <tr>
              	<td class="tdstyling-siswa">
              		<h4 class="styling-fonttitle">DATA SISWA SMP NEGERI 2 GODEAN SLEMAN<br>
	              	<?php 
	              		$sql = "select kelas from kelas where kd_kelas='$kd_kelas'";
						$tampil = mysqli_query($con,$sql);
						$baris=mysqli_fetch_array($tampil);
							echo $baris['kelas']; ?></h4>
				</td>
            </tr>
			<tr>
              	<td class="tdstyling-siswa">
              		<h4 class="styling-fonts" align="center"> Tahun Ajaran
		        <?php 
					  $sql = "select ta, semester from tahunajaran where id_ta='$id_ta'";
					  $tampil = mysqli_query($con,$sql);
					  $baris=mysqli_fetch_array($tampil);
							echo $baris['ta']; echo " - "; echo $baris['semester'];?></h4></td>
            </tr>
        </table><br>		  
		<table  width="1060" border="1"  align="center" cellpadding="1" cellspacing="0" style="margin-top: -30px;">
            <tr>
	            <th class="th-stylebox" width="71"><div align="center"><strong>NIS</strong></div></th>
				<th class="th-stylebox" width="200"><div align="center"><strong></strong>Nama</div></th>
				<th class="th-stylebox" width="150"><div align="center"><strong></strong>TTL</div></th>
				<th class="th-stylebox" width="75"><div align="center"><strong></strong>Jenis Kelamin</div></th>
	            <th class="th-stylebox" width="41"><div align="center"><strong>Agama</strong></div></th>
				<th class="th-stylebox" width="200"><div align="center"><strong>Alamat</strong></div></th>
            </tr>
				<?php 
				$sql1 = "select * from anggota_kelas a
						 INNER JOIN siswa b ON a.nis=b.nis 
						 where a.kd_kelas='$kd_kelas' AND a.id_ta='$_GET[id_ta]'";
				$result1 = mysqli_query($con,$sql1);
				while($data1 = mysqli_fetch_array($result1)){
				?>
			<tr>
				<td class="td-stylebox"><?php echo $data1['nis']; ?></td>
				<td class="td-stylebox"><?php echo $data1['nama_siswa'];?></td>
				<td class="td-stylebox"><?php echo $data1['tempat_lahir']; echo ", "; echo $data1['tgl_lahir'] ?></td>
				<td class="td-stylebox"><?php echo $data1['jen_kel'] ; ?></td>
		        <td class="td-stylebox"><div align="center"><?php echo $data1['agama']; ?></div></td>
				<td class="td-stylebox"><?php echo $data1['alamat_siswa']; ?></td>
				<?php } ?>
			</tr>
		</table>      
		<br>
		<center><table width="1000" border="0" cellpadding="2" cellspacing="0">
				<?php
				 $sql = "select g.nama, g.nip, g.gelar_dp, g.gelar_bk from kelas k inner join guru g on k.nip=g.nip where k.kd_kelas='$kd_kelas'";
						$tampil = mysqli_query($con,$sql);
						$baris=mysqli_fetch_array($tampil); ?>
		    <tr align="right">
				<td class="td-styleboxnone" width="455"></td>
		        <td class="td-styleboxnone" width="212" align="center">
        		<p><strong>
        			<?php
							$array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
							$bulan = $array_bulan[date('n')];
							$tgl = date('j');
							$thn = date('Y'); 
							echo "Yogyakarta, ".$tgl." ".$bulan." ".$thn;
					?><br />Wali Kelas</strong></p>
       			</td>
			</tr>
			<tr align="right">
				<td class="td-styleboxnone" width="455"></td>
		        <td class="td-styleboxnone" width="212" align="center">
        		<br><br>
        		<p><strong><?php echo $baris['gelar_dp'];  echo " "; echo $baris['nama']; echo " "; echo $baris['gelar_bk']; ?></strong><br><strong><? echo $baris['nip']?> </strong></p>
        		</td>
    		</tr>
		</table></center>
		<form>
	</div>
</div>
</body>
</head>
</html>