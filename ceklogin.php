<?php session_start();

include "setting/koneksi.php";

$myusername =$_POST['user'];
$mypassword =$_POST['password'];

	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysqli_real_escape_string($con,$myusername);
	$mypassword = mysqli_real_escape_string($con,$mypassword);

		if (empty($myusername) && empty($mypassword)) {
		    //kalau username dan password kosong
		    	header('location:login.php?error=1');
		    break;
		} else if (empty($myusername)) {
		    //kalau username saja yang kosong
		    	header('location:login.php?error=2');
		    break;
		} else if (empty($mypassword)) {
		    //kalau password saja yang kosong
		    //redirect ke halaman login
		    	header('location:login.php?error=3');
		    break;
		}

		$mypassword = md5($mypassword);

	$sql = mysqli_query($con,"SELECT * FROM user WHERE  user ='$myusername' and password='$mypassword'") 
					   or die("gagal kueri!");
					   	
		if (mysqli_num_rows($sql) == '0') {

	    	echo "<script>alert('Username atau password salah !!!')</script>";
        	echo "<script>history.go(-1)</script>";
	    	
		}else {
	    	header('location:login.php?error=4');

	$data=mysqli_fetch_array($sql);
		if ($data['level']=='0') {
			$_SESSION['USER']->id=$data['id'];
			$_SESSION['USER']->user=$data['user'];
			$_SESSION['USER']->password=$data['password'];
			$_SESSION['USER']->level=$data['level'];
				echo "<script> alert ('anda berhasil masuk ke sistem!') </script>";
				header("location:index.php");

					$_SESSION['level']    = $data['level'];
    				$_SESSION['username'] = $data['user'];
		}
		if ($data['level']=='1') {
			$_SESSION['USER']->id=$data['id'];
			$_SESSION['USER']->user=$data['user'];
			$_SESSION['USER']->password=$data['password'];
			$_SESSION['USER']->level=$data['level'];
				echo "<script> alert('anda berhasil masuk ke sistem!') </script>";
				//include "directsukses.php";
				header("location:index.php");
					$_SESSION['level']    = $data['level'];
    				$_SESSION['username'] = $data['user'];

		}else { echo "data tidak ditemukan!"; include "direct.php";}
			
	}
?>