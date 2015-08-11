<?php session_start();
//koneksi database

include "setting/koneksi.php";

#ambil data kelas
$query = "SELECT * FROM kelas  ORDER BY kelas";
$sql   = mysqli_query($con,$query);
$arrkelas = array();
	while ($row = mysqli_fetch_assoc($sql)) {
		$arrkelas [ $row['kd_kelas']] = $row['kelas'];
}


#action get mapel
// if(isset($_GET['action']) && $_GET['action'] == "getmap") {
// 		$kd_kelas = $_GET['kd_kelas'];
// 		//ambil data mapel
// 		$query = "SELECT j.kd_mapel, c.mapel 
// 				  FROM jadwalharian j JOIN mapel c ON c.kd_mapel=j.kd_mapel
// 				  WHERE j.kd_kelas='$kd_kelas' and j.nip='$_SESSION[username]' ORDER BY c.mapel";
// 		$sql = mysqli_query($con,$query);
// 		$arrmap = array();
// 		while ($row = mysqli_fetch_assoc($sql)) {
// 			array_push($arrmap, $row);
// 		}
// 			echo json_encode($arrmap);
// 	exit;
// }
?>

<link rel="stylesheet" type="text/css" href="css/base_style.css"/>
<style type="text/css">
		span.inputan { 
						display:block; 
					    margin-bottom:5px; 
		}
		span.inputan label { 
						float:left; 
						display:block; width:200px;
		}
		.th-styiling-nilai{
						background: none repeat scroll 0% 0% #484848;
						color: #FFF;
						font-family: Arial,sans-serif;
						font-size: 13px;
		}
		.td-styling-inner{
						font-size: 12px;
						font-family: Arial,sans-serif;
						text-align: center;
		}	
		</style>
	<script type="text/javascript" src="libs/jquery.min.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				$('#kelas').change(function(){
					$.getJSON('manajemen_lihatnilai.php',{action:'getmap', kd_kelas:$(this).val()}, function(json){
						$('#mapel').html('');
						$.each(json, function(index, row) {
							$('#mapel').append('<option value='+row.kd_mapel+'>'+row.mapel+'</option>');
						});
					});
				});
			});
	</script>
<div id="wrapper-kelas">
	<div id="box-kelas">
		<div id="content-kelas">	
			<center><form method="post" action="index.php?hal=manajemen_lihatnilai">
				<h2 class="title-kelas">Pilih Kelas dan Mata Pelajaran untuk Melihat Nilai</h2><hr></center>
				<h4 class="style-fontheading">Pilih tahun ajaran, kelas & mata pelajaran untuk input nilai siswa</h4>
			<table class="tb-kelas">
				<tr>
					<td class="td-lapcetak-nilai">
						<input type="hidden" value="" name="id_nilaimapel" id="id_nilaimapel"></td>
				</tr>
				<tr>
					<td class="td-lapcetak-nilai" width="120">Tahun Ajaran</td>
					<td class="td-lapcetak-nilai"><select name="id_ta" id="id_ta">
						<?php
							echo "<option value=''>-- Pilih -- </option>";
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
					<td class="td-lapcetak-nilai"><label for="mapel">Kelas</label></td>
					<td class="td-lapcetak-nilai">
						<span class="inputan">
						<select id="kelas" name="kelas">
						<option value="">-- Pilih --</option>
						<?php
							foreach ($arrkelas as $kd_kelas=>$kelas) {
							echo "<option value='$kd_kelas'>$kelas</option>";
							}
						?>
						</select>
						</span>
				</tr>
