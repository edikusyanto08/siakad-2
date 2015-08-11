<?php session_start();
//koneksi database
include "setting/koneksi.php";


//deklarasi tgl bulan tahun
$bulan = array("January","February","Maret","April","Mei","Juni","Juli","Agustus","September","Okotober","November","Desember");
$hari  = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$month = intval(date('m')) - 1;
$days  = date('w');
$tg_angka = date('d');
$year  = date('Y');

/*echo 'Sekarang ini hari '.$hari[$days].' , Tanggal '.$tg_angka.' - '.$bulan[$month].' - '.$year;*/

	$id_absen 	 =$_POST['id_absen'];
	$id_ta 		 =$_POST['id_ta'];
	$tgl_absen   =$_POST['tgl_absen'];
	$kd_kelas    =$_POST['kd_kelas'];
	$kd_mapel    =$_POST['kd_mapel'];
	$nis 		 =$_POST['nis'];
	$nisn 		 =$_POST['nisn'];
	$keterangan  =$_POST['keterangan'];
	$format 	 =date('Y-m-d');
	$tglkonversi =(''.$tg_angka.' - '.$bulan[$month].' - '.$year);

//apabila klik simpan
if(isset($_POST['simpan'])){
	$a = 0;
	foreach ($_POST['nis'] as $nis) {
		
		$tampildata = mysqli_query($con,"SELECT * FROM absensi WHERE tgl_absen='$_POST[tgl_absen]' and nis='$nis' and kd_mapel='$_POST[kd_mapel]' and id_ta='$_POST[id_ta]' and kd_kelas='$_POST[kd_kelas]'");
		$cekSiswa = mysqli_num_rows($tampildata);

		if ($cekSiswa > 0) {
			/*echo "<script type='text/javascript'>
					onload =function(){
					alert('maaf siswa ber NIS : $nis sudah di input !!');
					document.location.href='?hal=pengolhan_data_absensi';
				}
				  </script>";*/
			echo "maaf siswa ber NIS : $nis sudah di input !!<br/>";
		} else {
		$sql= "insert into absensi (id_ta, tgl_absen, kd_kelas, kd_mapel, nis, keterangan) values('$_POST[id_ta]', '$_POST[tgl_absen]','$_POST[kd_kelas]', '$_POST[kd_mapel]', '$nis', '$keterangan[$a]')";
			
			$simpan=mysqli_query($con,$sql);
			//bila berhasil simpan kembali ke index
			if ($simpan) {
				header("location:index.php?hal=pengolhan_data_absensi");
			} else { 	
				/*echo "<script type='text/javascript'>
							onload =function() {
							alert('Data gagal disimpan!');
						}
					  </script>";*/
				echo "maaf siswa ber NIS : $nis gagal di input !!";
			} 
		}
		$a++;
	}
}

//proses editing
//Ambil nilai yang akan di edit
/*if (isset($_GET['id_absen'])) {
	$id_absen = $_GET['id_absen'];
} */

