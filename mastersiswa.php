<?php session_start();
//koneksi database
include "setting/koneksi.php";


//setting format tanggal
$tanggal 	  =date('Y-m-d');
$ambiltahun   =substr($tanggal, 0, 4);
$ambilbulan   =substr($tanggal, 5, 2);
$ambiltanggal =substr($tanggal, 8, 2);

/*echo "$ambiltanggal-$ambilbulan-$ambiltahun";*/

$query = "SELECT max(nis) as id FROM siswa";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);

$kd = $data['id'];

//mengatur 6 karakter 
//mengatur 3 karakter untuk jumlah karakter yang berubah-ubah
$noUrut = (int) substr($kd ,2 ,2);
$noUrut ++;

//mengatur nis sebagai karakter tetap
$char   = "60";
//%02s untuk mengatur 3 karakter di belakang 6001
$IDbaru = $char . sprintf("%02s", $noUrut);


//deklarasi fariabel dari form
$nis						='';
$nama_siswa					='';
$tgl_diterima 				='';
$jen_kel					='';
$tempat_lahir				='';
$tgl_lahir					='';
$status_dlmkluarga			='';
$notelp_siswa				='';
$anak_ke 					='';
$jumlah_saudara 			='';
$agama 						='';
$alamat_siswa 				='';
$sekolah_asal 				='';
$nama_ayah					='';
$pekerjaan_ayah 			='';
$nama_ibu					='';
$pekerjaan_ibu 				='';
$notelp_ortu				='';
$alamat_ortu				='';
$nama_wali 					='';					
$pekerjaan_wali				='';
$alamat_wali				='';
$notelp_wali 				='';
$foto 						='';



//apabila klik simpan
if(isset($_POST['simpan'])){
	$nis = (isset($_POST['nis']) && !empty($_POST['nis'])) ? $_POST['nis']: '';
	if(empty($nis)){
		echo "<script type='text/javascript'>
					onload =function(){
					alert('Nomor induk siswa belum diisi');
				}
			 </script>";
	}else {
			$nis						=$_POST['nis'];
			$nama_siswa					=$_POST['nama_siswa'];
			$tgl_diterima 				=$_POST['tgl_diterima'];
			$jen_kel					=$_POST['jen_kel'];
			$tempat_lahir				=$_POST['tempat_lahir'];
			$tgl_lahir					=$_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
			$status_dlmkluarga			=$_POST['status_dlmkluarga'];
			$notelp_siswa				=$_POST['notelp_siswa'];
			$anak_ke 					=$_POST['anak_ke'];
			$jumlah_saudara 			=$_POST['jumlah_saudara'];
			$agama 						=$_POST['agama'];
			$alamat_siswa 				=$_POST['alamat_siswa'];
			$sekolah_asal 				=$_POST['sekolah_asal'];
			$nama_ayah					=$_POST['nama_ayah'];
			$pekerjaan_ayah 			=$_POST['pekerjaan_ayah'];
			$nama_ibu					=$_POST['nama_ibu'];
			$pekerjaan_ibu 				=$_POST['pekerjaan_ibu'];
			$notelp_ortu				=$_POST['notelp_ortu'];
			$alamat_ortu				=$_POST['alamat_ortu'];
			$nama_wali 					=$_POST['nama_wali'];					
			$pekerjaan_wali				=$_POST['pekerjaan_wali'];
			$alamat_wali				=$_POST['alamat_wali'];
			$notelp_wali				=$_POST['notelp_wali'];
		
			$sql="INSERT INTO siswa
							(nis,
							 nama_siswa, 
							 tgl_diterima, 
							 jen_kel, 
							 tempat_lahir, 
							 tgl_lahir, 
							 status_dlmkluarga,
							 notelp_siswa, 
							 anak_ke,
							 jumlah_saudara,
							 agama,
							 alamat_siswa,
							 sekolah_asal,
							 nama_ayah,
							 pekerjaan_ayah,
							 nama_ibu,
							 pekerjaan_ibu,
							 notelp_ortu,
							 alamat_ortu,
							 nama_wali,
							 pekerjaan_wali,
							 alamat_wali,
							 notelp_wali)

					VALUES ('$nis',
							'$nama_siswa',
							'$tanggal',
							'$jen_kel',
							'$tempat_lahir',
							'$tgl_lahir',
							'$status_dlmkluarga',
							'$notelp_siswa',
							'$anak_ke',	
	 						'$jumlah_saudara',
	 						'$agama',
	 						'$alamat_siswa',
	 						'$sekolah_asal',
	 						'$nama_ayah',
	 						'$pekerjaan_ayah',
	 						'$nama_ibu',
	 						'$pekerjaan_ibu',
	 						'$notelp_ortu', 
							'$alamat_ortu',
							'$nama_wali',
							'$pekerjaan_wali',
							'$alamat_wali',
							'$notelp_wali')";
			
			$simpan=mysqli_query($con,$sql);	
	} 
		
		//bila berhasil simpan kembali ke index halaman sekolah
		if ($simpan) {
			$foto = $_FILES['foto']['name'];
			//upload foto
			if (strlen($foto)>0) {
				//upload
				if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
					move_uploaded_file ($_FILES['foto']['tmp_name'], "images/foto/".$foto);
					// edit data siswa
					mysqli_query($con,"UPDATE siswa SET foto='$foto' WHERE nis='$nis'");
				}else { 
					echo"gagal dikirim"; 
				}
			}
			header("location:index.php?hal=mastersiswa");
		}else { 
			echo "<script type='text/javascript'>
						onload =function(){
							alert('data gagal disimpan!');
					}	
				  </script>";
		} 
	}

