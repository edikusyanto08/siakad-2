<?php session_start();
//koneksi database
include "setting/koneksi.php";

/*action get mapel*/
	if(isset($_GET['action']) && $_GET['action'] == "getmap") {
		$nip = $_GET['nip'];
		//ambil data mapel
		$query = "select m.kd_mapel, m.mapel from guru g join mapel m on g.kd_mapel= m.kd_mapel where g.nip='$nip'";
		$sql   = mysqli_query($con,$query);

		$arrmap = array();
		while ($row = mysqli_fetch_assoc($sql)) {
			array_push($arrmap, $row);
		}
			echo json_encode($arrmap);
	exit;
	}

//deklarasi fariabel dari form
	$id_jampelajaran  =$_POST['id_jampelajaran'];
	$id_ta 	 		  =$_POST['id_ta'];
	$nip 	 	   	  =$_POST['nip'];
	$kd_mapel 	 	  =$_POST['kd_mapel'];
	$kd_kelas 	 	  =$_POST['kd_kelas'];
	
	$jam_pelajrn 	  =array();
	if(count($_POST['jam_pelajrn']) > 0) {
  		foreach($_POST['jam_pelajrn'] as $key=>$value) {
			if($value != 0){
    			$jam_pelajrn[] = $value;
			}
  		}
	}
	$addJam = implode(',', $jam_pelajrn);

	$hariOptions = array("1"=>'Senin', "2"=>'Selasa', "3"=>'Rabu', "4"=>'Kamis', "5"=>'Jumat', "6"=>'Sabtu');
	$hari = (isset($_POST['hari'])) ? $_POST['hari']: '';


//apabila klik simpan
if(isset($_POST['simpan'])){
	if(empty($nip)){
	echo "<script type='text/javascript'> onload =function(){
				alert('Guru Belum di isi !!');
				}
		  </script>";
	}else{
		$queryCek = "SELECT * FROM jadwalharian WHERE id_ta='$id_ta' and kd_kelas='$kd_kelas' and hari='$hari' and jam_pelajrn='$addJam'";
		$queryCek2 = "SELECT * FROM jadwalharian WHERE id_ta='$id_ta' and nip='$nip' and hari='$hari' and jam_pelajrn='$addJam'";
		$queryCek3 = "SELECT * FROM jadwalharian WHERE id_ta='$id_ta' and nip='$nip' and hari='$hari'";
		$queryCek4 = "SELECT * FROM jadwalharian WHERE id_ta='$id_ta' and kd_kelas='$kd_kelas' and kd_mapel='$kd_mapel'";

		$cek = mysqli_num_rows(mysqli_query($con, $queryCek));
		$cek2 = mysqli_num_rows(mysqli_query($con, $queryCek2));
		$cek3 = mysqli_num_rows(mysqli_query($con, $queryCek3));
		$cek4 = mysqli_fetch_array(mysqli_query($con, $queryCek4));
		if ($cek > 0) {
			echo "<script type='text/javascript'> onload =function(){
				alert('Jadwal Bentrok!!');
				}
		  </script>";	
		} else if($cek2 > 0) {
			echo "<script type='text/javascript'> onload =function(){
				alert('Jadwal Bentrok, karena sudah mengajar di kelas lain!!');
				}
		  </script>";
		} else if ($cek3 >= 2) {
			echo "<script type='text/javascript'> onload =function(){
				alert('Jadwal Maksimal 2 Jam Perhari!!');
				}
		  </script>";
		} else  {
			if($cek4['nip'] == "" || $cek4['nip'] == $nip){

				$cekMapel = mysqli_fetch_array(mysqli_query($con,"select kd_mapel from guru where nip='$nip'"));

				$sql="INSERT INTO jadwalharian(id_ta, jam_pelajrn, nip, hari, kd_mapel, kd_kelas) VALUES ('$id_ta', '$addJam', '$nip', '$hari', '$cekMapel[kd_mapel]', '$kd_kelas')";

				$simpan=mysqli_query($con,$sql);
				//bila berhasil simpan kembali ke halaman index web sekolah
				if ($simpan) {
					echo "<script>alert('Jadwal Berhasil Disimpan');</script>";	
	    			echo "<meta http-equiv=refresh content=0;url=index.php?hal=pengolhan_data_jadwalharian>";
					// header("Location:index.php?hal=pengolhan_data_jadwalharian");
				}else { 	
					echo "<script type='text/javascript'>
							onload =function(){
								alert('Data gagal disimpan!');
							}
						  </script>";
			    } 
		    } else if ($cek4['nip'] != $nip) {
				echo "<script type='text/javascript'> onload =function(){
					alert('Mata Pelajaran utk kelas ini sudah gurunya!!');
					}
			  </script>";
			} 
		}
	}
}
//proses editing
if (isset($_GET['id_jadwalharian'])) {
	$id_jadwalharian = $_GET['id_jadwalharian'];
} 

	//tampilkan data sebelum di edit
	$sql2 	="select * from jadwalharian where id_jadwalharian='$id_jadwalharian'";
	$tampil =mysqli_query($con,$sql2);
	$baris 	=mysqli_fetch_array($tampil);

	$id_jadwalharian 	=$baris['id_jadwalharian'];
	$id_ta 	 	 	 	=$baris['id_ta'];
	$hari 	 	 	 	=$baris['hari'];
	$jam_pelajrn 	 	=$baris['jam_pelajrn'];
	$nip		 		=$baris['nip'];
	$kd_mapel 		 	=$baris['kd_mapel'];
	$kd_kelas 	 	 	=$baris['kd_kelas'];

