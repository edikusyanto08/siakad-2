<?php session_start();
//koneksi database
include "setting/koneksi.php";

$query = "SELECT max(kd_mapel) as id FROM mapel";
$hasil =  mysqli_query($con,$query);
$data  =  mysqli_fetch_array($hasil);

$kd = $data['id'];

//mengatur 6 karakter sebagai jumalh karakter yang tetap
//mengatur 3 karakter untuk jumlah karakter yang berubah-ubah
$noUrut = (int) substr($kd, 3, 3);
$noUrut ++;

//menjadikan 201353 sebagai 6 karakter yang tetap
//$format = date(y);
$char = "KMP";
//%03s untuk mengatur 3 karakter di belakang 201353
$IDbaru = $char . sprintf("%03s", $noUrut);

//deklarasi fariabel dari form
	$kd_mapel 	 =$_POST['kd_mapel'];
	$mapel 		 =$_POST['mapel'];
	$kd_kelas 	 =$_POST['kd_kelas'];
	$jenis_mapel =$_POST['jenis_mapel'];
	$kkm 		 =$_POST['kkm'];
	$status		 =$_POST['$status'];

//apabila klik simpan
if(isset($_POST['simpan'])){

	$cekmapel =mysqli_query($con,"SELECT * FROM mapel WHERE mapel='$mapel'");
/*	echo $cekmapel;*/
	$cekvalidasimapel =mysqli_num_rows($cekmapel);
	//cek mapel
	if ($cekvalidasimapel > 0) {
		echo "<script type='text/javascript'>
					onload =function(){
					alert('Matapelajaran telah di input!');
				}
			   </script>";
			
	}else{

	$sql="insert into mapel(kd_mapel, mapel, jenis_mapel, kkm, status) values('$kd_mapel', '$mapel', '$jenis_mapel', '$kkm' ,'1')";

	$simpan=mysqli_query($con,$sql);
	//bila berhasil simpan kembali ke halaman index web sekolah
		if ($simpan) {
			header("location:index.php?hal=mastermappel");
		}else { 	
			echo "<script type='text/javascript'>
						onload =function(){
						alert('Data gagal disimpan!');
					}
				  </script>";
		    } 
		}
	}
//proses editing
//Ambil nilai yang akan di edit
if (isset($_GET['kd_mapel'])) {
	$kd_mapel = $_GET['kd_mapel'];
} 

//tampilkan data sebelum di edit
$sql2 	="select * from mapel where kd_mapel='$kd_mapel';";
$tampil =mysqli_query($con,$sql2);
$baris 	=mysqli_fetch_array($tampil);

$kd_mapel 	 =$baris['kd_mapel'];
$mapel 		 =$baris['mapel'];
$jenis_mapel =$baris['jenis_mapel'];
$kkm 		 =$baris['kkm'];
//$kd_kelas	 =$baris['kd_kelas'];

//apabila klik tombol edit
if(isset($_POST['Edit'])) {
	$mapel 		 =$_POST['mapel'];
	$jenis_mapel =$_POST['jenis_mapel'];
	$kkm 		 =$_POST['kkm'];
	//$kd_kelas 	 =$_POST['kd_kelas'];
	
$SQL = "UPDATE mapel SET mapel  ='$mapel', jenis_mapel ='$jenis_mapel', kkm='$kkm'  where kd_mapel ='$kd_mapel'"; 
  	$hasil= mysqli_query($con,$SQL); 
	//jika berhasil kembali ke halaman index web sekolah
  	if($hasil){
    	header("location:index.php?hal=mastermappel");
	} 
    else 
    { 
		echo "<script type='text/javascript'>
					onload =function(){
					alert('Update error!');
				}
			  </script>";
	} 
} 

