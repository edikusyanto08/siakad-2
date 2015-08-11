<?php session_start();
//koneksi database
include "setting/koneksi.php";

//setting tanggal 
$tanggal      =date('Y-m-d');
$ambiltahun   =substr($tanggal, 0, 4);
$ambilbulan   =substr($tanggal, 5, 2);
$ambiltanggal =substr($tanggal, 8, 2);


//deklarasi fariabel dari form
$gnama				=$_POST['gnama'];
$nip 				=$_POST['nip'];
$nama 				=$_POST['nama'];
$jen_kel 			=$_POST['jen_kel'];
$tempat_lahir   	=$_POST['tempat_lahir'];
$tgl_lahir 			=$_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
$status_kepegawaian =$_POST['status_kepegawaian'];
$agama 				=$_POST['agama'];
$alamat 			=$_POST['alamat'];
$no_telp 			=$_POST['no_telp'];
$tgl_masuk 			=$_POST['tgl_masuk'];
$jabatan 			=$_POST['jabatan'];
$kd_mapel 			=$_POST['kd_mapel'];
$kwa_pend 			=$_POST['kwa_pend'];
$jurusan 			=$_POST['jurusan'];
$universitas 		=$_POST['universitas'];
$th_lulus 			=$_POST['th_lulus'];
$gelar_dp 			=$_POST['gelar_dp'];
$gelar_bk 			=$_POST['gelar_bk'];
$foto 				=$_FILES['foto']['name'];
//upload foto
if (strlen($foto)>0) {
		//upload
		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
			move_uploaded_file ($_FILES['foto']['tmp_name'], "images/foto/".$foto);
		}else{ 
			echo"gagal dikirim"; }
		}
		
//apabila klik simpan
if(isset($_POST['simpan'])){
	if(empty($nip)){
		echo "<script type='text/javascript'>
					onload =function(){
					alert('Nomor induk guru belum diisi');
					}
			</script>";
	}else{
			$sql="insert into guru (nip,
									nama,
									jen_kel,
									tempat_lahir,
									tgl_lahir,
									status_kepegawaian,
									agama,
									alamat,
									no_telp,
									tgl_masuk,
									jabatan,
									kd_mapel,
									kwa_pend,
									jurusan,
									universitas,
									th_lulus,
									gelar_dp,
									gelar_bk,
									foto) 
							values ('$nip',
								    '$nama',
								    '$jen_kel',
									'$tempat_lahir',
									'$tgl_lahir',
									'$status_kepegawaian',
									'$agama',
									'$alamat',
									'$no_telp',
									'$tgl_masuk',
									'$jabatan',
									'$kd_mapel',
									'$kwa_pend',
									'$jurusan',
									'$universitas',
									'$th_lulus',
									'$gelar_dp',
									'$gelar_bk',
									'$foto')";
			$simpan=mysqli_query($con,$sql);

	//bila berhasil simpan kembali ke halaman web sekolah
	if ($simpan) {
		header("location:index.php?hal=masterguru");
	}else{ 	
		echo "<script type='text/javascript'>
					onload =function(){
						alert('data gagal disimpan!');
						}
			  </script>";
    	} 
	}
}
//proses editing
//Ambil nilai yang akan di edit
if (isset($_GET['nip'])) {
	$nip = $_GET['nip'];
} 

//tampilkan data sebelum di edit
	$sql2   ="select * from guru where nip='$nip';";
	$tampil =mysqli_query($con,$sql2);
	$baris  =mysqli_fetch_array($tampil);

	$nip 				 =$baris['nip'];
	$nama 				 =$baris['nama'];
	$jen_kel 			 =$baris['jen_kel'];
	$tempat_lahir 		 =$baris['tempat_lahir'];
	list($thn,$bln,$tgl) = explode("-",$baris['tgl_lahir']);
	$status_kepegawaian  =$baris['status_kepegawaian'];
	$gol_darah 			 =$baris['gol_darah'];
	$agama 				 =$baris['agama'];
	$alamat 			 =$baris['alamat'];
	$status_nikah 		 =$baris['status_nikah'];
	$no_telp 			 =$baris['no_telp'];
	$tgl_masuk           =$baris['tgl_masuk'];
	$jabatan 			 =$baris['jabatan'];
	$kd_mapel 			 =$baris['kd_mapel'];
	$kwa_pend 			 =$baris['kwa_pend'];
	$jurusan 			 =$baris['jurusan'];
	$universitas 		 =$baris['universitas'];
	$th_lulus 			 =$baris['th_lulus'];
	$gelar_dp 			 =$baris['gelar_dp'];
	$gelar_bk 			 =$baris['gelar_bk'];
	$foto 				 =$baris['foto'];