/*//tampilkan data sebelum di edit
$sql2 	= "SELECT * FROM absensi WHERE id_absen='$id_absen';";
$tampil = mysql_query($sql2);
$baris  = mysql_fetch_array($tampil);

	$id_absen 		= $baris['id_absen'];
	$id_ta  		= $baris['id_ta'];
	$tgl_absen 		= $baris['tgl_absen'];
	$nis 			= $baris['nis'];
	$kd_kelas		= $baris['kelas'];
	$kd_mapel		= $baris['mapel'];
	$keterangan 	= $baris['keterangan'];

//apabila klik tombol edit
if(isset($_POST['Edit'])) {
	$id_absen 		= $_POST['id_absen'];
	$id_ta  		= $_POST['id_ta'];
	$tgl_absen 		= $_POST['tgl_absen'];
	$nis 			= $_POST['nis'];
	$kd_kelas		= $_POST['kelas'];
	$keterangan 	= $_POST['keterangan'];
	
$SQL = "UPDATE absen SET id_ta='$id_ta', tgl_absen='$tgl_absen', nis='$nis', kd_kelas='$kelas', kd_mapel='$kd_mapel', keterangan='$keterangan' WHERE id_absen='$id_absen'"; 
  	$hasil= mysql_query($SQL); 
	//jika berhasil kembali ke home
  	if($hasil){
    	header("location:index.php?hal=pengolhan_data_absensi");
	} else { 
		echo "<script type='text/javascript'>
					onload =function(){
					alert('Update data gagal!');
			}
			  </script>";
    } 
} */
//apabila klik hapus
if(isset($_POST['Hapus'])) {
	if (!empty($id_absen) && $id_absen != "") {
		$SQL = "delete from absensi where id_absen='$id_absen'"; 
 		if(mysqli_query($con,$SQL)) { 
    		header("location:index.php?hal=pengolhan_data_absensi");
		}else {
			echo "Data berhasil dihapus";
    	} 
  	}
}
 
?>		
<link rel="stylesheet" type="text/css" href="css/base_style.css"/>
<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas">Form Data Absensi SMP Negeri 2 Godean </h2></center><hr>
          	<form action="" method="post" enctype="multipart/form-data" name="form1"><legend>
          		<h4 class="title-style-absensi"> Masukkan data dengan valid : Tahun ajaran, Kelas dan Mapel nya</h4> 
            	<table width="500" class="tb-kelas">
					<tr>
						<td class="td-guruwali">Tahun Ajaran</td>
					 	<td class="td-guruwali"><label>
		                  	<select name="id_ta" id="id_ta" class="select-style" required="">
		                  		<option value="">-- Pilih --</option>
								<?php
									$query = mysqli_query($con,"SELECT * FROM tahunajaran ORDER BY ta DESC");
									while($row = mysqli_fetch_array($query)){
										$selected = ($row['id_ta']==$id_ta)? 'selected="selected"' : '';
							  			echo "<option value='".$row['id_ta']."' $selected>".$row['ta']." - ".$row['semester']."</option>";
									}
								?>                   
		                  	</select>
		                	</label>
		                </td>
		            </tr>
					<tr>
		                <td class="td-guruwali">Tanggal Absen</td>
						<td class="td-guruwali">
							<?php if(!$_GET['id_absen']){
									echo "<input name='tgl_absen' class='txt-inputstyle' type='text'  readonly='' value='$tglkonversi'>";
								} else {
									echo "<input name='tgl_absen' class='txt-inputstyle' type='text'  readonly='' value='$tgl_absen'>";
								}
							?>
						</td>
					</tr>         
					<!-- <tr>
					  	<td class="td-guruwali">NIS</td>
						<td class="td-guruwali">
							<input type="text" class='txt-inputstyle' required="" name="nis" id="nis" maxlength="6" value="<?php echo "$nis"; ?>"></td>
					</tr> -->
					<tr>
						<td class="td-guruwali">Kelas</td>
						<td class="td-guruwali">
					  	<select name="kd_kelas" id="kd_kelas" class="select-style" required="">
		                  		<option value="">-- Pilih --</option>
								<?php
									$query = mysqli_query($con,"SELECT * FROM kelas ORDER BY kelas ASC");
									while($row = mysqli_fetch_array($query)){
										$selected = ($row['kd_kelas']==$kd_kelas)? 'selected="selected"' : '';
							  			echo "<option value='".$row['kd_kelas']."' $selected>".$row['kelas']."</option>";
									}
								?>                   
		                  	</select>
					</tr>
					<tr>
						<td class="td-guruwali">Mapel</td>
						<td class="td-guruwali">
					  	<select name="kd_mapel" id="kd_mapel" required="" class="select-style">
		                  		<option value="">-- Pilih --</option>
								<?php
									$query = mysqli_query($con,"SELECT * FROM mapel ORDER BY mapel ASC");
									while($row = mysqli_fetch_array($query)){
										$selected = ($row['kd_mapel']==$kd_mapel)? 'selected="selected"' : '';
							  			echo "<option value='".$row['kd_mapel']."' $selected>".$row['mapel']."</option>";
									}
								?>                   
		                  	</select>
					</tr>
					<!-- <tr>
		                <td class="td-guruwali">Keterangan</td>
		                <td class="td-guruwali">
		                	<label>
		                		<select name="keterangan" id="keterangan" class="select-style" required=''>
		                		<option value=''>-- Pilih --</option>
									<?php 
										$selected = ($keterangan)? 'selected="selected"': '';
										foreach(array('Sakit','Izin','Alpha') as $ket) {
										$selected = ($keterangan==$ket)? ' selected="selected"': '';
											echo "<option value='$ket'".$selected.">$ket </option>";
								
									}
		
				                ?>
		                 		</select> 
		                 	</label>
		                </td>
		            </tr> -->
		           	<tr>
                		<td class="td-guruwali"></td>
                		<td class="td-guruwali"><label>
                  	<?php
                   		// if(!$_GET['id_absen']){
							//bila mau tambah data yang tampil tombol simpan
							// echo "<input name=\"simpan\" type=\"submit\" id=\"simpan\" value=\"Simpan\" class=\"btn-ctakabsensi\"  />";
        				// } else {
							//Apabila mau edit yg tampil tombol edit dan hapus
							// echo "<input name=\"Edit\" type=\"submit\" id=\"edit\" value=\"Edit\" class=\"btn-ctakabsensi\"  />";
							//echo "<input name=\"Hapus\" type=\"submit\" id=\"hapus\" value=\"Hapus\" class=\"elipse\"  />";
        				// } 
                  	
							echo "<input name=\"cari_data\" type=\"submit\" id=\"simpan\" value=\"Cari\" class=\"btn-ctakabsensi\"  />";
        			?>
                </label>
			 	</td>
              </tr>
            </table>
			</form></legend>
			<form action="index.php?hal=prosesabsen" method="post" >
				<!-- <div id ="content-pncarian-kelas">
					<label class="pencarian-text">Cari Berdasarkan Tanggal </label>
					<input type="text" name="nisn" id="nisn" />
					<input type="submit" value="cari" class="btn-cari" />
				</div> --><br>
			</form>	

