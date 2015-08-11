<?php 
session_start();
session_destroy();
echo "<script>alert('anda berhasil logout!')</script>";
//header("location:index.php");
include "redirecting.php";
?>