//proses editing
//Ambil nilai yang akan di edit
if (isset($_GET['nis'])) {
	$nis = $_GET['nis'];
} 

//tampilkan data sebelum di edit
	$sql2	="select * from siswa where nis='$nis';";
	$tampil = mysqli_query($con,$sql2);
	$baris  = mysqli_fetch_array($tampil);

	$nis				 =$baris['nis'];
	$nama_siswa 		 =$baris['nama_siswa'];
	$tgl_diterima 		 =$baris['tgl_diterima'];
	$jen_kel 			 =$baris['jen_kel'];
	$tempat_lahir 		 =$baris['tempat_lahir'];
	list($thn,$bln,$tgl) = explode("-",$baris['tgl_lahir']);
	$status_dlmkluarga	 =$baris['status_dlmkluarga'];
	$notelp_siswa 		 =$baris['notelp_siswa'];
	$anak_ke 			 =$baris['anak_ke'];
	$jumlah_saudara 	 =$baris['jumlah_saudara'];
	$agama 				 =$baris['agama'];
	$alamat_siswa 		 =$baris['alamat_siswa'];
	$sekolah_asal 		 =$baris['sekolah_asal'];
	$nama_ayah 			 =$baris['nama_ayah'];
	$pekerjaan_ayah 	 =$baris['pekerjaan_ayah'];
	$nama_ibu 			 =$baris['nama_ibu'];
	$pekerjaan_ibu 		 =$baris['pekerjaan_ibu'];
	$notelp_ortu		 =$baris['notelp_ortu'];
	$alamat_ortu		 =$baris['alamat_ortu'];
	$nama_wali 			 =$baris['nama_wali'];
	$pekerjaan_wali 	 =$baris['pekerjaan_wali'];
	$alamat_wali 		 =$baris['alamat_wali'];
	$notelp_wali 		 =$baris['notelp_wali'];
	$foto 				 =$baris['foto'];

//apabila klik tombol edit
if(isset($_POST['Edit'])) {

	$nis 				=$_POST['nis'];
	$nama_siswa 		=$_POST['nama_siswa'];
	$tgl_diterima 		=$_POST['tgl_diterima'];
	$jen_kel 			=$_POST['jen_kel'];
	$tempat_lahir 		=$_POST['tempat_lahir'];
	$tgl_lahir			=$_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
	$status_dlmkluarga 	=$_POST['status_dlmkluarga'];
	$notelp_siswa 		=$_POST['notelp_siswa'];
	$anak_ke 			=$_POST['anak_ke'];
	$jumlah_saudara 	=$_POST['jumlah_saudara'];
	$agama 				=$_POST['agama'];
	$alamat_siswa 		=$_POST['alamat_siswa'];
	$sekolah_asal 		=$_POST['sekolah_asal'];
	$nama_ayah 			=$_POST['nama_ayah'];
	$pekerjaan_ayah 	=$_POST['pekerjaan_ayah'];
	$nama_ibu 			=$_POST['nama_ibu'];
	$pekerjaan_ibu 		=$_POST['pekerjaan_ibu'];
	$notelp_ortu 		=$_POST['notelp_ortu'];
	$alamat_ortu 		=$_POST['alamat_ortu'];
	$nama_wali 			=$_POST['nama_wali'];
	$pekerjaan_wali 	=$_POST['pekerjaan_wali'];
	$alamat_wali 		=$_POST['alamat_wali'];
	$notelp_wali 		=$_POST['notelp_wali'];
	$foto 				=$_FILES['foto']['name'];

	if (strlen($foto)>0) {
		//upload
		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
				move_uploaded_file ($_FILES['foto']['tmp_name'], "images/foto/".$foto);
			}
				mysqli_query("UPDATE siswa SET foto='$foto' WHERE nis='$nis'");
	}
	
