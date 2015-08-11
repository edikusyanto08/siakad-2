<?php session_start();
//koneksi database
include "setting/koneksi.php";
      //menampilkan data dari tabel guru
	  $nip =$_GET['nip'];
	  $sql = "select * from guru where nip='$nip'";
	  $result = mysqli_query($con,$sql);
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
                    }
                    else{
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
                    }
                else{
                    alert("The print ready feature is only available if you are using an browser. Please update your browswer.");
            }
        }
</script>
<link rel="stylesheet" type="text/css" href="css/base_style.css"/>
</head>
<body>
<div id="tombl-kembali">
         <a href="javascript:window.history.back()">
            <img src="images/icon/Arrow-Right.png" width="40" height="40"></a>
</div>
    <div id="tombolprint">
         <a href="javascript:void(printSpecial())">
            <img src="images/icon/printer1.png" width="48" height="48" border="0"></a>
     </div>
    <div id="printReady"></p>
        <div id="wrapperprint-guru">
            <div id="contentprint-guru">
                <table width="677" border="0" align="center" cellpadding="1" cellspacing="0">
                	<tr>
                		<td class="tdguru-cetak" width="130" align="right" class="tdguru-cetak">
                		<td class="tdguru-cetak" width="677" ><img class="foto-gurustyle" src="images/icon/kop.png" width="700" height="115" align="right"/>
                		</td>
                   </tr>
                </table><p></p>
        		<table width="677" border="0" align="center">
                    <div id="jdul-dataguru">    
                                <h2 align="center" class="guruheadings">Data Guru</h2>
                    </div> 
        	           <?php while($guru = mysqli_fetch_array($result)){?>
                            <tr>
                    		  	<td class="tdguru-cetak" width="15">a).</td>
                                <td class="tdguru-cetak" width="200">NIP </td>
                                <td class="tdguru-cetak" width="300">: <?php echo $guru ['nip']?></td>
                                <td class="tdguru-cetak" width="157" rowspan="5">
        	                       <div id="bingkai-foto-guru"><strong><img src=images/foto/<?php echo $guru['foto'];?> width="100" height="120" /></strong></div>
        			            </td>
                            </tr>
        		            <tr>
                    		  	<td class="tdguru-cetak">b).</td>
                                <td class="tdguru-cetak">Nama</td>
                                <td class="tdguru-cetak">: <?php  echo $guru['gelar_dp'];  echo " "; echo $guru['nama']; echo " "; echo $guru['gelar_bk']; ?></td>
                            </tr>
                            <tr>
                    		  	<td class="tdguru-cetak">c).</td>
                                <td class="tdguru-cetak">Jenis Kelamin </td>
                                <td class="tdguru-cetak">: <?php  echo $guru['jen_kel'] ?></td>
                            </tr>
                            <tr>
                    		  	<td class="tdguru-cetak">d).</td>
                                <td class="tdguru-cetak">Tempat Lahir </td>
                                <td class="tdguru-cetak">: <?php echo $guru['tempat_lahir'] ?></td>
                            </tr>
                             <tr>
                    		  	<td class="tdguru-cetak">e).</td>
                                <td class="tdguru-cetak">Tanggal Lahir </td>
                                <td class="tdguru-cetak">: <?php echo $guru['tgl_lahir'] ?></td>        
                            </tr>
                            <tr>
                    		  	<td class="tdguru-cetak">f).</td>
                                <td class="tdguru-cetak">Status Kepegewaian</td>
                                <td class="tdguru-cetak">: <?php echo $guru ['status_kepegawaian'] ?></td>  
                            </tr>
                            <tr>
                    		  	<td class="tdguru-cetak">h).</td>
                                <td class="tdguru-cetak">Agama</td>
                                <td class="tdguru-cetak">: <?php echo $guru['agama']?></td>
                            </tr>
                            <tr>
                    		  	<td class="tdguru-cetak">i).</td>
                                <td class="tdguru-cetak">Alamat</td>
                                <td class="tdguru-cetak">: <?php echo $guru['alamat']?></td>
                            </tr>		  
        			         <tr>
        			            <td class="tdguru-cetak">k).</td>
                                <td class="tdguru-cetak">No Telpon</td>
                                <td class="tdguru-cetak">: <?php echo $guru ['no_telp']?></td>
                            </tr>
                			<tr>
                    			<td class="tdguru-cetak">l).</td>
                                <td class="tdguru-cetak">Tanggal Masuk</td>
                                <td class="tdguru-cetak">: <?php echo $guru['tgl_masuk']?></td>  
                            </tr>
                			<tr>
                                <td class="tdguru-cetak">m).</td>
                    			<td class="tdguru-cetak">Jabatan</td>
                                <td class="tdguru-cetak">: <?php echo $guru['jabatan']?></td>
                            </tr>
                			<tr>
                                <td class="tdguru-cetak">n).</td>
                    			<td class="tdguru-cetak">Kwalifikasi Pendidikan</td>
                                <td class="tdguru-cetak">: <?php echo $guru['kwa_pend']?></td>  
                            </tr>
                			<tr>
                                <td class="tdguru-cetak">o).</td>
                    			<td class="tdguru-cetak">Jurusan</td>
                                <td class="tdguru-cetak">: <?php echo $guru ['jurusan']?></td>
                            </tr>
                			<tr>
                                <td class="tdguru-cetak">p).</td>
                    			<td class="tdguru-cetak">Universitas</td>
                                <td class="tdguru-cetak">: <?php echo $guru['universitas']?></td>   
                            </tr>
                    		<tr>
                                <td class="tdguru-cetak">q).</td>
                    			<td class="tdguru-cetak">Tahun lulus</td>
                                <td class="tdguru-cetak">: <?php echo $guru['th_lulus']?></td>
                            </tr>
                </table><br><br>
                <center><table width="677" border="0" align="left" cellpadding="2" cellspacing="0">
                    <div id="box-contentkepsek">
                        <?php
                            $sql = "select nama,nip,gelar_dp,gelar_bk from guru where jabatan='Kepala Sekolah'";
                    		$tampil = mysqli_query($con,$sql);
                    		$baris=mysqli_fetch_array($tampil); 
                        ?> 
                            <tr align="left">
                                <td class="tdguru-cetak" width="425"></td>
                                <td class="tdguru-cetak" width="242" align="center"> 
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
                    	   <tr align="left">
                                <td class="tdguru-cetak" width="425"></td>
                                <td class="tdguru-cetak" width="242" align="center">
                            	<br><br>
                            	<p><strong><?php echo $baris['gelar_dp'];  echo " "; echo $baris['nama']; echo " "; echo $baris['gelar_bk']; ?></strong><br><strong><?php echo $baris['nip']?> </strong></p>
                                </td>
                            </tr>
                        </table></center>
                        <p align="center"></p>
                    </div>
         <?php } ?>
</body>
</head> 
</html>
    </div>
 </div>