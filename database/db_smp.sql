-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2015 at 10:37 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_smp`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
`id_absen` int(5) NOT NULL,
  `id_ta` int(5) NOT NULL,
  `kd_kelas` varchar(10) NOT NULL,
  `kd_mapel` varchar(10) NOT NULL,
  `tgl_absen` date NOT NULL,
  `nis` varchar(6) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absen`, `id_ta`, `kd_kelas`, `kd_mapel`, `tgl_absen`, `nis`, `keterangan`) VALUES
(20, 9, 'K-VIIA', 'KMP003', '2015-07-02', '6003', 'Izin'),
(21, 9, 'K-VIIA', 'KMP004', '2015-07-03', '6004', 'Sakit');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_kelas`
--

CREATE TABLE IF NOT EXISTS `anggota_kelas` (
`id_anggota_kelas` int(10) NOT NULL,
  `id_ta` int(5) NOT NULL,
  `kd_kelas` varchar(10) NOT NULL,
  `nis` varchar(6) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota_kelas`
--

INSERT INTO `anggota_kelas` (`id_anggota_kelas`, `id_ta`, `kd_kelas`, `nis`, `status`) VALUES
(8, 9, 'K-VIIA', '6007', 1),
(9, 10, 'K-VIIA', '6007', 1),
(10, 9, 'K-VIIB', '6006', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jen_kel` varchar(9) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `status_kepegawaian` varchar(25) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `kd_kelas` varchar(10) NOT NULL,
  `kd_mapel` varchar(10) NOT NULL,
  `kwa_pend` varchar(2) NOT NULL,
  `jurusan` varchar(25) NOT NULL,
  `universitas` text NOT NULL,
  `th_lulus` varchar(4) NOT NULL,
  `gelar_dp` varchar(5) DEFAULT NULL,
  `gelar_bk` varchar(10) DEFAULT NULL,
  `foto` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nama`, `jen_kel`, `tempat_lahir`, `tgl_lahir`, `status_kepegawaian`, `agama`, `alamat`, `no_telp`, `tgl_masuk`, `jabatan`, `kd_kelas`, `kd_mapel`, `kwa_pend`, `jurusan`, `universitas`, `th_lulus`, `gelar_dp`, `gelar_bk`, `foto`) VALUES
