<?php session_start();
include "setting/koneksi.php";

?>
<div id="wrapper-kelas">
  <div id="box-kelas">
    <div id="content-kelas">
    	  <center><h2 class="title-kelas">Form Cetak Data Guru SMP Negeri 2 Godean </h2></center><hr/>
    			<table  class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
              <tr class="kelas-table">
                  <th width="40"><div align="center">No</th>
                  <th width="71"><div align="center">NIP</div></th>
                  <th width="250"><div align="center">Nama</div></th>
    				      <th width="250"><div align="center">TTL</div></th>
    				      <th width="100"><div align="center">Jenis Kelamin</div></th>
                  <th width="250"><div align="center">Alamat</div></th>
                  <th width="60"><div align="center">Agama</div></th>
                  <th width="40"><div align="center">Aksi</div></th>
              </tr>
          <?php
              //pilih data dari tabel guru
              $x="select * from guru";
              //ambil query tampilkan
              $tampil=mysqli_query($con,$x);
              $no=1;
              //tampilkan data dalam bentuk array di tabel
              while ($data=mysqli_fetch_array($tampil)) {
          ?>
            <tr>
              <td><?php echo $no++; $nomor; ?></td>
              <td><?php echo $data['nip']; ?></td>
              <td><?php echo $data['nama']; ?></td>
        			<td><?php echo $data['tempat_lahir']; echo ", "; echo $data['tgl_lahir'] ?></td>
        			<td><?php echo $data['jen_kel']; ?></td>
        			<td><?php echo $data['alamat']; ?></td>
              <td><div align="center"><?php echo $data['agama']; ?></div></td>
              <td><center><a href="printguru_onepage.php?nip=<?php echo $data['nip'];?>"><img src="images/icon/printer.png" width="20" height="20" border="0" /></a></center></td>
      <?php } ?>
		        </tr>
		      </table><br/> 
            <legend><br>
              <div class="tombol-cetakguru">
                <a class="btnbtn-cetak-guru" href="printguru_all.php">Cetak Semua</a></div><br>
            </legend>
          <div class="content-clearfix" style="width: 100%; margin: 90px;">
          </div>
    </div>
  </div>
</div>
</div><!-- penutup dari class paging fungsi include untuk autofooter height-->