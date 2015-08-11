<?php session_start();
include "setting/koneksi.php";

//inisialisasi variabel awal
$id_wali  = 0;
$id_ta 	  = '';
$gkelas	  = $_POST['gkelas'];

	if (!empty($ta_list)) {
		$ta = $ta_list[0];
	}
		$kd_kelas = '';
		$nip	  = '';

if (isset($_POST['simpan']) or isset($_POST['edit']) or isset($_POST['hapus'])) {

	$id_wali  = $_POST['id_wali'];
	$id_ta 	  = $_POST['id_ta'];
	$kd_kelas = $_POST['kd_kelas'];
	$nip	  = $_POST['nip'];
	
	
	$success = false;
	if (isset($_POST['simpan'])) {
		// validasi
		$sql = mysqli_query($con,"SELECT * FROM walikelas WHERE id_ta='$id_ta' and kd_kelas='$kd_kelas'");
		if (mysqli_num_rows($sql)) {
				echo "<script type='text/javascript'>
					onload =function(){
						alert('Wali Kelas telah terisi!');
						document.location.href='?hal=pengolhan_data_guruwalikelas';
					}
				</script>";
				die;
		}
		$sql = mysqli_query($con,"SELECT * FROM walikelas WHERE id_ta='$id_ta' and nip='$nip'");
		if (mysqli_num_rows($sql)) {
				echo "<script type='text/javascript'>
					onload =function(){
						alert('Guru telah terdaftar!');
						document.location.href='?hal=pengolhan_data_guruwalikelas';
					}
				</script>";
				die;
			}			

		$sql = "INSERT INTO walikelas(id_ta,kd_kelas,nip) VALUES('$id_ta','$kd_kelas','$nip')";
		mysqli_query($con,$sql);
			if ($id_wali = mysqli_insert_id()) {
					$success = true;
				}
			} else if (isset($_POST['edit'])) {
				$sql = "UPDATE walikelas SET id_ta='$id_ta', kd_kelas='$kd_kelas', nip='$nip' WHERE id_wali='$id_wali'";
				if (mysqli_query($con,$sql)) {
					$success = true;
				}
			} else if (isset($_POST['delete'])) {
				$sql = "DELETE FROM walikelas WHERE id_wali='$id_wali'";
				if (mysqli_query($con,$sql)) {
					$success = true;
				}
			}
			
			if ($success) {
				header("Location:?hal=pengolhan_data_guruwalikelas");
			}
		}

	if (isset($_GET['id_wali'])) {
		$id_wali = $_GET['id_wali'];
	}

	// Jika id_wali > 0 then edit;
	if (!empty($id_wali)) {
		$query = mysqli_query($con,"SELECT * FROM walikelas WHERE id_wali='$id_wali'");
		if ($data  = mysqli_fetch_object($query)) {
			$id_ta 	  = $data->id_ta;
			$kd_kelas = $data->kd_kelas;
			$nip	  = $data->nip;
		
		}
	}
	 
