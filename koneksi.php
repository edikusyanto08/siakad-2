<?php
	error_reporting(E_ALL ^E_NOTICE);
		#$site ="http://localhost/siakad";
		$con = mysqli_connect('www.smpnduagodean.zz.mu','u978535507','')or die('gagal koneksi');
		$db   = mysqli_select_db('db_smp')or die('gagal database');

?>