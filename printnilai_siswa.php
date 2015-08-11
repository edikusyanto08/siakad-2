<?php session_start();
//koneksi database
include "setting/koneksi.php";

#ambil data kelas
$query = "SELECT kd_kelas, kelas FROM kelas ORDER BY kelas";
$sql = mysqli_query($con,$query);
$arrkelas = array();
while ($row = mysqli_fetch_assoc($sql)) {
	$arrkelas [ $row['kd_kelas']] = $row['kelas'];
}

#action get mapel
// if(isset($_GET['action']) && $_GET['action'] == "getmap") {
// 	$kd_kelas = $_GET['kd_kelas'];
	
// 	//ambil data mapel
// 	$query = "SELECT j.kd_mapel, c.mapel 
// 			  FROM jadwalharian j
// 			  INNER JOIN mapel c ON c.kd_mapel=j.kd_mapel
// 			  WHERE j.kd_kelas='$kd_kelas' ORDER BY mapel";
// 	$sql = mysqli_query($con,$query);
// 	$arrmap = array();
// 		while ($row = mysqli_fetch_assoc($sql)) {
// 			array_push($arrmap, $row);
// 		}
// 			echo json_encode($arrmap);
// 		exit;
// }
?>

<style type="text/css">
	span.inputan { 
					display:block;
					margin-bottom:5px; 
				 }
	span.inputan label { 
					float:left; 
					display:block; 
					width:200px;
				 }
</style>
<script type="text/javascript" src="libs/jquery.min.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				$('#kelas').change(function(){
					$.getJSON('manajemen_inputnilai.php',{action:'getmap', kd_kelas:$(this).val()}, function(json){
						$('#mapel').html('');
						$.each(json, function(index, row) {
							$('#mapel').append('<option value='+row.kd_mapel+'>'+row.mapel+'</option>');
						});
					});
				});
			});
		</script>
