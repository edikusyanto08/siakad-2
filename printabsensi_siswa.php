<?php session_start();
//koneksi database
include "setting/koneksi.php";
?>

<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
		<center><h2 class="title-kelas"> Form Cetak Laporan Absensi Siswa SMP N 2 Godean</h2></center>
		<hr/>
			<form method="post" action="printabsensi_siswaproses.php">
			<legend>
			<h4 class="title-style-cetaklapabsensi"> Pilih Tahun Ajaran & Kelas Untuk Cetak Absensi Siswa</h4>
			<table class="tb-lapabsensi"><br>
				<tr class="tb-kelas">
					<td class="td-cetak-kelas" width="100">Tahun Ajaran</td>
					<td class="td-cetak-kelas">
						<select name="id_ta" id="id_ta" required=''>
							<?php
								echo "<option value=''>-- Pilih --</option>";
								$query = mysqli_query($con,"SELECT * FROM tahunajaran ORDER BY ta DESC");
								while($row = mysqli_fetch_array($query)){
								$selected = ($row['id_ta']==$id_ta)? 'selected="selected"' : '';
						  			echo "<option value='".$row['id_ta']."' $selected>".$row['ta']."$selected - ".$row['semester']."</option>";
								}
							?>                   
		                 </select>
					</td>
				</tr>
				<tr class="tb-kelas">
					<td class="td-cetak-kelas">Kelas</td>
					<td class="td-cetak-kelas">
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
				<tr class="tb-kelas">
					<td class="td-cetak-kelas">Mapel</td>
					<td class="td-cetak-kelas">
						<select name="mapel" required=''>
							<option value="">-- Pilih --</option>
								<?php
									// query untuk menampilkan semua kelas dari tabel kelas
									$query = "SELECT * FROM mapel";
									$hasil = mysqli_query($con,$query);
									while ($data = mysqli_fetch_array($hasil)) {
										echo "<option value='".$data['kd_mapel']."'>".$data['mapel']."</option>";
									}
								?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="td-cetak-kelas" colspan="2">
						<input type="submit" value="Submit" name="submit" class="btnbtn-absensi" /></td>
				</tr>
			</table><br>
		</legend>
		</form>
		</div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->