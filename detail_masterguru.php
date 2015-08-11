<?php session_start();
//koneksi database
include "setting/koneksi.php";

//Ambil nilai yang akan di edit
if (isset($_GET['nip'])) {
	   $nip = $_GET['nip'];
} 

//tampilkan data sebelum di edit
$sql2   ="select * from guru where nip='$nip';";
$tampil =mysqli_query($con,$sql2);
$baris  =mysqli_fetch_array($tampil);

$nip                =$baris['nip'];
$nama               =$baris['nama'];
$jen_kel            =$baris['jen_kel'];
$tempat_lahir       =$baris['tempat_lahir'];
$tgl_lahir          =$baris['tgl_lahir'];
$status_kepegawaian =$baris['status_kepegawaian'];
$agama              =$baris['agama'];
$alamat             =$baris['alamat'];
$no_telp            =$baris['no_telp'];
$tgl_masuk          =$baris['tgl_masuk'];
$kwa_pend           =$baris['kwa_pend'];
$jabatan            =$baris['jabatan'];
$jurusan            =$baris['jurusan'];
$universitas        =$baris['universitas'];
$th_lulus           =$baris['th_lulus'];
$foto               =$baris['foto'];

?>
<div id="wrapper-kelas">
  <div id="box-kelas">
    <div id="content-kelas">
       <center><h2 class="title-kelas">Form Detail Data Guru SMP NEGERI 2 GODEAN</h2></center><hr/>
      <legend>
        <div id="content-detailstyle">
        <table width="600" border="0" cellspacing="0" cellpadding="2" class="detail-style">
            </tr>    
            <tr>
                <td width="100" class="td-tmpil-guru">NIP</td>
                <td width="300" class="td-tmpil-guru">: <?php echo "$nip";?></td>
                <div id="position-img">
                      <?php 
                          if($_GET['nip']){
          				          echo "<img class='bingkai-detail-siswa'src='images/foto/$foto' width=150 height=180> <br />";
          				      } 
          				    ?>
                    </div>
                </td>
            </tr>
  			    <tr>
                <td class="td-tmpil-guru">Nama</td>
                <td class="td-tmpil-guru">: <?php echo "$nama";?></td>
            </tr>
            <tr>
                <td class="td-tmpil-guru">Jenis Kelamin</td>
                <td class="td-tmpil-guru">: <?php echo "$jen_kel";?></td>
            </tr>
  		      <tr>
                <td class="td-tmpil-guru">Tempat Lahir </td>
                <td class="td-tmpil-guru">: <?php echo "$tempat_lahir,$tgl_lahir";?></td>
            </tr>
            <tr>
                <td class="td-tmpil-guru">Status Kepegawaian</td>
                <td class="td-tmpil-guru">: <?php echo "$status_kepegawaian";?></td>
            </tr>
            <tr>
                <td class="td-tmpil-guru">Agama</td>
                <td class="td-tmpil-guru">: <?php echo "$agama";?></td>
            </tr>
            <tr>
                <td class="td-tmpil-guru">Alamat</td>
                <td class="td-tmpil-guru">: <?php echo"$alamat";?></td>
            </tr>		  
  			    <tr>
                <td class="td-tmpil-guru">Nomor Telepon</td>
                <td class="td-tmpil-guru">: <?php echo "$no_telp";?></td>
            </tr>
      			<tr>
                  <td class="td-tmpil-guru">Tgl Masuk</td>
                  <td class="td-tmpil-guru">: <?php echo"$tgl_masuk";?></td>
            </tr>
      			<tr>
                  <td class="td-tmpil-guru">Kwalifikasi Pendidikan</td>
                  <td class="td-tmpil-guru">: <?php echo"$kwa_pend"?></td>
            </tr>
      			<tr>
                  <td class="td-tmpil-guru">Jabatan</td>
                  <td class="td-tmpil-guru">: <?php echo "$jabatan";?></td>
            </tr>
      			<tr>
                  <td class="td-tmpil-guru">Jurusan</td>
                  <td class="td-tmpil-guru">: <?php echo "$jurusan";?></td>
            </tr>
      			<tr>
                  <td class="td-tmpil-guru">Universitas</td>
                  <td class="td-tmpil-guru">: <?php echo "$universitas";?></td>
            </tr>
      			<tr>
                  <td class="td-tmpil-guru">Tahun Lulus</td>
                  <td class="td-tmpil-guru">: <?php echo "$th_lulus";?></td>
            </tr>
        </table>
        </legend>
    </div>
  </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->

     