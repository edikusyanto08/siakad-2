<?php session_start();
include "setting/koneksi.php";

?>
<div id="tombolprint">
    <a style="text-decoration: none; position:absolute;" class="btn-btnprintcetakjadwal" target="blank" href="printjadwal_all.php">  
    <input type="submit" value="Cetak Jadwal" class="btn-btnjadwalgurucetak"></a></div>  
    <div id="printReady"></p>
        <div id="wrapper-kelas">
          <div id="box-kelas">
            <div id="content-kelas">
    	    <center><h2 class="title-kelas">Form Cetak Jadwal Mengajar Guru SMP Negeri 2 Godean </h2></center><hr/>
            <div class="hari">
                <h5>Senin</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=1 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Selasa</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=2 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Rabu</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=3 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Kamis</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=4 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Jumat</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=5 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
                <div class="clearfixcontent" style="margin: 20px 0px 0px;"></div>

            <div class="hari">
                <h5>Sabtu</h5>
                <table class="tb-frmkelas" align="center" cellpadding="4" cellspacing="0">
                    <tr class="kelas-table">
                        <th width="40"><div align="center">No</th>
                        <th width="71"><div align="center">Hari</div></th>
                        <th width="250"><div align="center">Jam Mengajar</div></th>
                        <th width="250"><div align="center">Nama Guru</div></th>
                        <th width="100"><div align="center">Dikelas</div></th>
                        <th width="250"><div align="center">Matapelajaran</div></th>
                    </tr>
                <?php
                    $datajadwal =" SELECT * FROM jadwalharian jh
                                    JOIN tahunajaran t ON jh.id_ta=t.id_ta
                                    JOIN mapel m ON m.kd_mapel=jh.kd_mapel
                                    JOIN kelas k ON k.kd_kelas=jh.kd_kelas
                                    JOIN guru g ON g.nip=jh.nip WHERE jh.hari=6 ORDER BY g.nama ASC";
                    $hasil=mysqli_query($con,$datajadwal);

                    $no=1;
                    while ($tampiljadwalnya=mysqli_fetch_array($hasil)) {
                        if($tampiljadwalnya['hari']==1) {
                            $namaharinya = "Senin";
                        } elseif ($tampiljadwalnya['hari']==2) {
                            $namaharinya = "Selasa";
                        } elseif ($tampiljadwalnya['hari']==3) {
                            $namaharinya ="Rabu";
                        } elseif ($tampiljadwalnya['hari']==4) {
                            $namaharinya ="Kamis";
                        } elseif ($tampiljadwalnya['hari']==5) {
                            $namaharinya= "Jumat";
                        } else {
                            $namaharinya="Sabtu";
                        }
            
                ?>
                    <tr>
                        <td class=""><?php echo $no;?></td>
                        <td class=""><?php echo $namaharinya;?></td>
                        <td class=""><?php echo $tampiljadwalnya['jam_pelajrn'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['nama'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['kelas'];?></td>
                        <td class=""><?php echo $tampiljadwalnya['mapel'];?></td>
                <?php $no++; }?>
                    </tr>
                </table>
            </div>
        </div>
        </div><!-- penutup div print ready -->
    </div>
</div>