//apabila klik tombol edit
if(isset($_POST['Edit'])) {

	$nip 				=$_POST['nip'];
	$nama 				=$_POST['nama'];
	$jen_kel 			=$_POST['jen_kel'];
	$tempat_lahir 		=$_POST['tempat_lahir'];
	$tgl_lahir 			=$_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
	$status_kepegawaian =$_POST['status_kepegawaian'];
	$gol_darah 			=$_POST['gol_darah'];
	$agama 				=$_POST['agama'];
	$alamat 			=$_POST['alamat'];
	$status_nikah 		=$_POST['status_nikah'];
	$no_telp 			=$_POST['no_telp'];
	$tgl_masuk 			=$_POST['thn_msk']."-".$_POST['bln_msk']."-".$_POST['tgl_msk'];
	$jabatan 			=$_POST['jabatan'];
	$kd_mapel 			=$_POST['kd_mapel'];
	$kwa_pend 			=$_POST['kwa_pend'];
	$jurusan 			=$_POST['jurusan'];
	$universitas 		=$_POST['universitas'];
	$th_lulus  			=$_POST['th_lulus'];
	$gelar_dp 			=$_POST['gelar_dp'];
    $gelar_bk 			=$_POST['gelar_bk'];
	$foto 				= $_FILES['foto']['name'];

	if (strlen($foto)>0) {
		//upload
		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
			move_uploaded_file ($_FILES['foto']['tmp_name'], "images/foto/".$foto);
			}
			mysqli_query($con,"UPDATE guru SET foto='$foto' WHERE nip='$nip'");
	}
	
$SQL = "UPDATE guru SET
			nama 				='$nama',
			jen_kel 			='$jen_kel',
			tempat_lahir 		='$tempat_lahir',
			tgl_lahir 			='$tgl_lahir',
			status_kepegawaian  ='$status_kepegawaian', 
			agama 				='$agama',
			alamat 				='$alamat',
			no_telp 			='$no_telp',
			tgl_masuk 			='$tgl_masuk',
			jabatan 			='$jabatan',
			kd_mapel 			='$kd_mapel',
			kwa_pend  			='$kwa_pend',
			jurusan 			='$jurusan',
			universitas 		='$universitas',
			th_lulus 			='$th_lulus',
			gelar_dp 			='$gelar_dp',
			gelar_bk 			='$gelar_bk'
		WHERE nip='$nip'";

$hasil= mysqli_query($con,$SQL); 
//jika berhasil kembali ke halaman web sekolah
  	if($hasil){
   		header("location:index.php?hal=masterguru");
	} else{ 
		echo "alert Data Gagal diupdate !!";
	} 
} 

//apabila klik hapus
if(isset($_POST['Hapus'])) {
	if (!empty($nip) && $nip != "") {
		$SQL = "delete from guru where nip='$nip'"; 
 			if(mysqli_query($con,$SQL)){ 
    			header("location:formguru.php");
			}else {
				echo "Data berhasil dihapus";
   			} 
   }
}
   
