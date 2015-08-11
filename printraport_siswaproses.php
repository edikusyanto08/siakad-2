<?php session_start();

include "setting/koneksi.php";

$kd_kelas = isset($_POST['kelas'])? $_POST['kelas']: '';
$id_ta	  = isset($_POST['id_ta'])? $_POST['id_ta']: '';

?>

<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas">Data Raport Siswa Kelas
					<?php 
						$p="SELECT * FROM kelas Where kd_kelas='$kd_kelas'";
						$t=mysql_query($p);
						$data=mysql_fetch_array($t);					
							echo $data['kelas'];
					?> & Tahun Ajaran
					<?php
						$t="SELECT * FROM tahunajaran Where id_ta='$id_ta'";
						$p=mysql_query($t);
						$data=mysql_fetch_array($p);					
							echo $data['ta']; 
					?></h2></center><hr/>
					
				<table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
					<tr class="kelas-table">
						<th width="50"><div align="center"><strong>N0</strong></div></th>
						<th width="200"><div align="center"><strong>NIS</strong></div></th>
						<th width="500"><div align="center"><strong>Nama</strong></div></th>
		                <th width="100"><div align="center"><strong>Aksi</strong></div></th>
		            </tr>   
				<?php
						
		 			//pilih data dari tabel siswa
					$x="SELECT * 
						FROM anggota_kelas a
						JOIN siswa b ON a.nis=b.nis
						JOIN kelas c ON a.kd_kelas=c.kd_kelas
						WHERE a.kd_kelas='$kd_kelas' AND a.id_ta='$id_ta'";
						//ambil query tampilkan
						$no=1;
						$tampil=mysql_query($x);
						//tampilkan data dalam bentuk array di tabel
						while ($data=mysql_fetch_array($tampil)) {
				?>
		            <tr>
		             	<td><?php echo $no++; echo $nomer; ?></td>
		                <td><?php echo $data['nis']; ?></td>
		                <td><?php echo $data['nama']; ?></td>
		                <td><center><a href="printraport_onepage.php?nis=<?php echo $data['nis'];?>&id_ta=<?php echo $data['id_ta'];?>">
		                	<img src="images/icon/printer.png" width="20" height="20" border="0" /></a></center></td>
				<?php } ?>
					</tr>
				</table>
		</div>
    </div>
</div><br><br><br><br>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->                      