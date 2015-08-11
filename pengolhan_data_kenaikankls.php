<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
		<div class="section-menubar">
			<div class="box-menubarinner">
		<center><h2 class="title-kelas">Form Pengolahan Data Anggota Kelas SMP N 2 Godean</h2></center><hr>
		<br>
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
		<div class="ket-content" style="margin-left:30px;">
		  	<h4 style="font-size: 13px; font-family: Arial,sans-serif; color: rgb(215, 28, 28); ">Keterangan</h4>
			<p class="ket-styleinner">Lihat Anggota kelas terlebih dahulu sebelum menaikan anggota Kelas</p>
	  	</div><hr>

		<?php 
			echo $alert;
		?>
		<?php 
		ini_set( "display_errors", 0);
		include "setting/koneksi.php";


		$kelas3  = $_POST['kelas'];
		$ta3     = $_POST['id_ta'];
		$nis     = $_POST['nis'];

		if(isset($_POST['submit'])){
			foreach($nis as $nis){
			$sql = mysqli_query($con,"SELECT * FROM anggota_kelas WHERE id_ta='$ta' and nis='$nis'");
				if (mysqli_num_rows($sql)) {
						echo "<script type='text/javascript'>
									onload =function(){
									alert('Pada tahun ajaran ini siswa telah terdaftar!');
									document.location.href='pengolhan_data_kenaikankls';
								}
							  </script>";
						die;
				}		
			// $sql1 = mysqli_query($con,"SELECT * FROM mutasi WHERE nis='$nis'");
			// 	if (mysqli_num_rows($sql1)) {
			// 			echo "<script type='text/javascript'>
			// 				onload =function(){
			// 					alert('Siswa telah Keluar!');
			// 					document.location.href='?hal=formanggota';
			// 				}
			// 			</script>";
			// 			die;
			// 	}
			}

		} 

		if(isset($_POST['naikKelas'])) {
			$nis     = $_POST['nis'];
			$kelas3  = $_POST['kelas'];
			$ta3     = $_POST['id_ta'];

			foreach($nis as $nis){
				$cekNIS = mysqli_query($con,"select * from anggota_kelas where nis='{$nis}' and id_ta='$ta3'");
				$nisCek = mysqli_fetch_array($cekNIS);
				if($nisCek['status'] == 1) {
					$alert = "NIS $nis sudah memiliki kelas";
				} else {
					$naikKelas = "insert into anggota_kelas (id_ta,kd_kelas,nis,status) values ('$ta3','$kelas3','{$nis}','1')";
					mysqli_query($con,$naikKelas);
				}
				header("Location:?hal=pengolhan_data_kenaikankls");
			}
		}

		?>
		<form method="post" action="index.php?hal=pengolhan_data_kenaikankls">
			<table width="350" border="0" class="tb-kelas">
				<tr class="">
					<td class="td-anggota-kelas">Tahun Ajaran :</td>
					<td class="td-anggota-kelas">
						<select name="id_ta" class="select-style">
							<option value="">-- Pilih --</option>
							<?php
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
					<td class="td-anggota-kelas">Kelas : </td>
					<td class="td-anggota-kelas">
						<select name="kelas" class="select-style">
							<option value="">-- Pilih --</option>
							<?php
							// query untuk menampilkan semua kelas dari tabel kelas
								$query = "SELECT * FROM kelas";
								$hasil = mysqli_query($con,$query);
								while ($data = mysqli_fetch_array($hasil)) {
									echo "<option value='".$data['kd_kelas']."'>".$data['kelas']."</option>";
								}
							?>
						</select>	
					</td>
				</tr>		
			</table><br>
			<div class="prefix-wrapper">
				<div class="content-innerprefix">
					<input type="submit" value="Lihat Siswa" name="submit" class="btn-btnperfixkenaikan" />
				</div>	
			</div>

			<?php
				$kd_kelas = $_POST['kelas'];
				$id_ta    = $_POST['id_ta'];

				$kelas2   = $_POST['kelas'];
				$ta2      = $_POST['id_ta'];

			?>
			<script type="text/javascript">
			//check all checkbox
			function checkAll(form){
				for (var i=0;i<document.forms[form].elements.length;i++) {
					var e=document.forms[form].elements[i];
					if ((e.name != 'allbox') && (e.type=='checkbox')) {
						e.checked=document.forms[form].allbox.checked;
					}
				}
			}
			</script>
			<p class="heading-prefixstyling"> Data Anggota Kelas
			<?php
					$p="SELECT * FROM kelas Where kd_kelas='$kd_kelas'";
					$t=mysqli_query($con,$p);
					$data=mysqli_fetch_array($t);					
						echo $data['kelas']; ?> & Tahun Ajaran 
			<?php
					$t="SELECT * FROM tahunajaran Where id_ta='$id_ta'";
					$p=mysqli_query($con,$t);
					$data=mysqli_fetch_array($p);					
						echo $data['ta']; echo " "; echo "Semester"; echo " - "; echo $data['semester']; ?>
				

			
				<input type="hidden" name="ta2" value="<?php echo $id_ta;?>" />
				<input type="hidden" name="kelas2" value="<?php echo $kd_kelas;?>" />
					<table border="0" width="1024" cellpadding="4" cellspacing="0" class="tb-frmkelas">
		            	<tr class="kelas-table">
		            	  	<th width="20"><div align="center">No</div></th>
							<th width="75"><div align="center">NIS</div></th>
			                <th width="250"><div align="center">Nama Siswa</div></th>
			                <th width="50"><div align="center">Pilih</div></th>
		            	</tr>
						<?php  //pilih data dari tabel siswa
							$x="SELECT * FROM anggota_kelas a
								INNER JOIN siswa b ON a.nis=b.nis
								INNER JOIN kelas c ON a.kd_kelas=c.kd_kelas
								INNER JOIN tahunajaran d ON a.id_ta=d.id_ta
								WHERE a.kd_kelas='$kd_kelas' and a.id_ta='$id_ta'
								GROUP BY a.nis";
							//ambil query tampilkan
							$no=1;
							$tampil=mysqli_query($con,$x);
							//tampilkan data dalam bentuk array di tabel
							while ($data=mysqli_fetch_array($tampil)) {
		 				?>
		             <tr>
		             	<td><?php echo $no; ?></td>
						<td><?php echo $data['nis'];?></td>
						<td><?php echo $data['nama_siswa']; ?></td>
		                <td><?php echo '<input type="checkbox" name="nis[]" value="'.$data['nis'].'"/>'; ?></td>
						<?php $no++; } ?>
					  </tr>
				</table> 
				<table border="0" width="500" cellpadding="4" cellspacing="0">
					<tr>
						<!-- <td class="td-anggota-kelas" width="20">
							<input type="checkbox" name="allbox" value="check" onclick="checkAll(0);" /></td>
						<td class="td-anggota-kelas" style="font-family: Arial,sans-serif; font-size:12px;">Centang semua</td> -->
					</tr>
				</table>  
				<div class="wrapper-content">
					<div class="content-prefik">
						<input type="submit" name="naikKelas" value="Proses Kenaikan Kelas" class="btn-btnsubmitkenaikan" />   	
					</div><!-- content-prefik -->
				</div><!-- wrapper-content   -->
			</div><!-- section-menubar  --> 
		</div><!-- content-kelas -->  
	</div><!-- box-kelas -->  
</div><!-- wrapper-kelas   -->
</form> 
</body>
</html>