?>		
<div id="wrapper-kelas">
  <div id="box-kelas">
    <div id="content-kelas">
		<center><h2 class="title-kelas">Form Data Guru SMP 2 Godean</h2></center><hr/> 
        <form action="" method="post" enctype="multipart/form-data" name="form1">
        <legend>
            <table class="tb-kelas">
           		<tr>
	                <td class="td-guru" width="170">Nomor Induk Pegawai </td>
	                <td class="td-guru" width="350">
	                	<label>
							<?php  
								if(!$_GET['nip']){
									echo "<input  class='txt-inputstyle' name='nip' type='text' id='nip' maxlength='18'>";
								}else {
									echo "<input  class='txt-inputstyle' name='nip' type='text' id='nip' readonly='' maxlength='18' value='$nip'>";
								}
							?>
                		</label>
                	</td>
                	<td class="td-guru">No Telepon</td>
                 	<td class="td-guru">
                 		<label><input name="no_telp"  class='txt-inputstyle' type="text" id="no_telp" maxlength="12" value="<?php echo "$no_telp";?>" required=''></label>
                	</td>
              	</tr>
              	<tr>
              		<td class="td-guru">Nama Guru </td>
                 	<td class="td-guru">
                 		<label><input name="nama" type="text"  class='txt-inputstyle' id="nama" size="40" value="<?php echo "$nama";?>" required=''></label>
                	</td>
                	<td class="td-guru">Tanggal Masuk</td>
                	<td class="td-guru">
                		<?php 
                			if (!$_GET['nip']){
                				echo "<input type='text'  class='txt-inputstyle' id='datepicker-example10' name='tgl_masuk' required=''>";
            				}else{
            					echo "<input type='text'  class='txt-inputstyle' name='tgl_masuk' required='' value='$tgl_masuk' readonly=''>";

                			}

                		?>
          				
                	</td>
              	</tr>
			  	<tr>
                	<td class="td-guru">Jenis Kelamin </td>
                	<td class="td-guru" >
          
                	<?php
                		if (!$_GET['$jen_kel']== 'Laki-Laki') {
              
                		echo "<label><input type='radio' class='radio-style' name='jen_kel' value='Laki-Laki' checked>Laki-Laki</label>
                			  <label><input type='radio' class='radio-style' name='jen_kel' value='Perempuan' >Perempuan</label>";

                		}else if (!$_GET['$jen_kel']=='Perempuan') {

                		echo "<label><input type='radio' class='radio-style' name='jen_kel' value='Laki-Laki'>$jen_kel</label>
                			  <label><input type='radio' class='radio-style' name='jen_kel' value='Perempuan' checked>$jen_kel</label>";

                	?>
                	<?php } ?>
                	</td>
							
              	</tr>
              	<tr>
                	<td class="td-guru">Tempat Lahir </td>
                	<td class="td-guru"><label><input  class='txt-inputstyle' name="tempat_lahir" type="text" id="tempat_lahir" size="40" value="<?php echo "$tempat_lahir";?>"  required=''></label></td>
					<td class="td-guru">Jabatan</td>
                	<td class="td-guru">
                		<label>
                  			<select name="jabatan" id="jabatan" required='' class="select-style">
				  				<option value= <?php $jabatan ?>>-- Pilih --</option>
         				         	<?php
										$selected = ($jabatan)? 'selected="selected"': '';
											foreach(array('Kepala Sekolah', 'Wakil Kepala Sekolah', 'Komite Sekolah', 'Tata Usaha','Urusan Kurikulum','Urusan Sarpas','Urusan Kesiswaan','Urusan Humas','Guru','Bimbingan Konseling') as $jab) {
												$selected = ($jabatan==$jab)? ' selected="selected"': '';
													echo "<option value='$jab'".$selected.">$jab</option>";
										}
									?>
                  			</select>
                		</label>
                	</td>
              	</tr>
              	<tr>
	                <td class="td-guru">Tanggal Lahir </td>
	                <td class="td-guru">
                		<select name="tgl" id="tgl" required='' class="select-style">
                			<option value="none" selected="selected">Tgl</option>
							<?php
								for ($i=1; $i<=31; $i++) {
									$tg = ($i<10) ? "0$i" : $i;
									$sele = ($tg==$tgl)? "selected" : "";
									echo "<option value='$tg' $sele>$tg</option>";	
								}
							?>
                		</select>
              		-
                		<select name="bln" id="bln" required='' class="select-style">
                			<option value="none" selected="selected">Bln</option>
							<?php
								for ($i=1; $i<=12; $i++) {
									$bl = ($i<10) ? "0$i" : $i;
									$sele = ($bl==$bln)?"selected" : "";
									echo "<option value='$bl' $sele>$bl</option>";	
								}
							?>	
                		</select>
                	-
                		<select name="thn" id="thn"  required='' class="select-style">
                			<option value="none" selected="selected">Thn</option>
							<?php
								for ($i=1970; $i<=2010; $i++) {
									$sele = ($i==$thn)?"selected" : "";
									echo "<option value='$i' $sele>$i</option>";	
								}
							?>
                		</select>
                	</td>
					<td class="td-guru">Kwalifikasi Pendidikan</td>
                	<td class="td-guru"><label>
						<select name="kwa_pend" id="kwa_pend"  required='' class="select-style">
					    <option value= <?php $kwa_pend ?>>-- Pilih --</option>
		                  	<?php
									$selected = ($kwa_pend)? 'selected="selected"': '';
										foreach(array('D3', 'S1', 'S2', 'S3') as $kwa) {
											$selected = ($kwa_pend==$kwa)? ' selected="selected"': '';
											echo "<option value='$kwa'".$selected.">$kwa</option>";
									}
							?>
                  		</select>
                		</label>
                	</td>
              	</tr>
			    <tr>
	                <td class="td-guru">Status Pegawai</td>
	                <td class="td-guru"><label>
	                	<input name="status_kepegawaian" class='txt-inputstyle' type="text" id="status_kepegawaian" size="40" value="<?php echo "$status_kepegawaian";?>"  required=''></label>
	                </td>
					<td class="td-guru">Universitas</td>
                	<td class="td-guru"><label>
                		<input name="universitas" class='txt-inputstyle' type="text" id="universitas" size="40" value="<?php echo "$universitas";?>" required=''></label>
                	</td>
             	</tr>
					<td class="td-guru">Jurusan</td>
	                <td class="td-guru"><label>
	                  	<input name="jurusan" type="text" class='txt-inputstyle' id="jurusan" size="40" value="<?php echo "$jurusan";?>" required=''></label>
	                </td>
	                <td class="td-guru">Tahun Lulus</td>
                	<td class="td-guru"><label>
                  		<input name="th_lulus" type="text" class='txt-inputstyle' id="th_lulus" maxlength="4" value="<?php echo "$th_lulus";?>" required=''></label>
                  	</td>
              	</tr>
			   	<tr>
	                <td class="td-guru">Agama</td>
	                <td class="td-guru"><label>
                  		<select name="agama" id="agama" required='' class="select-style">
				  		<option value= <?php $agama ?>>-- Pilih --</option>
                  	<?php
							$selected = ($agama)? 'selected="selected"': '';
							foreach(array('Islam', 'Kristen', 'Katholik', 'Hindu','Budha') as $ag) {
								$selected = ($agama==$ag)? ' selected="selected"': '';
								echo "<option value='$ag'".$selected.">$ag</option>";
							}
					?>
                  		</select>
                		</label>
                	</td>
                	<td class="td-guru">Gelar Depan</td>
                	<td class="td-guru"><label>
                  		<input name="gelar_dp" type="text" class='txt-inputstyle' id="gelar_dp" maxlength="4" value="<?php echo "$gelar_dp";?>" required=''></label>
                  	</td>
              	</tr>
              	<tr>
	                <td class="td-guru">Alamat</td>
	                <td class="td-guru"><label>
                  		<textarea name="alamat" class="textarea-style" cols="30" rows="2" id="alamat" value="" required=''><?php echo "$alamat";?></textarea></label>
                  	</td>
                  		<td class="td-guru">Gelar Belakang</td>
                	<td class="td-guru">
                	<label><input name="gelar_bk" class='txt-inputstyle' type="text" id="gelar_bk" maxlength="4" value="<?php echo "$gelar_bk";?>" required=''></label>
                	</td>
              	</tr>
              	<tr>
				  	<td class="td-guru">Mata Pelajaran Diampu</td>
					<td class="td-guru">
						<select name="kd_mapel" id="kd_mapel" required='' class="select-style">
						  	<?php
						  		echo "<option value=''>-- Pilih --</option>";	
								$query = mysqli_query($con,"SELECT * FROM mapel");
								while($row = mysqli_fetch_array($query)){
									$selected = ($row['kd_mapel']==$kd_mapel)? 'selected="selected"' : '';
						  			echo "<option value='".$row['kd_mapel']."' $selected>".$row['mapel']."</option>";
								}
							?>                    
                  		</select>
					</td>
			  	</tr>
			  	<tr>
	                <td class="td-guru">Foto</td>
	                <td class="td-guru"><label>
	                	<div class="input-stylefile">
							<span class="position-inputfile">
						<?php 
							if($_GET['nip']){
								//tampilkan foto saat mau ngedit
								echo "<img src='images/foto/$foto' width=150 height=180> <br />";
							} 
						?>
						<div class="input-stylefile">
							<span class="position-inputfile">
                 			 	<input name="foto" type="file" id="foto" /> 	
                  			</span>
                  		</div>
                  		</label>
					</td>
              	</tr>
              	<tr>
                	<td class="td-guru"></td>
                	<td class="td-guru">
                	<div class="cntrol-btnposition">
                		<label>
                		  <?php 
                		  		if(!$_GET['nip']){
								//bila mau tambah data yang tampil tombol simpan
									echo "<center><input name=\"simpan\" type=\"submit\" value=\"Simpan\" class=\"btn-guru\" /></center>";
						        }else {
								//Apabila mau edit yg tampil tombol edit dan hapus
									echo "<center><input name=\"Edit\" type=\"submit\" value=\"Edit\" class=\"btn-guru\" />";
									//echo "<input name=\"Hapus\" type=\"submit\" id=\"hapus\" value=\"Hapus\" class=\"btn-guru\" /></center>";
						        } 
						  ?>
						</label>
					</div>
			 		</td>
              	</tr>
            </table><br>
        </legend>
		</form>
		<?php
			$gnama  =$_POST['gnama'];
			$gnip   =$_POST['gnip'];


		?>
		<form action="index.php?hal=masterguru" method="post">
			<div style="margin: 19px 0px 24px 740px; width: 73%; font-family: Arial,sans-serif; font-size: 15px; font-weight: bold;">
				<label class="pencarian-text">Cari Bedasarkan Nama</label>
					<input type="text" name="gnama" id="gnama"/>
