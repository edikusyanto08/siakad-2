<?php session_start();
include "setting/koneksi.php";
?>

<html>
<head>
	<title>SMP NEGERI 2 Godean</title>
	<link rel="stylesheet" type="text/css" href="css/base_style.css"/>
</head>
<body style="margin:auto">
<center>
	<div id="container-login">
		<div id="header-loginadmin"  class="judul-contentlogin">
			<div class="heading-area">
				<span class="span-headerlogin">
					Sistem Informasi Akademik
					SMP NEGERI 2 Godean Sleman
				</span>
			</div>
		</div>
			<div id="formlogin">
				<form method="post" action="ceklogin.php">
				<!-- mengirim file ke ceklogin.php-->
					<div class="wrapper-boxlogin">
						<div class="boxlogin-sizer">
							<div class="inner-boxsizer">
								<input type="text" name="user" id="user" placeholder="username" class="txtinput"/></td>
							</div>
							<div class="inner-boxsizer">	
								<input type="password" name="password" id="password" placeholder="password" class="txtinput"/></td>
							</div>
						</div>
								<input type="submit" name="login" value="Masuk" class="btnlogin"/> 
						<div class="inner-boxlogin">
							<span class="">
							</span>
							<span>
							</span>
						</div>
					</div>
				</form>
			</div>
			<div id="menu-bottom">
				<?php 
					if (!empty($_GET['error'])) {
					    if ($_GET['error'] == 1) {
					        echo '<h4 class="error_message">Username dan Password belum diisi !</h4>';
					    } else if ($_GET['error'] == 2) {
					        echo '<h4 class="error_message">Username belum diisi !</h4>';
					    } else if ($_GET['error'] == 3) {
					        echo '<h4 class="error_message">Password belum diisi !</h4>';
					    } else if ($_GET['error'] == 4) {
					        echo '<h4 class="error_message">Username dan Password tidak terdaftar !</h4>';
					    }
					}

				?>
			</div>
	</div>
</center>
</body>
</html>
