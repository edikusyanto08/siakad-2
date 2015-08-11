<?php session_start();
include "setting/koneksi.php";
require('fpdf/fpdf.php');

//query databases
$id_ta = $_GET['ta'];
$nnis  = $_GET['nis'];

$getSemester = mysql_fetch_array(mysql_query("select semester from tahunajaran where id_ta='$id_ta'"));
$getTA = mysql_fetch_array(mysql_query("select ta from tahunajaran where id_ta='$id_ta'"));
$getSmt = $getSemester['semester'];


$hasilnya = mysql_query(
	 "SELECT a.id_ta ,b.nis, b.nama_siswa, m.mapel, a.nilai, t.semester, m.kd_mapel, d.kelas, t.ta
	  FROM nilai_mapel a
	  JOIN siswa b ON b.nis = a.nis
	  JOIN anggota_kelas ak ON ak.nis= a.nis
	  JOIN mapel m ON a.kd_mapel = m.kd_mapel
	  JOIN tahunajaran t ON ak.id_ta=t.id_ta
	  JOIN kelas d ON ak.kd_kelas = d.kd_kelas
	  WHERE b.nis='$nnis' AND a.id_ta='$_GET[ta]' AND t.semester='$getSmt' AND t.ta='$getTA[ta]'");

$hasilnya2 = mysql_query(
	 "SELECT m.kd_mapel,  m.mapel, d.kelas, a.nilai
	  FROM nilai_mapel a
	  JOIN siswa b ON b.nis = a.nis
	  JOIN anggota_kelas ak ON ak.nis= a.nis
	  JOIN mapel m ON a.kd_mapel = m.kd_mapel
	  JOIN tahunajaran t ON ak.id_ta=t.id_ta
	  JOIN kelas d ON ak.kd_kelas = d.kd_kelas
	  WHERE b.nis='$nnis' AND a.id_ta='$_GET[ta]' AND t.semester='$getSmt' AND t.ta='$getTA[ta]'");
$tampilHasil = mysql_fetch_array($hasilnya);

// list ($nama_siswa, $nis, $ta, $semester,$kd_mapel, $mapel, $kelas, $nilai) 

//medifinisikan variable class fpdf dan page pdf
$pdf = new FPDF('P','mm','A4'); 
$pdf->AddPage();

//medifinisikan set margin
$pdf->SetMargins(40,10,6);


$pdf->Image('images/icon/kop.png' ,12,3,0,28);
$pdf->SetFont('Arial','B',10); 
												
//fungsi mengatur text area font
$pdf->SetFont('Arial', 'B', 8);

$pdf->Text(140, 50, "Tahun Ajaran");
$pdf->Text(165, 50," : " .$tampilHasil['ta']);

$pdf->Text(15, 50, "NIS");
$pdf->Text(40, 50," : " .$tampilHasil['nis']);

$pdf->Text(15, 55, "Nama Siswa");
$pdf->Text(40, 55," : " .$tampilHasil['nama_siswa']);

$pdf->Text(140, 55, "Semester");
$pdf->Text(165, 55," : ".$tampilHasil['semester']);


//fungsi mengatur dan posisi table x dan y
$pdf->SetXY(15, 60);
$pdf->AliasNbPages();
// function untuk menampilkan tabel


//membuat header tabel set color
$pdf->SetFillColor(50, 50, 50);
$pdf->SetTextColor(255,255,255);

$pdf->Cell(10, 5, "No.", 1, 0, 'C', true);
$pdf->Cell(40, 5, "Kode Mapel", 1, 0, 'C', true);
$pdf->Cell(40, 5, "Mata Pelajaran", 1, 0, 'C', true);
$pdf->Cell(20, 5, "Kelas", 1, 0, 'C', true);
$pdf->Cell(30, 5, "Nilai Akhir", 1, 0, 'C', true);
$pdf->Cell(30, 5, "Predikat (NA)", 1, 0, 'C', true);




$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0,0,0);
//membuat halaman
$no=1; 

//fungsi mengatur dan posisi table x dan y	
$pdf->SetXY(15, 65);

//membuat baris tabel
while (list($kd_mapel, $mapel, $kelas, $nilai) = mysql_fetch_row($hasilnya2)) {
$pdf->Cell(10, 5, $no, 1, 0, 'C');
$pdf->Cell(40, 5, $kd_mapel, 1, 0, 'C');
$pdf->Cell(40, 5, $mapel, 1, 0, 'C');
$pdf->Cell(20, 5, $kelas, 1, 0, 'C');
$pdf->Cell(30, 5, $nilai, 1, 0, 'C');
$pdf->Cell(30, 5, $nilai, 1, 0, 'C');

$y = 65+(5*$no);
$no++;
$pdf->SetXY(15, $y);

}



//fungsi show halaman
$pdf->SetY(-15);
//buat garis horizontal
$pdf->Line(7, $pdf->GetY(),200,$pdf->GetY());
//Arial italic 9
$pdf->SetFont('Arial','I',7);
//nomor halaman
$pdf->Cell(0,-10,'Halaman '.$pdf->PageNo().' dari {nb}',0,0,'R');

$pdf->Output(); 






?>