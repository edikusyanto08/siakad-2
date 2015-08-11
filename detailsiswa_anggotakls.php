<?php session_start();
//koneksi database
include "setting/koneksi.php";

//Ambil nilai yang akan di edit
if (isset($_GET['nis'])) {
	 $nis = $_GET['nis'];
} 

//tampilkan data sebelum di edit
$sql2   ="select * from siswa where nis='$nis';";
$tampil =mysql_query($sql2);
$baris  =mysql_fetch_array($tampil);

$nis            =$baris['nis'];
$kd_kelas       =$baris['kd_kelas'];
$nama_siswa     =$baris['nama_siswa'];
$jen_kel        =$baris['jen_kel'];
$tempat_lahir   =$baris['tempat_lahir'];
$tgl_lahir      =$baris['tgl_lahir'];
$status         =$baris['status'];
$anak_ke        =$baris['anak_ke'];
$jml_saudara    =$baris['jumlah_saudara'];
$agama          =$baris['agama'];
$alamat_siswa   =$baris['alamat_siswa'];
$sekolah_asal   =$baris['sekolah_asal'];
$no_ijazah      =$baris['no_ijazah'];
$th_ijazah      =$baris['th_ijazah'];
$nama_ay        =$baris['nama_ayah'];
$pekerjaan_ay   =$baris['pekerjaan_ayah'];
$nama_i         =$baris['nama_ibu'];
$pekerjaan_i    =$baris['pekerjaan_ibu'];
$nama_wali      =$baris['nama_wali'];
$pekerjaan_wali =$baris['pekerjaan_wali'];
$alamat_wali    =$baris['alamat_wali'];
$nope_wali      =$baris['no_telp_wali'];
$foto           =$baris['foto'];

?>

<div id="wrapper-kelas">
  <div id="box-kelas">
    <div id="content-kelas">
         <div class="btnbackmenu"><a href="index.php?hal=pengolhan_data_anggotakelas"><img src="images/icon/icon-backarrow.png"></a></div>
      <center><h2 class="title-kelas">Form Detail Data Siswa SMP NEGERI 2 GODEAN</h2></center><hr/>
      <legend>
      <div id="content-detailstyle">
        <table width="510" border="0" cellspacing="0" cellpadding="2" class="detail-style">
            <tr>
                <td class="td-siswa" width="130">Nomor Induk Siswa </td>
                <td class="td-siswa" width="250">: <?php echo $nis; ?></td>
            </tr>
                <div id="position-img">
                <?php echo "<img class='bingkai-detail-siswa' src='images/foto/$foto' width=150 height=180> <br/>";?></div>
		    <tr>
                <td class="td-siswa">Nama</td>
                <td class="td-siswa">: <?php echo $nama_siswa; ?></td>
            </tr>
            <tr>
                <td class="td-siswa">Jenis Kelamin </td>
                <td class="td-siswa">: <?php echo $jen_kel; ?></td>
            </tr>
            <tr>
                <td class="td-siswa">Tempat Lahir </td>
                <td class="td-siswa">: <?php echo $tempat_lahir; ?></td>
            </tr>
            <tr>
                <td class="td-siswa">Tanggal Lahir </td>
                <td class="td-siswa">: <?php echo $tgl_lahir; ?></td>
            </tr>
            <tr>
                <td class="td-siswa">Anak ke</td>
                <td class="td-siswa">: <?php echo $anak_ke; ?></td>
            </tr>
            <tr>
                <td class="td-siswa">Jumlah Saudara</td>
                <td class="td-siswa">: <?php echo $jml_saudara; ?></td>
            </tr>
            <tr>
                <td class="td-siswa">Agama</td>
                <td class="td-siswa">: <?php echo $agama; ?></td>
            </tr>
            <tr>
                <td class="td-siswa">Alamat</td>
                <td class="td-siswa">: <?php echo $alamat_siswa; ?></td>
            </tr>		  
            <tr>
                <td class="td-siswa">Agama</td>
                <td class="td-siswa">: <?php echo $agama; ?></td>
            </tr>
			<tr>
                <td class="td-siswa">Asal Sekolah</td>
                <td class="td-siswa">: <?php echo $sekolah_asal; ?></td>
            </tr> 
			<tr>
                <td class="td-siswa">Nama Ayah</td>
                <td class="td-siswa">: <?php echo $nama_ay; ?></td>
            </tr>
			<tr>
                <td class="td-siswa">Pekerjaan Ayah</td>
                <td class="td-siswa">: <?php echo $pekerjaan_ay; ?></td>
            </tr>
			<tr>
                <td class="td-siswa">Nama Ibu</td>
                <td class="td-siswa">: <?php echo $nama_i; ?></td>
            </tr>
			<tr>
                <td class="td-siswa">Pekerjaan Ibu</td>
                <td class="td-siswa">: <?php echo $pekerjaan_i; ?></td>
            </tr>
			<tr>
                <td class="td-siswa">Nama Wali</td>
                <td class="td-siswa">: <?php echo $nama_wali; ?></td>
            </tr>
			<tr>
                <td class="td-siswa">Pekerjaan Wali</td>
                <td class="td-siswa">: <?php echo $pekerjaan_wali; ?></td>
            </tr>
			<tr>
                <td class="td-siswa">Alamat Wali</td>
                <td class="td-siswa">: <?php echo $alamat_wali; ?></td>
            </tr>
		    <tr>
                <td class="td-siswa">Nama Wali</td>
                <td class="td-siswa">: <?php echo $nope_wali; ?></td>
            </tr>

      </table>        
       </legend>
        </div>
      </div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->