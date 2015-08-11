<?php session_start();
//koneksi database
include "setting/koneksi.php";

$kd_kelas = $_POST['kd_kelas'];
$id_ta    = $_POST['id_ta'];

?>

<style type="text/css">
	.td-pilih-kelas{
		border: none;
	}

</style>
<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas"> Form Cetak Laporan Data Siswa SMP N 2 Godean</h2></center>
			<form method="post" action="index.php?hal=laporan_siswa">
				<legend>
				<h4 class="title-style-cetaklap">Pilih Tahun Ajaran & Kelas Untuk Mengetahui Data Siswa</h4>
				<table class="tb-kelas">
					<tr>
						<td class="td-pilih-kelas" width="100">Tahun Ajaran</td>
			 			<td class="td-pilih-kelas">
			 				<label>
                  			<select name="id_ta" id="id_ta" required=''>
								<?php
									echo "<option value=''>-- Pilih --</option>";
									$query = mysqli_query($con,"SELECT * FROM tahunajaran ORDER BY ta DESC");
									while($row = mysqli_fetch_array($query)){
										$selected = ($row['id_ta']==$id_ta)? 'selected="selected"' : '';
							  			echo "<option value='".$row['id_ta']."'$selected>".$row['ta']." - ".$row['semester']."</option>";
									}
								?>                   
                  			</select>
                			</label>
                		</td>
              		</tr>
					<tr>
                		<td class="td-pilih-kelas">Kelas</td>
                		<td class="td-pilih-kelas">
                  			<select name="kd_kelas" id="kd_kelas" required=''>
							  	<?php
							  		echo "<option value=''>-- Pilih --</option>";
									$query = mysqli_query($con,"SELECT kd_kelas, kelas FROM kelas WHERE NOT kd_kelas='all'");
									while($row = mysqli_fetch_array($query)){
										$selected = ($row['kd_kelas']==$kd_kelas)? 'selected="selected"' : '';
							  			echo "<option value='".$row['kd_kelas']."' $selected>".$row['kelas']."</option>";
									}
								?>                    
                  			</select>
		                </td>
					</tr>
					<tr>
						<td colspan="3" align="center" class="td-pilih-kelas">
							<input type="submit" value="Submit" name="submit" class="btnbtn-lapsiswa"/></td>
					</tr>
				</table>
				</legend><br>
			</form>
				<table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
              		<tr class="kelas-table">
              			<th width="40"><div align="center">No</div></th>
	                	<th width="60"><div align="center">NIS</div></th>
						<th width="250"><div align="center">Nama Siswa</div></th>
						<th width="200"><div align="center">TTL</div></th>
						<th width="75"><div align="center">Jenkel</div></th>
	                	<th width="250"><div align="center">Alamat</div></th>
	                	<th width="100"><div align="center">Agama</div></th>
						<th width="75"><div align="center">Kelas</div></th>
	                	<th width="75"><div align="center">Aksi</div></th>
             	 	</tr>
			<?php
				  //pilih data dari tabel siswa
				$x="SELECT * 
						FROM anggota_kelas a
						INNER JOIN siswa s ON a.nis= s.nis 
						INNER JOIN kelas k ON a.kd_kelas=k.kd_kelas
						where a.kd_kelas='$kd_kelas' AND id_ta='$id_ta'";
				//ambil query tampilkan
				$tampil=mysqli_query($con,$x);
				$no=1;
				//tampilkan data dalam bentuk array di tabel
				while ($data=mysqli_fetch_array($tampil)) {
			?>
	             <tr>
	             	<td><?php echo $no++; $nomor; ?></td>
	                <td><div align="center"><?php echo $data['nis']; ?></div></td>
	                <td><?php echo $data['nama_siswa']; ?></td>
					<td><?php echo $data['tempat_lahir']; echo ", "; echo $data['tgl_lahir'] ?></td>
					<td><?php echo $data['jen_kel'] ; ?></td>
					<td><?php echo $data['alamat_siswa']; ?></td>
	                <td><div align="center"><? echo $data['agama']; ?></div></td>
					<td><?php echo $data['kelas']; ?></td>
	                <td><center><a href="printsiswa_onepage.php?nis=<?php echo $data['nis'];?>&ta=<?php echo $id_ta ;?> ">
	                	<img src="images/icon/printer.png" width="20" height="20" border="0" /></a></center></td>
			<?php } ?>
				  </tr>
				</table><br>    
				<legend><br>            
					<div id="box-cetaksiswa">
						<a class="btn-btncetak-siswa" href="printsiswa_all.php?kd_kelas=<?php echo $kd_kelas;?>&id_ta=<?php echo $id_ta;?>">Cetak Semua</a>
					</div><br>
				</legend>
        </div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->