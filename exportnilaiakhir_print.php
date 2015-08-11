<?php session_start();
//koneksi database
include "setting/koneksi.php";

$nnis= $_GET['nis'];

?>
<!-- css -->
<link rel="stylesheet" type="text/css" href="css/base_style.css"/>

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

    <div style=" width: 20%; height: 56px; float: right; margin: 1px 34px 0px 0px;">
         <a href="javascript:void(printSpecial())">
            <img src="images/icon/Printer1.png" width="48" height="48" border="0"></a>
    </div>
	<div id="printReady"></p>
		 <div id="wrapperprint-guru">
            <div id="contentprint-guru">     

         	</div>
         </div>
            	<div class="content-innertext">
            		<div class="" style="margin: -60% 0% 0% 25%;">
            			<img src="images/icon/kop.png"></img></div>
            	 <!-- 	<h2 style="margin: -35% 0px 0px 31%;"> Daftar Nilai Akhir SMP N 2 Godean Sleman</h2> -->

            <table style="text-align: center; font-family: Arial,sans-serif; font-size: 13px;" width="500" cellpadding="" cellspacing="0">
            	<tr class="kelas-table">
					<th class="" width="30">No</th>
					<th class="" width="200">Kode Mapel</th>
					<th class="" width="150">Matapelajaran</th>
					<th class="" width="150">Kelas</th>
					<th class="" width="300">Tahun Ajaran & Semester</th>
					<th class="" width="100">Nilai Akhir</th>
					<th class="" width="100">Predikat (NA)</th>
				</tr>
			<?php

				$getSemester = mysql_fetch_array(mysql_query("select semester from tahunajaran where id_ta='$id_ta'"));
							$getTA = mysql_fetch_array(mysql_query("select ta from tahunajaran where id_ta='$id_ta'"));
							$getSmt = $getSemester['semester'];

            	 $ambildata="SELECT a.id_ta ,b.nis, b.nama_siswa, m.mapel, a.nilai, t.semester, m.kd_mapel, d.kelas, t.ta
							  FROM nilai_mapel a
							  JOIN siswa b ON b.nis = a.nis
							  JOIN anggota_kelas ak ON ak.nis= a.nis
							  JOIN mapel m ON a.kd_mapel = m.kd_mapel
							  JOIN tahunajaran t ON ak.id_ta=t.id_ta
							  JOIN kelas d ON ak.kd_kelas = d.kd_kelas
							  WHERE b.nis='$nis' AND a.id_ta='$_GET[id_ta]' AND  t.semester='$getSmt' AND t.ta='$getTA[ta]'";
				$no=1;
				$tampungdata=mysql_query($ambildata);
				while ($baris=mysql_fetch_array($tampungdata)) {
					
            ?>
           
              	<tr>
					<td class="td-stylebox"><?php echo $no; ?></td>
					<td class="td-stylebox"><?php echo $baris['kd_mapel']; ?></td>
					<td class="td-stylebox"><?php echo $baris['mapel']; ?></td>
					<td class="td-stylebox"><?php echo $baris['kelas']; ?></td>
			        <td class="td-stylebox"><?php echo $baris['ta']; ?></td>
					<td class="td-stylebox"><?php echo $baris['nilai']; ?></td>
				</tr>
            <?php $no++; }  ?>
			</table>
            	</div>
    </div>
       