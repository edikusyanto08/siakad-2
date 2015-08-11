<?php session_start();

include "setting/koneksi.php";
if(isset($_POST['nilai'])) {

	$id_ta				=$_POST['id_ta'];
	$id_mapel			=$_POST['id_mapel'];
	$id_kelas			=$_POST['id_kelas'];
	$nnis				=$_POST['nnis'];
	$nmapel     		=$_POST['nmapel'];
	$nkelas     		=$_POST['nkelas'];

 	$nilainya = " SELECT * FROM nilai_mapel a
								  JOIN siswa b ON a.nis = b.nis
								  JOIN anggota_kelas ak ON ak.nis= a.nis
								  JOIN kelas d ON ak.kd_kelas = d.kd_kelas
								  WHERE a.nis='$nnis' and a.kd_mapel='$id_mapel'";	
								  // echo $nilainya;
	$tampilNilai = mysqli_query($con,$nilainya);					
	$hasilpencarianquery = mysqli_fetch_array($tampilNilai);
	$nilai = $hasilpencarianquery['nilai'];

	}
?>
<!-- jquery validation rule -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#checknilai").validate({
			rules :{
				nnis:{
					selectcheck : true	
				},
				id_ta:{
					selectcheck : true
					
				},
				id_mapel:{
					selectcheck : true
					
				},
				id_kelas:{
					selectcheck : true
				}

			},					
			messages: {
	        	nnis: " Nis harus diisi!!",
	        	id_ta: {
          		selectcheck: "Tahun ajaran harus diisi!"

        		},
        		id_kelas: {
          		selectcheck: "Kelas Harus diisi!"
          		},

        		id_mapel:{
        		selectcheck: "Mapel Harus diisi !"
        		}
        	},
       
      			errorLabelContainer: $("div.error-style-tblenilai")
  		});
   	    	$.validator.addMethod('selectcheck', function (value) {
      		return (value != 0);
			});
	});
</script>

<div id="wrapper-kelas">
	<div id="content-home">
		<div id="form-bingkaihome">
			<div id="bingkai-foto">
				<img class="resize-foto" src="images/icon/smpgodean.png"></img></div></div>
			<div class="content-min-ketentuan">
				<h5 class="box-visimisi">VISI&MISI</h5>
				<h5 class="visimisi">SMP NEGERI 2 GODEAN SLEMAN</h5>
					<div class="box-position">
						<article class="style-visimisi">
							Visi Sekolah : Unggul dalam mutu berpijak pada imtaq & budaya Bangsa.<br>
							Misi Sekolah : <br> 
									1. Peningkatan mutu akademik<br>
									2. Pembimbingan pengembangan potensi siswa dalam bidang olahraga & seni<br>
									3. Mempersiapkan siswa yang unggul<br>
									4. Peningkatan & penghayatan terhadap ajaran agama sebagai sumber kearifan dalam brtindak<br> 
									5. Berpijak pada budaya bangsa sebagai dasar bertindak
						</article>
					</div>
			</div>
			<div id="content-berita">
				<h3 style="color: rgb(218, 16, 16); margin-bottom:10px;">Ketentuan melihat nilai berdasarkan pernilai mapel :</h3>
				<p>Untuk Melihat Nilai Siswa Masukkan Data Form Dibawah ini :</p>
			<form action="index.php" method="post" id="checknilai">
				<table>
		        	<tr>
		        		<td class="td-siswalihat" width="150">Masukkan Nis</td>
						<td class="td-siswalihat">
							<input type="text" class='txt-inputstyle' name="nnis" id="nnis" required></td>	
					</tr>
					<tr>
						<td class="td-siswalihat" required>Tahun Ajaran</td>
						<td class="td-siswalihat">
						<label class="erorr-message">
						<select name="id_ta" id="id_ta" required="" class="select-style">
							<?php
								echo "<option value=''>-- Pilih --</option>";
								$query = mysqli_query($con,"SELECT * FROM tahunajaran ORDER BY ta DESC");
								while($row = mysqli_fetch_array($query)){
								$selected = ($row['id_ta']==$id_ta)? 'selected="selected"' : ''; 
						  			echo "<option value='".$row['id_ta']."' $selected>".$row['ta']." - ".$row['semester']."</option>";
						  		
								}
							?>                   
		        		</select><td>
		        		</label>
		        	</tr>
		        	<tr>
		        		<td class="td-siswalihat">Pilih Mata Pelajaran</td>
		        		<td class="td-siswalihat">
		        		<select name="id_mapel" id="id_mapel" required="" class="select-style"> 
							<?php
								echo "<option value=''>-- Pilih --</option>";
								$query = mysqli_query($con,"SELECT * FROM mapel ORDER BY kd_mapel DESC");
								while($row = mysqli_fetch_array($query)){
								$selected = ($row['kd_mapel']==$kd_mapel)? 'selected="selected"' : '';
						  			echo "<option value='".$row['kd_mapel']."' $selected>".$row['mapel']."</option>";
								}
							?>                   
		        		</select></td>
		        	</tr>
					<tr>
						<td class="td-siswalihat">Pilih Kelas</td>	
						<td class="td-siswalihat">
						<select name="id_kelas" "id_kelas" required="" class="select-style">
							<?php
								echo "<option value=''>-- Pilih --</option>";
								$query = mysqli_query($con,"SELECT * FROM kelas ORDER BY kd_kelas ASC");
								while($row = mysqli_fetch_array($query)){
								$selected = ($row['kd_kelas']==$kd_kelas)? 'selected="selected"' : '';
						  			echo "<option value='".$row['kd_kelas']."' $selected>".$row['kelas']."</option>";
								}
							?>
						</select></td>                   
				</table>
						<div>
							<input type="submit" value="Lihat Nilai Siwa" name="nilai" id="nilai" class="btn-linksiswa">
						</div>
			</form>
				<table class="style-tblenilai">
					<tr>
						<td class="td-siswalihat">Nilai Mata Pelajaran Anda </td>
						<td class="td-siswalihat">
							<input type="text" class='txt-inputstyle' name="txtnilai" id="txtnilai" width="30" value=<?php echo $nilai; ?>></td>
					</tr>
				</table>
				<hr>
				<div id="">
					<h4 style="color: rgb(218, 16, 16); font-family:'montserratlight';">Klik dibawah ini untuk melihat nilai secara lengkap</h4>
					<a class="stylingdetail_nilai" href="index.php?hal=lihat_nilaimapel" >Detail Nilai Siswa</a>
				</div>
				<div class="wrapper-right">
					<div class="content-right-bottm">
						<p style="margin-top:25px;">Nama Sekolah		: SMP N 2 Godean<br>
									NPSN / NSS		    : 20401081 / 201040204010<br>
									Jenjang Pendidikan	: SMP<br>
									Satus Sekolah		: Negeri<br>
						</p>
				</div>
			</div>
			</div>
			<br>
		</div>
	</div>
</div>
</div><!-- footer include -->
</form>