//apabila klik tombol edit
if(isset($_POST['Edit'])) {

	$id_jadwalharian 	=$_POST['id_jadwalharian'];
	$id_ta 	 	 		=$_POST['id_ta'];
	$hari 	 	 		=$_POST['hari'];
	$nip 	 	 		=$_POST['nip'];
	$jam_pelajrn 	    =$_POST['jam_pelajrn']."-".$_POST['jam_pelajrn_2'];
	$kd_mapel 	 		=$_POST['kd_mapel'];
	$kd_kelas 	 		=$_POST['kd_kelas'];
	
	
	$SQL = "UPDATE jadwalharian SET id_ta = '$id_ta', hari = '$hari', nip ='$nip', jam_pelajrn = '$jam_pelajrn', kd_mapel = '$kd_mapel',
					kd_kelas = '$kd_kelas' WHERE id_jadwalharian = '$id_jadwalharian'";  
  	$hasil= mysqli_query($con,$SQL); 
	//jika berhasil kembali ke halaman index web sekolah
  	if($hasil){
		header("Location: index.php?hal=pengolhan_data_jadwalharian");
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
	if (!empty($id_jadwalharian) && $id_jadwalharian != "") {
	$SQL = "delete from jadwalharian where id_jadwalharian='$id_jadwalharian'"; 
	 	if(mysqli_query($con,$SQL)) { 
			header("Location:index.php?hal=pengolhan_data_jadwalharian");
		}else {
			echo "Data berhasil dihapus";
	   } 
	}
}

//apabila klik cari
if(isset($_POST['cari'])) {
	$harinya = $_POST['cari_hari'];	
	$kelasnya = $_POST['cari_kd_kelas'];
}
?>	

<script type="text/javascript">
$(document).ready(function(){
	$('#nip').change(function(){
		$.getJSON('pengolhan_data_jadwalharian.php',{action:'getmap', nip:$(this).val()}, function(json){
			// $('#kd_mapel').html('');
			// $('#mapel_nama').html('');
			$.each(json, function(index, row) {
				$('#mapel_nama').val(row.mapel);
				$('#kd_mapel').val(row.kd_mapel);
			});
		});
	});
});


$(document).ready(function() {
    $('#timepicker_start').timepicker({
       showLeadingZero: false,
       onSelect: tpStartSelect,
       maxTime: {
           hour: 16, minute: 30
       }
    });
    $('#timepicker_end').timepicker({
       showLeadingZero: false,
       onSelect: tpEndSelect,
       minTime: {
           hour: 9, minute: 15
       }
    });
    $("select.hari").change(function() {
    	var hari = $("select.hari").val();
    	if(hari==5) {
    		$("select.senin-kamis").attr("disabled");
    		$("select.senin-kamis").hide();
    		$("select.jumat").removeAttr("disabled");
    		$("select.jumat").show();
    		$(".plus-icon").removeClass("senin-kamis");
    		$(".plus-icon").addClass("jumatan");
    		$(".plus-icon").removeClass("disabled");
    	} else {
    		$("select.senin-kamis").removeAttr("disabled");
    		$("select.senin-kamis").show();
    		$("select.jumat").attr("disabled");
    		$("select.jumat").hide();
    		$(".plus-icon").addClass("senin-kamis");
    		$(".plus-icon").removeClass("jumatan");
    		$(".plus-icon").removeClass("disabled");
    	}
    });

    $(".plus-icon").click(function() {
    	if($(".plus-icon").hasClass("disabled")) {
    		alert("Pilih Hari Dahulu!");
    	}else {
    		if($(".plus-icon").hasClass("senin-kamis")) {
    			var selectSeninKamis = $("select.senin-kamis").clone();
	    		$(".hari-mapel").html(selectSeninKamis);
    		} else {
    			var selectJumat = $("select.jumat").clone();
	    		$(".hari-mapel").html(selectJumat);
    		}
    	}
    });
});

// when start time change, update minimum for end timepicker
function tpStartSelect( time, endTimePickerInst ) {
   $('#timepicker_end').timepicker('option', {
       minTime: {
           hour: endTimePickerInst.hours,
           minute: endTimePickerInst.minutes
       }
   });
}

// when end time change, update maximum for start timepicker
function tpEndSelect( time, startTimePickerInst ) {
   $('#timepicker_start').timepicker('option', {
       maxTime: {
           hour: startTimePickerInst.hours,
           minute: startTimePickerInst.minutes
       }
   });
}
</script>

<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">
			<center><h2 class="title-kelas">Form Data Jadwal Pelajaran SMP N 2 Godean</h2></center><hr/>
       			<form action="index.php?hal=pengolhan_data_jadwalharian" method="post" enctype="multipart/form-data" name="form1">
       				<legend>
       				<h4 class="title-style-jdwalharian"> Masukkan data dengan valid : Tahun ajaran, Jam pelajaran, Hari, Nama guru, Matapelajaran, Kelas</h4> 
	           	 	<table width="750" border="0" class="tb-kelas">
	           	 	<tr>
		                <td class="td-mapel"></td>
		                <td class="td-mapel">
		                	<input type="hidden" value='<?php echo "$id_jadwalharian"; ?>' name="id_jadwalharian">
		                	
	                   	</td>
	              	</tr>		
	           	 	<tr>
		                <td class="td-mapel">Tahun Ajaran</td>
		                <td class="td-mapel">
		                	<select name="id_ta" id="id_ta" required="">
		                		<option value="">-- Pilih --</option>
		                		<?php
		                			$query  = mysqli_query($con,"SELECT * FROM tahunajaran ORDER BY ta DESC ");
		                			while ($row = mysqli_fetch_array($query)) {
										$selected = ($row ['id_ta']==$id_ta) ? 'selected="selected"':'';
										echo "<option value='".$row['id_ta']."' $selected>".$row['ta']." - ".$row['semester']."</option>";                				
		                			}
		                
		                		?>
	                   	</td>
	              	</tr>	
	              	<tr>
						<td class="td-jadwalharian">Hari</td>
						<td class="td-jadwalharian">
							<select name="hari" id="hari" required="" class="hari">
								<option value"">-- Pilih --</option>
								<?php
									foreach($hariOptions as $opt=>$namaHari) {
										$selected = ($hari==$opt)? ' selected="selected"': '';
										echo "<option value='$opt'".$selected.">$namaHari</option>";
									}
								?>
							</select>
						</td>
					</tr>
	           	 	<tr>
		                <td class="td-mapel">Jam Pelajaran</td>
		                <td class="td-mapel">
		                	<label for="jampelajaran">
		                		<select name='jam_pelajrn[]' class="senin-kamis" disabled>
		                			<option value="0">--Pilih Jam--</option>
		                			<option>07:00-07:40</option>
		                			<option>07:41-08:20</option>
		                			<option>08:21-09:00</option>
		                			<!-- <option>09:01-09:20</option> -->
		                			<option>09:20-10:00</option>
		                			<option>10:01-10:40</option>
		                			<option>10:41-11:20</option>
		                			<!-- <option>11:21-11:40</option> -->
		                			<option>11:41-12:20</option>
		                			<option>12:21-13:00</option>
		                		</select>
		                		<select name='jam_pelajrn[]' class="jumat">
		                			<option value="0">--Pilih Jam--</option>
		                			<option>07:00-07:40</option>
		                			<option>07:41-08:20</option>
		                			<option>08:21-09:00</option>
		                			<!-- <option>09:01-09:20</option> -->
		                			<option>09:20-10:00</option>
		                			<option>10:01-10:40</option>
		                		</select>
		                		<!-- <div class="plus-icon senin-kamis disabled"></div> -->
		                	<?php 
		                	// 	if (!$_GET['id_jadwalharian']) {
		                	// 		echo "Mulai : <input type='text' value='' name='jam_pelajrn' id='timepicker_start' style='margin-right:20px;'>
		                	// Selesai : <input type='text' value='' name='jam_pelajrn_2' id='timepicker_end'>";
		                	// 	}else{
		                	// 		$data_jam = explode("-",$jam_pelajrn);
		                	// 		echo "Mulai : <input type='text' id='timepicker_start' name='jam_pelajrn' value='$data_jam[0]' readonly='' required='' style='margin-right:20px;'>";
		                	// 		echo "Selesai : <input type='text' id='timepicker_end' name='jam_pelajrn_2' value='$data_jam[1]' readonly='' required=''>";
		                	// 	}

		                	?>

		                	</label>
	                   </td>
	              	</tr>
					<tr>
		                <td class="td-mapel">Nama Guru</td>
		                <td class="td-mapel">
		                	<select name="nip" id="nip" required="">
		                		<option value="">-- Pilih --</option>
		                		<?php
		                			$query  = mysqli_query($con,"SELECT * FROM guru ORDER BY nip DESC ");
		                			while ($row = mysqli_fetch_array($query)) {
										$selected = ($row ['nip']==$nip) ? 'selected="selected"':'';
										echo "<option value='".$row['nip']."' $selected>".$row['nama']."</option>";                				
		                			}
		                
		                		?>
	                   </td>
	              	</tr>	

				  	<tr>
		                <td class="td-mapel">Mata Pelajaran</td>
		                <td class="td-mapel">
		              		<input type="hidden" name="kd_mapel" value="" id="kd_mapel">
		              		<input type="text" name="nama_mapel" id="mapel_nama" value="" readonly>
	                   </td>
	              	</tr>
				  	<tr>
		                <td class="td-mapel">Pilih Kelas</td>
		                <td class="td-mapel">
		                	<label>
							<select name="kd_kelas" id="kd_kelas" required=""> 
		                		<?php
		                			echo "<option>-- Pilih --</option>";
		                			$query  = mysqli_query($con,"SELECT * FROM kelas ORDER BY kd_kelas ASC ");
		                			while ($row = mysqli_fetch_array($query)) {
										echo "<option value='".$row['kd_kelas']."'>".$row['kelas']."</option>";                				
		                			}
		                
		                		?>
		                	</select>
	                		</label>
	                	</td>
	              	</tr>
	            	</table>
	            	 <div class="box-btnjadwalharian" style="margin: 6px 0px 18px 20%;">
				                <?php 
				                	if(!$_GET['id_jadwalharian']){
										//bila mau tambah data yang tampil tombol simpan
										echo "<input name=\"simpan\" type=\"submit\" id=\"simpan\" value=\"Simpan\" class=\"btn-mapel\"  />";
								    } else {
										//Apabila mau edit yg tampil tombol edit dan hapus
										echo "<input name=\"Edit\" type=\"submit\" id=\"edit\" value=\"Edit\" class=\"btn-mapel\"  />";
										//echo "<input name=\"Hapus\" type=\"submit\" id=\"hapus\" value=\"Hapus\" class=\"elipse\"  />";
								    } 	
								?>
	                			</label>
				 			</td>
	            	</div>
	            	</legend>
				</form>
				<form action="index.php?hal=pengolhan_data_jadwalharian" method="post">
					<table>
						<tr>
						<td class="td-jadwalharian">Hari</td>
						<td class="td-jadwalharian">
							<select name="cari_hari" id="hari" required="">
								<option value"">-- Pilih --</option>
								<?php
									foreach($hariOptions as $opt=>$namaHari) {
										echo "<option value='$opt'>$namaHari</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
		                <td class="td-mapel">Pilih Kelas</td>
		                <td class="td-mapel">
		                	<label>
							<select name="cari_kd_kelas" id="kd_kelas" required="">
		                		<?php
		                			echo "<option>-- Pilih --</option>";
		                			$query  = mysqli_query($con,"SELECT * FROM kelas ORDER BY kd_kelas ASC ");
		                			while ($row = mysqli_fetch_array($query)) {
										echo "<option value='".$row['kd_kelas']."'>".$row['kelas']."</option>";                				
		                			}
		                
		                		?>
		                	</select>
	                		</label>
	                	</td>
	              	</tr>
					</table>
					<input name="cari" type="submit" id="Cari" value="Cari" class="btn-mapel"/>
				</form>
				<?php 
					if($kelasnya == "" and $harinya == "") {
						echo "Silahkan pilih kelas dan hari";
					} else {
				?>
					<table  width="1070" class="tb-frmkelas" cellpadding="4" cellspacing="0" align="center">
		              	<tr class="kelas-table">
		              		<th width="30"><div align="center">No</div></th>
		              		<th width="150"><div align="center">Tahun Ajaran</div></th>
		              		<th width="200"><div align="center">Jam Pelajaran</div></th>
		              		<th width="50"><div align="center">Hari</div></th>
		              		<th width="300"><div align="center">Nama Guru</div></th>
							<th width="200"><div align="center">Mata Pelajaran</strong></div></th>
			                <th width="50"><div align="center">Kelas</div></th>
						  	<th width="50"><div align="center">Aksi</div></th>
		              	</tr>
						<?php
							
							$no=1;
							//pilih data dari tabel kelas
							$query="SELECT t.ta, t.semester, k.kelas, m.mapel, j.jam_pelajrn, j.hari, j.kd_kelas, g.nama, j.id_jadwalharian, g.nip, j.nip
									FROM jadwalharian j
										 JOIN mapel m ON j.kd_mapel = m.kd_mapel
										 JOIN tahunajaran t ON j.id_ta = t.id_ta
										 JOIN kelas k ON j.kd_kelas = k.kd_kelas
										 JOIN guru g ON j.nip = g.nip WHERE j.kd_kelas='$kelasnya' AND j.hari='$harinya'";

							$tampilkan=mysqli_query($con,$query);
							while ($data=mysqli_fetch_array($tampilkan)) {
							
							if($data['hari']==1) {
								$namaharinya = "Senin";
							} elseif ($data['hari']==2) {
								$namaharinya = "Selasa";
							} elseif ($data['hari']==3) {
								$namaharinya ="Rabu";
							} elseif ($data['hari']==4) {
								$namaharinya ="Kamis";
							} elseif ($data['hari']==5) {
								$namaharinya= "Jumat";
							} else {
								$namaharinya="Sabtu";
							}
						?>
	            		<tr>
			              	<td><?php echo $no++; echo $nomer; ?></td>
			              	<td><?php echo $data['ta']; echo ' - '; echo $data['semester'] ;?></td>
			              	<td><?php echo $data['jam_pelajrn'];?></td>
			              	<td><?php echo $namaharinya ?></td>
			              	<td><?php echo $data['nama']; ?></td>
			                <td><?php echo $data['mapel']; ?></td>
							<td><?php echo $data['kelas']; ?></td>
			                <td><div align="center"><a href="index.php?hal=pengolhan_data_jadwalharian&id_jadwalharian=<?php echo $data['id_jadwalharian'];?>">
			                	<img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a>
			                	<a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='index.php?hal=hapus_jadwalharian&id_jadwalharian=<?php echo $data['id_jadwalharian']; ?>';}">
			                	<img src="images/icon/del.png" width="20" height="20" border="0" /></a></div></td>
						</tr>
						<?php } ?>
           			</table><br>
				<?php } ?>
      </div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->
