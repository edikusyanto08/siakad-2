<?php session_start();
//koneksi database
include "setting/koneksi.php";


$kd_kelas = isset($_POST['kelas'])? $_POST['kelas']: '';
$id_ta	  = isset($_POST['id_ta'])? $_POST['id_ta']: '';


?>
<style type="text/css">
	.td-cetak-transkipnilai{
		border: none
	}

</style>

<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center>
				<?php  if($_GET['kd_kelas']) { 

					echo "<h2 class='title-kelas'> Form Cetak Laporan Transkip/Raport Nilai Siswa SMP N 2 Godean</h2>";

			 	}else{ 

					echo "<h2 class='title-kelas'> Form Cetak Laporan Transkip Nilai Siswa";

				
						$p="SELECT * FROM kelas Where kd_kelas='$kd_kelas'";
						$t=mysqli_query($con,$p);
						$data=mysqli_fetch_array($t);					
							echo $data['kelas'];
				  	echo  " & Tahun Ajaran";

			
						$t="SELECT * FROM tahunajaran Where id_ta='$id_ta'";
						$p=mysqli_query($con,$t);
						$data=mysqli_fetch_array($p);					
							echo $data['ta']; 
				}

				?>

					</h2></center><hr/>
			
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
		</div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->                      