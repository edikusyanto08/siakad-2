<?php 
ob_start();
session_start();
//koneksi database
include "setting/koneksi.php";
// if (isset($_SESSION['level']) && isset($_SESSION['username'])){

?>
<!DOCTYPE html>
<meta charset="utf-8">
<head>
<title>SMP NEGERI 2 GODEAN</title>
	<link rel="shortcut icon" href="images/icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/base_style.css"/>
	<link href="libs/zebra_datepicker/css/metallic.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="libs/jquery.js"></script>
	<script type="text/javascript" src="libs/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="libs/twd-menu.js"></script>
	<script type="text/javascript" src="libs/zebra_datepicker/zebra_datepicker.js"></script>
	<script type="text/javascript" src="libs/zebra_datepicker/core.js"></script>
	<!--jquery validation -->
	<script type="text/javascript" src="libs/jvalidation/jquery.validate.min.js"></script>
	<!-- end of jquery validation -->
	<!--jquery pagination -->
	<script type="text/javascript" src="libs/jquery.simplePagination.js"></script>
	<link type="text/css" rel="stylesheet" href="path_to/simplePagination.css"/>
	<!-- end of jquery validation -->

	<!-- timepicker -->
    <link rel="stylesheet" href="libs/timepicker/include/ui-1.10.0/ui-lightness/jquery-ui-1.10.0.custom.min.css" type="text/css" />
    <link rel="stylesheet" href="libs/timepicker/jquery.ui.timepicker.css?v=0.3.3" type="text/css" />
	<script type="text/javascript" src="libs/timepicker/include/ui-1.10.0/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="libs/timepicker/include/ui-1.10.0/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="libs/timepicker/include/ui-1.10.0/jquery.ui.tabs.min.js"></script>
    <script type="text/javascript" src="libs/timepicker/include/ui-1.10.0/jquery.ui.position.min.js"></script>
    <script type="text/javascript" src="libs/timepicker/jquery.ui.timepicker.js?v=0.3.3"></script>

</head>
<body>
	<div id="container-box">
        <div id="header">
       	<?php if ($_SESSION['level'] != ''){ ?>
        <?php }else{ ?>
        	<div class="header-boxlgin">
        		<a class="login-btn" href="login.php">Login</a></div>
        <?php } ?>	
          	<div id="header-box">
					<div id="img-box">
						<div id="img">
							<img class="img-siswalg" src="images/icon/logo.png" align="right"></img></div>
					</div>
				<div id="label-content">
					<h1>Sistem Informasi Akademik </br>SMP NEGERI 2 Godean</h1>		
				</div>
			</div>
        	<div class="container-nav">
				<nav>	
					<ul id="nav">
						<li><a href="?hal=homepage" >Home</a></li>
					<?php if ($_SESSION['level'] !='0' and $_SESSION['level'] !='1' ){ ?>
						<li><a>Profil Sekolah</a>
							<ul>
								<li><a href="?hal=masterprofilsekolah">Sejarah singkat sekolah </a></li>
							</ul>

					<?php } ?>
					<?php if ($_SESSION['level']== '0'){ ?>
			    		<li><a>Data Master</a>
							<ul>
								<li><a href="?hal=mastersiswa">Master Siswa</a></li>
								<li><a href="?hal=masterguru">Master Guru</a></li>	
					            <li><a href="?hal=mastermappel">Master Mata Pelajaran</a></li>
					            <li><a href="?hal=masterkelas">Master Kelas</a></li>			         
								<li><a href="?hal=mastertahunajaran">Master Tahun Ajaran</a></li>
								<li><a href="?hal=masterpengguna">Master User</a></li>
								<li><a href="?hal=masterprofilsekolah">Master Profil Sekolah</a></li>
								<!--<li><a href="?hal=jadwalharian">Master Jadwal Harian</a></li>-->
							</ul>
			    		<li><a href="#">Pengolahan Data</a>
							<ul>
								<li><a href="?hal=pengolhan_data_inputkelasbaru">Anggota Kelas</a></li>
								<li><a href="?hal=pengolhan_data_jadwalharian">Jadwal Harian</a></li>
								<li><a href="?hal=pengolhan_data_absensi">Data Absensi</a></li>	            	
							</ul>
						</li>
					<?php  }?>
					<?php if ($_SESSION['level']== '1' ){ ?>
						<li><a href="#">Manajemen Nilai</a>
							<ul>
					            <li><a href="?hal=manajemen_inputnilai">Input Nilai</a></li>			         
					            <li><a href="?hal=manajemen_lihatnilai">Lihat Nilai</a></li>							
								<!-- <li><a href="?hal=jadwalmengajar_guru">Jadwal Mengajar Guru</a></li>  -->
							</ul>	
						</li>
			        <?php  }?>
					<?php if ($_SESSION['level']== '0' or $_SESSION['level']== '1'){ ?>
						<li><a href="#">Laporan</a>
							<ul>
					            <li><a href="?hal=laporan_guru">Laporan Data Guru</a></li>	
					            <?php if($_SESSION['level']==0) {?>		         
					            <li><a href="?hal=jadwalmengajar">Laporan Jadwal Mengajar</a></li>		
					            <?php } else { ?>
					            <li><a href="?hal=jadwalmengajar_guru">Laporan Jadwal Mengajar</a></li>		
					            <?php } ?>	         
					            <li><a href="?hal=laporan_siswa">Laporan Data Siswa</a></li>
					            <li><a href="?hal=printabsensi_siswa">Laporan Absensi</a></li>
								<li><a href="?hal=printnilai_siswa">Laporan Nilai</a></li>
							</ul>
						</li>
					<?php  }?>
					<?php if ($_SESSION['level']== '0' or $_SESSION['level']== '1' ) { ?>
					<div class="position-boxlogoutbefore">
						<li><a href="logout.php" class="current">Logout</a></li>
					</div>
					<?php  }else { ?>
					<?php if ($_SESSION['level']== '0' or $_SESSION['level']== '1' ) { ?>
					<div class="position-boxlogoutafter">
						<li><a href="logout.php" class="current">Logout</a></li>
					</div>
					<?php  }?>
					<?php  }?>
					<?php if ($_SESSION['level']== '2'){ ?>
					<div class="position-boxlogoutafter">
						<li><span class="position-boxlogoutspaner"><a href="logout.php" class="current">Logout</a></span></li>
					</div>
					<?php  }?>
					</ul>
				</nav> 
       	 	</div>
    </div><!-- akhir dari container box -->
        <div id="content">
			<?php 
				if (empty($_GET['hal'])){ 
					$_GET['hal']="homepage" ; 
							include $_GET['hal'].".php"; 
						}else { 
							include $_GET['hal'].".php"; 
						}	
			?>
			<div id="footer"></div>
</body>
</html>

<?php
// }else{	
//    		echo "<script> alert ('Mohon maaf, harap login dahulu!!!')</script>";
// 				header("location:login.php");
//  }
?>