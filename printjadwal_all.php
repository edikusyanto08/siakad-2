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
	<a href="index.php?hal=jadwalmengajar_guru">
        <img src="images/icon/Arrow-Right.png" width="40" height="40"></a></div>
    <div id="tombolprint">
         <a href="javascript:void(printSpecial())" target="">
         	<img src="images/icon/hp-printer.png" width="48" height="48" border="0"></a></div>	
	<div id="printReady">
<!-- 	<div class="postion-box" -->
		<div class="content header">
		<div class="postion-img">
			<img src="images/icon/kop large.png" style="width: 675px;"></img>
		</div>
			<hr width="1060">
		  	<hr width="1060" style="margin-top: -7px; margin-bottom: 49px;">
		</div>
		<div class="hari">
                <h5>Senin</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=1 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Selasa</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=2 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Rabu</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=3 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Kamis</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=4 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Jumat</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=5 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Sabtu</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=6 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>
	</div>
</div>
</body>
</head>
</html>