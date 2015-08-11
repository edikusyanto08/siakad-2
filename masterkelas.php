<?php session_start();
//koneksi database
include "setting/koneksi.php";
//deklarasi variabel dari form
	$kd_kelas   =$_POST['kd_kelas'];
	$nip 		=$_POST['nip'];
	$kuota	    =$_POST['kuota'];

if (isset($_POST['simpan'])) {
	//validasi kelas 
	$cekdata = mysqli_query($con,"SELECT * FROM kelas WHERE kelas='$kd_kelas' AND nip='$nip' AND kd_kelas='$kd_kelas'");
	$cekdata2 = mysqli_query($con,"SELECT * FROM kelas WHERE nip='$nip'");
	$datacek = mysqli_num_rows($cekdata);
	$datacek2 = mysqli_num_rows($cekdata2);

	if ($datacek > 0) {
		echo "<script type='text/javascript'>
				    onload =function(){
					alert('Data sudah dinput!');
					document.location.href='?hal=masterkelas';
				}
			  </script>";
	} elseif ($datacek2 > 0) {
		echo "<script type='text/javascript'>
				    onload =function(){
					alert('NIP sudah terdaftar menjadi walikelas di kelas lain!');
					document.location.href='?hal=masterkelas';
				}
			  </script>";
	}else{
	$sql    = "insert into kelas(kd_kelas,kelas,nip,kuota) values ('$kd_kelas','$kd_kelas','$nip','$kuota')";
	$simpan = mysqli_query($con,$sql);
	// bila berhasil simpan 
		if ($simpan) {
				header("location:index.php?hal=masterkelas");
		}else { 	
				echo"<script type='text/javascript'>
						onload =function(){
						alert('Data gagal disimpan!');
						}
					 </script>";
   		} 
	}
}
//proses editing
//Ambil nilai yang akan di edit
if (isset($_GET['kd_kelas'])) {
	$kd_kelas = $_GET['kd_kelas'];

} 

//tampilkan data sebelum di edit
$sql2 	="select * from kelas where kd_kelas='$kd_kelas'";
$tampil =mysqli_query($con,$sql2);
$baris 	=mysqli_fetch_array($tampil);

$kelas 		=$baris['kelas'];
$kuota 		=$baris['kuota'];
$nip 		=$baris['nip'];

//apabila klik tombol edit
if(isset($_POST['Edit'])) {

	$kelas 	=$_POST['kelas'];
	$kuota 	=$_POST['kuota'];
	$nip    =$_POST['nip'];
	
	$SQL = "UPDATE kelas SET kd_kelas='$kd_kelas', kelas='$kelas', nip='$nip', kuota='$kuota' WHERE kd_kelas='$kd_kelas'"; 
  	$hasil= mysqli_query($con,$SQL); 
	//jika berhasil kembali ke halaman index tampilan awal web sekolah
  		if($hasil){
    		header("location:index.php?hal=masterkelas");
		}else { 
			echo "<script type='text/javascript'>
					onload =function(){
					alert('Update error!');
					}
			  </script>";
    } 
} 

//apabila klik hapus
if(isset($_POST['Hapus'])) {

	if (!empty($kd_kelas) && $kd_kelas != "") {

		$SQL = "delete from kelas where kd_kelas='$kd_kelas'"; 
 			if(mysqli_query($con,$SQL)){ 
    			header("location:index.php?hal=masterkelas");
			}else {
				echo "Data berhasil dihapus";
   			} 
   	}
}
   
?>	
<html>
<head>
	<script type="text/javascript" src="libs/jvalidation/jquery.validate.js"></script>
	<script src="libs/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="libs/jvalidation/messages_id.js"></script>
	<script>
		$(document).ready(function() {
			$("#formkelas").validate();
		
		});
	</script>
</head>
<body>
<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas">Form Data Kelas SMP 2 Godean</h2></center><hr/>
        		<form action="index.php?hal=masterkelas" method="post" enctype="multipart/form-data" id="formkelas">
        		<legend>
        			<h4 class="title-style-masterkelas"> Masukkan data dengan valid : kode kelas, kelas, kouta</h4>
            		<table width="500" class="tb-kelas">
		              	<tr>
			                <td class="td-kelas">Kelas</td>
			                <td class="td-kelas">
			                	<label for="kelas">
			                	<select name="kd_kelas" id="kd_kelas" required='' class="select-style">
						    		<option value>-- Pilih --</option>
				                  	<?php
										$selected = ($kd_kelas)? 'selected="selected"': '';
										foreach(array('VIIA','VIIB','VIIC','VIID','VIIIA','VIIIB','VIIIC','VIIID','IXA','IXB','IXC','XD') as $kels) {
											$selected = ($kd_kelas==$kels)? ' selected="selected"': '';
											echo "<option value='$kels'".$selected.">$kels </option>";
										}
									?>
								</select>
								</label>
		              	</tr>