<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<form method="post" action="printnilaisiswa_proses.php">
				<center><h2 class="title-kelas"> Form Cetak Laporan Nilai Siswa SMP N 2 Godean</h2></center><hr/>
				
				<!-- begin menu tab -->
				<div class="section-menubar">
					<div class="box-menubarinner">
						<input id="tab1" type="radio" class="menutab-menu" name="tabs" checked="">
    						<label class="labelmain-menu" for="tab1">Cetak Laporan Nilai Siswa</label>
  						<input id="tab2" type="radio" name="tabs">
    						<label class="labelmain-menu" a for="tab2">Cetak Laporan Raport Siswa</label>

  					<!-- begin content 1 tab -->
  				<section id="content1" class="mother-ofmenu">
					<h4 class="title-style-cetaklap">Pilih Tahun Ajaran,Kelas & Mapel untuk cetak nilai siswa</h4></center>
					<table class="tb-kelas">
						<tr>
							<td class="td-lapcetak-nilai" width="120">Tahun Ajaran</td>
							<td class="td-lapcetak-nilai">
								<select name="id_ta" id="id_ta" required=''>
								<option value=''>-- Pilih --</option>
									<?php
										$query = mysqli_query($con,"SELECT * FROM tahunajaran ORDER BY ta DESC");
										while($row = mysqli_fetch_array($query)){
										$selected = ($row['id_ta']==$id_ta)? 'selected="selected"' : '';
								  			echo "<option value='".$row['id_ta']."' $selected>".$row['ta']." - ".$row['semester']."</option>";
										}
									?>                   
					            </select></td>
						</tr>
						<tr>
							<td class="td-lapcetak-nilai">
								<label for="mapel">Kelas</label>
							</td>
							<td class="td-lapcetak-nilai">
								<span class="inputan">
								<select id="kelas" name="kelas" required=''>
								<option value="">-- Pilih --</option>
									<?php
										foreach ($arrkelas as $kd_kelas=>$kelas) {
										echo "<option value='$kd_kelas'>$kelas</option>";
										}
									?>
								</select>
								</span></td>
						</tr>
						<tr>
						<td class="td-input-nilai"><label for="mapel">Mata Pelajaran</label></td>
						<td class="td-input-nilai"><span class="inputan">
							<?php 
							$kodeMapel = mysqli_fetch_array(mysqli_query($con, "select kd_mapel from guru where nip='$_SESSION[username]'"));
							$mapelnya = mysqli_fetch_array(mysqli_query($con,"select * from mapel where kd_mapel='$kodeMapel[kd_mapel]'"));
							?>
							<input type="hidden" name="mapel" value="<?php echo $mapelnya['kd_mapel']; ?>">
							<input type="text" name="nama_mapel" value="<?php echo $mapelnya['mapel']; ?>">
							<!-- <select id="mapel" name="mapel"  class="select-style" >
							<option value="">-- Pilih --</option>
							</select></span></td> -->
					</tr>
							<tr>
								<td class="td-lapcetak-nilai" colspan="2">
									<input type="submit" value="Submit" name="submit" class="btn-nilaicetak" /></td>
						</tr>	
					</table>
			</form></center>
			</section>


			<section id="content2" class="mother-ofmenu">

			<?php

				$kd_kelas = isset($_POST['kelas'])? $_POST['kelas']: '';
				$id_ta	  = isset($_POST['id_ta'])? $_POST['id_ta']: '';


			?>
			<style type="text/css">
				.td-cetak-transkipnilai{
					border: none
				}

			</style>
					
						
			<form method="post" action="index.php?hal=printraport_siswa">
			<legend>
			<h4 class="title-style-cetaklap">Pilih Tahun Ajaran & Kelas untuk cetak raport siswa</h4>
			<table class="tb-kelas">
				<tr> 
					<td class="td-cetak-transkipnilai" width="120">Tahun Ajaran</td>
					<td class="td-cetak-transkipnilai">
						<select name="id_ta" id="id_ta" required=''>
						<option value=''>-- Pilih --</option>
							<?php
								$query = mysqli_query($con,"SELECT * FROM tahunajaran ORDER BY ta DESC");
								while($row = mysqli_fetch_array($query)){
									$selected = ($row['id_ta']==$id_ta)? 'selected="selected"' : '';
						  			echo "<option value='".$row['id_ta']."' $selected>".$row['ta']." - ".$row['semester']."</option>";
								}
							?>                   
		          		</select>
					</td>
				</tr>
				<tr>
					<td class="td-cetak-transkipnilai">Kelas</td>
					<td class="td-cetak-transkipnilai">
						<select name="kelas" required=''>
						<option value="">-- Pilih --</option>
							<?php
								// query untuk menampilkan semua kelas dari tabel kelas
								$query = "SELECT * FROM kelas";
								$hasil = mysqli_query($con,$query);
								while ($data = mysqli_fetch_array($hasil)) {
									echo "<option value='".$data['kd_kelas']."'>".$data['kelas']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
				<td colspan="2" class="td-cetak-transkipnilai">
					<input type="submit" value="Submit" name="submit" class="btnbtn-raport"/></td>
				</tr>
			</table>
			</legend><br>	
			<table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
				<tr class="kelas-table">
					<th width="50"><div align="center">No</div></th>
					<th width="200"><div align="center">Tahun Ajaran&Semester</div></th>
					<th width="200"><div align="center">NIS</div></th>
					<th width="500"><div align="center">Nama Siswa</div></th>
					<th width="100"><div align="center">Kelas</div></th>
	                <th width="100"><div align="center">Aksi</div></th>
	            </tr>   
				<?php
						
		 			//pilih data dari tabel siswa
					$x="SELECT * 
						FROM anggota_kelas a
						JOIN siswa b ON a.nis=b.nis
						JOIN kelas c ON a.kd_kelas=c.kd_kelas
						JOIN tahunajaran th ON a.id_ta=th.id_ta
						WHERE a.kd_kelas='$kd_kelas' AND a.id_ta='$id_ta'";
						//ambil query tampilkan
						$no=1;
						$tampil=mysqli_query($con,$x);
						//tampilkan data dalam bentuk array di tabel
						while ($data=mysqli_fetch_array($tampil)) {
				?>
	            <tr>
	             	<td><?php echo $no++; echo $nomer; ?></td>
	             	<td><?php echo $data['ta']; echo ' - '; echo $data['semester']; ?></td>
	                <td><?php echo $data['nis']; ?></td>
	                <td><?php echo $data['nama_siswa']; ?></td>
	                <td><?php echo $data['kelas']; ?></td>
	                <td><center><a href="printraport_onepage.php?nis=<?php echo $data['nis'];?>&id_ta=<?php echo $data['id_ta'];?>">
	                	<img src="images/icon/printer.png" width="20" height="20" border="0" /></a></center></td>
				<?php } ?>
					</tr>
			</table>
			</form>
		</section>
		</div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->