<?php if (isset($_POST['cari_data'])) {
	$cari=mysqli_query($con,"select * from anggota_kelas a join siswa s on a.nis=s.nis join tahunajaran t on a.id_ta=t.id_ta 
		join kelas k on a.kd_kelas=k.kd_kelas
	  where a.kd_kelas='$_POST[kd_kelas]' and a.id_ta='$_POST[id_ta]'");
	$mapelnya=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM mapel where kd_mapel='$_POST[kd_mapel]'"));
	$no=1;
	?>
	<form method="post" action="">
		<table width="1080" class="tb-frmkelas" border="0" align="center" cellpadding="2" cellspacing="0">
	     	<tr class="kelas-table">
	     		<th width="30"><div align="center">No </div></th>
			    <th width="150"><div align="center">TA & Semester</div></th>
	            <th width="100"><div align="center">Tanggal Absensi</div></th>
			    <th width="100"><div align="center">Nis</div></th>
				<th width="150"><div align="center">Nama Siswa</div></th>
				<th width="80"><div align="center">Kelas</div></th>
				<th width="100"><div align="center">Mata Pelajaran</div></th>
	            <th width="100"><div align="center">keterangan</div></th>
	        </tr>
	        <?php while ($cariSiswa = mysqli_fetch_array($cari)) {?>
	        <tr>
              		<td><?php echo $no; ?></td>
				  	<td><?php echo $cariSiswa['ta']; echo ' - '; echo $cariSiswa['semester']; ?></td>
				  	<td><?php echo $_POST['tgl_absen']; ?></td>
				  	<td><?php echo $cariSiswa['nis']; ?></td>
					<td><?php echo $cariSiswa['nama_siswa']; ?></td>
					<td><?php echo $cariSiswa['kelas']; ?></td>
					<td><?php echo $mapelnya['mapel']; ?></td>
	                <td>
	                	<select name="keterangan[]" id="keterangan" class="select-style" required=''>
		                		<option value=''>-- Pilih --</option>
		                		<?php 
	                foreach(array('Masuk','Sakit','Izin','Alpha') as $ket) {
											echo "<option value='$ket'>$ket </option>";
								
									}
	                ?>
	            </select></td>
	            <input type="hidden" name="nis[]" value="<?php echo $cariSiswa['nis']?>">
	            <input type="hidden" name="kd_mapel" value="<?php echo $mapelnya['kd_mapel'];?>">
	            <input type="hidden" name="tgl_absen" value="<?php echo date('Y-m-d');?>">
	            <input type="hidden" name="kd_kelas" value="<?php echo $_POST['kd_kelas'];?>">
	            <input type="hidden" name="id_ta" value="<?php echo $_POST['id_ta'];?>">
	        <?php $no++; } ?>
	    	</tr>
		</table>
		<input name="simpan" type="submit" id="simpan" value="Simpan" class="btn-ctakabsensi">

	</form>
	<br/>
			<?php } else { echo "Data belum ada! Pilih Tahun Ajaran, kelas dan mapel dahulu";} ?>
			<form>
			<table width="1080" class="tb-frmkelas" border="0" align="center" cellpadding="2" cellspacing="0" style="display:none;">
             	<tr class="kelas-table">
             		<th width="30"><div align="center">No </div></th>
				    <th width="150"><div align="center">TA &Semester</div></th>
	                <th width="100"><div align="center">Tanggal Absensi</div></th>
				    <th width="100"><div align="center">Nis</div></th>
					<th width="150"><div align="center">Nama Siswa</div></th>
					<th width="80"><div align="center">Kelas</div></th>
					<th width="100"><div align="center">Mata Pelajaran</div></th>
	                <th width="100"><div align="center">keterangan</div></th>
				    <th width="50"><div align="center">Aksi</div></th>
                </tr>
				<?php
					include "funct_page/setting_paging_absensi.php";
					$p= new Paging;
					$batas=20;
					$posisi=$p->cariPosisi($batas);
					$no=1;
					  //pilih data dari tabel kelas
					$x="SELECT *
						FROM absensi a
						INNER JOIN tahunajaran b on a.id_ta=b.id_ta
						INNER JOIN kelas k ON a.kd_kelas=k.kd_kelas
						INNER JOIN siswa c ON a.nis=c.nis
						INNER JOIN mapel m ON a.kd_mapel=m.kd_mapel
						WHERE a.tgl_absen LIKE '%".$nisn."%'
						ORDER BY a.id_absen
						DESC LIMIT $posisi, $batas";
						//ambil query tampilkan
					$tampil=mysqli_query($con,$x);
					//tampilkan data dalam bentuk array di tabel
					while ($data=mysqli_fetch_array($tampil)) {
				?>
              	<tr>
              		<td><?php echo $no++; $nomor; ?></td>
				  	<td><?php echo $data['ta']; echo ' - '; echo $data['semester']; ?></td>
				  	<td><?php echo $data['tgl_absen']; ?></td>
				  	<td><?php echo $data['nis']; ?></td>
					<td><?php echo $data['nama_siswa']; ?></td>
					<td><?php echo $data['kelas']; ?></td>
					<td><?php echo $data['mapel']; ?></td>
	                <td><?php echo $data['keterangan']; ?></td>
                	<td><!-- <div align="center"><a href="index.php?hal=pengolhan_data_absensi&id_absen=<?php echo $data['id_absen'];?>">
                		<img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a> -->
                		<a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='index.php?hal=hapus_absensi&id_absen=<?php echo $data['id_absen'];?>';}">
                		<img src="images/icon/del.png" width="20" height="20" border="0" /></a></div></td>
				<?php } ?>
            </table><br>

			<?php
				$tampil2 =mysqli_query($con,"select * from absensi");
				$jmldata =mysqli_num_rows($tampil2);
					// echo " <font face=verdana size=2 color=#00000> Jumlah :";
					// echo " <font face=verdana size=2 color=#E70E0E> <b> $jmldata data </font></b>";
					//menampilkan link halaman
					// echo " <font face=verdana size=1.5 color=#000000><b><br><center>Halaman   : </font></b><br>";
				$jmlhalaman	  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman  = $p->navHalaman($_GET[halaman], $jmlhalaman);
					// echo  $linkHalaman;
			?>