$SQL = "UPDATE siswa 
		   SET nama_siswa	  		='$nama_siswa',
			   tgl_diterima   		='$tgl_diterima',
			   jen_kel 		  		='$jen_kel',
			   tempat_lahir   		='$tempat_lahir',
			   tgl_lahir 	  		='$tgl_lahir',
			   status_dlmkluarga 	='$status_dlmkluarga',
			   notelp_siswa		    ='$notelp_siswa',
			   anak_ke		  		='$anak_ke',
			   jumlah_saudara 		='$jumlah_saudara',
			   agama 		  		='$agama',
			   alamat_siswa			='$alamat_siswa',
			   sekolah_asal 	  	='$sekolah_asal',
			   nama_ayah 	  		='$nama_ayah',
			   pekerjaan_ayah 		='$pekerjaan_ayah',
			   nama_ibu 	  		='$nama_ibu',
			   pekerjaan_ibu 	 	='$pekerjaan_ibu',
			   notelp_ortu			='$notelp_ortu',
			   alamat_ortu			='$alamat_ortu',
			   nama_wali 	 		='$nama_wali',
			   pekerjaan_wali 		='$pekerjaan_wali',
			   alamat_wali 	  		='$alamat_wali',
			   notelp_wali   		='$notelp_wali' 
		 WHERE nis 			  		='$nis'"; 
  	$hasil= mysqli_query($con,$SQL); 
	//jika berhasil kembali ke halaman index web sekolah
  	if($hasil){
    	header("location:index.php?hal=mastersiswa");
	}else{ 
		echo "<script type='text/javascript'>
					onload =function(){
					alert('Data gagal di edit!');
					}
		      </script>";
    } 
} 

//apabila klik hapus
if(isset($_POST['Hapus'])) {
	if (!empty($nis) && $nis != "") {
		$SQL = "delete from siswa where nis='$nis'"; 
 		if(mysql_query($SQL)) { 

   		 	header("location:mastersiswa.php");
		}else {
		 	echo "Data berhasil dihapus";
   		} 
  	}
}
   
?>