<!-- 					<input type="text" name="gnip" id="gnip"/> -->
					<input type="submit" value="cari" class="btn-cari"/>
			</div>
		</form>
		<form>
			<table cellpadding="4" cellspacing="0" class="tb-frmkelas">
              	<tr class="kelas-table">
              		<th width="50"><div align="center">No</div></th>
	                <th width="150"><div align="center">NIP</div></th>
	                <th width="300"><div align="center">Nama Guru</div></th> 
					<th width="200"><div align="center">TTL</div></th> 
					<th width="150"><div align="center">Jenis Kelamin</div></th>
	                <th width="250"><div align="center">Alamat</div></th>
	                <th width="60"><div align="center">Agama</div></th>
	                <th width="100"><div align="center">Aksi</div></th>
              	</tr>
     			<?php
					include "funct_page/setting_paging_guru.php";
						$p= new Paging;
						$batas=10;//set pagging yg ditampilkan
						$posisi=$p->cariPosisi($batas);
						//pilih data dari tabel guru
					$x="select * from guru 
						WHERE nama LIKE '%".$gnama."%'AND nip LIKE '%".$gnip."%' 
						ORDER BY nip
						DESC LIMIT $posisi, $batas";
						//ambil query tampilkan
					$no=1;
					$tampil=mysqli_query($con,$x);
					//tampilkan data dalam bentuk array di tabel
					while ($data=mysqli_fetch_array($tampil)) {
				?>
	            <tr>
	             	<td class="styletb-adm"><?php echo $no++; echo $nomer; ?></div></td>
	                <td class="styletb-adm"><div align="center"><?php echo $data['nip']; ?></div></td>
	                <td class="styletb-adm"><?php echo $data['gelar_dp'];  echo " "; echo $data['nama']; echo " "; echo $data['gelar_bk']; ?></td>
					<td class="styletb-adm"><?php echo $data['tempat_lahir']; echo " , "; echo $data['tgl_lahir']; ?></td>
					<td class="styletb-adm"><?php echo $data['jen_kel']; ?></td>
					<td class="styletb-adm"><?php echo $data['alamat']; ?></td>
	                <td class="styletb-adm"><div align="center"><?php echo $data['agama']; ?></div></td>
	                <td class="styletb-adm"><a href="index.php?hal=masterguru&nip=<?php echo $data['nip'];?>">
	                	<img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a>
	                	<a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='hapus_guru.php?nip=<?php echo $data['nip'];?>';}">
	                	<img src="images/icon/del.png" width="20" height="20" border="0" /></a></a><a href="index.php?hal=detail_masterguru&nip=<?php echo $data['nip'];?>">
	                	<img src="images/icon/zoom-btn.png" width="20" height="20" border="0" /></td>
					<?php } ?>
				</tr>
			</table><br>
			<?php
				$tampil2 =mysqli_query($con,"select * from guru");
				$jmldata =mysqli_num_rows($tampil2);
				//menampilkan total data 
				echo " <font face=verdana size=2 color=#00000> Jumlah :";
				echo " <font face=verdana size=2 color=#E70E0E> <b> $jmldata data </font></b>";
				//menampilkan link halaman 
				echo " <font face=verdana size=1 color=#000000><b><br><center>Halaman   : </font></b><br>";
				$jmlhalaman	  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman  = $p->navHalaman($_GET[halaman], $jmlhalaman);

				echo  $linkHalaman;
			?>
    </div>
  </div>
</div>   
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->      
