<?php session_start();
include "setting/koneksi.php";

$kd_kelas = $_POST['kd_kelas'];
$id_ta    = $_POST['id_ta'];
?>

<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas">Data Siswa SMP Negeri 2 Godean </h2></center><hr>
				<table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
              		<tr class="kelas-table">
	                	<th width="71"><div align="center"><strong>NIS</strong></div></th>
						<th width="250"><div align="center"><strong></strong>Nama</div></th>
						<th width="200"><div align="center"><strong></strong>TTL</div></th>
						<th width="75"><div align="center"><strong></strong>Jenkel</div></th>
	                	<th width="250"><div align="center"><strong>Alamat</strong></div></th>
	                	<th width="41"><div align="center"><strong>Agama</strong></div></th>
						<th width="75"><div align="center"><strong></strong>Kelas</div></th>
	                	<th width="75"><div align="center"><strong>Aksi</strong></div></th>
             	 	</tr>
			<?php
				  //pilih data dari tabel siswa
				$x="SELECT * 
						FROM anggota_kelas a
						INNER JOIN siswa s ON a.nis= s.nis 
						INNER JOIN kelas k ON a.kd_kelas=k.kd_kelas
						where a.kd_kelas='$kd_kelas' AND id_ta='$id_ta'";
				//ambil query tampilkan
				$tampil=mysql_query($x);
				//tampilkan data dalam bentuk array di tabel
				while ($data=mysql_fetch_array($tampil)) {
			?>
	             <tr>
	                <td><div align="center"><?php echo $data['nis']; ?></div></td>
	                <td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['tempat_lahir']; echo ", "; echo $data['tgl_lahir'] ?></td>
					<td><?php echo $data['jen_kel'] ; ?></td>
					<td><?php echo $data['alamat']; ?></td>
	                <td><div align="center"><? echo $data['agama']; ?></div></td>
					<td><?php echo $data['kelas']; ?></td>
	                <td><center><a href="cetaksiswa2.php?nis=<?php echo $data['nis'];?>"><img src="images/icon/printer.png" width="20" height="20" border="0" /></a></center></td>
			<?php } ?>
				  </tr>
				</table><br>    
				<legend><br>            
					<div id="box-cetaksiswa">
						<a class="btn-btncetak-siswa" href="cetaksiswaall.php?kd_kelas=<?php echo $kd_kelas;?>&id_ta=<?php  echo $id_ta;?>">Cetak Semua</a>
					</div><br>
				</legend>
        </div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->