<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas">Form Data Siswa SMP 2 Godean</h2></center><hr/>
         	<form action="index.php?hal=mastersiswa" method="post" enctype="multipart/form-data" id="formsiswa">
         		<legend>
            	<table align="center" class="tb-siswa">
	              	<tr>
		                <td width="200" class="td-siswa">Nomor Induk Siswa </td>
		                <td width="350" class="td-siswa">
		                	<label>
								<?php 
									if(!$_GET ['nis']) {
										echo "<input name='nis' class='txt-inputstyle' type='text'  maxlength='6' readonly='' value='$IDbaru'>";
									}else {
										echo "<input name='nis' class='txt-inputstyle' type='text'  readonly='' maxlength='5'value='$nis'>";
									}
								?>
		                	</label>
	                	</td>
						<td class="td-siswa" width="150">SD/Sekolah Asal</td>
		                <td class="td-siswa">
		               	 	<label><input name="sekolah_asal" class='txt-inputstyle' type="text" size="40" value="<?php echo $sekolah_asal ?>" required></label>
	                	</td>
	                </tr>
	              	<tr>
		                <td class="td-siswa">Nama Siswa </td>
		                <td class="td-siswa">
		                	<label><input name="nama_siswa" class='txt-inputstyle' type="text" size="40" value="<?php echo $nama_siswa ?>" required></label>
	                  	</td>
	                  	<td class="td-siswa">Nama Ayah</td>
	                	<td class="td-siswa">
	                		<label><input name="nama_ayah" class='txt-inputstyle' type="text" size="40" value="<?php echo $nama_ayah ?>" required></label>
	                  	</td>
	              	</tr>
				   	<tr>
		                <td class="td-siswa">Jenis Kelamin </td>
		                <td class="td-siswa">
		                	<label><input name="jen_kel" type="radio" class="radio-style" value="Laki-Laki" checked>Laki-Laki</label>
	                  		<label><input type="radio" name="jen_kel" class="radio-style" style="margin-left:30px;" value="Perempuan" >Perempuan</label>
	               		</td>
	              	</tr>
	              	<tr>
	                	<td class="td-siswa">Tempat Lahir </td>
	                	<td class="td-siswa">
	                		<label><input name="tempat_lahir" class='txt-inputstyle' type="text"  size="40" value="<?php echo $tempat_lahir ?>" required></label>
	                  	</td>
						<td class="td-siswa">Pekerjaan Ayah</td>
	                	<td class="td-siswa">
	                		<label><input name="pekerjaan_ayah" class='txt-inputstyle' type="text"  size="40" value="<?php echo $pekerjaan_ayah ?>" required></label>
	                  	</td>
	              	</tr>
	              	<tr>
		                <td class="td-siswa">Tanggal Lahir </td>
		                <td class="td-siswa">
                		<select name="tgl" id="tgl" required='' class="select-style">
                			<option class='option-style' value='none'>Tgl</option>
							<?php
								for ($i=1; $i<=31; $i++) {
									$tg = ($i<10) ? "0$i" : $i;
									$sele = ($tg==$tgl)? "selected" : "";
									echo "<option class='option-style' value='$tg' $sele>$tg</option>";	
								}
							?>
               			</select>
                	-
                		<select name="bln" id="bln" required='' class="select-style">
                			<option class='option-style' value='none'>Bln</option>
							<?php
								for ($i=1; $i<=12; $i++) {
									$bl = ($i<10) ? "0$i" : $i;
									$sele = ($bl==$bln)?"selected" : "";
									echo "<option class='option-style' value='$bl' $sele>$bl</option>";	
								}
							?>
                		</select>
                	-
                		<select name="thn" id="thn" required='' class="select-style">
                			<option class='option-style' value='none'>Thn</option>
							<?php
								for ($i=1970; $i<=2010; $i++) {
									$sele = ($i==$thn)?"selected" : "";
									echo "<option class='option-style' value='$i' $sele>$i</option>";	
								}
							?>
                		</select>
                	</td>
					<td class="td-siswa">Nama Ibu</td>
                	<td class="td-siswa">
                		<label><input name="nama_ibu" class='txt-inputstyle' type="text" size="40" value="<?php echo $nama_ibu ?>" required=''></label>
                  	</td>
              	</tr>
              	<tr>
	              	<td class="td-siswa" width="150">Diterima  Disekolah Tanggal</td>
		            <td class="td-siswa">
		            <?php 
		            	if (!$_GET ['nis']) {
		            		echo "<input type='text' class='txt-inputstyle' name='tgl_diterima' id='datepicker-example1' value='$tgl_diterima'>";
		            	}else{
		            		echo "<input type='text' class='txt-inputstyle' name='tgl_diterima'  value='$tgl_diterima' readonly=''>";
		            	}
		            
		            ?>
		              
	                </td>
	                <td class="td-siswa">Pekerjaan Ibu</td>
                	<td class="td-siswa">
                		<label><input name="pekerjaan_ibu" class='txt-inputstyle' type="text" id="pekerjaan_i" size="40" value="<?php echo $pekerjaan_ibu ?>" required=''></label>
                  	</td>
	            </tr>
	            <tr>
                 	<td class="td-siswa">Alamat Siswa</td>
	                <td class="td-siswa">
	                	<label><textarea class="textarea-style" name="alamat_siswa" cols="30" rows="3" value="" required=''><?php echo "$alamat_siswa"; ?></textarea></label>
	                 </td>
	                 <td class="td-siswa">Alamat Ortu</td>
                	<td class="td-siswa">
                		<label><textarea class="textarea-style" name="alamat_ortu" cols="30" rows="3" value="" required=''><?php echo "$alamat_ortu"; ?></textarea></label>
                 	</td>
	                
              	</tr>
			  	<tr>
	                <td class="td-siswa">Status Dalam Keluarga</td>
	                <td class="td-siswa"><label>
				  		<select name="status_dlmkluarga" required='' class="select-style">
					 		<option class='option-style' value=>-- Pilih --</option>
			                  	<?php
										$selected = ($status)? 'selected="selected"': '';
										foreach(array('Anak Kandung', 'Anak Asuh','Anak Tiri') as $status) {
											$selected = ($status_dlmkluarga==$status)? ' selected="selected"': '';
											echo "<option class='option-style' value='$status'".$selected.">$status</option>";
										}
								?>
                  		</select>
                		</label>
                	</td>
					<td class="td-siswa">No Telepon Ortu</td>
                		<td class="td-siswa">
                			<label><input name="notelp_ortu" class='txt-inputstyle' type="text" size="40" value="<?php echo $notelp_ortu ?>" required=''></label>
                  		</td>
              	</tr>
			  	<tr>
                	<td class="td-siswa">Anak Ke</td>
                	<td class="td-siswa">
                		<label><input name="anak_ke" class='txt-inputstyle' type="text" size="40" maxlength="2" value="<?php echo $anak_ke ?>" required=''></label>
                  	</td>
					<td class="td-siswa">Nama Wali</td>
                	<td class="td-siswa">
                		<label><input name="nama_wali" class='txt-inputstyle' type="text" id="nama_wali" size="40" value="<?php echo $nama_wali ?>" required=''></label>
                  	</td>
              	</tr>
			  	<tr>
                	<td class="td-siswa">Jumlah Saudara</td>
                	<td class="td-siswa">
                		<label><input name="jumlah_saudara" class='txt-inputstyle' type="text" id="jumlah_saudara" size="40" maxlength="2" value="<?php echo $jumlah_saudara ?>" required=''></label>
                  	</td>
					<td class="td-siswa">Pekerjaan Wali</td>
               	 	<td class="td-siswa">
               	 		<label><input name="pekerjaan_wali" class='txt-inputstyle' type="text" id="pekerjaan_wali" size="40" value="<?php echo $pekerjaan_wali ?>" required=''></label>
                  	</td>
              	</tr>
              	<tr>
              		<td class="td-siswa">No Telepon Siswa</td>
                	<td class="td-siswa">
                		<label><input name="notelp_siswa" class='txt-inputstyle' type="text" size="40" value="<?php echo $notelp_siswa ?>" required=''></label>
                  	</td>
                  	<td class="td-siswa">No Telepon Wali</td>
                	<td class="td-siswa">
                		<label><input name="notelp_wali" class='txt-inputstyle' type="text" size="40" value="<?php echo $notelp_wali ?>" required=''></label>
                  	</td>
              	</tr>
			  	<tr>
	                <td class="td-siswa">Agama</td>
	                <td class="td-siswa">
	                <label>
                  		<select name="agama" id="agama" required='' class="select-style">
				 			<option class='option-style' value=>-- Pilih --</option>
			                  	<?php
									$selected = ($agama)? 'selected="selected"': '';
									foreach(array('Islam', 'Kristen', 'Katholik', 'Hindu','Budha') as $ag) {
										$selected = ($agama==$ag)? ' selected="selected"': '';
										echo "<option class='option-style' value='$ag'".$selected.">$ag</option>";
									}
								?>
                  		</select>
                		</label>
                	</td>
					<td class="td-siswa">Alamat Wali</td>
                	<td class="td-siswa">
                		<label><textarea class="textarea-style" name="alamat_wali" value="" required=""><?php echo "$alamat_wali" ?></textarea></label>
                  	</td>
              	</tr>
              	<tr>
	                <td class="td-siswa">Foto</td>
	                <td class="td-siswa">
						<label>
						<?php if($_GET['nis']){
								//tampilkan foto saat mau ngedit
								 echo "<img src='images/foto/$foto' width=150 height=180> <br />";
							} 
						?>
						<div class="input-stylefile">
							<span class="position-inputfile">
                  				<input name="foto" type="file" id="foto" required=''/> 
                  			</span>
                  		</div>
                  		</label>
					</td>
              	</tr>
              	<tr>
                	<td class="td-siswa"></td>
                	<td class="td-siswa"><label>
                		<span class="btn-control">
			              <?php 
			              		if(!$_GET['nis']){
									//bila mau tambah data yang tampil tombol simpan
									echo "<input name=\"simpan\" type=\"submit\" value=\"Simpan\" class=\"elipse-siswa\"  />";
						        }else {
									//Apabila mau edit yg tampil tombol edit dan hapus
									echo "<input name=\"Edit\" type=\"submit\"  value=\"Edit\" class=\"elipse-siswa-left\"  />";
						        } 
						   ?>
                		</span>
                		</label>
			 		</td>
              	</tr>
            </form>
            </table></legend><br>
            <br>
			<?php

			    $nnis =$_POST['cari'];

			  

			?>
				<!--tampil siswa -->
			<form action="index.php?hal=mastersiswa" method="post" >
				<div style="margin: 0px 0px 0px 750px; width: 73%; font-family: Arial,sans-serif; font-size: 15px; font-weight: bold;">
					<label class="pencarian-text">Cari Bedasarkan NIS</label>
				 		<input type="text" name="cari" id="cari"/>
						<input type="submit" value="cari" class="btn-cari"/>
				</div><br>
			</form>
		  	<table border="0"  width="" cellpadding="4" cellspacing="0" class="tb-frmkelas">
              	<tr class="kelas-table">
              		<th width="50"><div align="center">No</div></th>
               	 	<th width="100"><div align="center">NIS</div></th>
					<th width="500"><div align="center">Nama Siswa</div></th>
					<th width="400"><div align="center">TTL</div></th>
					<th width="150"><div align="center">Jenkel</div></th>
	                <th width="500"><div align="center">Alamat</div></th>
	                <th width="100"><div align="center">Agama</div></th>
	                <th width="150"><div align="center">Aksi</div></th>
              	</tr>
              	<?php

					include "funct_page/setting_paging_siswa.php";
					$p= new Paging;
					$batas=10;
					$posisi=$p->cariPosisi($batas);

					$x="select * from siswa
						WHERE nis LIKE '%".$nnis."%' AND nama_siswa LIKE '%".$nsiswa."%'
						ORDER BY nis
						DESC LIMIT $posisi, $batas";
					//ambil query tampilkan
					$no=1;

				
					$tampil=mysqli_query($con,$x);
					//tampilkan data dalam bentuk array di tabel
					while ($data=mysqli_fetch_array($tampil)) {
				?>
            	 <tr>
	             	<td class="styletb-adm"><?php echo $no++; echo $nomer;?></div></td>
	                <td class="styletb-adm"><?php echo $data['nis']; ?></div></td>
	                <td class="styletb-adm"><?php echo $data['nama_siswa']; ?></td>
					<td class="styletb-adm"><?php echo $data['tempat_lahir']; echo ' , '; echo $data['tgl_lahir'] ?></td>
					<td class="styletb-adm"><?php echo $data['jen_kel'] ; ?></td>
					<td class="styletb-adm"><?php echo $data['alamat_siswa']; ?></td>
	                <td class="styletb-adm"><div align="center"><?php echo $data['agama']; ?></div></td>
	                <td class="styletb-adm"><a href="index.php?hal=mastersiswa&nis=<?php echo $data['nis'];?>">
	                	<img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a>
	                	<a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='index.php?hal=hapus_siswa&nis=<?php echo $data['nis'];?>';}">
	                	<img src="images/icon/del.png" width="20" height="20" border="0" /></a>
	                	<a href="index.php?hal=detail_mastersiswa&nis=<?php echo $data['nis'];?>">
	                	<img src="images/icon/zoom-btn.png" width="20" height="20" border="0" /></a></td>
				<?php } ?>
				</tr>
			</table><br>
			<?php
				$tampil2 =mysqli_query($con,"select * from siswa");
				$jmldata =mysqli_num_rows($tampil2);
				//menampilkan total data 
				echo " <font face=verdana size=2 color=#00000> Jumlah :";
				echo " <font face=verdana size=2 color=#E70E0E> <b> $jmldata data </font></b>";
				//menampilkan link halaman
				echo " <font face=verdana size=1 color=#000000><b><br><center>Halaman   : </font></b><br>";
				$jmlhalaman	  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman= $p->navHalaman($_GET[halaman], $jmlhalaman);

				echo  $linkHalaman;
			?>
        </div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->