<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
		<!-- <div class="tombol"> -->
		<center>
			<h2 class="title-kelas">Form Pengolahan Data Anggota Kelas SMP N 2 Godean</h2>
		</center>
		<hr>
		<br>
		<div class="section-menubar">
			<div class="box-menubarinner">
		<!-- <div id="wrapper-kelas">
			<div id="box-kelas">
				<div id="content-kelas"> -->
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

  	 	<?php 
	  	//apabila klik cari
		if(isset($_POST['cari'])) {
			$kelasnya = $_POST['cari_kd_kelas'];
		}
	  	?>
		<form action="index.php?hal=pengolhan_data_lihatanggotakls" method="post">
		<div id ="boxpncarian-anggota" style="margin: 0px 0px 0px 738px;">
			<label class="pencarian-text">Cari Bedasarkan Kelas</label>
	 			<select name="cari_kd_kelas" id="kd_kelas" required="" class="select-style">
            		<?php
            			echo "<option>-- Pilih --</option>";
            			$query  = mysqli_query($con,"SELECT * FROM kelas ORDER BY kd_kelas ASC ");
            			while ($row = mysqli_fetch_array($query)) {
							echo "<option value='".$row['kd_kelas']."'>".$row['kelas']."</option>";                				
            			}
            
            		?>
            	</select>
					<input name="cari" type="submit" value="cari" class="btn-cari"/>
		</div>
		<br>
		<table align="center" cellpadding="4" cellspacing="0" class="tb-frmkelas">
		<tr class="kelas-table">
			<th width="50"><div align="center">No</div></th>
		  	<th width="200"><div align="center">Tahun Ajaran&Semester</div></th>
			<th width="200"><div align="center">Kelas</div></th>
	        <th width="300"><div align="center">NIS</div></th>
			<th width="400"><div align="center">Nama Siswa</div></th>
			<th width="80"><div align="center">Aksi</div></th>
	    </tr>	
        <?php
			 
			$x=("SELECT b.nama_siswa, b.nis, k.kelas, d.ta, d.semester, a.id_anggota_kelas
				 FROM anggota_kelas a
				 JOIN siswa b ON a.nis = b.nis
				 JOIN kelas k ON a.kd_kelas = k.kd_kelas
				 JOIN tahunajaran d ON a.id_ta = d.id_ta
				 WHERE a.kd_kelas='$kelasnya'
				 ORDER BY k.kelas 
				 DESC");
			//ambil query tampilkan
			$no=1;

			$tampil=mysqli_query($con,$x);
			//tampilkan data dalam bentuk array di tabel
			while ($data=mysqli_fetch_array($tampil)) {
		?>
		<tr>
			<td><?php echo $no++; echo $nomer; ?></td>
		  	<td><?php echo $data['ta']; echo ' - ' ; echo $data['semester'] ;?></td>
	        <td><?php echo $data['kelas']; ?></td>
	        <td><?php echo $data['nis']; ?></td>
			<td><?php echo $data['nama_siswa']; ?></td>
	        <td>
	        	<div align="center">
	        		<!-- <a href="index.php?hal=pengolhan_data_kelasbaru&id=<?php echo $data['id'];?>">
	        	<img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a> -->
	        	<a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='hapus_anggota.php?id=<?php echo $data['id_anggota_kelas'];?>';}">
	        	<img src="images/icon/del.png" width="20" height="20" border="0" /></a>
	        	</div>
	    	</td>
		</tr>
		<?php } ?>
		</table><br>  
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