<!-- 		              	<tr>
		              	  	<td class="td-kelas">Kelas</td>
		                	<td class="td-kelas">
		                		<label for="kelas">
		                  		<input name="kelas" class='txt-inputstyle' type="text" id="kelas" size="40" autocomplete="off" value="<?php echo "$kelas";?>" required=""></label>
		                  	</td>
		              	</tr> -->
		              	<tr>
		              		<td class="td-kelas">Guru walikelas</td>
		              		<td class="td-kelas">
		              		<select name="nip" class="select-style">
							<option value>-- Plih Guru Walikelas --</option>
							<?php
								$query = mysqli_query($con,"SELECT * FROM guru ORDER BY nama DESC");
								while($row = mysqli_fetch_array($query)){
									$selected = ($row['nip']==$nip)? 'selected="selected"' : '';
						  			echo "<option value='".$row['nip']."'$selected>".$row['nama']."</option>";
								}
							?>
						</select> 
		              	</tr>
					  	<tr>
			                <td class="td-kelas">Kuota</td>
			                <td class="td-kelas">
			                	<label for="kuota">
		                  		<input name="kuota" class='txt-inputstyle' type="text" id="kuota" size="40" autocomplete="off" value="<?php echo "$kuota";?>" required=""></label>
		                  	</td>
		              	</tr>
		              	<tr>
			                <td class="td-kelas"></td>
	               			<td class="td-kelas"><label>
	               				<div class="cntrol-btnpositionkelas">
				                  <?php 
				                  	  if(!$_GET['kd_kelas']){
											//bila mau tambah data yang tampil tombol simpan
											echo "<input name=\"simpan\" type=\"submit\" value=\"Simpan\" class=\"btn-kelas\"  />";
							        }else {
											//Apabila mau edit yg tampil tombol edit dan hapus
											echo "<input name=\"Edit\" type=\"submit\"  value=\"Edit\" class=\"btn-kelas\"  />";
											echo "<input name=\"Batal\" type=\"submit\" value=\"Cancel\" class=\"btn-kelas-hapus\"  />";
							        } 
							      ?>
		                		</label>
		                		</div>
			 				</td>
              			</tr>
            		</table>
            	</legend>
        		</form>
				<table class="tb-frmkelas" cellpadding="4" cellspacing="0" width="1090">
			        <tr class="kelas-table">
			        	<th width="40"><div align="center">No</div></th>
				        <th width="100"><div align="center">Kelas</div></th>
				        <th width="300"><div align="center">Walikelas</div></th>
				        <th width="50"><div align="center">Kuota</div></th>
					    <th width="50"><div align="center">Aksi</div></th>
			        </tr>
					<form action="index.php?hal=masterkelas" method="post">
						<div id ="content-pncarian-kelas">
							<!-- <label class="pencarian-text">Masukkan Kelas</label> -->
						<!-- 	<input type="text" name="keyword" id="keyword" /> -->
							<!-- <input type="submit" value="cari" class="btn-cari" /> -->
						</div><br>
					</form>
		
					<?php
						//mengambil fungsi include pagingkelas
						include "funct_page/setting_paging_kelas.php";

						$p= new Paging;
						$batas=10;
						$posisi=$p->cariPosisi($batas); 
						//pilih data dari tabel kelas
						//membuat data limit serta link page halaman
						$joinquery="SELECT k.kd_kelas, k.kelas, g.nama, k.kuota
									 FROM kelas k JOIN guru g ON k.nip=g.nip ORDER BY g.nip DESC";
					/*	$x="select * from kelas k join guru g ON k.nip=g.nip order by g.nip ASC LIMIT $posisi, $batas";*/
						$no=1;
						//ambil query tampilkan
						$tampil=mysqli_query($con,$joinquery);
						//tampilkan data dalam bentuk array di tabel
						while ($data=mysqli_fetch_array($tampil)) {
					?>
					<tr>
						<td class="styletb-adm"><?php echo $no++; echo $nomer; ?></td>
					    <td class="styletb-adm"><?php echo $data['kelas']; ?></td>
					    <td class="styletb-adm"><?php echo $data['nama']; ?></td>
					    <td class="styletb-adm"><?php echo $data['kuota']; ?></td>
					    <td class="styletb-adm"><div align="center"><a href="index.php?hal=masterkelas&kd_kelas=<?php echo $data['kd_kelas'];?>">
		        			<img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a>
		        			<a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='hapus_kelas.php?kd_kelas=<?php echo $data['kd_kelas'];?>';}">
		        			<img src="images/icon/del.png" width="20" height="20" border="0" /></a></div></td>
		    		<?php }  ?>
					</table><br>
					<?php

						$tampil2 =mysqli_query($con,"select * from kelas");
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
		</body>	
        </div>
    </div>
</div>

</div><!-- penutup dari class paging fungsi include untuk autofooter height-->