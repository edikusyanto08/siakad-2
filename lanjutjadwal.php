<?php session_start();
error_reporting(E_ALL ^E_NOTICE); 
include "setting/koneksi.php";

$hari    = isset($_GET['hari']) ? $_GET['hari'] : '';
$id_ta   = isset($_GET['id_ta'])? $_GET['id_ta'] : '';
$kd_kelas= isset($_GET['kd_kelas'])? $_GET['kd_kelas']: '';
$id		 = isset($_GET['id'])? $_GET['id']: 0;

$strsubmit = "Tambah";

if ($id) {
	$strsubmit = "Edit";
	// Cari data jika jadwal dipanggil
	$query = mysql_query("SELECT * FROM jadwal_harian WHERE id='$id'");
	$jadwal = mysql_fetch_array($query);
	if (!empty($jadwal)) {
		$hari    = $jadwal['hari'];
		$id_ta   = $jadwal['id_ta'];
		$kd_kelas= $jadwal['kd_kelas'];
		$kd_jam  = $jadwal['kd_jam'];
		$kd_mapel= $jadwal['kd_mapel'];
	} 
}

if(isset($_POST['simpan'])){
	$kd_jam	 = $_POST['jam'];
	$kd_mapel= $_POST['kd_mapel'];
	if ($id) {
		$sql	 = "UPDATE jadwal_harian SET id_ta='$id_ta', kd_kelas='$kd_kelas', hari='$hari', kd_jam='$kd_jam', kd_mapel='$kd_mapel' WHERE id='$id'";
	} else {
			$sql1 = mysql_query("select * from jadwal_harian where id_ta='$id_ta' and kd_kelas='$kd_kelas' and hari='$hari' and kd_jam='$kd_jam'");
			$rowcount = mysql_num_rows($sql1);
		if ($rowcount >= 1) {
			echo "<script type='text/javascript'>
					onload =function(){
						alert('Jadwal telah terisi!');
						document.location.href='lanjutjadwal.php?id_ta=$id_ta&kd_kelas=$kd_kelas&hari=$hari';
					}
				</script>";
		}else{
		$sql	 = "INSERT INTO jadwal_harian(id_ta,kd_kelas,hari,kd_jam,kd_mapel) VALUES('$id_ta','$kd_kelas','$hari','$kd_jam','$kd_mapel')";
		}
	}
	if ($simpan=mysql_query($sql)) {
		header("location:lanjutjadwal.php?id_ta=$id_ta&kd_kelas=$kd_kelas&hari=$hari");
	}else { 	
		echo"<script type='text/javascript'>
			onload =function(){
			alert('Jadwal telah terisi!!');
			}
			</script>";
	} 
}
//apabila klik hapus
if(isset($_POST['Hapus'])) {
	if (!empty($id) && $id != "") {
		$SQL = "delete from jadwal_harian where id='$id'"; 
 			if(mysql_query($SQL)){ 
    			header("location:lanjutjadwal.php?id_ta=$id_ta&kd_kelas=$kd_kelas&hari=$hari");
			}else {
				echo "Data berhasil dihapus";
   			} 
   }
}

?>

