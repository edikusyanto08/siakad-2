<?php session_start();
//koneksi database
include "setting/koneksi.php";

	$nis = $_GET['nis'];
	$sql = "SELECT * FROM anggota_kelas ak
    		    INNER JOIN siswa s ON ak.nis=s.nis
				INNER JOIN kelas k ON ak.kd_kelas=k.kd_kelas
			    WHERE s.nis='$nis' AND ak.id_ta='$_GET[ta]'";
	$result = mysqli_query($con,$sql);
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
<link rel="stylesheet" type="text/css" href="css/base_style.css"/>
</head>
<body>
<div id="tombl-kembali">
         <a href="index.php?hal=laporan_siswa">
            <img src="images/icon/Arrow-Right.png" width="40" height="40"></a>
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
                		<td class="tdguru-cetak">
                            <img src="images/icon/kop.png" align="right"/></td>
                   </tr>
                </table><p></p>  
                <table width="650" border="0" align="center" cellpadding="1" cellspacing="0">
            <div class="position-judullapran">
                <center><h2 class=""> KETERANGAN TENTANG DIRI PESERTA DIDIK</h2></center>


                <?php while($siswa = mysqli_fetch_array($result)){?>
                	<tr>
                        <td width="22" class="tdguru-cetak">1.</td>
                		<td width="210" class="tdguru-cetak">Nama Peserta Didik (Lengkap)</td>
                        <td class="tdguru-cetak">: &nbsp;<?php  echo $siswa['nama_siswa']?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">2.</td>
                        <td class="tdguru-cetak" >Nomor Induk Siswa </td>
                        <td class="tdguru-cetak" >: &nbsp;<?php echo $siswa ['nis']?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">3.</td>
                		<td class="tdguru-cetak">Tempat & Tanggal Lahir </td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo  $siswa['tempat_lahir'];echo " , ";echo $siswa['tgl_lahir'] ?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">4.</td>
                        <td class="tdguru-cetak">Jenis Kelamin </td>
                        <td class="tdguru-cetak">: &nbsp;<?php  echo $siswa['jen_kel'] ?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">5.</td>
                		<td class="tdguru-cetak">Agama</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['agama']?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">6.</td>
                        <td class="tdguru-cetak">Status dalam keluarga</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa ['status_dlmkluarga'] ?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">7.</td>
                        <td class="tdguru-cetak">Anak ke</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa ['anak_ke'] ?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">8.</td>
                        <td class="tdguru-cetak">Alamat Peserta Didik</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['alamat_siswa']?></td>
                    </tr>
                      <tr>
                        <td class="tdguru-cetak"></td>
                        <td class="tdguru-cetak">Telepon</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa ['notelp_siswa'] ?></td>
                    </tr>
                	<tr>
                        <td class="tdguru-cetak">9.</td>
                		<td class="tdguru-cetak">Sekolah Asal</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['sekolah_asal']?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">10.</td>
                        <td class="tdguru-cetak">Diterima Disekolah Ini</td>
                        <td class="tdguru-cetak"></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak"></td>
                        <td class="tdguru-cetak">Dikelas </td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa ['kelas'] ?></td>
                    </tr>
                     <tr>
                        <td class="tdguru-cetak"></td>
                        <td class="tdguru-cetak">Pada Tanggal </td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa ['tgl_diterima'] ?></td>
                    </tr>
                	<tr>
                        <td class="tdguru-cetak">11.</td>
                		<td class="tdguru-cetak">Orang Tua</td>
                        <td class="tdguru-cetak"></td>
                    </tr>
                	<tr>
                    	<td class="tdguru-cetak"></td>
                		<td class="tdguru-cetak">Ayah</td>
                    	<td class="tdguru-cetak">: &nbsp;<?php echo $siswa['nama_ayah']?></td>
                    </tr>
                	<tr>
                        <td class="tdguru-cetak"></td>
                		<td class="tdguru-cetak">Ibu</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa ['nama_ibu']?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">12.</td>
                        <td class="tdguru-cetak">Alamat Orang Tua</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa ['alamat_ortu']?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak"></td>
                        <td class="tdguru-cetak">Telepon</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['notelp_ortu']?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">13.</td>
                        <td class="tdguru-cetak">Pekerjaan Orang Tua</td>
                        <td class="tdguru-cetak"></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak"></td>
                        <td class="tdguru-cetak">Pekerjaan Ayah</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['pekerjaan_ayah']?></td>
                    </tr>
                	<tr>
                        <td class="tdguru-cetak"></td>
                		<td class="tdguru-cetak">Pekerjaan Ibu</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['pekerjaan_ibu']?></td>
                    </tr>
                	<tr>
                        <td class="tdguru-cetak">14.</td>
                		<td class="tdguru-cetak">Nama Wali</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['nama_wali']?></td>
                    </tr>
                	<tr>
                    	<td class="tdguru-cetak">15.</td>
                		<td class="tdguru-cetak">Alamat Wali</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['alamat_wali']?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak"></td>
                        <td class="tdguru-cetak">Telepon</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['notelp_wali']?></td>
                    </tr>
                    <tr>
                        <td class="tdguru-cetak">16.</td>
                        <td class="tdguru-cetak">Pekerjaan Wali</td>
                        <td class="tdguru-cetak">: &nbsp;<?php echo $siswa['pekerjaan_wali']?></td>
                    </tr>
                </table>
         <div id="bingkai-foto-guru">
            <img src=images/foto/<?php echo $siswa ['foto'];?> class="styleimg" width="110" height="120" /></div>   
                          
            <div class="position-boxdatasiswa">
                <div class="content-boxdatasiswa">
                    <?php 
                        $sql = "select * from guru where jabatan='Kepala Sekolah'";
                		$tampil = mysqli_query($con,$sql);
                		$baris = mysqli_fetch_array($tampil); ?>
                   
                        	<p><strong>
                            <?php
    							$array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
    							$bulan = $array_bulan[date('n')];
    							$tgl = date('j');
    							$thn = date('Y'); 
    							echo "Yogyakarta, ".$tgl." ".$bulan." ".$thn;
    							?><br />Kepala Sekolah
                            </strong></p>
                        </td>
                	</tr>
                	<tr align="right">
                		<td width="455" class="tdguru-cetak"></td>
                        <td width="212" align="center" class="tdguru-cetak">
                        	<br><br>
                        	<p><strong><?php echo $baris['gelar_dp'];  echo " "; echo $baris['nama']; echo " "; echo $baris['gelar_bk']; ?></strong><br><strong><? echo $baris['nip']?> </strong></p>
                        </td>
                    </tr>
                        <p align="center"></p>
                    <?php } ?>
                </div>
                </div>  
            </div>
        </div>       
    </div>