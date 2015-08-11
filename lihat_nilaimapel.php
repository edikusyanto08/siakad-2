<?php session_start();
include "setting/koneksi.php";


?>
<style type="text/css">
	.headingstlyefluix{
		font-family: Arial,Sans-serif;
		font-size: 12px;
		text-transform: uppercase;
		font-weight: bold;
	}	

</style>


<div id="wrapper-kelas">
  	<div id="box-kelas">
    	<div id="content-kelas">	
			<p class="title-kelas">Form Detail Nilai Akhir Siswa : </p><hr width="1070">
			<div id="wrapperbox-login-siswa">
				<div id="content-left">
					<div id="box-login-siswa">
					<form action="index.php?hal=lihat_nilaimapel" method="post">
						<table>
							<tr>
								<td class="td-siswalihat"><input type="text" name="nis" id="nis" class="" placeholder="Masukkan Nis" required=''></td>
							</tr>
							<tr>
								<td class="td-siswalihat">
								<label class="erorr-message">
								<select name="id_ta" id="id_ta" required="">
									<?php
										echo "<option value=''> Pilih Tahunajaran </option>";
										$query = mysql_query("SELECT * FROM tahunajaran ORDER BY ta DESC");
										while($row = mysql_fetch_array($query)){
										$selected = ($row['id_ta']==$id_ta)? 'selected="selected"' : ''; 
								  			echo "<option value='".$row['id_ta']."' $selected>".$row['ta']." - ".$row['semester']."</option>";
								  		
										}
									?>                   
				        		</select><td>
		        				</label>
							</tr>
						</table>
						<table>
							<tr>
								<td colspan="2">
									<input type="submit" name="submit" id="submit" value="Cari" class="btn-siswalogin">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div id="content-right">
			<div class>
				<?php 

					if(isset($_POST['submit'])) {

					$nis   =$_POST['nis'];
					$id_ta =$_POST['id_ta']; 
						
							$tampilnama ="SELECT s.nama_siswa, s.nis
										  FROM siswa s
										  JOIN anggota_kelas ak ON ak.nis=s.nis
										  JOIN tahunajaran t ON ak.id_ta=t.id_ta
										  WHERE s.nis='$nis' AND ak.id_ta='$id_ta' ";	
							$datanya = mysql_query($tampilnama);	
							while ($hasilpencarianquery = mysql_fetch_array($datanya)) { ?>
		
				<table class="tb-frmkelas" cellpadding="4" cellspacing="0" border="0">
					<tr>
						<p class="headingstlyefluix">NIS : <?php echo $hasilpencarianquery['nis'];  ?></p>
						<p class="headingstlyefluix">Nama Siswa : <?php echo $hasilpencarianquery['nama_siswa'];  ?></p>
					</tr>
				</table>

				<?php $no++; }	} ?>
			</div>
				<table class="tb-frmkelas" cellpadding="4" cellspacing="0" border="0">
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

						if(isset($_POST['submit'])) {

							$nis   =$_POST['nis'];
							$id_ta =$_POST['id_ta'];

							$getSemester = mysql_fetch_array(mysql_query("select semester from tahunajaran where id_ta='$id_ta'"));
							$getTA = mysql_fetch_array(mysql_query("select ta from tahunajaran where id_ta='$id_ta'"));
							$getSmt = $getSemester['semester'];
	
							$nilainya = " SELECT a.id_ta ,b.nis, b.nama_siswa, m.mapel, a.nilai, t.semester, m.kd_mapel, d.kelas, t.ta
										  FROM nilai_mapel a
										  JOIN siswa b ON b.nis = a.nis
										  JOIN anggota_kelas ak ON ak.nis= a.nis
										  JOIN mapel m ON a.kd_mapel = m.kd_mapel
										  JOIN tahunajaran t ON ak.id_ta=t.id_ta
										  JOIN kelas d ON ak.kd_kelas = d.kd_kelas
										  WHERE b.nis='$nis' AND a.id_ta='$_POST[id_ta]' AND  t.semester='$getSmt' AND t.ta='$getTA[ta]'";	
													
							$no=1;							  
							$tampilNilai = mysql_query($nilainya);					
							/*$nilai = $hasilpencarianquery['nilai'];*/
							while ($hasilpencarianquery = mysql_fetch_array($tampilNilai)) { ?>

							<!-- cari nilai predikat -->
							<?php
								 $nilaiakhir=$hasilpencarianquery['nilai'];

									if (($nilaiakhir<100) and ($nilaiakhir>=80)) {
										$predikat="Lulus"; 
									}elseif ((80>$nilaiakhir) and ($nilaiakhir>=75)) {
										$predikat=" Lulus";
									}elseif ((75>$nilaiakhir) and ($nilaiakhir>=55)) {
										$predikat="Tidak Lulus";
									}elseif ((55>$nilaiakhir) and ($nilaiakhir>=25)) {
										$predikat="Tidak Lulus";
									}elseif ((25>$nilaiakhir) and ($nilaiakhir>0)) {
										$predikat="Tidak Lulus";
									}else{
										$predikat="Tidak Lulus";
									}
						?>
					<tr>
						<td class="td-stylebox"><?php echo $no; ?></td>
						<td class="td-stylebox"><?php echo $hasilpencarianquery['kd_mapel']; ?></td>
						<td class="td-stylebox"><?php echo $hasilpencarianquery['mapel']; ?></td>
						<td class="td-stylebox"><?php echo $hasilpencarianquery['kelas']; ?></td>
				        <td class="td-stylebox"><?php echo $hasilpencarianquery['ta'];  echo " - ";echo $hasilpencarianquery['semester'];  ?></td>
						<td class="td-stylebox"><?php echo $hasilpencarianquery['nilai']; ?></td>
						<td class="td-stylebox"><?php echo $predikat;?></td>
					</tr>
					<?php $no++; }	} ?>
				</table>
				<div class="wrapper-boxexportpdf">
					<div class="content-exportnilai">
						<a class="btn-btnexport" target="blank" href="exportnilai_siswa.php?nis=<?php echo $nis; ?>&ta=<?php echo $id_ta;?> ">Export to PDF</a>				
					</div>
				</div>
			</div>
			



		</div><br><br><br><br><br><br><br>
	</div>
</div>
</div>
