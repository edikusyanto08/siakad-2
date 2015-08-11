<?php session_start();
include "setting/koneksi.php";

	$id 	  = 0;
	$kelas   = $_POST['kelas'];
	$id_ta 	  = '';

	if (!empty($ta_list)) {
		$ta = $ta_list[0];
	}

	$kd_kelas = '';
	$nis	  = '';

	if (isset($_POST['simpan']) or isset($_POST['edit']) or isset($_POST['hapus'])) {

	$id  		= $_POST['id'];
	$id_ta 	    = $_POST['id_ta'];
	$kd_kelas	= $_POST['kd_kelas'];
	$nis	  	= $_POST['nis'];

	$success = false;
	if (isset($_POST['simpan'])) {
		// validasi siswa
		$sql = mysqli_query($con,"SELECT * FROM anggota_kelas WHERE id_ta='$id_ta' and kd_kelas='$kd_kelas' and nis='$nis'");
		if (mysqli_num_rows($sql)) {
				echo "<script type='text/javascript'>
						onload =function(){
							alert('Siswa telah terdaftar!');
							document.location.href='?hal=pengolhan_data_inputkelasbaru';
						}
					 </script>";
				 die;
		}
		$query     = mysqli_query($con,"SELECT kuota FROM kelas WHERE kd_kelas='$kd_kelas'  LIMIT 1");
		$kapasitas = mysqli_fetch_array($query);
		
		$query  = mysqli_query($con,"SELECT COUNT(kd_kelas) AS jumlah FROM anggota_kelas WHERE kd_kelas='$kd_kelas' AND id_ta='$id_ta'");
		$jumlahsiswa = mysqli_fetch_array($query);	
		
		$simpan = false;
				if ((int)$jumlahsiswa['jumlah'] > (int)$kapasitas['kuota']) {
						echo "<script type='text/javascript'>
								onload =function(){
									alert('Kuota kelas telah penuh!!!');
									document.location.href='?hal=pengolhan_data_inputkelasbaru';
							}
						</script>";
				die;

		}
		//setting_paging_data_kelasbaru insert multiple colom
		
		foreach($nis as $nis){
			
		$sql = "insert into anggota_kelas (id_ta,kd_kelas,nis,status) values ('$id_ta','$kd_kelas','{$nis}','1')";
		$hasil=(mysqli_query($con,$sql));
			
		}

			if ($id_wali = mysqli_insert_id($con)) {
					$success = true;
				}	

			}else if (isset($_POST['edit'])) {
				$sql = "UPDATE anggota_kelas SET id_ta='$id_ta', kd_kelas='$kd_kelas' WHERE id='$id'";
				if (mysqli_query($con,$sql)) {
					$success = true;
				}
			}else if (isset($_POST['hapus'])) {
				$sql = "DELETE FROM anggota_kelas WHERE id='$id'";
				if (mysqli_query($con,$sql)) {
					$success = true;
				}
			}
			
			if ($success) {
				header("Location:?hal=pengolhan_data_inputkelasbaru");
			}
		}

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
		}

		// Jika id > 0 then edit;
		if (!empty($id)) {

			$query = mysqli_query($con,"SELECT * FROM anggota_kelas WHERE id='$id'");
			if ($data  	  = mysqli_fetch_object($query)) {
				$id_ta 	  = $data->id_ta;
				$kd_kelas = $data->kd_kelas;
				$nis	  = $data->nis;
			
			}
		}
 			
	?>
<style type="text/css">
/*setting table siswa*/
	.tb-frmsiswakelas{
	    text-align: center;
	    font-family: Arial,sans-serif;
	    font-size: 13px;
	    margin-left: 55px;
	}

	.heading-prefixstyling{
		font-family: Arial,sans-serif;
		font-size: 13px;
		text-transform: uppercase;
		font-weight: bold;
		text-align: center;
	}

</style>	

