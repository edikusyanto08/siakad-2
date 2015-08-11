<?php session_start();
//koneksi database
include "setting/koneksi.php";

//deklarasi fariabel dari form
$id_ta    =$_POST['id_ta'];
$ta       =$_POST['ta'];
$semester =$_POST['semester'];

if(isset($_POST['simpan'])){

  //validasi cek tahun ajaran
  $cektahunajaran =mysqli_query($con,"SELECT * FROM tahunajaran WHERE ta='$ta'");
  $cekdatanya =mysqli_num_rows($cektahunajaran);

  if($cekdatanya  > 0) {
      echo "<script type='text/javascript'>
                  onload =function(){
                  alert('semester sudah di input !');
                  }
            </script>";

}else{

$sql="insert into tahunajaran (ta,semester) values('$ta','$semester')";
$simpan=mysqli_query($con,$sql);
//bila berhasil simpan kembali ke halaman index web sekolah
    if ($simpan) {
          header("location:index.php?hal=mastertahunajaran");
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
if (isset($_GET['id_ta'])) {
	 $id_ta = $_GET['id_ta'];
} 

//tampilkan data sebelum di edit
$sql2     ="select * from  tahunajaran  where id_ta='$id_ta'";
$tampil   =mysqli_query($con,$sql2);
$baris    =mysqli_fetch_array($tampil);

$id_ta    =$baris['id_ta'];
$ta       =$baris['ta'];
$semester =$baris['semester'];


//apabila klik tombol edit
if(isset($_POST['Edit'])) {
  
  $id_ta    =$_POST['id_ta'];
  $ta       =$_POST['ta'];
  $semester =$_POST['semester'];
	
$SQL = "Update  tahunajaran SET ta='$ta' where id_ta='$id_ta'"; 
  	$hasil= mysqli_query($con,$SQL); 
	   //jika berhasil kembali ke halaman web index sekolah
  	if($hasil){
        header("location:index.php?hal=mastertahunajaran");
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
  if (!empty($id_ta) && $id_ta != "") {
  $SQL = "delete from tahunajaran where id_ta='$id_ta'"; 
      if(mysqli_query($con,$SQL)) { 
            header("location:index.php?hal=mastertahunajaran");
  	  }else {
  	        echo "Data berhasil dihapus";
      } 
    }
  }
   
?>		
<div id="wrapper-kelas">
  <div id="box-kelas">
    <div id="content-kelas">
      <center><h2 class="title-kelas">Form Data Tahun Ajaran SMP N 2 Godean</h2></center><hr/>   
        <form action="index.php?hal=mastertahunajaran" method="post" enctype="multipart/form-data" name="form1">
          <legend>
          <h4 class="title-style-masterthunajaran"> Masukkan data dengan valid : Tahun ajaran</h4>
          <table class="tb-kelas">
              <tr>
                  <td class="td-mapel" width="100">Tahun Ajaran</td>
                  <td class="td-mapel">
                    <label>
                      <input name="id_ta" type="hidden" size="40" value="<?php echo $baris["id_ta"]; ?>" ></label>
                      <input name="ta" required class='txt-inputstyle' type="text" size="40" value="<?php echo $baris["ta"]; ?>" ></label>
                  </td>
              </tr>
              <tr>
                  <td class="td-mapel" width="100">Semester</td>
                  <td class="td-mapel">
                  <select name="semester" class="select-style" required>
                    <option required>-- Pilih --</option>
                    <?php
                            $selected = ($semester)? 'selected="selected"': '';
                            foreach(array('Ganjil', 'Genap') as $semester) {
                            $selected = ($status_semester==$semester)? ' selected="selected"': '';
                            echo "<option value='$semester'".$selected.">$semester</option>";
                          }

                    ?>
                  </td>
              </tr>
              <tr>
                  <td class="td-mapel"></td>
                  <td class="td-mapel"><label>
                    <div class="cntrol-btnpositionkelas">
                      <?php 
                          if(!$_GET['id_ta']){
                            	//bila mau tambah data yang tampil tombol simpan
                            	echo "<input name=\"simpan\" type=\"submit\" value=\"Simpan\" class=\"btn-TA\"  />";
                          }else {
                              //Apabila mau edit yg tampil tombol edit dan hapus
                              //echo "<input name=\"Edit\" type=\"submit\" value=\"Edit\" class=\"btn-TA\"  />";
                            	//echo "<input name=\"Hapus\" type=\"submit\" id=\"hapus\" value=\"Hapus\" class=\"btn-TA\"  />";
                          } 
                      ?>
                      </label>
                    </div>
			 	          </td>
              </tr>
          </table>
          </legend>
        </form><br>      
		    <table class="tb-frmkelas" width="1090" align="center" cellpadding="4" cellspacing="0">
          <tr class="kelas-table">
              <th width="50"><div align="center">No</div></th>
  				    <th width="300"><div align="center">Tahun Ajaran</div></th>
              <th width="300"><div align="center">Semester</div></th>
  				    <th width="50"><div align="center">Aksi</div></th>
          </tr>
          <?php

              //pilih data dari tabel ta
              $x="select * from tahunajaran order by ta ASC";
              //ambil query tampilkan
              $tampil=mysqli_query($con,$x);
              $no=0;
              //tampilkan data dalam bentuk array di tabel
              while ($baris=mysqli_fetch_array($tampil)){
          ?>
          <tr>
              <td class="styletb-adm"><?php $no++; echo $no;?></td>
              <td class="styletb-adm"><?php echo $baris['ta'];?></td>
              <td class="styletb-adm"><?php echo $baris['semester'];?></td>
              <td class="styletb-adm">
              <div align="center">
                  <!--<a href="index.php?hal=mastertahunajaran&ta=<?php echo $baris['id_ta'];?>">
                  <img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a>-->
                  <a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='hapus_tahunajaran.php?id_ta=<?php echo $baris['id_ta'];?>';}">
                  <img src="images/icon/del.png" width="20" height="20" border="0" /></a></div></td>
          </tr>
        <?php } ?>

          <?php
              //pilih data dari tabel ta
              $x1="select * from tahunajaran";
              //ambil query tampilkan
              $hitung=mysqli_query($con,$x1);
              //tampilkan data dalam bentuk array di tabel
              $jumlah=mysqli_num_rows($hitung);
          ?>
          <tr>
              <td class="styletb-adm" colspan="2"><strong>Jumlah Data Tahun Ajaran Sekarang</strong> </td>
              <td class="styletb-adm" align="center" class="Fnt-Tahunajaran"><?php echo $jumlah;?> Tahun Ajaran</td>
          </tr>
      </table>
    </div>
  </div>
</div>  
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->