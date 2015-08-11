<?php session_start();
//koneksi database
include "setting/koneksi.php";
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
	.styling-fontguruall{
			font-family: Arial,sans-serif;
			margin: 0px 0px 0px 264px;
			text-align: center;
			font-weight: normal;
			font-size:18px;
	}
	.styling-fontguruallinner{
			font-family: Arial,sans-serif;
			margin: 0px 0px 0px -17px;
			text-align: center;
			font-weight: normal;
			font-size: 18px;
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
</head>

<body style="background:#fff;">
	<div id="tombl-kembali">
         <a href="javascript:window.history.back()"><img src="images/icon/Arrow-Right.png" width="40" height="40"></a></div>
    <div id="tombolprint">
         <a href="javascript:void(printSpecial())">
         	<img src="images/icon/hp-printer.png" width="48" height="48" border="0"></a></div>
	<div id="printReady"></p>
	<div class="content header">
		<div class="postion-img">
			<img src="images/icon/kop large.png" style="width: 675px;"></img></div>
			<hr width="1200px">
		  	<hr width="1200px" style="margin-top: -7px; margin-bottom: 49px;">
		</div>
          <!-- <div class="content-headerlap">
           		<div class="isi-headerlap">
		  			<h2 class="styling-fontguruall">PEMERINTAH KABUPATEN SLEMAN</h2>
		  			<h2 class="styling-fontguruallinner">DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA</h2>
		  			<h2 class="styling-fonttop">SEKOLAH MENENGAH PERTAMA NEGERI 2 GODEAN</h2>
		  			<h3 class="styling-fontdown"> Alamat : Sidomoyo, Godean, Sleman, Yogyakarta telp (0274)7114120 kodepos 55564</h3>
		  		</div>
		  			<hr width="1200px">
		  			<hr width="1200px" style="margin-top: -7px; margin-bottom: 49px;" > -->
		  			<h4 class="styling-fonttitle">DATA GURU SMP NEGERI 2 GODEAN SLEMAN</h4>
          	</table><br>		  
			<table class="styling-tableguru" width="1200" border="1"  align="center" cellpadding="2" cellspacing="0">
              	<tr>
                	<th style="padding: 5px;" class="tdcetak-style" width="100"><div align="center">NIP</div></th>
					<th class="tdcetak-style" width="250"><div align="center">Nama</div></th>
					<th class="tdcetak-style" width="200"><div align="center">TTL</div></th>
					<th class="tdcetak-style" width="100"><div align="center">Jenis Kelamin</div></th>
                	<th class="tdcetak-style" width="50"><div align="center">Agama</div></th>
				 	<th class="tdcetak-style" width="50"><div align="center">Status</div></th>
					<th class="tdcetak-style" width="250"><div align="center">Alamat</div></th>
              	</tr>
			<?php 
				$sql1 = "select * from guru";
				$result1 = mysqli_query($con,$sql1);
				while($data1 = mysqli_fetch_array($result1)){
				?>
				<tr>
					<td class="tdcetak-style"><div align="center"><?php echo $data1['nip']; ?></div></td>
					<td class="tdcetak-style"><?php echo $data1['nama'];?></td>
					<td class="tdcetak-style"><?php echo $data1['tempat_lahir']; echo ", "; echo $data1['tgl_lahir'] ?></td>
					<td class="tdcetak-style"><div align="center"><?php echo $data1['jen_kel'] ; ?></div></td>
			        <td class="tdcetak-style"><div align="center"><?php echo $data1['agama']; ?></div></td>
					<td class="tdcetak-style"><div align="center"><?php echo $data1['status_kepegawaian']; ?></div></td>
					<td class="tdcetak-style"><?php echo $data1['alamat']; ?></div></td>
			<?php } ?>
				</tr>
			</table><br>
			<center>
			<table class="styling-fontkepsek" width="1000" border="0" cellpadding="2" cellspacing="0">
				<?php
					$sql    = "select * from guru where jabatan='Kepala Sekolah'";
					$tampil = mysqli_query($con,$sql);
					$baris  = mysqli_fetch_array($tampil); 
				?>
	    		<tr align="right">
					<td class="tdguru-cetak-kepsek" width="455"></td>
	        		<td class="tdguru-cetak-kepsek" width="212" align="center">
	        		<p><strong>
	        	<?php
					$array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
					$bulan = $array_bulan[date('n')];
					$tgl = date('j');
					$thn = date('Y'); 
						echo "Yogyakarta, ".$tgl." ".$bulan." ".$thn;
				?><br>Kepala Sekolah</strong>
					</td>
				</tr>
				<tr  align="right">
					<td class="tdguru-cetak-kepsek" width="455"></td>
			        <td class="tdguru-cetak-kepsek" width="212" align="center">
        		<br><br>
        			<div><strong><?php echo $baris['gelar_dp'];  echo " "; echo $baris['nama']; echo " "; echo $baris['gelar_bk']; ?></strong>
        			<br><strong><?php echo $baris['nip']?> </strong></div>
        			</td>
    			</tr>
			</table>
			</center>
		</div>
</body>
</head>
</html>