<div id="wrapper-kelas">
  <div id="box-kelas">
    <div id="content-kelas">
		<link rel="stylesheet" type="text/css" href="css/base_style.css"/>
			<center><h2>Form Jadwal Harian</h2></center>
			<form action="" method="post">
				<?php 
					echo "<div style='display:hidden'>";
					foreach(compact('id', 'id_ta','kd_kelas','hari') as $param=>$value) {
					echo "<input type='hidden' name='$param' value='$value' />";
					}
					echo "</div>";
				?>
			<table align="center">
				<tr>
					<td>Tahun Ajaran</td>
					<td>
						<input type="text" value="
						<?php 
							$p="SELECT * FROM ta Where id_ta='$id_ta'";
							$t=mysql_query($p);
							$data=mysql_fetch_array($t);					
							echo $data['ta'];
						?>" readonly=""/>
					</td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td>
						<input type="text" readonly="" value="
							<?php 
								$p="SELECT * FROM kelas Where kd_kelas='$kd_kelas'";
								$t=mysql_query($p);
								$data=mysql_fetch_array($t);					
								echo $data['kelas'];
							?>"/>
					</td>
				</tr>
				<tr>
					<td>Hari</td>
					<td><input type="text" value="<?php echo $hari; ?>" readonly=""/></td>
				</tr>
				<tr>
					<td>Jam Ke</td>
			 		<td><label>
                		<select name="jam" id="jam">
							<?php
								$query = mysql_query("SELECT * FROM jam_pelajaran ORDER BY jam ASC");
								while($row = mysql_fetch_array($query)){
								$selected = ($row['id']== $kd_jam)? 'selected="selected"' : '';
				  				echo "<option value='".$row['id']."' $selected>".$row['jam']."</option>";
							}
							?>                   
                 		</select>
            			</label></td>
				</tr>
				<tr>
					<td>Mata Pelajaran</td>
					<td><label>
                 		<select name="kd_mapel" id="kd_mapel">
							<?php
								$query = mysql_query("SELECT a.kd_mapel, c.mapel 
														FROM data_mapel a
														INNER JOIN mapel c ON c.kd_mapel=a.kd_mapel
														WHERE a.kd_kelas='$kd_kelas' ORDER BY mapel");
								while($row = mysql_fetch_array($query)){
									$selected = ($row['kd_mapel']==$kd_mapel)? 'selected="selected"' : '';
						  			echo "<option value='".$row['kd_mapel']."' $selected>".$row['mapel']."</option>";
								}
							?>                   
                 		</select>
             			</label></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<label><input name="simpan" type="submit" id="simpan" value="<?php echo $strsubmit; ?>" class="elipse"  />
						<?php
				 			if($id){
							echo "<input name=\"Hapus\" type=\"submit\" id=\"hapus\" value=\"Hapus\" class=\"elipse\"  />";
        					} 
						?>
                		</label>
					</td>
       			</tr>
			</table><br />
			<table border="0" align="center" cellpadding="1" cellspacing="0">
				<tr>
			        <th width="71"><div align="center"><strong>Jam ke</strong></div></th>
					<th width="100"><div align="center"><strong>Mulai</strong></div></th>
			        <th width="250"><div align="center"><strong>Mata Pelajaran</strong></div></th>
					<th width="200"><div align="center"><strong>Pengajar</strong></div></th>
					<th width="100"><div align="center"><strong>Aksi</strong></div></th>
			    </tr>
			<?php 
 			//pilih data dari tabel siswa
			$x="SELECT jh.*, jp.jam, jp.mulai, m.mapel, g.nama 
				FROM jadwal_harian jh
				INNER JOIN jam_pelajaran jp ON jh.kd_jam=jp.id
				INNER JOIN data_mapel dm ON jh.kd_mapel=dm.kd_mapel
				INNER JOIN mapel m ON dm.kd_mapel=m.kd_mapel
				INNER JOIN guru g ON g.nip=dm.nip
				WHERE jh.id_ta='$id_ta' AND jh.kd_kelas='$kd_kelas' AND jh.hari='$hari' AND dm.kd_kelas='$kd_kelas'
				ORDER BY jp.jam ASC
				";
			//ambil query tampilkan
			$tampil=mysql_query($x);
			//tampilkan data dalam bentuk array di tabel
			while ($data=mysql_fetch_array($tampil)) {
			?>
	            <tr>
	                <td align="center"><? echo $data['jam']; ?></td>
					<td><?php echo $data['mulai']; ?></td>
	                <td><?php echo $data['mapel']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td align="center"><a href="lanjutjadwal.php?id=<? echo $data['id'];?>"><img src="images/icon/button-edit.gif" width="20" height="20" border="0" /></a></td>
			<?php } ?>
				</tr>
			</table><br />        
		</form>      
		<form method="post" action="index.php?hal=jadwalharian">
			<?php 
				echo "<div style='display:hidden'>";
				foreach(compact('id_ta','kd_kelas','hari') as $param=>$value) {
					echo "<input type='hidden' name='$param' value='$value' />";
				}
				echo "</div>";
			?>
				<input type="submit" value="Kembali" class="elipse"  /> 
		</form>     
</body>
</html>
		</div>
	</div>
</div>
</div>