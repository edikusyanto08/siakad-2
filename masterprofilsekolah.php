<?php session_start();

include "setting/koneksi.php";

if (isset($_POST['simpan'])) {

    $id_profil      = $_POST['id_profil'];
    $profil_sekolah = $_POST['profilsekolah'];

    $SQL="update profil_sekolah set profil_sekolah='$profil_sekolah' where id_profil=$id_profil"; 
    $simpan=mysqli_query($con,$SQL);
     if ($simpan) {
        //jika simpan berhasil kirim ke index sekolah
        header("location:index.php?hal=masterprofilsekolah");
    }else{
        echo "<script type='text/javascript'>
                    onload =function(){
                    alert('Data gagal disimpan !');
                }
              </script>";
        }
    }
?>
<div id="wrapper-kelas">
    <div id="box-kelas">
        <div id="content-kelas">
            <div id="content-isi">
                    <?php
                        $tampil=mysqli_query($con,"SELECT * FROM profil_sekolah");
                        while ($data=mysqli_fetch_array($tampil)) { ?>
                	
                	       <?php echo $data['profil_sekolah'];?>
                    <?php }?>
           
            <?php if ($_SESSION['level']=='0'){  ?>
                    <!--plugins tinymce-->
                    <script type="text/javascript" src="libs/tinymce/js/tinymce/tinymce.min.js"></script>
                    <script type="text/javascript">
                        tinymce.init({
                        selector: "textarea",
                        plugins: [
                                    "advlist autolink lists link image charmap print preview anchor",
                                    "searchreplace visualblocks code fullscreen",
                                    "insertdatetime media table contextmenu paste "
                                 ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                        });
                    </script>
                    <!--plugins tinymce-->
            <form method="post" action="index.php?hal=masterprofilsekolah">
            <?php
                $tampil=mysqli_query($con,"SELECT * FROM profil_sekolah");
                while ($data=mysqli_fetch_array($tampil)) { 
            ?>
                <textarea name="profilsekolah" id="profilsekolah" style="width:100%"><?php echo $data['profil_sekolah']?></textarea>
                    <input type="hidden" value="<?php echo $data['id_profil']; ?>" name="id_profil" class="btnprofilsekolah">
                    <input type="submit" value="Simpan" name="simpan"  class="btnprofilsekolah">

            </form>
            <?php } ?>
            </div>
            <?php }?>
            </div>
        </div>
    </div>
</div>
</div><!-- penutup footer include-->