<!-- 				<tr>
					<td class="td-lapcetak-nilai"><label for="mapel">Mata Pelajaran</label></td>
					<td class="td-lapcetak-nilai"><span class="inputan">
						<select id="mapel" name="mapel">
						</select></span>
					</td>
				</tr> -->
				<tr>
						<td class="td-input-nilai"><label for="mapel">Mata Pelajaran</label></td>
						<td class="td-input-nilai"><span class="inputan">
							<?php 
							$kodeMapel = mysqli_fetch_array(mysqli_query($con, "select kd_mapel from guru where nip='$_SESSION[username]'"));
							$mapelnya = mysqli_fetch_array(mysqli_query($con,"select * from mapel where kd_mapel='$kodeMapel[kd_mapel]'"));
							?>
							<input type="hidden" name="mapel" value="<?php echo $mapelnya['kd_mapel']; ?>">
							<input type="text" name="nama_mapel" value="<?php echo $mapelnya['mapel']; ?>">
							<!-- <select id="mapel" name="mapel"  class="select-style" >
							<option value="">-- Pilih --</option>
							</select></span></td> -->
					</tr>
				<tr>
					<td class="td-lapcetak-nilai" colspan="2">
						<input type="submit" value="Submit" name="submit" class="btnbtn-lapcetak"/>
					</td>
				</tr>
			</table>
			</form></center>

		

			<style type="text/css">
			<?php 	
				$kelas = $_POST['kelas'];
				$id_ta = $_POST['id_ta'];
				$nis   = $_POST['nis'];
				$mapel = $_POST['mapel'];
				$id_nilaimapel = $_POST['id_nilaimapel'];
				$getSemester = mysqli_fetch_array($con,mysqli_query("select semester from tahunajaran where id_ta='$id_ta'"));
				$getSmt = $getSemester['semester'];
			?>

			</style><br>
			<form method="post" action="index.php?hal=manajemen_lihatnilai">
				<?php 
					echo "<div style='display:none'>";
						foreach(compact('kelas','mapel','id_ta','nis','id_nilaimapel') as $param=>$value) {
					echo "<input type='hidden' name='$param' value='$value' />";
						}
					echo "</div>";
					?>
			</form>
			<table class="tb-frmkelas" width="1080" border="0" align="center" cellpadding="2" cellspacing="0">
				<tr class="kelas-table">
					<th width="50">No</th>
					<th width="100">NIS</th>
					<th width="400">Nama Siswa</th>
					<th width="200">KKM </th>
					<th width="200">ulangan 1</th>
					<th width="200">ulangan 2</th>
					<th width="100">UTS</th>
					<th width="100">UAS</th>
					<th width="200">Nilai Akhir</th>
				</tr>
				<?php
					// menampilkan data nim dan nilai siswa dari kelas dan kkm
					$query = mysqli_query($con,"SELECT a.nis, s.nama_siswa, m.kkm
										  FROM anggota_kelas a
										  INNER JOIN siswa s ON a.nis= s.nis
										  INNER JOIN jadwalharian j ON a.kd_kelas = j.kd_kelas
										  INNER JOIN mapel m ON j.kd_mapel = m.kd_mapel
										  WHERE a.kd_kelas='$kelas' AND a.id_ta='$id_ta'");
							
					$siswa_kelas = array();
					while($data = mysqli_fetch_array($query)) {
						$siswa_kelas[$data['nis']]   = new stdClass;
						$siswa_kelas[$data['nis']]->nama = $data['nama_siswa'];
					}
					 
					//cari data nilai
					$query2 =mysqli_query($con,"SELECT n.nis, n.ulangan_1,n.ulangan_2,n.uts,n.uas, m.kkm, m.kd_mapel, n.id_nilaimapel
										FROM nilai_mapel n 
										INNER JOIN mapel m ON n.kd_mapel=m.kd_mapel
										INNER JOIN anggota_kelas ak ON n.nis=ak.nis
										WHERE ak.kd_kelas='$kelas' AND n.kd_mapel='$mapel' AND n.id_ta='$id_ta'");

					$getKKM = mysqli_fetch_array(mysqli_query($con,"select kkm from mapel where kd_mapel='$mapel'"));

					
					$nilai_mapel = array();
					while($data = mysqli_fetch_array($query2)) {
						$nilai_mapel[$data['nis']] = new stdClass; 
						$nilai_mapel[$data['nis']]->kkm = $data['kkm']; 
						$nilai_mapel[$data['nis']]->ulangan_1 = $data['ulangan_1']; 
						$nilai_mapel[$data['nis']]->ulangan_2 = $data['ulangan_2']; 
						$nilai_mapel[$data['nis']]->uts = $data['uts']; 
						$nilai_mapel[$data['nis']]->uas = $data['uas']; 
						$nilai_mapel[$data['nis']]->id_nilaimapel = $data['id_nilaimapel']; 
					}
					// print_r($data);

						// echo $nilai_mapel[$data['nis']]->kkm = $data['kkm'];
					// gabungkan keduanya
					if (!empty($siswa_kelas)) {
						$i = 1;
						$z = 1;
						foreach($siswa_kelas as $nis=>& $info) {
							echo "<tr>";
							echo "<td>$i</td>";
							echo "<td>".$nis."</td>";
							echo "<td>".$siswa_kelas[$nis]->nama."</td>";
							if (array_key_exists($nis, $nilai_mapel)) {
								$value1 = $nilai_mapel[$nis]->ulangan_1;
								$value2 = $nilai_mapel[$nis]->ulangan_2;
								$value3 = $nilai_mapel[$nis]->uts;
								$value4 = $nilai_mapel[$nis]->uas;
								$value5 = $nilai_mapel[$nis]->id_nilaimapel;
								$value_all = ($value1+$value2+$value3+$value4)/4;
							} else {
								$value1 = 0;
								$value2 = 0;
								$value3 = 0;
								$value4 = 0;
								$value5 = 0;
								$value_all = 0;
							}

							// $nilai_akhir = ($value1+$value2+$value3+$value4)/4;
							echo "<td>".$getKKM['kkm']."</td>";

							echo "<td>$value1</td>";
							echo "<td>$value2</td>";
							echo "<td>$value3</td>";
							echo "<td>$value4</td>";
							echo "<td>$value_all</td>";
							$i++;
						}
						
					}
				?>
			</table>
		</div>
	</div>
</div>
</div>