?>		
<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas">Form Data Guru WaliKelas SMP N 2 Godean </h2></center><hr/>
          		<form action="index.php?hal=pengolhan_data_guruwalikelas" method="post" enctype="multipart/form-data" name="form1">
          			<legend>
		  			<div style="display:none">
						<input type="text" name="id_wali" value="<?php echo $id_wali ?>" /></div>
				<h4 class="title-style-pnglahanwalikelas"> Masukkan data dengan valid : Tahun ajaran, Kode kelas, Nip</h4> 
            	<table width="350" class="tb-kelas">
              		<tr>
	               		<td class="td-guruwali">Tahun Ajaran</td>
	                	<td class="td-guruwali"> 
							<select name="id_ta" id="id_ta" required="">
								<?php
									echo "<option value=''> -- Pilih -- </option>";
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
                		<td class="td-guruwali">Kode Kelas</td>
                		<td class="td-guruwali"> 
                  			<select name="kd_kelas" id="kd_kelas" required="">

								  <?php
								  		echo "<option value=''> -- Pilih -- </option>";
									$query = mysqli_query($con,"SELECT * FROM kelas ORDER BY kelas ASC");
									while($row = mysqli_fetch_array($query)){
										$selected = ($row['kd_kelas']==$kd_kelas)? 'selected="selected"' : '';
							  			echo "<option value='".$row['kd_kelas']."' $selected>".$row['kd_kelas']."</option>";
								
										}
									?>                    
                  			</select>
                		</td>
              		</tr>
			  		<tr>
                		<td class="td-guruwali">NIP</td>
                		<td class="td-guruwali"> 
                  			<input type="text" name="nip" id="nip" maxlength="18" required='' value="<?php echo "$nip";?>" />
                		</td>
              		</tr>
              		</tr>
              		<tr>
                		<td class="td-guruwali"></td>
                		<td class="td-guruwali">
                  			<?php 
				  				if(!$id_wali){
									//bila mau tambah data yang tampil tombol simpan
									echo "<input name=\"simpan\" type=\"submit\" value=\"Simpan\" class=\"btn-walikelas\" />";
        						}else {
									//Apabila mau edit yg tampil tombol edit dan hapus
									echo "<input name=\"edit\" type=\"submit\" value=\"Edit\" class=\"btn-walikelas\" />";
							
        						}	 
        					?>
			 			</td>
              		</tr>
           		</table>
           		</legend>
				</form>
				<form action="index.php?hal=formguruwali" method="post">
					<div id ="content-pncarian-kelas">
						<label class="pencarian-text">Masukkan Kelas</label>
						<input type="text" name="gkelas" id="gkelas" />
						<input type="submit" value="cari" class="btn-cari" />
					</div><br>
				</form>
				<table class="tb-frmkelas" cellpadding="4" cellspacing="0">
					<tr class="kelas-table">
						<th width="40"><div align="center">No</div></th>
					  	<th width="200"><div align="center">Tahun Ajaran&Semester</div></th>
						<th width="200"><div align="center">Kelas</div></th>
				        <th width="300"><div align="center">NIP</div></th>
						<th width="300"><div align="center">Nama Guru Walikelas</div></th>
						<th width="100"><div align="center">Aksi</div></th>
				    </tr>	
					<?php
						include "funct_page/setting_paging_guruwalikelas.php";
						$p= new Paging;
						$batas=10;
						$posisi=$p->cariPosisi($batas);
						//pilih data dari tabel kelas
						$x="SELECT a.id_wali,
								   a.id_ta,
								   a.nip,
								   b.nama,
								   c.kelas,
								   d.ta,
								   d.semester
							FROM walikelas a
							LEFT JOIN guru b ON a.nip=b.nip
							LEFT JOIN kelas c ON a.kd_kelas=c.kd_kelas
							LEFT JOIN tahunajaran d ON a.id_ta=d.id_ta
							WHERE c.kelas LIKE '%".$gkelas."%'
							ORDER BY a.nip
							DESC LIMIT $posisi, $batas";
						//ambil query tampilkan
						$no=1;
						$tampil=mysqli_query($con,$x);
						//tampilkan data dalam bentuk array di tabel
						while ($data=mysqli_fetch_array($tampil)) {
					?>
					<tr>
						<td><?php echo $no++; echo $nomer;?></td>
					  	<td><?php echo $data['ta']; echo ' - '; echo $data['semester']; ?></td>
				        <td><?php echo $data['kelas']; ?></td>
				        <td><?php echo $data['nip']; ?></td>
						<td><?php echo $data['nama']; ?></td>
				        <td><div align="center"><a href="index.php?hal=pengolhan_data_guruwalikelas&id_wali=<?php echo $data['id_wali'];?>">
				        	<img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a>
				        	<a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='hapus_pngolahan_datawalikls.php?id_wali=<?php echo $data['id_wali']; ?>';}">
				        	<img src="images/icon/del.png" width="20" height="20" border="0" /></a></div></div></td>
					<?php } ?>
					</tr>
				</table>
				<?php
					$tampil2 =mysqli_query($con,"select * from walikelas");
					$jmldata =mysqli_num_rows($tampil2);

					echo " <font face=verdana size=1 color=#000000><b><br><center>Halaman   : </font></b><br>";
					$jmlhalaman	  = $p->jumlahHalaman($jmldata, $batas);
					$linkHalaman  = $p->navHalaman($_GET[halaman], $jmlhalaman);

					echo  $linkHalaman;?>     
            	</form>
        </div>
   	</div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->