('787677673878378738', 'Siswandono', 'Laki-Laki', 'Yogyakarta', '1979-09-03', 'Tetap', 'Islam', 'Grebekan Sidomulyo Godean', '095676553776', '2007-04-11', 'Guru', '', 'kd_mapel', 'S1', 'Bahasa Inggris', 'UNY', '1989', 'Drs', '-', 'Sumidi, S.Pd.jpg'),
('878345768767123567', 'Yanti Sunarni', 'Laki-Laki', 'Sleman', '1973-01-16', 'Tetap', 'Islam', 'Karangkajen Denggung Sleman', '085678887236', '0000-00-00', 'Guru', '', 'KMP003', 'S1', 'Sastra Bahasa', 'UNY', '1997', 'Drs', '-', 'Haryanti, S.Pd.jpg'),
('878798787672351236', 'Joko Subiyanto', 'Laki-Laki', 'Sleman', '1972-09-13', 'Tetap', 'Islam', 'Senuko Sidoagung Godean', '095643887975', '0000-00-00', 'Wakil Kepala Sekolah', '', 'KMP001', 'S1', 'Matematika', 'UNY', '1998', 'Drs', '-', 'Joko Subiyanto, S.Pd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalharian`
--

CREATE TABLE IF NOT EXISTS `jadwalharian` (
`id_jadwalharian` int(11) NOT NULL,
  `id_ta` varchar(15) NOT NULL,
  `jam_pelajrn` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `hari` varchar(15) NOT NULL,
  `kd_mapel` varchar(50) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwalharian`
--

INSERT INTO `jadwalharian` (`id_jadwalharian`, `id_ta`, `jam_pelajrn`, `nip`, `hari`, `kd_mapel`, `kd_kelas`) VALUES
(44, '9', '07:00-07:40', '878798787672351236', 'Senin', 'KMP001', 'K-VIIA'),
(45, '9', '07:00-07:40', '878345768767123567', 'Senin', 'KMP003', 'K-VIIB'),
(46, '9', '07:41-08:20', '878798787672351236', 'Senin', 'KMP001', 'K-VIIA'),
(47, '9', '08:21-09:00', '878345768767123567', 'Senin', 'KMP003', 'K-VIIA');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kd_kelas` varchar(10) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `kuota` int(3) NOT NULL,
  `nip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `kelas`, `kuota`, `nip`) VALUES
('K-VIIA', 'VII A', 30, '878798787672351236'),
('K-VIIB', 'VII B', 30, '878345768767123567');

-- --------------------------------------------------------

--
-- Table structure for table `leger`
--

CREATE TABLE IF NOT EXISTS `leger` (
`id_leger` int(10) NOT NULL,
  `id_nilaimapel` int(10) NOT NULL,
  `id_ta` int(5) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `kd_mapel` varchar(10) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leger`
--

INSERT INTO `leger` (`id_leger`, `id_nilaimapel`, `id_ta`, `nis`, `kd_mapel`, `nilai`) VALUES
(12, 0, 9, '6007', 'KMP001', 80);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
  `kd_mapel` varchar(6) NOT NULL,
  `mapel` varchar(50) NOT NULL,
  `jenis_mapel` varchar(15) NOT NULL,
  `kkm` int(5) NOT NULL,
  `status` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `mapel`, `jenis_mapel`, `kkm`, `status`) VALUES
('KMP001', 'Matematika', 'Normatif', 75, ''),
('KMP003', 'Bahasa Jawa', 'Normatif', 75, ''),
('KMP004', 'Bahasa Inggris', 'Normatif', 75, '1'),
('KMP005', 'IPS', 'Normatif', 75, '1');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_mapel`
--

CREATE TABLE IF NOT EXISTS `nilai_mapel` (
`id_nilaimapel` int(10) NOT NULL,
  `id_ta` int(10) NOT NULL,
  `nis` varchar(5) NOT NULL,
  `kd_mapel` varchar(10) NOT NULL,
  `ulangan_1` int(5) NOT NULL,
  `ulangan_2` int(5) NOT NULL,
  `uts` int(5) NOT NULL,
  `uas` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_mapel`
--

INSERT INTO `nilai_mapel` (`id_nilaimapel`, `id_ta`, `nis`, `kd_mapel`, `ulangan_1`, `ulangan_2`, `uts`, `uas`) VALUES
(72, 9, '6007', 'KMP001', 80, 80, 80, 80);

-- --------------------------------------------------------

--
-- Table structure for table `profil_sekolah`
--

CREATE TABLE IF NOT EXISTS `profil_sekolah` (
`id_profil` int(5) NOT NULL,
  `profil_sekolah` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id_profil`, `profil_sekolah`) VALUES
(1, '<div id="judul-sejarahsekolah">\r\n<h2 class="sjr-latar-sekolah">Sejarah Berdirinya SMP N 2 Godean</h2>\r\n</div>\r\n<hr />\r\n<div id="cntent-sj-sekolah">\r\n<div id="isi-sjsekolah" style="text-align: justify;">Sekolah Menengah Pertama Negeri 2 Godean berdiri pada tahun 1986 yang berasal dari SMEP (Sekolah Menengah Ekonomi Pertama) yang beralamat di Kowanan Sidoagung Godean. Pada tahun 1997 berintegrasi menjadi SMP Sidomoyo yang selanjutnya menjadi SMP Negeri 2 Godean type C, dengan luas tanah 4000 m2 dan luas bangunan kurang</div>\r\n<div style="text-align: justify;">lebih 2.792 m2. Sekolah ini berjarak sekitar 1200m dari jalan raya Jogja - Godean Km 7,5 dan berada di Pedukuhan Karangmalang desa Sidomoyo Kecamatan Godean. Status bangunan yang dimiliki oleh atas nama pemerintah desa dan dinas pendidikan Kabupaten Sleman dengan surat ijin bangunan 303 / VII / S / 1982 pada tanggal 19 Juli 1982.</div>\r\n<div style="text-align: justify;">Sekolah telah diakreditasi dengan nilai A, dan pada tahun ini menduduki rangking 15 di tingkat Kabupaten. Untuk merealisasikan tujuan utama sekolah, SMP N 2 Godean, Sleman telah mengalami beberapa kali perubahan kepemimpinan, diantaranya :</div>\r\n<div>&nbsp;</div>\r\n<div id="content-generasi">\r\n<div id="isi-generasi">1. Sugiman, BA. (1979-1984)<br /> 2. S. Pardi, BA. (1984-1987)<br /> 3. Soedarso, BA. (1987-1988)<br /> 4. Dra. Murti Isnaini (1988-1991)<br /> 5. Drs. Sukirno (1991-1994<br /> 6. Suwardiyono, BA. (1994-1998)<br /> 7. S. Prajoto, S.Pd. (1998-2000)<br /> 8. Drs. Badrun (2000-2005)<br /> 9. Urip Mulyono, S.Pd. (2005-2010)<br /> 10. Drs. Haryanto (2010-2013)</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(6) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `tgl_diterima` date NOT NULL,
  `jen_kel` varchar(9) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `status_dlmkluarga` varchar(12) NOT NULL,
  `notelp_siswa` varchar(20) NOT NULL,
  `anak_ke` varchar(2) NOT NULL,
  `jumlah_saudara` varchar(2) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `alamat_siswa` text NOT NULL,
  `sekolah_asal` varchar(30) NOT NULL,
  `nama_ayah` varchar(40) NOT NULL,
  `pekerjaan_ayah` varchar(30) NOT NULL,
  `nama_ibu` varchar(40) NOT NULL,
  `pekerjaan_ibu` varchar(30) NOT NULL,
  `notelp_ortu` varchar(20) NOT NULL,
  `alamat_ortu` text NOT NULL,
  `nama_wali` varchar(40) DEFAULT NULL,
  `pekerjaan_wali` varchar(30) DEFAULT NULL,
  `alamat_wali` text,
  `notelp_wali` varchar(20) DEFAULT NULL,
  `foto` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `tgl_diterima`, `jen_kel`, `tempat_lahir`, `tgl_lahir`, `status_dlmkluarga`, `notelp_siswa`, `anak_ke`, `jumlah_saudara`, `agama`, `alamat_siswa`, `sekolah_asal`, `nama_ayah`, `pekerjaan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `notelp_ortu`, `alamat_ortu`, `nama_wali`, `pekerjaan_wali`, `alamat_wali`, `notelp_wali`, `foto`) VALUES
('6003', 'Siska Wahyuni', '2015-07-02', 'Perempuan', 'Sleman', '2000-09-05', 'Anak Kandung', '091804667873', '2', '1', 'Islam', 'Buntala Sidoagung Godean', 'SDN Godean 2', 'Sarno', 'Wiraswasta', 'Windarti', 'PNS', '089997864765', 'Buntala Sidoagung Godean', '-', '-', '-', '-', 'IMG_7102.JPG'),
('6004', 'Dita Ayunda', '2015-07-02', 'Perempuan', 'Sleman', '1999-07-12', 'Anak Kandung', '095898776323', '1', '1', 'Islam', 'Sembungan Sidoagung Godean', 'SDN Jetis 1', 'Suparjan', 'PNS', 'Sariyanti', 'Ibu Rumahtangga', '097876447653', 'Sembungan Sidoagung Godean', '-', '-', '-', '-', 'IMG_7111.JPG'),
('6005', 'Diva Susanti', '2015-07-02', 'Perempuan', 'Sleman', '2000-07-14', 'Anak Kandung', '085643887986', '1', '1', 'Islam', 'Kramen Sidoagung Godean', 'SDN Godean 2', 'Murdiyo', 'PNS', 'Suratini', 'Ibu Rumahtangga', '087665376554', 'Kramen Sidoagung Godean', '-', '-', '-', '-', 'IMG_7101.JPG'),
('6006', 'Ratih Purwasih', '2015-07-02', 'Perempuan', 'Sleman', '1999-10-15', 'Anak Kandung', '085876887345', '1', '1', 'Islam', 'Buntalan Sidoagung Godean', 'SDN Godean 2', 'Suratno', 'PNS', 'Winarsih', 'Ibu Rumahtangga', '085768776345', 'Buntalan Sidoagung Godean', '-', '-', '-', '-', 'IMG_7103.JPG'),
('6007', 'Sekar Anjani', '2015-07-02', 'Perempuan', 'Sleman', '1999-04-18', 'Anak Kandung', '098776334656', '1', '1', 'Islam', 'Seuko Sidoagung Godean', 'SDN Jetis 1', 'Wandono', 'PNS', 'Sarni', 'Ibu Rumahtangga', '087667445653', 'Seuko Sidoagung Godean', '-', '-', '-', '-', 'IMG_7103.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `tahunajaran`
--

CREATE TABLE IF NOT EXISTS `tahunajaran` (
`id_ta` int(5) NOT NULL,
  `ta` varchar(12) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahunajaran`
--

INSERT INTO `tahunajaran` (`id_ta`, `ta`, `semester`) VALUES
(9, '2015/2016', 'Ganjil'),
(10, '2015/2016', 'Genap'),
(11, '2016/2017', 'Ganjil'),
(12, '2016/2017', 'Genap');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(5) NOT NULL,
  `user` varchar(18) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `password`, `level`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 0),
(4, '878345768767123567', '202cb962ac59075b964b07152d234b70', 1),
(5, '878798787672351236', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
 ADD PRIMARY KEY (`id_absen`), ADD KEY `FK_absen` (`nis`);

--
-- Indexes for table `anggota_kelas`
--
ALTER TABLE `anggota_kelas`
 ADD PRIMARY KEY (`id_anggota_kelas`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `jadwalharian`
--
ALTER TABLE `jadwalharian`
 ADD PRIMARY KEY (`id_jadwalharian`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `leger`
--
ALTER TABLE `leger`
 ADD PRIMARY KEY (`id_leger`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
 ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `nilai_mapel`
--
ALTER TABLE `nilai_mapel`
 ADD PRIMARY KEY (`id_nilaimapel`);

--
-- Indexes for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
 ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tahunajaran`
--
ALTER TABLE `tahunajaran`
 ADD PRIMARY KEY (`id_ta`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
MODIFY `id_absen` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `anggota_kelas`
--
ALTER TABLE `anggota_kelas`
MODIFY `id_anggota_kelas` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `jadwalharian`
--
ALTER TABLE `jadwalharian`
MODIFY `id_jadwalharian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `leger`
--
ALTER TABLE `leger`
MODIFY `id_leger` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `nilai_mapel`
--
ALTER TABLE `nilai_mapel`
MODIFY `id_nilaimapel` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
MODIFY `id_profil` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tahunajaran`
--
ALTER TABLE `tahunajaran`
MODIFY `id_ta` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
ADD CONSTRAINT `FK_absen` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