//apabila klik hapus
if(isset($_POST['Hapus'])) {
	if (!empty($kd_mapel) && $kd_mapel != "") {
	$SQL = "delete from mapel where kd_mapel='$kd_mapel'"; 
	 	if(mysqli_query($con,$SQL)) { 
	    	header("location:index.php?hal=mastermappel");
		}else {
			echo "Data berhasil dihapus";
	   } 
	}
}

   
?>		
<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas">Form Data Mata Pelajaran SMP N 2 Godean</h2></center><hr/>
			<h4></h4>
       			<form action="index.php?hal=mastermappel" method="post" enctype="multipart/form-data" name="form1">
       				<legend>
       				<h4 class="title-style-mastermappel"> Masukkan data dengan valid : kode matapelajaran, mata pelajaran, jenis pelajaran, KKM</h4>
	           	 	<table width="477" border="0" class="tb-kelas">
	              		<tr>
		               		<td width="500" class="td-mapel">Kode Mata Pelajaran </td>
		                	<td width="100" class="td-mapel">
							<?php  
								if(!$_GET['kd_mapel']){
									echo "<input name='kd_mapel' class='txt-inputstyle' type='text' maxlength='5' value='$IDbaru' autocomplete='off' readonly=''";
								}else {
									echo "<input name='kd_mapel' class='txt-inputstyle' type='text' readonly='' autocomplete='off' maxlength='5' value='$kd_mapel'>";
								}
							?>
							</td>
	              		</tr>
				  		<tr>
			                <td class="td-mapel">Mata Pelajaran</td>
			                <td class="td-mapel"><label>
	                   		<input name="mapel" type="text" class='txt-inputstyle' id="mapel" size="40" value="<?=$mapel?>" autocomplete="off" required=''></label></td>
	              		</tr>
				  		<tr>
			                <td class="td-mapel">Jenis Pelajaran</td>
			                <td class="td-mapel"><label>
							<select name="jenis_mapel" id="jenis_mapel" required='' class="select-style">
						    <option value= <?php $jenis_mapel ?>>-- Pilih --</option>
				                  	<?php
										$selected = ($jenis_mapel)? 'selected="selected"': '';
										foreach(array('Normatif','Muatan Lokal','Pilihan') as $gol) {
											$selected = ($jenis_mapel==$gol)? ' selected="selected"': '';
											echo "<option value='$gol'".$selected.">$gol </option>";
										}
									?>
	                  		</select>
	                		</label>
	                		</td>
	              		</tr>
				  		<tr>
			                <td class="td-mapel">KKM</td>
			                <td class="td-mapel"><label>
							<input name="kkm" type="text" class='txt-inputstyle' id="kkm" size="40" value="<?=$kkm?>" style="width: 58px;" autocomplete="off" required=''></label></td>
	              		</tr>
	            	</table>
	            	 <div class="box-mapelposition">
		                <?php 
		                	if(!$_GET['kd_mapel']){
								//bila mau tambah data yang tampil tombol simpan
								echo "<input name=\"simpan\" type=\"submit\" value=\"Simpan\" class=\"btnbtn-mastermapel\"  />";
						    } else {
								//Apabila mau edit yg tampil tombol edit dan hapus
								echo "<input name=\"Edit\" type=\"submit\" value=\"Edit\" class=\"btnbtn-mastermapel\"  />";
								//echo "<input name=\"Hapus\" type=\"submit\" id=\"hapus\" value=\"Hapus\" class=\"elipse\"  />";
						    } 	
						?>
				 		</td>
	            	</div>
	            	</legend>
				</form>
				<?php
					$mapel = $_POST['mmapel'];

				?>
				<form action="index.php?hal=mastermappel" method="post">
					<div id ="content-pncarian-mappel">
						<!-- <label class="pencarian-text">Cari Bedasarkan Matapelajaran</label> -->
				 			<!-- <input type="text" name="mmapel" id="mmapel"/> -->
						<!-- 	<input type="submit" value="cari" class="btn-cari"/> -->
					</div><br>
				</form>
				<form>
					<table class="tb-frmkelas" cellpadding="4" cellspacing="0">
		              	<tr class="kelas-table">
		              		<th width="50"><div align="center">No</div></th>
						   	<th width="150"><div align="center">Kode Mapel</div></th>
			                <th width="400"><div align="center">Mata Pelajaran</div></th>
							<th width="300"><div align="center">Jenis Mata Pelajaran</div></th>
			                <th width="150"><div align="center">KKM</div></th>
						  	<th width="75"><div align="center">Aksi</div></th>
		              	</tr>
						<?php
							include "funct_page/setting_paging_mastermapel.php";
							$p= new Paging;
							$batas=10; // variable untuk limit jumlah data yg ditampilkan
							$posisi=$p->cariPosisi($batas);
							$no=1;
							//pilih data dari tabel kelas
							$x="select *
								from mapel 
								WHERE mapel LIKE '%".$mmapel."%'
								ORDER BY kd_mapel
								DESC LIMIT $posisi, $batas";
							//ambil query tampilkan
							$tampil=mysqli_query($con,$x);
							//tampilkan data dalam bentuk array di tabel
							while ($data=mysqli_fetch_array($tampil)) {
						?>
		              	<tr>
			              	<td class="styletb-adm"><?php echo $no++; echo $nomer; ?></td>
						  	<td class="styletb-adm"><?php echo $data['kd_mapel']; ?></td>
			                <td class="styletb-adm"><?php echo $data['mapel']; ?></td>
							<td class="styletb-adm"><?php echo $data['jenis_mapel']; ?></td>
			                <td class="styletb-adm"><?php echo $data['kkm']; ?></td>
			                <td class="styletb-adm"><div align="center"><a href="index.php?hal=mastermappel&kd_mapel=<?php echo $data['kd_mapel'];?>">
			                	<img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a>
			                	<a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='index.php?hal=hapus_mapel&kd_mapel=<?php echo $data['kd_mapel'];?>';}">
			                	<img src="images/icon/del.png" width="20" height="20" border="0" /></a></div></td>
					<?php } ?>
           			</table><br>
					<?php
						$tampil2 =mysqli_query($con,"select * from mapel");
						$jmldata =mysqli_num_rows($tampil2);
						//menampilkan total data 
						echo " <font face=verdana size=2 color=#00000> Jumlah :";
						echo " <font face=verdana size=2 color=#E70E0E> <b> $jmldata data </font></b>";
						//menampilkan link halaman
						echo " <font face=verdana size=1.5 color=#000000><b><br><center>Halaman   : </font></b><br>";
						$jmlhalaman	  = $p->jumlahHalaman($jmldata, $batas);
						$linkHalaman  = $p->navHalaman($_GET[halaman], $jmlhalaman);

						echo  $linkHalaman;
					?>
				</form>
      </div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->