<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
		<center><h2 class="title-kelas">Form Pengolahan Data Anggota Kelas SMP N 2 Godean</h2></center><hr>
		<br>
		<div class="section-menubar">
			<div class="box-menubarinner">

			<!--- ................tabs tabs menu................... -->
			<div class="box-innertab">
				<div class="menu-wrapboxtab">
					<span class="sizing-menustab">
						<a class="block-menustab" href="index.php?hal=pengolhan_data_inputkelasbaru">Input anggota kelas baru</a>
					</span>

					<span class="sizing-menustab">
						<a class="block-menustab" href="index.php?hal=pengolhan_data_lihatanggotakls">Lihat Anggota Kelas</a>
					</span>

					<span class="sizing-menustab">
						<a class="block-menustab" href="index.php?hal=pengolhan_data_kenaikankls">Input Kenaikan Kelas</a>
					</span>
				</div>
			</div>
			<!--- ................tabs tabs menu................... -->

			<h4 class="title-style-pnglahananggotakelasbru"> Masukkan data dengan valid : Tahun ajaran, Kelas, Nis</h4>
			<form action="index.php?hal=pengolhan_data_inputkelasbaru" method="post" enctype="multipart/form-data" name="form1">
				<div style="display:none">
				<input type="text" name="id" value="<?php echo "$id"; ?>" /></div> 
			<table width="350" border="0" class="tb-kelas">
				<tr>
		        	<td class="td-anggota-kelas">Tahun Ajaran</td>
		        	<td class="td-anggota-kelas">	 
						<select name="id_ta"  required='' class="select-style">
							<?php
								echo "<option value=''>-- Pilih --</option>";

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
		    		<td class="td-anggota-kelas">Kelas</td>
		    		<td class="td-anggota-kelas"> 
		               		<select name="kd_kelas" required='' class="select-style">
					 		<?php
					  			echo "<option value=''>-- Pilih --</option>";
								$query = mysqli_query($con,"SELECT * FROM kelas");
								while($row = mysqli_fetch_array($query)){
								$selected = ($row['kd_kelas']==$kd_kelas)? 'selected="selected"' : '';
					  			echo "<option value='".$row['kd_kelas']."' $selected>".$row['kelas']."</option>";
							}
						?>                    
		      			</select>
		    		</td>
		  		</tr>
			</table>
			<br>

			<!-- function checkbox checked form -->
			<script type="text/javascript">
				function checkAll(form) {
					for (var i=0; i<document.forms[form].elements.length;i++) {
						var e=document.forms[form].elements[i];
						if ((e.name != 'allbox') && (e.type=='checkbox')) {
							e.checked=document.forms[form].allbox.checked;
						}
					}
				}
			</script>
			<table width="1000" cellpadding="4" cellspacing="0" class="tb-frmsiswakelas">
				<tr class="kelas-table">
					<th width="20">No</th>
					<th width="100">Nis</th>
					<th width="200">Nama Siswa</th>
					<th width="20">Pilih</th>
				</tr>
					<?php
						$ambildata=("SELECT siswa.nis as nis, siswa.nama_siswa FROM siswa LEFT JOIN anggota_kelas ON siswa.nis = anggota_kelas.nis WHERE anggota_kelas.nis IS NULL ORDER BY siswa.nis DESC");
						$tampilkan=mysqli_query($con,$ambildata);
						$no=1;
						while ($data=mysqli_fetch_array($tampilkan)) {
					?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $data['nis'];?></td>
					<td><?php echo $data['nama_siswa'];?></td>
					<td><?php echo '<input type="checkbox" name="nis[]" value="'.$data['nis'].'"/>'; ?></td>
				</tr>
				<?php $no++; } ?>
			</table>
			


			<div class="section-position">
				<div class="box-buttonposition">
		          	<?php 
				  		if(!$id){
							//bila mau tambah data yang tampil tombol simpan
							echo "<input name=\"simpan\" type=\"submit\" id=\"simpan\" value=\"Simpan\" class=\"btn_kelasbaru\" />";
						}else {
							//Apabila mau edit yg tampil tombol edit dan hapus
							echo "<input name=\"edit\" type=\"submit\" id=\"edit\" value=\"Edit\" class=\"btn_kelasbaru\" />";
							//echo "<input name=\"hapus\" type=\"submit\" id=\"hapus\" value=\"Hapus\" class=\"btn-anggota\" />";
						} 
					?>
		 		</div>
			</div>
		</form>
		</div>
		</div>
	</div>
</div>