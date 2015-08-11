<?php session_start();
//koneksi database
include "setting/koneksi.php";

$kd_kelas = $_POST['kelas'];
$ta		  = $_POST['id_ta'];

?>
<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas">Form Data Anggota Kelas SMP Negeri 2 Godean</h2></center><hr>
				<h5 class="style-fontheading">Pilih Tahun Ajaran & Kelas untuk Melihat Anggota Kelas</h5>
				<form method="post" action="index.php?hal=pengolhan_data_anggotakelas">
				<table class="tb-kelas">
					<tr>
						<td class='td-anggota-kelas' width="100">Tahun Ajaran</td>
						<td class='td-anggota-kelas'>
							<select name="id_ta" id="id_ta" required=''>
								<?php
									echo "<option value=''>-- Pilih -- </option>";

									$query = mysqli_query($con,"SELECT * FROM tahunajaran ORDER BY ta DESC");
									while($row = mysqli_fetch_array($query)){
										$selected = ($row['id_ta']==$id_ta)? 'selected="selected"' : '';
							  			echo "<option value='".$row['id_ta']."' $selected>".$row['ta']." $selected - ".$row['semester']."</option>";
									}
								?>                   
			                </select>
						</td>
					<tr>
			            <td class='td-anggota-kelas'>Kelas</td>
						<td class='td-anggota-kelas'>
							<select name="kelas" id="kelas" required=''>
							<option value="">-- Pilih --</option>
								<?php
									// query untuk menampilkan semua kelas dari tabel kelas
									$query = "SELECT * FROM kelas";
									$hasil = mysqli_query($con,$query);
									while ($data = mysqli_fetch_array($hasil)){
											echo "<option value='".$data['kd_kelas']."'>".$data['kelas']."</option>";
									}
								?>
							</select>
						</td>
			    	</tr>
					<tr>
						<td colspan="3" align="center" class='td-anggota-kelas'>
							<input type="submit" value="Submit" name="submit" class="btn-btn-anggotakls" /></td>
					</tr>
				</table><hr/>
				<table border="0" align="center" cellpadding="4" cellspacing="0" class="tb-masteranggotkls">
		            <tr class="kelas-table">
		            	<th width="50"><div align="center">No</div></th>
			            <th width="100"><div align="center">NIS</div></th>
						<th width="300"><div align="center">Nama Siswa</div></th>
						<th width="200"><div align="center">TTL</div></th>
						<th width="100"><div align="center">Jenkel</div></th>
			            <th width="250"><div align="center">Alamat</div></th>
			            <th width="41"><div align="center">Agama</div></th>
						<th width="75"><div align="center">Kelas</div></th>
			            <th width="50"><div align="center">Aksi</div></th>
		            </tr>
					<?php
						//pilih data dari tabel siswa
						include "funct_page/setting_paging_anggotakelas.php";//mengambil fungsi include pagingkelas

						$p= new Paging;
						$batas=5;
						$posisi=$p->cariPosisi($batas);
						$x="SELECT *
							FROM anggota_kelas a
								JOIN siswa b ON a.nis = b.nis
								JOIN kelas c ON a.kd_kelas = c.kd_kelas
							WHERE a.kd_kelas = '$kd_kelas'
							AND a.id_ta = '$ta'";
						//ambil query tampilkan
						$no=1;
						$tampil=mysqli_query($con,$x);
						//tampilkan data dalam bentuk array di tabel
						while ($data=mysqli_fetch_array($tampil)){
					?>

     				<tr>
		             	<td><?php echo $no++; echo $nomer;?></div></td>
		                <td><?php echo $data['nis']; ?></div></td>
		                <td><?php echo $data['nama_siswa']; ?></td>
						<td><?php echo $data['tempat_lahir']; echo ' , '; echo $data['tgl_lahir'] ?></td>
						<td><?php echo $data['jen_kel'] ; ?></td>
						<td><?php echo $data['alamat_siswa']; ?></td>
		                <td><div align="center"><? echo $data['agama']; ?></div></td>
						<td><?php echo $data['kelas']; ?></td>
		                <td><a href="index.php?hal=detailsiswa_anggotakls&nis=<?php echo $data['nis'];?>">
		                	<img src="images/icon/zoom-btn.png" width="20" height="20" border="0" /></a></td>
						<?php } ?>
	  				</tr>
				</table>
			</form>
        </div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->
   
