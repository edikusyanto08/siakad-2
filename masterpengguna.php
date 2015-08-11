<?php
session_start();
//koneksi database
include "setting/koneksi.php";

//deklarasi fariabel dari form
$user     =$_POST['user'];
$password =md5($_POST['password']);
$level    =$_POST['level'];

if(isset($_POST['simpan'])){
  if(empty($user)){
    echo "<script type='text/javascript'>
              onload =function(){
              alert('User belum diisi');
          }
          </script>";
}else{

$sql="insert into user (user, password, level) values ('$user','$password','$level')";

$simpan =mysqli_query($con,$sql);
//bila berhasil simpan kembali ke halaman utama
if ($simpan) {
header("location:index.php?hal=masterpengguna");
	} 
    else 
    { 	
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
if (isset($_GET['id'])) {
	 $id = $_GET['id'];
} 

//tampilkan data sebelum di edit
$sql2   ="select * from user where id='$id';";
$tampil =mysqli_query($con,$sql2);
$baris  =mysqli_fetch_array($tampil);

$user     =$baris['user'];
$password =$baris['password'];
$level    =$baris['level'];

//apabila klik tombol edit
if(isset($_POST['Edit'])) {
	$user     =$_POST['user'];
	$password =md5($_POST['password']);
	$level    =$_POST['level'];
	
$datapengguna = "UPDATE user SET   user           ='$user', 
                                         password ='$password', 
                                         level    ='$level'
                                WHERE    id       ='$id'"; 
$hasil = mysqli_query($con,$datapengguna); 
//jika berhasil kembali ke index web sekolah
  if($hasil){
    header("location:index.php?hal=masterpengguna");
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
if (!empty($id) && $id != "") {
$datapengguna = "delete from user where id='$id'"; 
       if(mysqli_query($con,$datapengguna)) { 
            header("location:index.php?hal=masterpengguna");
  	 } else {
  	        echo "Data berhasil dihapus";
     } 
  }
}
   
?>
<div id="wrapper-kelas">
  <div id="box-kelas">
    <div id="content-kelas">		
      <center><h2 class="title-kelas">Form Data User ( pengguna )</h2></center><hr>
        <legend>
        <form action="" method="post" enctype="multipart/form-data" name="form1">
          <h4 class="title-style-absensi"> Masukkan data dengan valid : Username, Password, Level</h4> 
          <table width="477"  class="tb-kelas">
              <tr>
                  <td class="td-user">User</td>
                  <td class="td-user"><label>
                      <input name="user" class='txt-inputstyle' type="text" id="user" size="40" value="<?php echo "$user";?>"/>
                  </td>
              </tr>
			        <tr>
                  <td class="td-user">Password</td>
                  <td class="td-user"><label>
                      <input name="password" class='txt-inputstyle' type="text" id="password" size="40" value="<?php echo "$password";?>" required=''/><label>
                  </td>
              </tr>
			        <tr>
                  <td class="td-user">Level</td>
                  <td class="td-user"><select name="level" id="level" required=''/ class="select-style">
				                  <option value= <?php $level ?>>-- Pilih --</option>
                              	<?php
                      							$selected = ($level)? 'selected="selected"': '';
                      							foreach(array('0', '1') as $hakakses) {
                          								$selected = ($level==$hakakses)? ' selected="selected"': '';
                          								echo "<option value='$hakakses'".$selected.">$hakakses</option>";
                          							}
            					          ?>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td class="td-user"></td>
                  <td class="td-user"><label>
                      <?php if(!$_GET['id']){
                          		//bila mau tambah data yang tampil tombol simpan
                          		echo "<input name=\"simpan\" type=\"submit\" id=\"simpan\" value=\"Simpan\" class=\"btn-pengguna\"  />";
                                  } else {
                          		//Apabila mau edit yg tampil tombol edit dan hapus
                          		echo "<input name=\"Edit\" type=\"submit\" id=\"edit\" value=\"Edit\" class=\"btn-pengguna\"  />";
                          		//echo "<input name=\"Hapus\" type=\"submit\" id=\"hapus\" value=\"Hapus\" class=\"elipse\"  />";
                                  } 
                      ?>
                      </label>
			 	         </td>
              </tr>
          </table>
        </form>     
        </legend><br>
			    <table border="0" width="1090" align="center" cellpadding="4" cellspacing="0" class="tb-frmkelas">
              <tr class="kelas-table">
                  <th width="50"><div align="center">No</div></td>
                  <th width="300"><div align="center">Username</div></td>
                  <th width="300"><div align="center">Password</div></td>
          				<th width="200"><div align="center">Level</div></td>
          				<th width="60"><div align="center">Aksi</div></td>
              </tr>
              <?php
             
                  $x="select * from user";
                  //ambil query tampilkan
                  $no=1;
                  $tampil=mysqli_query($con,$x);
                  //tampilkan data dalam bentuk array di tabel
                  while ($data=mysqli_fetch_array($tampil)){
              ?>
            <tr>
                <td class="styletb-adm"><?php echo $no++; echo $nomor;?></td>
                <td class="styletb-adm"><?php echo $data['user'];?></td>
                <td class="styletb-adm"><?php echo $data['password'];?></td>
				        <td class="styletb-adm"><?php echo $data['level'];?></td>
                <td class="styletb-adm">
                <div align="center"><a href="index.php?hal=masterpengguna&id=<?php echo $data['id'];?>">
                   <img src="images/icon/edit icon.png" width="20" height="20" border="0" /></a>
                   <a href="javascript:if(confirm('Anda yakin akan menghapus data ini??')){document.location='hapus_pengguna.php?id=<?php echo $data['id'];?>';}">
                   <img src="images/icon/del.png" width="20" height="20" border="0" /></a></div></td>
            </tr>
		    <?php } ?>
        <?php
              //pilih data dari tabel siswa
            $x1="select * from user";
            //ambil query tampilkan
            $hitung=mysqli_query($con,$x1);
            //tampilkan data dalam bentuk array di tabel
            $jumlah=mysqli_num_rows($hitung);
        ?>    
            <tr>
                <td class="styletb-adm" colspan="4"><strong>Jumlah Data User </strong> </td>
                <td class="styletb-adm" align="center" class="Fnt-Tahunajaran"><b><?php echo $jumlah;?> user</b></td>
            </tr>
          </table>  
      </div>
    </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->