</form>
		</div>
	</div>
</div>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-s6z2{text-align:center}
</style>
<?php 
$hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
echo $a=$hari[date("w")];


?>
<?php $query = "select mapel.mapel as nama from jadwalharian left join mapel on jadwalharian.kd_mapel = mapel.kd_mapel where jadwalharian.kd_kelas = 'K-VIIA' AND jadwalharian.hari ='Senin' group by nama";
  	$tampil=mysqli_query($con,$query);
  	$span = mysqli_num_rows($tampil); ?>
<table class="tg">
  <tr>
    <th class="tg-031e" rowspan="2">No</th>
    <th class="tg-031e" rowspan="2">TA</th>
    <th class="tg-031e" rowspan="2">Tgl</th>
    <th class="tg-031e" rowspan="2">NIS</th>
    <th class="tg-031e" rowspan="2">Nama</th>
    <th class="tg-031e" rowspan="2">Kelas</th>
    <th class="tg-s6z2" colspan="<?php echo $span; ?>">Mapel</th>
    <th class="tg-031e" rowspan="2">Ket Harian</th>
  </tr>
  <tr>
  	<?php 
					//tampilkan data dalam bentuk array di tabel
					while ($data=mysqli_fetch_array($tampil)) {

  	?>
    <td class="tg-031e"><?php echo $data['nama'];  ?></td>
    <?php } ?>
  </tr>
  
  	<?php $no=1;
  	  $query = "select anggota_kelas.*, tahunajaran.*,kelas.kelas , siswa.nama_siswa from anggota_kelas left join siswa on anggota_kelas.nis = siswa.nis left join kelas on anggota_kelas.kd_kelas = kelas.kd_kelas  left join tahunajaran on anggota_kelas.id_ta = tahunajaran.id_ta where anggota_kelas.kd_kelas ='K-VIIA'"; 
  	$tampil=mysqli_query($con,$query);
  	while ($data=mysqli_fetch_array($tampil)) {
  	?>
  	<tr>
    <td class="tg-031e"><?php echo $no; ?></td>
    <td class="tg-031e"><?php echo $data['ta'].'-'.$data['semester'] ?></td>
    <td class="tg-031e">2015-7-10</td>
    <td class="tg-031e"><?php echo $data['nis'] ?></td>
    <td class="tg-031e"><?php echo $data['nama_siswa'] ?></td>
    <td class="tg-031e"><?php echo $data['kelas'] ?></td>
    <?php for ($i=0; $i < $span; $i++) { ?>
    	<td>
	                	<select name="keterangan[]" id="keterangan" class="select-style" required=''>
		                		<option value=''>-- Pilih --</option>
		                		<?php 
	                foreach(array('Masuk','Sakit','Izin','Alpha') as $ket) {
											echo "<option value='$ket'>$ket </option>";
								
									}
	                ?>
	            </select></td>
    <?php } ?>

    <td class="tg-031e"></td>
    </tr>
     <?php $no++;} ?>
  
</table>