-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2022 at 11:56 AM
-- Server version: 10.3.33-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `udi93xus_fishmap_v1_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `com_menu`
--

CREATE TABLE `com_menu` (
  `nav_id` int(11) UNSIGNED NOT NULL,
  `portal_id` int(11) UNSIGNED DEFAULT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `nav_title` varchar(50) DEFAULT NULL,
  `nav_desc` varchar(100) DEFAULT NULL,
  `nav_url` varchar(100) DEFAULT NULL,
  `nav_no` int(11) UNSIGNED DEFAULT NULL,
  `active_st` enum('1','0') DEFAULT '1',
  `display_st` enum('1','0') DEFAULT '1',
  `nav_icon` varchar(50) DEFAULT NULL,
  `nav_icon_color` char(6) DEFAULT NULL,
  `mdb` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_menu`
--

INSERT INTO `com_menu` (`nav_id`, `portal_id`, `parent_id`, `nav_title`, `nav_desc`, `nav_url`, `nav_no`, `active_st`, `display_st`, `nav_icon`, `nav_icon_color`, `mdb`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, 1, 0, 'Home', 'Selamat Datang', 'home/adminwelcome', 1, '1', '1', NULL, '777777', 1, NULL, NULL, NULL, NULL, NULL),
(2, 1, 0, 'Settings', 'Pengaturan', 'settings/adminportal', 2, '1', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(3, 1, 2, 'Application', 'Pengaturan aplikasi', '-', 21, '1', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(4, 1, 3, 'Web Portal', 'Pengelolaan web portal', 'settings/adminportal', 211, '1', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(5, 1, 3, 'Users', 'Pengelolaan pengguna', 'settings/adminuser', 212, '1', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(6, 1, 3, 'Roles', 'Pengelolaan hak akses', 'settings/adminrole', 213, '1', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(7, 1, 3, 'Navigation', 'Pengelolaan menu', 'settings/adminmenu', 214, '1', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(8, 1, 3, 'Permissions', 'Pengelolaan hak akses pengguna', 'settings/adminpermissions', 215, '1', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(9, 1, 3, 'Preferences', 'Pengelolaan preferences', 'settings/adminpreferences', 216, '1', '0', NULL, '777777', 1, NULL, NULL, NULL, NULL, NULL),
(654, 2, 0, 'Dasbor', 'Dashboard', 'dashboard', 1, '1', '1', 'bx bx-home-circle', '777', 1, '2021-09-28 10:40:19', NULL, NULL, NULL, NULL),
(655, 2, 0, 'Berita', 'Informasi', 'informasi/berita', 2, '1', '1', '-', '777', 1, '2021-09-28 10:43:00', '2021-10-13 17:16:39', NULL, NULL, NULL),
(656, 2, 0, 'Artikel', 'Informasi', 'informasi/artikel', 3, '1', '1', '-', '777', 1, '2021-09-28 10:43:16', '2021-10-13 17:18:46', NULL, NULL, NULL),
(657, 2, 0, 'Tim', 'Informasi', 'informasi/tim', 4, '1', '1', '-', '777', 1, '2021-09-28 10:43:44', '2022-06-08 17:02:16', NULL, NULL, NULL),
(658, 2, 0, 'Layanan', 'Layanan', 'layanan/layanan', 11, '1', '1', '-', '777', 1, '2021-09-28 10:44:05', '2022-06-07 12:34:49', NULL, NULL, NULL),
(660, 2, 0, 'Galeri Foto', 'Galeri', 'galeri/foto', 13, '1', '1', '', '777', 1, '2021-09-28 10:44:49', '2021-11-16 08:33:38', NULL, NULL, NULL),
(661, 2, 0, 'Galeri Video', 'Galeri', 'galeri/video', 14, '1', '1', '', '777', 1, '2021-09-28 10:45:02', '2021-11-16 08:33:02', NULL, NULL, NULL),
(662, 2, 0, 'Slide', 'Pengaturan', 'pengaturan/slide', 96, '1', '1', '', '777', 1, '2021-09-28 10:45:16', '2021-11-15 11:57:36', NULL, NULL, NULL),
(663, 2, 0, 'Menu', 'Pengaturan', 'pengaturan/menu', 97, '1', '1', '', '777', 1, '2021-09-28 10:45:27', '2021-11-15 11:57:29', NULL, NULL, NULL),
(664, 2, 0, 'Sosial Media', 'Pengaturan', 'pengaturan/sosmed', 98, '1', '1', '', '777', 1, '2021-09-28 10:45:48', '2021-11-15 11:57:20', NULL, NULL, NULL),
(665, 2, 0, 'Pengguna', 'Pengaturan', 'pengaturan/pengguna', 99, '1', '1', '', '777', 1, '2021-09-28 10:46:02', '2021-11-15 11:57:13', NULL, NULL, NULL),
(666, 2, 0, 'Pengaturan', 'Pengaturan', 'pengaturan/pengaturan', 100, '1', '1', '', '777', 1, '2021-09-28 10:46:15', '2021-11-15 11:57:05', NULL, NULL, NULL),
(668, 2, 0, 'Halaman', 'Halaman', 'halaman/halaman', 6, '1', '1', '', '777', 1, '2021-10-07 13:03:31', '2021-10-26 08:47:05', NULL, NULL, NULL),
(669, 2, 0, 'Data', 'Halaman', 'halaman/data', 8, '1', '1', '', '777', 1, '2021-10-07 13:03:44', '2022-06-05 14:25:52', NULL, NULL, NULL),
(672, 2, 0, 'Profil', '-', 'pengaturan/profil', 0, '1', '0', '', '777', 1, '2021-10-14 10:07:47', NULL, NULL, NULL, NULL),
(673, 2, 655, 'Tulis Baru', '-', 'informasi/berita/add', 1, '1', '1', '', '777', 1, '2021-11-15 11:09:36', '2021-11-15 11:18:41', NULL, NULL, NULL),
(674, 2, 655, 'Semua Berita', '-', 'informasi/berita', 0, '1', '1', '', '777', 1, '2021-11-15 11:09:49', '2021-11-15 11:18:21', NULL, NULL, NULL),
(675, 2, NULL, 'Setelan', '-', '#', 3, '1', '1', '', '777', 1, '2021-11-15 11:52:32', '2021-11-15 11:53:16', NULL, NULL, NULL),
(676, 2, 0, 'Popup', 'Pengaturan', 'pengaturan/popup', 95, '1', '1', '', '777', 1, '2021-11-15 11:58:23', '2021-11-15 11:58:35', NULL, NULL, NULL),
(677, 2, 0, 'Teks Berjalan', 'Pengaturan', 'pengaturan/runningtext', 94, '1', '1', '', '777', 1, '2021-11-15 12:55:20', '2021-11-15 12:55:30', NULL, NULL, NULL),
(678, 2, 656, 'Semua Artikel', '-', 'informasi/artikel', 1, '1', '1', '', '777', 1, '2021-11-15 14:05:36', NULL, NULL, NULL, NULL),
(679, 2, 656, 'Tulis Baru', '-', 'informasi/artikel/add', 2, '1', '1', '', '777', 1, '2021-11-15 14:06:04', NULL, NULL, NULL, NULL),
(680, 2, 657, 'Semua Anggota', '-', 'informasi/tim', 1, '1', '1', '', '777', 1, '2021-11-15 14:06:40', '2022-06-08 17:02:47', NULL, NULL, NULL),
(681, 2, 657, 'Tambah Baru', '-', 'informasi/tim/add', 2, '1', '1', '', '777', 1, '2021-11-15 14:06:55', '2022-06-08 17:03:02', NULL, NULL, NULL),
(682, 2, 667, 'Semua Kegiatan', '-', 'informasi/kegiatan', 1, '1', '1', '', '777', 1, '2021-11-15 14:07:11', NULL, NULL, NULL, NULL),
(683, 2, 667, 'Tulis Baru', '-', 'informasi/kegiatan/add', 2, '1', '1', '', '777', 1, '2021-11-15 14:07:25', NULL, NULL, NULL, NULL),
(684, 2, 668, 'Semua Halaman', '-', 'halaman/halaman', 1, '1', '1', '', '777', 1, '2021-11-15 14:07:42', NULL, NULL, NULL, NULL),
(685, 2, 668, 'Tambah Halaman', '-', 'halaman/halaman/add', 2, '1', '1', '', '777', 1, '2021-11-15 14:07:56', NULL, NULL, NULL, NULL),
(687, 2, 686, 'Informasi', '-', 'halaman/kbb', 1, '1', '1', '', '777', 1, '2021-11-15 14:30:49', '2021-11-17 12:29:25', NULL, NULL, NULL),
(688, 2, 686, 'Hasil Diskusi', '-', 'halaman/kbb/hasil', 3, '1', '1', '', '777', 1, '2021-11-15 14:31:15', '2021-11-16 16:20:26', NULL, NULL, NULL),
(689, 2, 686, 'Tambah Informasi', '-', 'halaman/kbb/add', 2, '1', '1', '', '777', 1, '2021-11-15 14:34:48', '2021-11-17 12:30:40', NULL, NULL, NULL),
(690, 2, 666, 'Site', '-', 'pengaturan/pengaturan', 1, '1', '1', '', '777', 1, '2021-11-19 10:12:44', NULL, NULL, NULL, NULL),
(691, 2, 666, 'Footer', '-', 'pengaturan/pengaturan/footer', 2, '1', '1', '', '777', 1, '2021-11-19 10:12:59', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_portal`
--

CREATE TABLE `com_portal` (
  `portal_id` int(11) UNSIGNED NOT NULL,
  `portal_nm` varchar(100) DEFAULT NULL,
  `site_title` varchar(100) DEFAULT NULL,
  `site_desc` varchar(100) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `mdb` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `portal_session` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_portal`
--

INSERT INTO `com_portal` (`portal_id`, `portal_nm`, `site_title`, `site_desc`, `meta_desc`, `meta_keyword`, `mdb`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `portal_session`) VALUES
(1, 'Developer Area', 'CiSmart 3.1.11 Developer Site', '-', '-', '-', 1, NULL, '2021-06-15 11:25:19', NULL, NULL, NULL, NULL),
(2, 'CISMART 3.1.11 Operator Site', 'CISMART 3.1.11 Operator Site', 'CISMART 3.1.11 Operator Site', '-', '-', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Proyek Akhir - SI Orbit', 'Portal Public', '-', '-', '-', 1, '2021-09-28 13:55:14', '2022-05-29 14:46:48', NULL, NULL, NULL, 'v5yOFeeMvH6RLNJ4uGsG');

-- --------------------------------------------------------

--
-- Table structure for table `com_preferences`
--

CREATE TABLE `com_preferences` (
  `pref_id` int(11) UNSIGNED NOT NULL,
  `pref_group` varchar(50) DEFAULT NULL,
  `pref_nm` varchar(50) DEFAULT NULL,
  `pref_value` text DEFAULT NULL,
  `mdb` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_preferences`
--

INSERT INTO `com_preferences` (`pref_id`, `pref_group`, `pref_nm`, `pref_value`, `mdb`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, 'general', 'site_title', 'Fishmap - Find Fish In The Sea', NULL, NULL, '2022-06-11 14:34:05', NULL, NULL, '2'),
(2, 'general', 'site_logo', 'http://ahmadfaisalsiregar.skom.id//resource/doc/images/logo21.png', NULL, NULL, '2022-06-11 14:34:05', NULL, NULL, '2'),
(3, 'general', 'desc_title', 'Fishmap - Find Fish In The Sea merupakan aplikasi yang digunakan untuk mempermudah nelayan menetukan daerah pontesnial penangkapan ikan. Selain itu, aplikasi ini juga memberikan fitur pendukung berupa layanan informasi berupa berita, artikel, dan peta kemaritiman,', NULL, NULL, '2022-06-11 14:34:05', NULL, NULL, '2'),
(4, 'general', 'site_icon', 'http://ahmadfaisalsiregar.skom.id//resource/doc/images/logo-round2.png', NULL, NULL, '2022-06-11 14:34:05', NULL, NULL, '2'),
(5, 'sosmed', 'facebook', 'http://fb.com', NULL, NULL, '2022-06-08 14:11:14', NULL, NULL, '2'),
(6, 'sosmed', 'instagram', 'http://instagram.com', NULL, NULL, '2022-06-08 14:11:14', NULL, NULL, '2'),
(7, 'sosmed', 'twitter', 'http://twitter.com', NULL, NULL, '2022-06-08 14:11:14', NULL, NULL, '2'),
(8, 'footer', 'alamat', 'Jl. Hiu No. 123, Kota Sibolga, Prov. Sumatera Utara', NULL, NULL, '2022-06-09 10:37:30', NULL, NULL, '2'),
(9, 'footer', 'telepon', '(021) 1234567', NULL, NULL, '2022-06-09 10:37:30', NULL, NULL, '2'),
(10, 'footer', 'faksimile', '(021) 1234567', NULL, NULL, '2022-06-09 10:37:30', NULL, NULL, '2'),
(11, 'footer', 'pos_el', 'proyeksiorbit@gmail.com', NULL, NULL, '2022-06-09 10:37:30', NULL, NULL, '2'),
(12, 'sosmed', 'youtube', 'http://youtube.com', NULL, NULL, '2022-06-08 14:11:14', NULL, NULL, '2'),
(13, 'lks', 'keterangan', '<h4>Subbagian Kerja Sama</h4>\r\n<p><strong>Bagian Kerja Sama dan Hubungan Masyarakat</strong><br>Sekretariat Badan Pengembangan dan Pembinaan Bahasa Gedung Darma, Lantai 2<br>Jalan Daksinapati Barat IV, Rawamangun, Jakarta Timur<br>Telepon: (021) 4706287</p>', NULL, NULL, '2021-12-22 13:06:03', NULL, NULL, NULL),
(14, 'lks', 'galeri', '6', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'sosmed', 'tiktok', 'http://tiktok.com', NULL, NULL, '2022-06-08 14:11:14', NULL, NULL, '2'),
(16, 'sosmed', 'info', '<h3><b>Ingin mengetahui lebih lanjut??</b></h3>Kunjungi media Fishmap', NULL, NULL, '2022-06-08 14:11:14', NULL, NULL, '2'),
(17, 'column_1', 'judul', 'Link Keluar', NULL, NULL, '2022-06-09 10:37:30', NULL, NULL, '2'),
(18, 'column_2', 'judul', 'Layanan', NULL, NULL, '2022-06-09 10:37:30', NULL, NULL, '2'),
(19, 'column_3', 'judul', 'Produk', NULL, NULL, '2021-11-19 09:35:56', NULL, NULL, '2'),
(20, 'column_1', 'isi', '{\"text\":[\"MyOcean\",\"BMKG\",\"\",\"\",\"\"],\"link\":[\"https:\\/\\/marine.copernicus.eu\\/access-data\\/myocean-viewer\",\"https:\\/\\/maritim.bmkg.go.id\\/\",\"\",\"\",\"\"]}', NULL, NULL, '2022-06-09 10:37:30', NULL, NULL, '2'),
(21, 'column_2', 'isi', '{\"text\":[\"Konsentrasi Klorofil-a\",\"Suhu Permukaan Laut\",\"Tinggi Permukaan Laut\",\"Kecepatan Arus Laut\",\"Salinitas Air Laut\"],\"link\":[\"https:\\/\\/myocean.marine.copernicus.eu\\/data?view=viewer&crs=epsg:4326&t=1655211600000&z=0&center=97.75319,1.31479&zoom=15&layers=W3siaWQiOiJjMCIsImxheWVySWQiOiJHTE9CQUxfQU5BTFlTSVNfRk9SRUNBU1RfQklPXzAwMV8wMjgvZ2xvYmFsLWFuYWx5c2lzLWZvcmVjYXN0LWJpby0wMDEtMDI4LWRhaWx5L2NobCIsInpJbmRleCI6MCwibG9nU2NhbGUiOnRydWV9XQ==&initial=1\",\"https:\\/\\/myocean.marine.copernicus.eu\\/data?view=viewer&crs=epsg:4326&t=1655211600000&z=0&center=97.75319,1.31479&zoom=15&layers=W3siaWQiOiJjMCIsImxheWVySWQiOiJHTE9CQUxfQU5BTFlTSVNfRk9SRUNBU1RfUEhZXzAwMV8wMjQvZ2xvYmFsLWFuYWx5c2lzLWZvcmVjYXN0LXBoeS0wMDEtMDI0L3RoZXRhbyIsInpJbmRleCI6MTAsImxvZ1NjYWxlIjpmYWxzZX1d&initial=1\",\"https:\\/\\/myocean.marine.copernicus.eu\\/data?view=viewer&crs=epsg:4326&t=1655211600000&z=0&center=97.75319,1.31479&zoom=15&layers=W3siaWQiOiJjMCIsImxheWVySWQiOiJHTE9CQUxfQU5BTFlTSVNfRk9SRUNBU1RfUEhZXzAwMV8wMjQvZ2xvYmFsLWFuYWx5c2lzLWZvcmVjYXN0LXBoeS0wMDEtMDI0L3pvcyIsInpJbmRleCI6MjAsImxvZ1NjYWxlIjpmYWxzZX1d&initial=1\",\"https:\\/\\/myocean.marine.copernicus.eu\\/data?view=viewer&crs=epsg:4326&t=1655211600000&z=0&center=97.75319,1.31479&zoom=15&layers=W3siaWQiOiJjMCIsImxheWVySWQiOiJHTE9CQUxfQU5BTFlTSVNfRk9SRUNBU1RfUEhZXzAwMV8wMjQvZ2xvYmFsLWFuYWx5c2lzLWZvcmVjYXN0LXBoeS0wMDEtMDI0L3NlYV93YXRlcl92ZWxvY2l0eSIsInpJbmRleCI6MTAsImxvZ1NjYWxlIjpmYWxzZX1d&initial=1\",\"https:\\/\\/myocean.marine.copernicus.eu\\/data?view=viewer&crs=epsg:4326&t=1655211600000&z=0&center=97.75319,1.31479&zoom=15&layers=W3siaWQiOiJjMCIsImxheWVySWQiOiJHTE9CQUxfQU5BTFlTSVNfRk9SRUNBU1RfUEhZXzAwMV8wMjQvZ2xvYmFsLWFuYWx5c2lzLWZvcmVjYXN0LXBoeS0wMDEtMDI0L3NvIiwiekluZGV4IjoyMCwibG9nU2NhbGUiOmZhbHNlfV0=&initial=1\"]}', NULL, NULL, '2022-06-09 10:37:30', NULL, NULL, '2'),
(22, 'column_3', 'isi', NULL, NULL, NULL, '2021-11-16 09:32:09', NULL, NULL, NULL),
(23, 'general', 'site_footer', '© 2022 Fishmap - Find Fish In The Sea', NULL, NULL, '2022-06-11 14:34:05', NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `com_role`
--

CREATE TABLE `com_role` (
  `role_id` int(11) UNSIGNED NOT NULL,
  `portal_id` int(11) UNSIGNED DEFAULT NULL,
  `role_nm` varchar(50) DEFAULT NULL,
  `role_desc` varchar(100) DEFAULT NULL,
  `default_page` varchar(50) DEFAULT NULL,
  `mdb` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_role`
--

INSERT INTO `com_role` (`role_id`, `portal_id`, `role_nm`, `role_desc`, `default_page`, `mdb`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'Developer', '', 'home/adminwelcome', 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'Operator', 'Operator', 'dashboard', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'Contributor', 'Contributor', 'dashboard', NULL, NULL, '2021-10-14 10:00:11', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_role_menu`
--

CREATE TABLE `com_role_menu` (
  `role_id` int(11) UNSIGNED NOT NULL,
  `nav_id` int(11) UNSIGNED NOT NULL,
  `role_tp` varchar(4) NOT NULL DEFAULT '1111'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_role_menu`
--

INSERT INTO `com_role_menu` (`role_id`, `nav_id`, `role_tp`) VALUES
(1, 1, '1111'),
(1, 2, '1111'),
(1, 3, '1111'),
(1, 4, '1111'),
(1, 5, '1111'),
(1, 6, '1111'),
(1, 7, '1111'),
(1, 8, '1111'),
(1, 9, '1111'),
(2, 654, '1111'),
(3, 654, '1111'),
(2, 655, '1111'),
(2, 656, '1111'),
(3, 656, '1111'),
(2, 657, '1111'),
(2, 658, '1111'),
(2, 660, '1111'),
(2, 661, '1111'),
(2, 662, '1111'),
(2, 663, '1111'),
(2, 664, '1111'),
(2, 665, '1111'),
(2, 666, '1111'),
(2, 668, '1111'),
(2, 669, '1111'),
(2, 672, '1111'),
(3, 672, '1111'),
(2, 673, '1111'),
(2, 674, '1111'),
(2, 675, '1111'),
(2, 676, '1111'),
(2, 677, '1111'),
(2, 678, '1111'),
(2, 679, '1111'),
(2, 680, '1111'),
(2, 681, '1111'),
(2, 682, '1111'),
(2, 683, '1111'),
(2, 684, '1111'),
(2, 685, '1111'),
(2, 687, '1111'),
(2, 688, '1111'),
(2, 689, '1111'),
(2, 690, '1111'),
(2, 691, '1111');

-- --------------------------------------------------------

--
-- Table structure for table `com_role_user`
--

CREATE TABLE `com_role_user` (
  `role_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_role_user`
--

INSERT INTO `com_role_user` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `com_user`
--

CREATE TABLE `com_user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_key` varchar(50) DEFAULT NULL,
  `user_mail` varchar(50) DEFAULT NULL,
  `user_st` enum('admin','guru','siswa','staff') DEFAULT 'staff',
  `user_photo` varchar(255) DEFAULT NULL,
  `lock_st` enum('1','0') DEFAULT '0',
  `mdb` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_user`
--

INSERT INTO `com_user` (`user_id`, `user_name`, `user_pass`, `user_key`, `user_mail`, `user_st`, `user_photo`, `lock_st`, `mdb`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, 'userdemo', '$2y$10$8jCg4DLERr2ERF6NA8kmN.5zNoaoucSQWr4GI..owNa97UTKWvFGa', '1883219921', 'yayong.dk@excelindo.co.id', 'admin', NULL, '0', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'operator', '$2y$10$MrcGOY9TGTVldl6BCm3Tx.qfAoELF6DhyXZHNmawmBF7NRPhvpYOK', '3618023297', 'operator@gmail.com', 'staff', 'resource/doc/images/profil/no-profile-pic-icon-12.png', '0', 1, '2021-09-28 10:38:57', '2022-06-14 14:44:05', NULL, NULL, '2'),
(5, 'tesdev', '$2y$10$GZxmzOB8Avx6bTAcYXiwDuJ3zVJk7jPX4TJSeyB6.V3rtzcGsqm9C', NULL, 'operatordev@gmail.com', 'staff', NULL, '1', 2, '2021-12-14 10:04:07', '2022-06-14 20:15:42', NULL, 'operator', 'operator'),
(6, 'operator2', '$2y$10$pI5Te1vfhhBl049VOCV9OeJK0GJBq4sQ2jqYAaeTN8Otoln3uSZI6', NULL, 'operator2@gmail.com', 'staff', 'resource/doc/images/profil/A_-A_-Navis.jpg', '0', 5, '2021-12-14 10:07:54', '2021-12-14 10:15:51', NULL, 'tesdev', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_user_login`
--

CREATE TABLE `com_user_login` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `login_date` datetime NOT NULL,
  `logout_date` datetime DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_user_login`
--

INSERT INTO `com_user_login` (`user_id`, `login_date`, `logout_date`, `ip_address`) VALUES
(1, '2021-09-28 11:25:04', '2021-09-28 14:03:21', '::1'),
(1, '2021-09-30 10:40:35', '2021-09-30 11:49:08', '::1'),
(1, '2021-10-07 13:00:30', NULL, '::1'),
(1, '2021-10-13 17:12:47', NULL, '127.0.0.1'),
(1, '2021-10-14 09:58:51', '2021-10-14 11:13:33', '127.0.0.1'),
(1, '2021-10-26 08:43:40', NULL, '::1'),
(1, '2021-10-27 15:07:27', NULL, '::1'),
(1, '2021-10-28 22:02:11', NULL, '::1'),
(1, '2021-10-30 09:42:49', NULL, '::1'),
(1, '2021-11-02 10:02:39', NULL, '::1'),
(1, '2021-11-03 21:26:45', NULL, '127.0.0.1'),
(1, '2021-11-04 09:56:10', NULL, '127.0.0.1'),
(1, '2021-11-08 11:05:51', NULL, '127.0.0.1'),
(1, '2021-11-11 10:46:19', NULL, '::1'),
(1, '2021-11-15 11:09:06', '2021-11-15 12:06:32', '127.0.0.1'),
(1, '2021-11-16 08:15:12', NULL, '::1'),
(1, '2021-11-17 12:24:58', NULL, '::1'),
(1, '2021-11-19 10:12:17', '2021-11-19 10:16:08', '127.0.0.1'),
(1, '2021-11-24 14:27:53', NULL, '127.0.0.1'),
(1, '2021-12-04 09:32:48', NULL, '182.253.163.109'),
(1, '2021-12-07 10:35:30', NULL, '::1'),
(1, '2021-12-09 10:05:09', NULL, '127.0.0.1'),
(1, '2022-05-27 19:12:32', NULL, '::1'),
(1, '2022-05-29 14:30:17', NULL, '::1'),
(1, '2022-06-05 13:14:37', NULL, '::1'),
(1, '2022-06-07 12:34:15', NULL, '::1'),
(1, '2022-06-08 16:34:47', NULL, '::1'),
(1, '2022-06-11 12:24:08', NULL, '::1'),
(1, '2022-06-14 13:17:33', NULL, '116.206.31.39'),
(2, '2021-09-28 10:47:15', NULL, '::1'),
(2, '2021-09-30 10:36:47', NULL, '::1'),
(2, '2021-10-13 18:01:15', NULL, '::1'),
(2, '2021-10-14 07:54:50', NULL, '127.0.0.1'),
(2, '2021-10-15 08:10:52', NULL, '127.0.0.1'),
(2, '2021-10-16 07:09:42', NULL, '127.0.0.1'),
(2, '2021-10-17 09:39:34', NULL, '127.0.0.1'),
(2, '2021-10-18 14:41:16', NULL, '127.0.0.1'),
(2, '2021-10-19 08:49:58', NULL, '127.0.0.1'),
(2, '2021-10-22 14:36:26', NULL, '::1'),
(2, '2021-10-26 08:57:12', NULL, '127.0.0.1'),
(2, '2021-10-27 10:53:01', NULL, '127.0.0.1'),
(2, '2021-10-29 08:34:44', NULL, '::1'),
(2, '2021-11-01 10:47:32', NULL, '127.0.0.1'),
(2, '2021-11-02 08:50:53', NULL, '127.0.0.1'),
(2, '2021-11-03 09:50:53', NULL, '202.91.8.226'),
(2, '2021-11-04 09:53:46', NULL, '127.0.0.1'),
(2, '2021-11-05 09:45:40', NULL, '127.0.0.1'),
(2, '2021-11-08 08:35:51', NULL, '127.0.0.1'),
(2, '2021-11-09 08:05:59', NULL, '127.0.0.1'),
(2, '2021-11-10 10:17:17', NULL, '127.0.0.1'),
(2, '2021-11-11 09:02:31', NULL, '127.0.0.1'),
(2, '2021-11-15 10:17:55', NULL, '127.0.0.1'),
(2, '2021-11-16 08:13:08', NULL, '::1'),
(2, '2021-11-17 08:14:37', NULL, '127.0.0.1'),
(2, '2021-11-18 08:36:23', NULL, '202.91.8.226'),
(2, '2021-11-19 08:54:57', NULL, '202.91.8.226'),
(2, '2021-11-21 18:48:56', NULL, '180.214.246.34'),
(2, '2021-11-22 08:01:01', NULL, '36.72.255.33'),
(2, '2021-11-23 07:42:33', NULL, '114.10.10.30'),
(2, '2021-11-24 06:40:15', NULL, '182.2.36.176'),
(2, '2021-11-25 08:21:03', NULL, '202.91.8.226'),
(2, '2021-11-26 05:48:48', NULL, '::1'),
(2, '2021-11-29 08:30:16', NULL, '202.91.8.226'),
(2, '2021-11-30 09:59:58', NULL, '202.91.8.226'),
(2, '2021-12-01 10:38:31', NULL, '202.91.8.226'),
(2, '2021-12-02 10:16:57', NULL, '202.91.8.226'),
(2, '2021-12-06 12:01:49', NULL, '202.91.8.226'),
(2, '2021-12-07 09:04:41', NULL, '127.0.0.1'),
(2, '2021-12-08 07:59:47', NULL, '103.83.176.154'),
(2, '2021-12-09 08:00:57', NULL, '114.142.168.49'),
(2, '2021-12-10 09:03:01', NULL, '182.253.163.109'),
(2, '2021-12-11 16:12:37', NULL, '182.253.163.109'),
(2, '2021-12-13 09:09:07', NULL, '202.91.8.226'),
(2, '2021-12-14 08:39:57', NULL, '202.91.8.226'),
(2, '2021-12-15 08:33:58', NULL, '202.91.8.226'),
(2, '2021-12-16 10:52:19', NULL, '202.91.8.226'),
(2, '2021-12-17 09:00:33', NULL, '182.253.163.109'),
(2, '2021-12-18 16:10:44', NULL, '182.253.163.108'),
(2, '2021-12-20 13:46:27', NULL, '202.91.8.226'),
(2, '2021-12-21 09:28:18', NULL, '182.253.163.104'),
(2, '2021-12-22 11:28:20', NULL, '202.91.8.226'),
(2, '2021-12-23 05:31:24', NULL, '182.253.163.106'),
(2, '2021-12-24 10:59:28', NULL, '182.253.163.105'),
(2, '2021-12-27 08:55:11', NULL, '182.253.163.108'),
(2, '2022-05-26 16:25:42', NULL, '::1'),
(2, '2022-05-27 18:56:00', NULL, '::1'),
(2, '2022-05-29 14:31:40', NULL, '::1'),
(2, '2022-05-30 11:26:27', NULL, '::1'),
(2, '2022-05-31 12:53:00', NULL, '::1'),
(2, '2022-06-03 13:45:33', NULL, '::1'),
(2, '2022-06-04 20:40:18', NULL, '::1'),
(2, '2022-06-05 13:13:54', NULL, '::1'),
(2, '2022-06-06 10:02:42', NULL, '::1'),
(2, '2022-06-07 08:49:40', NULL, '::1'),
(2, '2022-06-08 12:51:33', NULL, '::1'),
(2, '2022-06-09 09:41:59', NULL, '::1'),
(2, '2022-06-10 09:09:27', NULL, '::1'),
(2, '2022-06-11 06:23:13', NULL, '::1'),
(2, '2022-06-13 14:13:45', NULL, '116.206.31.61'),
(2, '2022-06-14 05:57:51', NULL, '116.206.31.40'),
(2, '2022-06-15 08:11:19', NULL, '116.206.38.45'),
(5, '2021-12-14 10:06:23', NULL, '202.91.8.226'),
(6, '2021-12-14 10:08:14', NULL, '202.91.8.226');

-- --------------------------------------------------------

--
-- Table structure for table `com_user_super`
--

CREATE TABLE `com_user_super` (
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_user_super`
--

INSERT INTO `com_user_super` (`user_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_file`
--

CREATE TABLE `dokumen_file` (
  `doc_id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `doc_title` varchar(255) DEFAULT NULL,
  `doc_year` char(4) DEFAULT NULL,
  `doc_month` varchar(11) DEFAULT NULL,
  `doc_type` varchar(30) DEFAULT NULL,
  `doc_file` varchar(255) DEFAULT NULL,
  `doc_desc` longtext DEFAULT NULL,
  `doc_active` enum('1','0') DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen_file`
--

INSERT INTO `dokumen_file` (`doc_id`, `cat_id`, `doc_title`, `doc_year`, `doc_month`, `doc_type`, `doc_file`, `doc_desc`, `doc_active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(18, 1, 'klorofila_04_2022', '2022', '04', 'csv', 'resource/doc/dataklorofil.csv', '', '1', '2022-06-05 14:47:54', '2022-06-07 18:42:29', NULL, 'operator', NULL, NULL),
(19, 3, 'Suhu Permukaan Laut', '2022', '04', 'csv', 'resource/doc/dataspl.csv', '', '1', '2022-06-07 13:02:25', '2022-06-07 18:34:46', NULL, 'operator', NULL, NULL),
(20, 4, 'Tinggi Permukaan Laut', '2022', '04', 'csv', 'resource/doc/datatpl.csv', '', '1', '2022-06-07 13:03:30', '2022-06-07 18:34:54', NULL, 'operator', NULL, NULL),
(21, 12, 'Kecepatan Arus Laut', '2022', '04', 'csv', 'resource/doc/dataarus.csv', '', '1', '2022-06-07 13:03:56', '2022-06-07 18:35:00', NULL, 'operator', NULL, NULL),
(23, 1, 'klorofila_05_2022', '2022', '05', 'csv', 'resource/doc/dataklorofil2.csv', '', '0', '2022-06-07 18:32:46', '2022-06-07 18:42:24', NULL, 'operator', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_kategori`
--

CREATE TABLE `dokumen_kategori` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) DEFAULT NULL,
  `cat_desc` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen_kategori`
--

INSERT INTO `dokumen_kategori` (`cat_id`, `cat_title`, `cat_desc`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Konsentrasi Klorofil-a', 'Klorofil-a adalah suatu pigmen aktif dalam sel tumbuhan yang mempunyai peranan penting dalam berlangsungnya proses fotosintesis di perairan yang dapat digunakan sebagai indikator banyak atau tidaknya ikan di suatu wilayah dari gambaran siklus rantai makanan yang terjadi di lautan.', '2021-10-26 04:00:03', '2022-06-05 13:19:03', NULL, 'operator', 'operator', NULL),
(3, 'Suhu Permukaan Laut', 'Suhu permukaan dapat diartikan sebagai suhu bagian terluar dari suatu objek. sedangkan untuk vegetasi dapat dipandang sebagai suhu permukaan kanopi tumbuhan, dan pada tubuh air merupakan suhu dari permukaan air tersebut. Pada saat permukaan suatu benda menyerap radiasi, suhu permukaannya belum tentu sama.', '2021-11-08 14:40:06', '2022-06-05 13:19:39', NULL, 'operator', 'operator', NULL),
(4, 'Tinggi Permukaan Laut', 'Tinggi muka laut atau yang biasa disebut sebagai topografi permukaan laut merupakan representatif jarak antara permukaan air laut dengan referensi elipsoid bumi yang biasa disebut dengan goid.', '2021-11-09 13:45:30', '2022-06-05 13:20:22', NULL, 'operator', 'operator', NULL),
(12, 'Kecepatan Arus Laut', 'Arus air laut adalah pergerakan massa air secara vertikal dan horisontal sehingga menuju keseimbangannya, atau gerakan air yang sangat luas yang terjadi di seluruh lautan dunia. Arus juga merupakan gerakan mengalir suatu massa air yang dikarenakan tiupan angin atau perbedaan densitas atau pergerakan gelombang panjang.', '2022-06-05 13:18:18', '2022-06-07 13:04:06', NULL, 'operator', 'operator', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_album`
--

CREATE TABLE `gallery_album` (
  `album_id` bigint(20) UNSIGNED NOT NULL,
  `album_title` varchar(255) DEFAULT NULL,
  `album_note` varchar(255) DEFAULT NULL,
  `album_type` enum('video','image','lks') DEFAULT 'image',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_album`
--

INSERT INTO `gallery_album` (`album_id`, `album_title`, `album_note`, `album_type`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(28, 'Pulau Mursala', 'Pulau Mursala merupakan salah satu pulau yang berada di Samudra Hindia. Pulau ini berada di sisi barat Pulau Sumatra. Secara administrasi, Pulau Mursala merupakan pulau terbesar yang terletak di Tapanuli Tengah, Provinsi Sumatra Utara, Indonesia.', 'image', '2022-06-08 21:45:51', '2022-06-09 16:56:51', NULL, 'operator', 'operator', NULL),
(29, 'Pulau Putri', 'Pulau Putri merupakan sebuah pulau kecil yang berada dalam wilayah Tapian Nauli, Kabupaten Tapanuli Tengah. Untuk ke pulau ini, dapat menggunakan perahu dari Pelabuhan Sibolga dengan waktu tempuh sekitar 1 jam.', 'image', '2022-06-09 17:00:01', NULL, NULL, 'operator', NULL, NULL),
(30, 'Ikan kerapu', 'Kerapu adalah ikan anggota sejumlah genus dalam anaksuku Epinephelinae, suku Serranidae dalam seri Perciformes.', 'image', '2022-06-09 17:05:32', '2022-06-09 17:11:40', NULL, 'operator', 'operator', NULL),
(31, 'Ikan Tuna', 'Tuna adalah ikan laut pelagik yang termasuk bangsa Thunnini, terdiri dari beberapa spesies dari famili skombride, terutama genus Thunnus. Ikan ini adalah perenang andal.', 'image', '2022-06-09 17:13:11', NULL, NULL, 'operator', NULL, NULL),
(32, 'Nelayan', 'Menangkap ikan atau biota lainnya yang hidup di dasar, kolom maupun permukaan perairan disekitar peiran Teluk Tapian Nauli.', 'image', '2022-06-09 17:22:21', NULL, NULL, 'operator', NULL, NULL),
(33, 'Pelabuhan', 'Fasilitas untuk menerima kapal dan memindahkan barang kargo maupun penumpang ke dalamnya. Pelabuhan biasanya memiliki alat-alat yang dirancang khusus untuk memuat dan membongkar muatan kapal-kapal yang berlabuh.', 'video', '2022-06-09 17:25:36', NULL, NULL, 'operator', NULL, NULL),
(34, 'Pulau', 'Tanah atau daratan yang dikelilingi air dengan luas lebih kecil dari benua dan lebih besar dari terumbu karang.', 'video', '2022-06-09 18:19:18', NULL, NULL, 'operator', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_files`
--

CREATE TABLE `gallery_files` (
  `file_id` bigint(20) UNSIGNED NOT NULL,
  `album_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_type` enum('image','video') DEFAULT NULL,
  `file_desc` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_files`
--

INSERT INTO `gallery_files` (`file_id`, `album_id`, `file_type`, `file_desc`, `file_path`, `file_url`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(32, 28, 'image', 'Lorem', 'resource/doc/download_(2).jpg', NULL, '2022-06-08 21:46:15', NULL, '2022-06-09 16:55:47', 'operator', NULL, NULL),
(33, 28, 'image', 'Airi terjun Pulau Mursala', 'resource/doc/m1.jpg', NULL, '2022-06-09 16:55:41', NULL, '2022-06-09 16:56:22', 'operator', NULL, NULL),
(34, 28, 'image', 'Air terjun Pulau Mursala', 'resource/doc/m2.jpg', NULL, '2022-06-09 16:56:16', NULL, NULL, 'operator', NULL, NULL),
(35, 28, 'image', 'Air terjun Pulau Mursala', 'resource/doc/m3.jpg', NULL, '2022-06-09 16:56:37', NULL, NULL, 'operator', NULL, NULL),
(36, 28, 'image', 'Air terjun Pulau Mursala', 'resource/doc/m4.jpg', NULL, '2022-06-09 16:56:48', NULL, NULL, 'operator', NULL, NULL),
(37, 29, 'image', 'Dermaga Pulau Putri', 'resource/doc/p1.jpg', NULL, '2022-06-09 17:00:23', NULL, NULL, 'operator', NULL, NULL),
(38, 29, 'image', 'Dermaga Pulau Putri', 'resource/doc/p2.jpg', NULL, '2022-06-09 17:00:38', NULL, NULL, 'operator', NULL, NULL),
(39, 29, 'image', 'Dermaga Pulau Putri', 'resource/doc/p3.jpg', NULL, '2022-06-09 17:00:48', NULL, NULL, 'operator', NULL, NULL),
(40, 30, 'image', 'Kerapu bebek atau kerapu tikus (Chromileptes altivelis) adalah jenis ikan dari keluarga Serranidae. Habitat alaminya adalah karang laguna pantai. Jenis ini terancam kehilangan habitatnya.', 'resource/doc/kerapu_bebek.jpg', NULL, '2022-06-09 17:07:02', NULL, NULL, 'operator', NULL, NULL),
(41, 30, 'image', 'Kerapu macan (Epinephelus fuscoguttatus) menghuni perairan Indo-Pasifik yang berstatus terancam punah karena rusaknya habitat. Ikan ini dapat mencapai lebih dari 2 m.', 'resource/doc/macan.jpg', NULL, '2022-06-09 17:10:36', NULL, NULL, 'operator', NULL, NULL),
(42, 30, 'image', 'Kerapu Sunu adalah jenis ikan karang yang biasa hidup pada kedalaman 3 sampai 300 m dibawah permukaan air laut. Ikan ini bisa mencapai panjang 50 cm setelah berumur 5 tahun dan merupakan jenis hermaphrodite protogini.', 'resource/doc/kerapu_sunu.jpg', NULL, '2022-06-09 17:11:34', NULL, NULL, 'operator', NULL, NULL),
(43, 31, 'image', 'Ikan Tongkol Abu-Abu (Thunnus Tonggol), memiliki badan yang ramping bila dibandingkan dengan ikan tuna jenis lainnya. Selain itu, ikan tongkol abu-abu memiliki sirip dada yang pendek', 'resource/doc/tongkol-abu.jpg', NULL, '2022-06-09 17:15:24', NULL, NULL, 'operator', NULL, NULL),
(44, 31, 'image', 'Madidihang (Tuna Sirip Kuning – Yellowfin Tuna), memiliki bentuk tubuh seperti terpadu dan juga ukuran panjangnya sekitar 150 cm.', 'resource/doc/tuna-sirip-kuningg.jpg', NULL, '2022-06-09 17:16:06', NULL, NULL, 'operator', NULL, NULL),
(45, 31, 'image', 'Ikan Cakalang (Katsuwonus pelamis), memiliki panjang tubuh sampai 1 m dengan berat lebih dari 18 kg. Cakalang yang banyak tertangkap berukuran panjang sekitar 50 cm.', 'resource/doc/Katsuwonus_pelamis.png', NULL, '2022-06-09 17:18:22', NULL, NULL, 'operator', NULL, NULL),
(46, 32, 'image', 'Kegiatan nelayan Sibolga', 'resource/doc/images_(1).jpg', NULL, '2022-06-09 17:22:54', '2022-06-09 17:23:32', NULL, 'operator', 'operator', NULL),
(47, 32, 'image', 'Dermaga', 'resource/doc/download.jpg', NULL, '2022-06-09 17:23:08', NULL, NULL, 'operator', NULL, NULL),
(48, 32, 'image', 'Kampung nelayan', 'resource/doc/download_(1).jpg', NULL, '2022-06-09 17:23:25', NULL, NULL, 'operator', NULL, NULL),
(49, 33, 'video', 'Pengembangan Pelabuhan Sibolga', 's85SRP8Np2U', 'https://www.youtube.com/watch?v=s85SRP8Np2U', '2022-06-09 17:26:13', '2022-06-09 18:10:21', NULL, 'operator', 'operator', NULL),
(50, 33, 'video', 'Pulau Mursala Tapteng', 'vM5a28EN6YM', 'https://www.youtube.com/watch?v=vM5a28EN6YM', '2022-06-09 17:30:40', '2022-06-09 18:10:54', '2022-06-09 18:20:38', 'operator', 'operator', NULL),
(51, 33, 'video', 'Pulau Kalimantung Sibolga-Tapanuli Tengah', NULL, 'https://www.youtube.com/watch?v=s_TshqDYh_o', '2022-06-09 18:18:17', NULL, '2022-06-09 18:20:45', 'operator', NULL, NULL),
(52, 34, 'video', 'Pulau Mursala Tapteng', NULL, 'https://www.youtube.com/watch?v=vM5a28EN6YM', '2022-06-09 18:19:58', NULL, NULL, 'operator', NULL, NULL),
(53, 34, 'video', 'Pulau Kalimantung Sibolga-Tapanuli Tengah', NULL, 'https://www.youtube.com/watch?v=s_TshqDYh_o', '2022-06-09 18:20:22', NULL, NULL, 'operator', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `layanan_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL,
  `layanan_active` enum('1','0') DEFAULT '0',
  `position` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`layanan_id`, `title`, `desc`, `url`, `icon`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `layanan_active`, `position`) VALUES
(3, 'Konsentrasi Fitoplankton', 'Fitoplankton adalah tumbuhan air dengan ukuran yang mirko serta hidup melayang air. Fitoplankton berperan dalam ekosistem perairan yang mana memiliki peran yang sama pentingnya dengan peranan tumbuhan hijau yang tingkatannya lebih tinggi di ekosistem dara', 'https://tinyurl.com/24kkdltj', 'resource/doc/images/icon-fito.png', '2021-11-18 06:51:32', '2022-06-07 11:36:42', NULL, 'operator', 'operator', NULL, '1', 2),
(11, 'Salinitas Air Laut', 'Salinitas atau Keasinan adalah tingkat keasinan atau kadar garam terlarut dalam air. Salinitas juga dapat mengacu pada kandungan garam dalam tanah.', 'https://tinyurl.com/2cxyu865', 'resource/doc/images/icon-rumahpusbin_-_Copy.png', '2021-11-18 07:29:47', '2022-06-07 11:06:25', NULL, 'operator', 'operator', NULL, '1', 1),
(12, 'Kecepatan Arus Laut', 'Arus air laut adalah pergerakan massa air secara vertikal dan horisontal sehingga menuju keseimbangannya, atau gerakan air yang sangat luas yang terjadi di seluruh lautan dunia. Arus juga merupakan gerakan mengalir suatu massa air yang dikarenakan tiupan ', 'https://tinyurl.com/263tnejx', 'resource/doc/images/icon-ukbi_-_Copy.png', '2021-11-18 07:31:55', '2022-06-07 10:58:30', NULL, 'operator', 'operator', NULL, '1', 3),
(13, 'Tinggi Permukaan Laut', 'Tinggi muka laut atau yang biasa disebut sebagai topografi permukaan laut merupakan representatif jarak antara permukaan air laut dengan referensi elipsoid bumi yang biasa disebut dengan goid.', 'https://tinyurl.com/23cvjvp5', 'resource/doc/images/icon-spai_-_Copy.png', '2021-11-18 07:33:34', '2022-06-07 10:50:58', NULL, 'operator', 'operator', NULL, '1', 4),
(14, 'Suhu Permukaan Laut', 'Suhu permukaan dapat diartikan sebagai suhu bagian terluar dari suatu objek. sedangkan untuk vegetasi dapat dipandang sebagai suhu permukaan kanopi tumbuhan, dan pada tubuh air merupakan suhu dari permukaan air tersebut. Pada saat permukaan suatu benda me', 'https://tinyurl.com/2azjv6fr', 'resource/doc/images/icon-whistle_-_Copy.png', '2021-11-18 07:36:45', '2022-06-07 10:35:23', NULL, 'operator', 'operator', NULL, '1', 5),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 15),
(18, 'Konsentrasi Klorofil-a', 'Klorofil-a adalah suatu pigmen aktif dalam sel tumbuhan yang mempunyai peranan penting dalam berlangsungnya proses fotosintesis di perairan yang dapat digunakan sebagai indikator banyak atau tidaknya ikan di suatu wilayah dari gambaran siklus rantai makan', 'https://tinyurl.com/2c6hjzk2', 'resource/doc/images/icon-lab_-_Copy.png', '2022-06-07 10:08:19', '2022-06-07 10:23:01', NULL, 'operator', 'operator', NULL, '1', 6);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `url`, `position`, `group_id`) VALUES
(1, 0, 'Beranda', '', 1, 1),
(2, 0, 'Tentang Kami', '#', 2, 1),
(3, 0, 'Informasi', '#', 3, 1),
(4, 0, 'Layanan', 'layanan', 5, 1),
(6, 0, 'Galeri', '#', 7, 1),
(7, 2, 'Profil Organisasi', 'profil-organisasi', 1, 1),
(8, 2, 'Sejarah', 'sejarah', 2, 1),
(10, 0, 'Data', 'data', 4, 1),
(13, 3, 'Berita', 'berita', 2, 1),
(14, 3, 'Artikel', 'artikel', 1, 1),
(24, 0, 'Prediksi', 'prediksi', 6, 1),
(17, 6, 'Galeri Foto', 'galeri-album/foto', 1, 1),
(18, 6, 'Galeri Video', 'galeri-album/video', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`id`, `title`) VALUES
(1, 'Main Menu');

-- --------------------------------------------------------

--
-- Table structure for table `popup`
--

CREATE TABLE `popup` (
  `id` int(11) NOT NULL,
  `text` text DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `is_active` enum('1','0') DEFAULT '0',
  `alamat_tautan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `popup`
--

INSERT INTO `popup` (`id`, `text`, `title`, `img`, `is_active`, `alamat_tautan`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'tes nama popup', 'tes nama popup', 'resource/doc/images/popup2.png', '0', 'https://nuxtjs.org/', '2021-11-22 08:16:10', '2022-06-09 11:30:18', NULL, 'operator', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `popup_layanan`
--

CREATE TABLE `popup_layanan` (
  `pop_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `alamat_tautan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(225) NOT NULL,
  `deleted_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `popup_layanan`
--

INSERT INTO `popup_layanan` (`pop_id`, `id`, `name`, `photo`, `alamat_tautan`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 1, 'Next Js', 'resource/doc/images/icon-petabahasa3.png', 'https://nextjs.org/', '2021-11-19 14:34:47', '2021-12-09 04:26:17', '2022-06-14 14:16:34', '', 'operator', ''),
(2, 1, 'Nuxt js', 'resource/doc/images/icon-rumahpusbin6.png', 'https://nuxtjs.org/', '2021-11-19 14:38:03', '2021-12-13 13:56:50', '2022-06-14 14:16:39', '', 'operator', ''),
(6, 1, 'React js', 'resource/doc/images/icon-rumahpusbin2.png', 'https://reactjs.org/', '2021-12-09 04:27:04', NULL, '2022-06-14 14:16:42', 'operator', '', ''),
(10, 1, 'testing', 'resource/doc/images/amikom_logo20.png', 'https://www.google.com/', '2021-12-22 13:35:37', NULL, '2022-06-14 14:16:45', 'operator', '', ''),
(11, 1, 'Popup', 'resource/doc/images/popup1.png', 'https://www.google.com', '2022-06-14 17:35:27', NULL, NULL, 'operator', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_author` varchar(100) DEFAULT NULL,
  `post_content` longtext DEFAULT NULL,
  `post_title` text DEFAULT NULL,
  `post_status` enum('publish','draft') DEFAULT 'draft',
  `post_parent` bigint(20) UNSIGNED DEFAULT NULL,
  `post_link` varchar(255) DEFAULT NULL,
  `post_order` int(11) DEFAULT NULL,
  `post_type` enum('post','page','attachment') DEFAULT 'post',
  `post_category` varchar(100) DEFAULT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `photo_penulis` varchar(255) DEFAULT NULL,
  `name_penulis` varchar(255) DEFAULT NULL,
  `profile_penulis` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL,
  `counter` int(10) UNSIGNED DEFAULT NULL,
  `tags` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_date`, `post_author`, `post_content`, `post_title`, `post_status`, `post_parent`, `post_link`, `post_order`, `post_type`, `post_category`, `post_image`, `photo_penulis`, `name_penulis`, `profile_penulis`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `counter`, `tags`) VALUES
(3, '2021-10-27 14:32:00', 'operator', '&lt;h5&gt;&lt;span xss=&quot;removed&quot;&gt;LATAR BELAKANG&lt;/span&gt;&lt;/h5&gt;&lt;hr xss=&quot;removed&quot;&gt;&lt;div id=&quot;Content&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;bannerL&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;div-gpt-ad-1474537762122-2&quot; data-google-query-id=&quot;CPC3ou6goPgCFW2LSwUdWecLGg&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;google_ads_iframe_/15188745,22440292294/Lipsum-Unit3_0__container__&quot; xss=&quot;removed&quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div id=&quot;bannerR&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;div-gpt-ad-1474537762122-3&quot; data-google-query-id=&quot;CPG3ou6goPgCFW2LSwUdWecLGg&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;google_ads_iframe_/15188745,22440292294/Lipsum-Unit4_0__container__&quot; xss=&quot;removed&quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;boxed&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;lipsum&quot; xss=&quot;removed&quot;&gt;&lt;p xss=&quot;removed&quot;&gt;Kota Sibolga merupakan salah satu kota di Provinsi Sumatera Utara yang\r\nberada di pantai barat Pulau Sumatera pada kawasan Teluk Tapian Nauli.\r\nWilayah Kota Sibolga berbatasan dengan Kabupaten Tapanuli Tengah di\r\nsebelah utara, timur, dan selatan serta Teluk Tapian Nauli di sebelah barat.\r\nPotensi utama perekonomian Kota Sibolga dan Kabupaten Tapanuli Tengah\r\nbersumber dari sektor perikanan dan industri maritim. Hal tersebut\r\ndipengaruhi oleh sebagian besar penduduknya yang bermatapencaharian\r\nsebagai nelayan.\r\n&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Berdasarkan hasil Laporan Tahunan Statistik Perikanan Pelabuhan\r\nPerikanan Nusantara Sibolga, terjadi penurunan total volume produksi ikan\r\nyang didaratkan di Kota Sibolga dan Kabupaten Tapanuli Tengah dari tahun\r\n2018 hingga 2021. Penurunan produksi ikan tersebut disebabkan oleh\r\nberbagai faktor, di antaranya seperti penurunan kualitas perairan, aktivitas\r\npenangkapan yang berlebihan dan pola penangkapan ikan yang merusak.\r\nSelain itu, proses penangkapan ikan di daerah tersebut masih berupa naluri\r\nnelayan tanpa didasari dengan data dan informasi yang valid.\r\n&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Berdasarkan penjelasan tersebut, kami ingin mengimplementasikan metode\r\nK-Means Clustering dalam sebuah sistem untuk memprediksi daerah\r\npotensial penangkapan ikan di perairan Teluk Tapian Nauli dengan\r\nbeberapa parameter berdasarkan anomali tinggi permukaan laut, kecepatan\r\narus laut, suhu permukaan laut, dan konsentrasi klorofil. Data hasil masingmasing parameter digabungkan menjadi satu, lalu akan diproses dengan\r\nmenggunakan metode K-Means Clustering sehingga hasil clustering akan\r\nmenampilkan peta daerah potensial penangkapan ikan.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', 'Profil Organisasi', 'publish', 0, NULL, 3, 'page', 'halaman', NULL, NULL, NULL, NULL, '2021-10-27 14:32:38', '2022-06-15 01:57:42', NULL, 'operator', '1', NULL, 911, NULL),
(7, '2021-11-01 11:59:00', 'operator', '&lt;div class=&quot;post-content&quot;&gt;\r\n&lt;h5&gt;&lt;span xss=&quot;removed&quot;&gt;PROSES PELAKSANAAN PROYEK AKHIR&lt;/span&gt;&lt;/h5&gt;&lt;hr xss=&quot;removed&quot;&gt;&lt;div id=&quot;Content&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;bannerL&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;div-gpt-ad-1474537762122-2&quot; data-google-query-id=&quot;CPC3ou6goPgCFW2LSwUdWecLGg&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;google_ads_iframe_/15188745,22440292294/Lipsum-Unit3_0__container__&quot; xss=&quot;removed&quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div id=&quot;bannerR&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;div-gpt-ad-1474537762122-3&quot; data-google-query-id=&quot;CPG3ou6goPgCFW2LSwUdWecLGg&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;google_ads_iframe_/15188745,22440292294/Lipsum-Unit4_0__container__&quot; xss=&quot;removed&quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;boxed&quot; xss=&quot;removed&quot;&gt;&lt;div id=&quot;lipsum&quot; xss=&quot;removed&quot;&gt;&lt;p xss=&quot;removed&quot;&gt;Dalam proses pelaksanaan proyek\r\nakhir yaitu sistem prediksi daerah\r\npotensial penangkapan ikan di\r\nperairan Teluk Tapian Nauli dengan\r\nmetode K-Means Clustering didasari\r\npada langkah-langkah AI Project Cycle\r\nyang harus dilakukan antara lain:&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;&lt;b&gt;Problem Scoping&lt;/b&gt;&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Dasar masalah yang dihadapi oleh nelayan dalam kegiatan penangkapan ikan\r\nkhususnya di perairan Teluk Tapian Nauli. Hal ini dikarenakan keterbatasan\r\npengetahuan nelayan terkait titik pusat wilayah yang terdapat banyak ikan.\r\nOleh karena itu, pada proyek akhir ini berniat menyediakan platform untuk\r\nmempermudah nelayan dalam memprediksi wilayah penangkapan ikan sesuai\r\ndengan spesifikasi yang diinginkan oleh pengguna.&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;&lt;b&gt;Data Acquisition&lt;/b&gt;&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Proses akuisisi data yang dilakukan dalam proyek akhir ini menggunakan web\r\nscraping melalui website MyOcean Viewer dan diproses di Ocean Data View\r\nyang terdiri dari:\r\n&lt;/p&gt;&lt;ol&gt;&lt;li&gt;Mass Concentration of Chlorophyll a in Sea Water.xls (Konsentrasi Klorofil)&lt;/li&gt;&lt;li&gt;Sea Surface Height Above Geoid.xls (Tinggi permukaan laut)&lt;/li&gt;&lt;li&gt;Sea Water Velocity.xls (Kecepatan arus laut) &lt;/li&gt;&lt;li&gt;Sea Water Potential Temperature (Suhu permukaan laut)&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;&lt;b&gt;Data Exploration&lt;/b&gt;&lt;/p&gt;&lt;p&gt;Proses eksplorasi data yang dilakukan dari menyatukan empat dataset\r\nyang sudah didapatkan menjadi satu dataset untuk mempermudah\r\npengklasifikasian. Selain itu, juga untuk mendapatkan data terbaik\r\ndilakukan penghapusan beberapa baris data yang bernilai “NA” atau\r\ntidak memiliki nilai. Oleh karena itu, data ini terdiri 6 variabel yang\r\ndigunakan untuk diteliti yaitu klorofil, kedalaman laut, tinggi permukaan\r\nlaut, suhu permukaan laut, arus laut arah x, dan arus arah Y.&lt;/p&gt;&lt;p&gt;&lt;b&gt;Modelling\r\n&lt;/b&gt;&lt;/p&gt;&lt;p&gt;Dalam kegiatan proyek akhir ini menggunakan\r\nalgoritma K-Means Clustering sehingga didapatkan\r\ncluster. Cluster yang dipilih adalah cluster 6 karena\r\nmemiliki nilai akurasi tertinggi dengan titik pusat\r\nyang terbaik, di mana pada cluster ini terdapat enam\r\nwarna berbeda dalam penentuan wilayah berpotensi\r\nbanyak ikan dengan tingkat potensi yang berbedabeda.&lt;/p&gt;&lt;p&gt;&lt;b&gt;Evaluation&lt;/b&gt;&lt;/p&gt;&lt;p&gt;Pada proses clustering menggunakan K-Means dengan parameter yang digunakan\r\nialah penentuan jumlah cluster (k). Parameter ini akan berpengaruh pada\r\npenentuan centroid hingga pada penentuan anggota cluster. Pengujian hasil\r\nclustering menggunakan metode Silhouette Coefficient dilakukan dengan jumlah\r\ncluster k = 6. Dari hasil proses perhitungan Silhouette Coefficient terhadap\r\nkeseluruhan data, maka hasil Silhouette Coefficient pada saat k = 6 dengan nilai\r\nSilhouette Coefficient sebesar 0.8896 atau 88,96%. Nilai Silhouette Coefficient\r\nuntuk cluster.&lt;br&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;\r\n&lt;/div&gt;', 'Sejarah', 'publish', 0, NULL, 7, 'page', 'halaman', NULL, NULL, NULL, NULL, '2021-11-01 11:59:10', '2022-06-14 13:44:54', NULL, 'operator', '1', NULL, 762, NULL),
(75, '2022-06-03 08:18:00', 'operator', '&lt;p class=&quot;rtejustify&quot; xss=&quot;removed&quot;&gt;&lt;span xss=removed&gt;Jika seseorang bertanya kepada Anda apa warna laut, kemungkinan besar Anda akan menjawab bahwa itu biru. Untuk sebagian besar Samudra di dunia, jawaban Anda pasti benar.&lt;/span&gt;&lt;br xss=removed&gt;&lt;/p&gt;&lt;p class=&quot;rtejustify&quot; xss=&quot;removed&quot;&gt;&lt;span xss=removed&gt;Tetapi jika airnya sangat dalam sehingga tidak ada pantulan di dasar laut, air tersebut tampak seperti biru tua yang sangat gelap.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Lautan berwarna biru karena air menyerap warna di bagian merah spektrum cahaya. Seperti filter yang meninggalkan warna di bagian biru spektrum cahaya.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Melansir Ocean Service, laut juga dapat berubah menjadi hijau, merah, atau warna lainnya saat cahaya memantul dari sedimen dan partikel yang mengapung di air.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Mengutip laman resmi NASA, di air, penyerapan kuat di warna merah dan lemah di warna biru, sehingga cahaya merah diserap dengan cepat di lautan dan menyisakan warna biru.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Hampir semua sinar Matahari yang masuk ke laut terserap. Panjang gelombang merah, kuning, dan hijau sinar matahari diserap oleh molekul air di lautan.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Ketika sinar Matahari \'menghantam\' lautan, sebagian cahaya dipantulkan kembali secara langsung tetapi sebagian besar menembus permukaan laut dan berinteraksi dengan molekul air yang ditemuinya.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Panjang gelombang cahaya merah, oranye, kuning, dan hijau diserap sehingga sisa cahaya yang kita lihat terdiri dari biru dan violet dengan panjang gelombang yang lebih pendek.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Di daerah pesisir, limpasan dari sungai, resuspensi pasir dan lumpur, gelombang dan badai serta sejumlah zat lainnya dapat mengubah warna perairan dekat pantai.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Beberapa jenis partikel seperti sel fitoplankton atau alga juga dapat mengandung zat yang menyerap panjang gelombang cahaya tertentu. Zat penyerap cahaya terpenting di lautan adalah klorofil yang digunakan fitoplankton untuk menghasilkan karbon melalui fotosintesis.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Pasalnya, pigmen hijau ini secara istimewa menyerap bagian merah dan biru dari spektrum cahaya (untuk fotosintesis) dan memantulkan cahaya hijau.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Jadi, lautan di atas wilayah dengan konsentrasi fitoplankton yang tinggi akan tampak dalam corak-corak tertentu dari biru-hijau hingga hijau, bergantung pada jenis dan kepadatan populasi fitoplankton di sana.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Prinsip dasar di balik penginderaan jauh warna lautan adalah semakin banyak fitoplankton di dalam air maka akan semakin hijau dan semakin sedikit fitoplankton, semakin biru warnanya.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Ada zat lain yang mungkin ditemukan terlarut dalam air yang juga dapat menyerap cahaya karena zat ini biasanya terdiri dari karbon organik, para peneliti umumnya menyebut zat ini sebagai bahan organik terlarut berwarna, disingkat CDOM (Colored Dissolved Organic Matter).&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Studi tentang warna laut membantu para ilmuwan mendapatkan pemahaman yang lebih baik tentang fitoplankton dan dampaknya terhadap sistem Bumi. Organisme kecil ini dapat memengaruhi sistem dalam skala yang sangat besar seperti perubahan iklim.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Fitoplankton menggunakan karbon dioksida untuk fotosintesis dan pada gilirannya menyediakan hampir setengah dari oksigen yang kita hirup. Semakin besar populasi fitoplankton dunia, semakin banyak karbon dioksida yang ditarik dari atmosfer.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Para ilmuwan telah menemukan bahwa populasi fitoplankton tertentu dapat menggandakan jumlahnya sekitar sekali sehari. Dengan kata lain, fitoplankton merespon dengan sangat cepat terhadap perubahan lingkungannya.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Memahami dan memantau fitoplankton dapat membantu para ilmuwan mempelajari dan memprediksi perubahan lingkungan.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Karena fitoplankton bergantung pada sinar matahari, air, dan nutrisi untuk bertahan hidup, variasi fisik atau kimiawi dalam salah satu bahan ini dari waktu ke waktu untuk wilayah tertentu akan mempengaruhi konsentrasi fitoplankton.&lt;/span&gt;&lt;br xss=removed&gt;&lt;br xss=removed&gt;&lt;span xss=removed&gt;Populasi fitoplankton tumbuh atau berkurang dengan cepat sebagai respons terhadap perubahan lingkungannya. Perubahan tren populasi fitoplankton tertentu, seperti kepadatan, distribusi, dan laju pertumbuhan atau penurunan populasi, akan mengingatkan para ilmuwan Bumi bahwa kondisi lingkungan sedang berubah.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'Rahasia Air Laut Berwarna Biru', 'publish', NULL, NULL, NULL, 'post', 'artikel', 'resource/doc/images/images1.jpg', NULL, 'Admin', '', '2021-11-17 08:18:44', '2022-06-11 15:23:27', NULL, 'operator', '1', NULL, 161, NULL),
(328, '2021-11-19 09:08:00', 'operator', 'Ilmu Komputer', 'Ahmad Faisal Siregar', 'publish', NULL, 'https://www.usu.ac.id/id', NULL, 'post', 'tim', 'resource/doc/images/no-image-available6.png', 'resource/doc/images/Logo_USU_(Universitas_Sumatera_Utara)_Terbaru4.png', 'Universitas Sumatera Utara', 'Mahasiswa', '2021-11-19 09:08:22', '2022-06-09 16:12:23', NULL, 'operator', 'operator', NULL, 146, NULL),
(329, '2021-11-18 09:10:00', 'operator', 'Matematika', 'Diana Eka Riyani', 'publish', NULL, 'https://www.undip.ac.id/', NULL, 'post', 'tim', 'resource/doc/images/no-image-available11.png', 'resource/doc/images/Logo_Undip_Universitas_Diponegoro.png', 'Universitas Diponegoro', 'Mahasiswa', '2021-11-19 09:10:47', '2022-06-09 16:17:10', NULL, '', 'operator', NULL, 164, NULL),
(330, '2021-11-14 09:15:00', 'operator', 'Statistika', 'Rossy Prima Nada Utami', 'publish', NULL, 'https://unimus.ac.id/', NULL, 'post', 'tim', 'resource/doc/images/no-image-available111.png', 'resource/doc/images/SeekPng.com_logo-pkk-png_5335389.png', 'Universitas Muhammadiyah Semarang', 'Mahasiswa', '2021-11-19 09:15:17', '2022-06-09 18:34:15', NULL, 'operator', 'operator', NULL, 179, NULL),
(331, '2021-11-16 09:17:00', 'operator', 'Statistika', 'Evida Oktaviana', 'publish', NULL, 'https://unimus.ac.id/', NULL, 'post', 'tim', 'resource/doc/images/no-image-available112.png', 'resource/doc/images/SeekPng.com_logo-pkk-png_53353891.png', 'Universitas Muhammadiyah Semarang', 'Mahasiswa', '2021-11-19 09:17:18', '2022-06-09 16:23:11', NULL, 'operator', 'operator', NULL, 163, NULL),
(658, '2021-11-15 11:49:00', 'operator', 'Statistika', 'Nila Amelinda Putri', 'publish', NULL, 'https://unimus.ac.id/', NULL, 'post', 'tim', 'resource/doc/images/no-image-available113.png', 'resource/doc/images/SeekPng.com_logo-pkk-png_53353892.png', 'Universitas Muhammadiyah Semarang', 'Mahasiswa', '2021-12-22 11:49:00', '2022-06-09 16:24:38', NULL, 'operator', 'operator', NULL, 6, NULL),
(674, '2022-06-06 10:07:00', 'operator', '&lt;div class=&quot;post-content clearfix&quot; xss=removed&gt;Sibolga - Komandan Pangkalan TNI Angkatan Laut (Danlanal) Sibolga, Letkol Laut (P) Syaifuddin Zuhri, M.Tr. Opsla, secara langsung melaunching Kelompok Budidaya Ikan Keramba Apung Bahari Sibolga, dan panen raya ikan di keramba jaring apung, di Perairan Pulau Panjang Kota Sibolga, Sumatera Utara, Selasa (26/10).&lt;br&gt;&lt;br&gt;Dalam sambutannya Danlanal Sibolga menjelaskan,  bahwa acara tersebut dalam rangka pembinaan ketahanan wilayah Maritim melalui wujud nyata pembinaan kondisi sosial masyarakat yang diarahkan untuk ikut serta memelihara, melestarikan, serta memanfaatkan sumber daya maritim dalam menopang kesejahteraan dan kemandirian ekonomi, serta meningkatkan kwalitas hidup masyarakat di Kota Sibolga.&lt;br&gt;&lt;br&gt;Lebih lanjut Danlanal menyampaikan, bahwa potensi maritim dengan cara pemanfaatan, pembinaan, dan pengembangan budidaya ikan melalui keramba jaring apung, diharapkan dapat mewujudkan  program ketahanan pangan masyarakat, apalagi di masa pandemi COVID-19 seperti saat ini.&lt;br&gt;&lt;br&gt;Ia pun berharap kepada para pelaku usaha, masyarakat, nelayan, pelajar dan mahasiswa, bahwa dengan terselenggaranya acara Launching Kelompok Budidaya Ikan Apung Bahari Sibolga dan Panen Raya Ikan di Keramba Jaring Apung, dapat dimanfaatkan dengan sebaik-baiknya, karena sangat bermanfaat sebagai solusi sumber penghasilan baru dan juga menambah ilmu pengetahuan khususnya di bidang keramba jaring apung.&lt;br&gt;&lt;br&gt;&quot;Pada kesempatan ini, juga kita akan  melaksanakan penen ikan sebanyak 300 ekor,  jenis ikan kerapu, ikan jarang gigi dan ikan gabu, yang pemanfaatannya diharapkan sebagai acuan dalam pemasaran ikan keramba jaring apung dan ke depannya dapat berkoordinasi langsung dengan kadis perikanan, ketahanan Pangan dan Pertanian Kota Sibolga,&quot; katanya..&lt;br&gt;&lt;br&gt;&quot;Mari bersama-sama kita majukan perekonomian di Kota Sibolga ini, untuk mendukung visi- misi Wali Kota Sibolga dalam mewujudkan &quot;Sibolga Pintar&quot; melalui mengembangkan usaha budidaya perikanan keramba jaring apung yang ramah lingkungan serta dalam mewujudkan ketahanan pangan dan menunjang perekonomian masyarakat,&quot; tambahnya.&lt;br&gt;&lt;br&gt;Kegiatan ini terlaksana dengan baik dan lancar, dengan tetap menerapkan protokol kesehatan dalam memutus mata rantai penyebaran pandemi COVID-19.&lt;/div&gt;', 'Danlanal Sibolga launching kelompok budidaya ikan keramba apung bahari dan panen raya ikan', 'publish', NULL, NULL, NULL, 'post', 'berita', 'resource/doc/images/danlanal.jpg', NULL, NULL, NULL, '2022-06-06 10:07:04', '2022-06-11 16:07:51', NULL, 'operator', '1', NULL, 9, NULL),
(675, '2022-05-31 11:00:00', 'operator', '&lt;p&gt;&lt;/p&gt;&lt;footer class=&quot;post-meta&quot; xss=removed&gt;&lt;/footer&gt;&lt;p&gt;&lt;/p&gt;&lt;div class=&quot;post-content clearfix&quot; xss=removed&gt;&lt;div class=&quot;post-content clearfix&quot;&gt;Tapanuli Tengah - Untuk menjadikan Kabupaten Tapanuli Tengah, Sumatera Utara menjadi Sorganya Mangrove, Kelompok Tani Hutan (KTH) yang ada di Kabupaten Tapanuli Tengah menanam 1.080.000 Mangrove di 4 kelurahan dan 2 desa di Kecamatan Pandan, Kabupaten Tapanuli Tengah, Sabtu (30/10).&lt;br&gt;&lt;br&gt;Ada pun Kelompok Tani Hutan yang mempelopori aksi ini, yaitu, Kelompok Mandiri Lestari, Kelompok Mandiri, Kelompok Sejahtera, dan Kelompok Mekar Lestari. Dan juga didukung empat instansi, yaitu, Pemkab Tapteng, Polres Tapteng, KADIN Tapteng, dan Badan Restorasi Gambut dan Mangrove (BRGM) Wilayah Sumut.&lt;br&gt;&lt;br&gt;Menurut koordinator penanaman Mangrove, Abdul Rahman Sibuea kepada ANTARA, bahwa Kabupaten Tapanuli Tengah sangat layak untuk dijadikan Sorganya Mangrove, mengingat Tapteng memiliki kawasan yang cukup luas. Untuk itulah mereka bersama para Kelompok Tani Hutan menggelar aksi tersebut yang didukung empat instansi.&lt;/div&gt;&lt;div class=&quot;post-content clearfix&quot;&gt;&lt;br&gt;Dia pun mengajak seluruh lapisan masyarakat, khususnya para pemangku kepentingan dan perusahaan BUMN maupun swasta untuk turut serta memberikan kontribusi demi kelestarian Mangrove di Tapanuli Tengah. &quot;Kami mengajak seluruh pemangku kepentingan, mulai dari pemerintah, TNI, Polri, KPw Bank Indonesia Sibolga, BUMN (Pertamina) maupun perusahaan swasta, terutama masyarakat umum untuk bersama-sama melestarikan Mangrove baik yang baru ditanam maupun yang sudah ada. Karena potensi Mangrove di Tapteng sangat luar biasa,” katanya.&lt;figure class=&quot;figure-image&quot; id=&quot;fgimage_1&quot;&gt;&lt;img id=&quot;image_1&quot; src=&quot;https://img.antaranews.com/cache/730x487/2021/10/31/Mangrove-1.jpg&quot;&gt;&lt;figcaption class=&quot;fig-caption&quot; xss=removed&gt;&lt;em&gt;&lt;span xss=removed&gt;Koordinator penanaman Mangrove di Tapteng, Abdul Rahman Sibuea bersama Kapolres Tapteng dan dari BRGM Wilayah Sumut, mewakili Lanal Sibolga, Asisten II Pemkab Tapteng yang mewakili Bupati Tapteng, Kadis Lingkungan Hidup dan Kelompok Tani Hutan saat turun langsung menanam Mangrove di beberapa titik di Kecamatan Pandan, Sabtu (30/10). &lt;/span&gt;&lt;/em&gt;&lt;/figcaption&gt;&lt;/figure&gt;&lt;br&gt;&lt;br&gt;Masih menurutnya, bahwa kawasan Mangrove dapat juga dijadikan sebagai objek wisata yang berdampak terhadap peningkatan ekonomi masyarakat, karena didukung potensi perairannya yang dapat dijadikan sebagai lokasi budidaya kepiting bakau, kerang, siput dan lain sebagainya. “Makanya kami sangat tertarik dan merespon langsung program nasional yang dicanangkan oleh Bapak Presiden Jokowi terkait pelestarian Mangrove dengan menanam 1 juta lebih Mangrove hari ini,&quot; tandasnya.&lt;br&gt;&lt;br&gt;Ketua KADIN Tapteng ini pun memiliki gagasan supaya kawasan Mangrove yang ada di Kecamatan Pandan dijadikan kawasan Lubuk Larangan dan kawasan konservasi khusus.&lt;br&gt;&lt;br&gt;Sementara itu Kapolres Tapanuli Tengah, AKBP Jimmy yang turun langsung ikut menanam Mangrove bersama Kelompok Tani Hutan, sangat mendukung gerakan yang digagasi KTH.&lt;br&gt;&lt;br&gt;“Sebagai bentuk dukungan Tapanuli Tengah Surganya Mangrove, Polres Tapteng akan menindak tegas setiap pelaku pengrusakan atau penebangan hutan Mangrove. Karena dalam beberapa hari ini, saya sudah berkeliling langsung meninjau lokasi-lokasi kawasan Mangrove di daerah ini, khususnya yang ada di Kecamatan Pandan. Dan ternyata keanekaragaman jenisnya luar bisa. Jadi, sangat tepat Tapteng ini dijadikan Surganya Mangrove. Untuk itulah sudah menjadi kewajiban kita bersama menjaga kekayaan alam ini,” kata Kapolres.&lt;br&gt;&lt;br&gt;Atas dasar itulah kata Jimmy, siapa saja orang atau oknum, baik pribadi maupun kelompok yang merusak kawasan Mangrove di Tapteng, akan ditindak tegas.&lt;br&gt;“Kepada warga masyarakat yang selama ini merusak Mangrove, semisal untuk usaha kayu arang dan lain sebagainya, supaya menghentikannya sebelum kami mengambil tindakan tegas sesuai UU Nomor 32 Tahun 2009 Tentang Perlindungan dan Pengelolaan Lingkungan Hidup, serta Pasal 116 junto Pasal 119 dan Pasal 55 KUHP yang ancaman hukumnya maksimal 10 tahun penjara atau denda maksimal Rp1 miliar,” tegas Kapolres seraya memuji KTH selaku pelopor pelestarian Mangrove di Tapteng.&lt;figure class=&quot;figure-image&quot; id=&quot;fgimage_2&quot;&gt;&lt;img id=&quot;image_2&quot; src=&quot;https://img.antaranews.com/cache/730x487/2021/10/31/Mangrove-4.jpg&quot;&gt;&lt;figcaption class=&quot;fig-caption&quot; xss=removed&gt;&lt;em&gt;&lt;span xss=removed&gt;Penyerahan bantuan sosial dan vaksinasi bagi masyarakat Lansia dan penanam Mangrove dari Polres Tapteng di sela-sela acara penananam Mangrove di Kecamatan Pandan , Sabtu (30/10). &lt;/span&gt;&lt;/em&gt;&lt;/figcaption&gt;&lt;/figure&gt;&lt;br&gt;&lt;br&gt;Sebagai bukti keseriusan Polres Tapteng mendukung pelestarian itu, Kapolres langsung memasang plang larangan merusak Mangrove di kawasan Mangrove yang ada di Kelurahan Kalangan hingga Desa Aek Garut.&lt;br&gt;&lt;br&gt;Bupati Tapanuli Tengah, Bakhtiar Ahmad Sibarani yang diwakili Asisten II, drh. Iskandar dalam sambutannya, menyampaikan, bahwa Pemkab Tapteng sangat menyambut baik kegiatan penanaman 1.080.000 Mangrove yang dilaksanakan di Tapteng. Karena, sebagai salah satu daerah pesisir, keberadaan Mangrove amat penting. Artinya, dalam kehidupan masyarakat, baik dari sektor ekonomi, sosial dan terutama untuk perlindungan dari abrasi pantai.&lt;br&gt;&lt;br&gt;&quot;Mangrove amat penting bagi masyarakat Tapteng. Karena Mangrove menjadi salah satu kawasan ekosistem alami bagi ikan dan hewan yang bernilai ekonomi. Artinya, banyak masyarakat kita yang mata pencahariannya bergantung kepada kelestarian Mangrove. Belum lagi manfaat Mangrove untuk mengatasi bencana abrasi pantai. Untuk itulah kalau Mangrove sampai punah di Tapteng, maka daratan Tapteng pasti akan berkurang akibat terkikis gelombang pasang surut laut. Atas dasar itulah kami sangat mendukung upaya pelestarian Mangrove dan menyampaikan apresiasi atas kegiatan yang luar biasa ini,” pungkasnya.&lt;br&gt;&lt;br&gt;Acara penanaman 1.080.000 Mangrove ini, juga diisi dengan pemberian bantuan sosial dan vaksinasi massal bagi masyarakat Lansia dan pekerja Mangrove oleh Polres Tapteng, yang juga dilanjutkan dengan penaburan benih Kepiting Bakau (Ketam) dan Kerang.&lt;br&gt;&lt;br&gt;Turut hadir dalam kegiatan ini perwakilan dari Lanal Sibolga, dari KPw Bank Indonesia Sibolga, Kepala Depot TBBM Pertamina Sibolga, Wisnu, Kadis Lingkungan Hidup Tapteng, dr. Ricky Nelson Harahap, Kadis Kelautan dan Perikanan Tapteng, Ridsam Batubara, mewakili Kadis Pariwisata Tapteng, pihak BRI Unit Pandan, Kepala UPT KPH Tapteng, Camat Pandan, Gusni Pasaribu, Kepala Desa Aek Garut, Ronald Pakpahan beserta undangan lainnya. &lt;/div&gt;&lt;footer class=&quot;post-meta&quot; xss=removed&gt;&lt;/footer&gt;&lt;/div&gt;', 'Jadikan Tapteng surganya mangrove, kelompok tani hutan tanam 1 juta lebih mangrove', 'publish', NULL, NULL, NULL, 'post', 'berita', 'resource/doc/images/Mangrove_1.jpg', NULL, NULL, NULL, '2022-06-06 11:00:29', '2022-06-06 11:37:35', NULL, 'operator', 'operator', NULL, 1, NULL),
(676, '2022-06-04 11:04:00', 'operator', '&lt;p xss=removed&gt;&lt;strong&gt;Sibolga&lt;/strong&gt; - Kelompok Masyarakat Pengawas Bina Samudera (Pokmaswas BS), mengaku malu dengan julukan \'Sibolga Kota Ikan\' jika pemerintah daerah tidak serius melakukan langkah penyelamatan ekosistem laut.&lt;/p&gt;&lt;p xss=removed&gt;Sekretaris Pokmaswas BS Kota Sibolga, Rahmad Saleh Harahap mengatakan, hasil tangkapan ikan &lt;a href=&quot;https://www.tagar.id/tag/nelayan&quot; title=&quot;nelayan&quot; xss=removed&gt;nelayan&lt;/a&gt; tradisional di Kota Sibolga mengalami penurunan.&lt;/p&gt;&lt;p xss=removed&gt;&lt;/p&gt;&lt;div class=&quot;p2&quot;&gt;&lt;/div&gt;&lt;p&gt;&lt;/p&gt;&lt;p xss=removed&gt;&quot;Malu kita dengan julukan itu, kalau tidak lagi ada ikan yang dihasilkan seperti saat ini,&quot; kata Rahmad, Rabu 16 Oktober 2019, di kantornya, Jalan Bangau, Kelurahan Aek Manis, Kecamatan Sibolga &lt;a href=&quot;https://www.tagar.id/tag/sambas&quot; title=&quot;Sambas&quot; xss=removed&gt;Sambas&lt;/a&gt;.&lt;/p&gt;&lt;p xss=removed&gt;Rahmat menyebut, biota laut seperti terumbu karang dan &lt;a href=&quot;https://www.tagar.id/tag/padang&quot; title=&quot;padang&quot; xss=removed&gt;padang&lt;/a&gt; lamun yang ada di daerah Pesisir Pantai Barat Sumatera telah mengalami kerusakan.&lt;/p&gt;&lt;p xss=removed&gt;Kondisi ini, disebabkan kegiatan eksploitasi biota laut yang tidak terkendali. Penggunaan alat tangkap ikan yang tidak ramah lingkungan, masih ditemukan beroperasi.&lt;/p&gt;&lt;p xss=removed&gt;&quot;Terumbu karang di Pantai Barat Sumatera sudah hancur berantakan, itu karena maraknya penggunaan pukat trawl, &lt;a href=&quot;https://www.tagar.id/tag/bom&quot; title=&quot;bom&quot; xss=removed&gt;bom&lt;/a&gt; ikan dan jaring tangkap udang alias jaring Malong kalau istilah di sini (Sibolga),&quot; ucapnya.&lt;/p&gt;&lt;p xss=removed&gt;Dia menjelaskan, ekosistem laut sangat erat hubungannya dengan keberlangsungan hidup masyarakat pesisir. Sama halnya wilayah Sibolga, karena geografis terletak di &lt;a href=&quot;https://www.tagar.id/tag/pantai&quot; title=&quot;Pantai&quot; xss=removed&gt;Pantai&lt;/a&gt; Pulau Sumatera.&lt;/p&gt;&lt;p xss=removed&gt;&quot;Masyarakat Sibolga ini umumnya nelayan, tapi perekonomian masyarakat nelayan sudah melemah,&quot; ucapnya.&lt;/p&gt;&lt;p xss=removed&gt;Rahmad berharap pemerintah serius mengatasi permasalahan tersebut, sehingga nelayan tradisonal dapat meningkatkan produksi ikan dari hasil tangkapannya.&lt;/p&gt;', 'Sibolga Kota Ikan, Ekosistem Lautnya Sudah Rusak', 'publish', NULL, NULL, NULL, 'post', 'berita', 'resource/doc/images/kota.jpg', NULL, NULL, NULL, '2022-06-06 11:04:45', '2022-06-11 14:36:01', NULL, 'operator', '1', NULL, 3, NULL),
(677, '2022-06-02 11:21:00', 'operator', '&lt;p xss=removed&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;Sibolga - Salah satu pelaku usaha di bidang perikanan ternyata sudah berhasil melakukan budi daya lobster di Indonesia. Bahkan praktik ini berlangsung selama hampir 10 tahun terakhir.&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt; Ketua Himpunan Pembudidaya Ikan Laut Indonesia (Hipilindo) Effendi menyatakan telah berhasil membudidayakan lobster. Lokasinya ada di Pulau Mursala yang terletak di antara Kota Sibolga dan Pulau Nias. &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;Effendi menyebut ini kali pertama dia membongkar lokasi budi daya lobster miliknya setelah ada wacana pemerintah akan melakukan budi daya terhadap komoditas bernilai tinggi ini. &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;Sebelumnya, dia enggan membeberkan hal tersebut karena khawatir ditindak penegak hukum setelah ada larangan pengambilan benih dan budi daya lobster melalui Permen KP No.56/2016 tentang Larangan Penangkapan dan/atau Pengeluaran Lobster (Panulirus Spp.), Kepiting (Scylla Spp.), dan Rajungan (Portunus Spp.) dari Wilayah RI, yang dikeluarkan Susi. &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&quot;KJA [keramba jaring apung] saya di Sibolga, budi daya lobster. Saya buat antara Sibolga dan Nias. Ada pulau di tengah laut, Pulau Mursala, benar-benar tersembunyi,&quot; ungkapnya dalam sebuah FGD di Gedung Mina Bahari IV, Jakarta, Kamis (19/12/2019) &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;Effendi mengungkapkan awal mula dia melakukan budi daya lobster karena cemburu terhadap Vietnam yang berhasil melakukannya pada 2008. Padahal, benih Vietnam berasal dari Indonesia.  &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&quot;Kita jauh lebih bisa dari Vietnam. Mereka lakukan, kami juga lakukan, tapi kita diganjal, malah dilarang. Ketahuan, malah ditangkap. Ini sangat sedih. Waktu itu kita tidak bisa apa-apa,&quot; tuturnya.&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;span xss=removed&gt;Dia menyebut tak perlu teknologi canggih untuk budi daya lobster. Syaratnya hanya sanitasi, kedalaman KJA minimal 15 meter dan arus laut yang tepat. Hasil tangkapannya di sekitar perairan selatan Sumatra kini berkembang dan bisa dibesarkan.&lt;/span&gt;&lt;/div&gt;&lt;span xss=removed&gt;&lt;/span&gt;&lt;/p&gt;', 'Di Pulau Ini, Lobster Berhasil Dibudidayakan', 'publish', NULL, NULL, NULL, 'post', 'berita', 'resource/doc/images/lobster.jpg', NULL, NULL, NULL, '2022-06-06 11:21:20', '2022-06-06 11:30:19', NULL, 'operator', 'operator', NULL, 1, NULL),
(678, '2022-06-06 11:30:00', 'operator', '&lt;p&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;MENTERI Kelautan dan Perikanan (KKP) Sakti Wahyu Trenggono mendukung Tapanuli Tengah dan Sibolga, Sumatera Utara sebagai roda penggerak industri perikanan. &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;Pasalnya, sebagai wilayah yang didominasi oleh garis pantai, masyarakat Tapanuli Tengah dan Sibolga bergantung pada hasil sumber daya kelautan dan perikanan. &lt;/span&gt;&lt;span xss=removed&gt;Dalam pertemuan Bupati Tapanuli Tengah Bakhtiar Ahmad dengan Menteri KKP, Senin (22/3) menjelaskan, terdapat 30 ribu nelayan pribumi dari Sibolga yang masih aktif melaut hingga kini.&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;Dia menyebut, salah satu kebutuhan dalam melakukan pengembangan tersebut adalah kebutuhan cold storage untuk menyimpan hasil tangkap sebelum dipasarkan.   &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;“Ada beberapa hal yang ingin kami sampaikan. Salah satunya adalah kesulitan yang tengah dialami oleh pelaku home industry. Hal ini disebabkan kurangnya fasilitas cold storage dan pengering ikan di tempat kami,” ucap Bakhtiar dalam keterangan pers KKP, Selasa (23/3).   &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;Menanggapi hal tersebut, Trenggono meminta jajarannya untuk memastikan pengecekan di lapangan, melakukan pembinaan kepada nelayan, serta penggalian potensi yang ada di wilayah tersebut.&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;Selain itu Menteri KKP ingin Tapanuli Tengah dapat menjadi roda penggerak industri perikanan dan Sibolga yang bertugas memperkuat pemasarannya.   &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;Trenggono juga menyampaikan beberapa desain program yang sedang dijalankan dan menjadi fokus utama KKP hingga tahun 2024. Seperti, peningkatan pendapatan negara bukan pajak (PNBP) dari sub-sektor perikanan tangkap, pengembangan perikanan budidaya &lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div xss=removed&gt;&lt;span xss=removed&gt;&quot;Di mana salah satu caranya adalah melalui perikanan tangkap, dan perikanan budidaya. Sehingga Pemda juga harus mendukung hal tersebut, termasuk Tapanuli Tengah dan Sibolga,&quot; pungkasnya. &lt;/span&gt;&lt;/div&gt;&lt;span xss=removed&gt;&lt;/span&gt;&lt;/p&gt;', 'Sibolga dan Tapanuli Tengah jadi Penggerak Industri Perikanan', 'publish', NULL, NULL, NULL, 'post', 'berita', 'resource/doc/images/nelayan.jpg', NULL, NULL, NULL, '2022-06-06 11:30:59', '2022-06-14 15:40:00', NULL, 'operator', '1', NULL, 4, NULL),
(679, '2022-06-06 11:58:00', 'operator', '&lt;p xss=&quot;removed&quot;&gt;&lt;strong xss=&quot;removed&quot;&gt;Kima&lt;/strong&gt; merupakan biota moluska yang bertubuh lunak dan bercangkang yang termasuk kelas &lt;em&gt;Bivalvia&lt;/em&gt; atau kelompok kerang-kerangan. Habitat alami biota ini ialah terumbu karang. Dari 12 jenis kima yang teridentifikasi secara global, 8 di antaranya berada di perairan Indonesia. Biota ini juga sering disebut kerang raksasa dan termasuk sebabai biota laut yang dilindungi.&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Fakta menariknya, kima memiliki peran yang sangat penting di perairan, yakni sebagai penjaga lingkungan perairan agar tetap sehat. Biota ini berperan untuk membersihkan mikroorganisme yang berlebihan sehingga lingkungan perairan terjaga lebih sehat. Satu ekor kima mampu membersihkan berton-ton air laut setiap harinya.&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Kerang raksasa ini mampu berperan sebagai biofilter alami karena dapat menyaring nutrien yang terlarut di dalam laut. Selain itu, biota ini juga menyerap berbagai jenis zat berbahaya bagi laut, seperti zat nitrogen dan fosfat.&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Kondisi kima dapat menjadi pertanda dari kondisi perairan daerah tersebut. Misalnya, kima yang terlihat pucat dapat menjadi pertanda bahwa daerah tersebut sudah tercemar polusi dan mengalami kenaikan suhu.&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Cara hidup biota laut ini terbagi menjadi dua golongan. Pertama, golongan yang membenamkan dirinya pada substrat karang, kima tersebut adalah &lt;em&gt;Tridacna crocea &lt;/em&gt;dan &lt;em&gt;Tridacna maxima&lt;/em&gt;. Golongan kedua adalah biota yang menempel bebas di dasar laut berpasir di daerah terumbu karang seperti &lt;em&gt;Tridacna derasa &lt;/em&gt;dan &lt;em&gt;Tridacna squamosa.&lt;/em&gt;&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Biota laut ini cenderung hidup menetap pada substrat dan sangat mudah ditemukan di perairan yang dangkal hingga kedalaman 2 meter, terutama pada habitat terumbu karang yang bersih. Kondisi perairan yang bersih menjadi habitat yang paling cocok untuk kima.&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Pasalnya, kenaikan sedimentasi yang menyebabkan kekeruhan dapat langsung memengaruhi pertumbuhan biota, bahkan kenaikan yang terjadi di atas batas toleransi dapat mengakibatkan kematian pada biota.&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Kima memakan jasad renik berupa fitoplankton yang melayang di dalam air. Biota ini akan menyaring air melalui insangnya, zat yang masuk ke tubuhnya akan disaring oleh bulu-bulu getar yang terdapat pada insangnya. Setelah itu, zat yang diperlukan akan diserap oleh mulut, sedangkan zat yang tidak dibutuhkan akan disemprotkn keluar melalui &lt;em&gt;exhalant siphon&lt;/em&gt;.&lt;/p&gt;&lt;p xss=&quot;removed&quot;&gt;Fakta menarik lain yang perlu Anda ketahui, pada mantel kima kerap ditumbuhi alga bersel satu yang disebut &lt;em&gt;Zooxanthella&lt;/em&gt;. Alga tersebut merupakan sumber makanan bagi karang besar ini.&lt;/p&gt;', 'Kima, Moluska Penyelamat Habitat Laut', 'publish', NULL, NULL, NULL, 'post', 'artikel', 'resource/doc/images/Kima-Moluska-Penyelamat-Habitat-Laut.jpg', NULL, 'Admin', '', '2022-06-06 11:58:15', '2022-06-11 14:35:48', NULL, 'operator', '1', NULL, 1, NULL),
(680, '2022-06-06 12:01:00', 'operator', '&lt;p xss=removed&gt;Terumbu karang merupakan salah satu biota laut yang harus dijaga ekosistemnya dengan kata lain terumbu karang adalah aset vital bagi keberlangsungan kelestarian ekosistem laut. Untuk itu, Kementerian Kelautan dan Perikanan (KKP) memiliki progam guna menjaga biota laut tersebut agar terjaga kelestariannya.&lt;/p&gt;&lt;figure id=&quot;attachment_25462&quot; aria-describedby=&quot;caption-attachment-25462&quot; class=&quot;wp-caption aligncenter&quot; xss=removed&gt;&lt;a href=&quot;https://www.pertanianku.com/wp-content/uploads/2017/09/Seberapa-Penting-Terumbu-Karang-Bagi-Ekosistem-Laut-pixabay.jpg&quot; class=&quot;td-modal-image&quot; xss=removed&gt;&lt;img loading=&quot;lazy&quot; class=&quot;size-full wp-image-25462&quot; src=&quot;https://www.pertanianku.com/wp-content/uploads/2017/09/Seberapa-Penting-Terumbu-Karang-Bagi-Ekosistem-Laut-pixabay.jpg&quot; alt=&quot;&quot; width=&quot;696&quot; height=&quot;464&quot; srcset=&quot;https://www.pertanianku.com/wp-content/uploads/2017/09/Seberapa-Penting-Terumbu-Karang-Bagi-Ekosistem-Laut-pixabay.jpg 696w, https://www.pertanianku.com/wp-content/uploads/2017/09/Seberapa-Penting-Terumbu-Karang-Bagi-Ekosistem-Laut-pixabay-300x200.jpg 300w, https://www.pertanianku.com/wp-content/uploads/2017/09/Seberapa-Penting-Terumbu-Karang-Bagi-Ekosistem-Laut-pixabay-630x420.jpg 630w&quot; sizes=&quot;(max-width: 696px) 100vw, 696px&quot; xss=removed&gt;&lt;/a&gt;&lt;figcaption id=&quot;caption-attachment-25462&quot; class=&quot;wp-caption-text&quot; xss=removed&gt;Foto: pixabay&lt;/figcaption&gt;&lt;/figure&gt;&lt;p xss=removed&gt;“Koral (terumbu karang) adalah tempat awal menjaga ekosistem laut,” jelas Direktur Jendral Pengelolaan Ruang Laut KKP, Brahmantya Satyamurti Poerwadi di Jakarta, beberapa waktu lalu, seperti dilansir dari &lt;em&gt;Antara&lt;/em&gt; (12/9).&lt;/p&gt;&lt;p xss=removed&gt;Menurutnya, dengan berusaha terus memperbaiki kualitas terumbu karang dan padang lamun di kawasan perairan Indonesia juga sama dengan memastikan potensi sumber daya perikanan tetap terjaga.&lt;/p&gt;&lt;p xss=removed&gt;Dirjen Pengelolaan Ruang Laut KKP juga menegaskan pentingnya untuk menciptakan banyak kawasan luas bagi terumbu karang agar mereka tidak dapat dirusak sehingga dapat dilestarikan sepenuhnya.&lt;/p&gt;&lt;p xss=removed&gt;Berdasarkan data LIPI, hasil pengukuran terkini melalui pemetaan satelit, luas terumbu karang Indonesia mencapai 25.000 kilometer persegi atau sekitar 10 persen dari terumbu karang dunia.&lt;/p&gt;&lt;p xss=removed&gt;Sementara dari total 1.064 stasiun pengamatan pada 108 lokasi di Indonesia, didapat status terumbu karang, yaitu 68 titik (6,39 persen) sangat baik, 249 titik (23,4 persen) baik, 373 totol (35 persen cukup), dan 374 titik (35,15 persen) jelek.&lt;/p&gt;&lt;p xss=removed&gt;Menurut analisis LIPI, hal itu disebabkan pemutihan terumbu karang karena kenaikan suhu air laut akibat fenomena anomali cuaca El Nino.&lt;/p&gt;&lt;p xss=removed&gt;Di sejumlah daerah, kalangan aktivis lingkungan menyesalkan kembali terulangnya perusakan terumbu karang seperti yang terjadi di perairan Karimunjawa, Kabupaten Jepara, oleh kapal-kapal tongkang pengangkut batubara.&lt;/p&gt;&lt;p xss=removed&gt;Deputi Indonesia Coralreef Action Network (I-Can) Amiruddin saat beraudiensi dengan Komisi B DPRD Provinsi Jawa Tengah di Semarang, mengungkapkan bahwa luasan terumbu karang di Perairan Karimunjawa yang rusak akibat kapal tongkang saat ini lebih dari 1.660 meter persegi.&lt;/p&gt;&lt;p xss=removed&gt;Tak jauh berbeda, pemerhati lingkungan Gabriel Mahal melaporkan dugaan kerusakan terumbu karang di Labuan Bajo Nusa Tenggara Timur (NTT) yang diakibatkan transportasi laut atau kapal yang mengangkut wisatawan.&lt;/p&gt;', 'Seberapa Penting Terumbu Karang Bagi Ekosistem Laut', 'publish', NULL, NULL, NULL, 'post', 'artikel', NULL, NULL, 'Admin', '', '2022-06-06 12:01:05', '2022-06-14 09:20:48', NULL, 'operator', '1', NULL, 6, NULL),
(681, '2022-06-02 12:03:00', 'operator', '&lt;p xss=removed&gt;Apakah Anda pernah mendengar ikan kuwe? &lt;strong xss=removed&gt;Ikan kuwe&lt;/strong&gt; termasuk jenis ikan permukaan yang sangat digemari oleh masyarakat. Ikan ini hidup pada perairan dangkal, karang, dan batu karang. Di beberapa restoran &lt;em&gt;seafood&lt;/em&gt;, ikan ini dijual dengan harga yang cukup menggiurkan. Selain menjadi ikan konsumsi, ikan kuwe juga bisa dijadikan ikan hias.&lt;/p&gt;&lt;p xss=removed&gt;Tubuh ikan ini berbentuk oval dan pipih. Warna tubuhnya bervariasi. Ada yang biru pada bagian atas dan perak keputih-putihan di bagian bawah. Seluruh tubuhnya ditutupi oleh sisik halus berbentuk &lt;em&gt;cycloid&lt;/em&gt;.&lt;/p&gt;&lt;p xss=removed&gt;Ikan kuwe merupakan ikan karnivora yang dapat berenang lebih cepat dibanding jenis ikan laut lainnya. Pakan utama ikan karnivora ini adalah ikan dan krustea berukuran kecil. Perihal pakan, ikan ini sangat efisien dalam memanfaatkan pakan dan mampu hidup pada kondisi yang cukup padat.&lt;/p&gt;&lt;p xss=removed&gt;Ikan kuwe biasanya dibudidayakan di teluk yang terlindungi dari ombak dan badai serta memiliki pola pergantian massa air yang baik. Prospek ikan ini akan semakin baik jika dipelihara dalam keramba jaring apung (KJA). Salah satu keunggulan ikan yang dibudidayakan dalam KJA adalah Anda bisa mengatur waktu panen yang sesuai pada saat harga ikan di pasar lagi bagus sehingga bisa mendapatkan keuntungan yang tinggi.&lt;/p&gt;&lt;p xss=removed&gt;Benih ikan kuwe pun sudah bisa didapatkan dari &lt;em&gt;hatchery&lt;/em&gt; di daerah Gondol, Bali. Namun, pembudidaya yang berada di daerah terpencil masih mengambil benih langsung dari alam. Benih yang digunakan untuk budidaya berukuran 20—25 gram dan banyak tersebar pada perairan dangkal, padang lamun. Para petani biasanya mengambil benih dengan alat tangkap seperti redi, sero, bandrong, dan bagan.&lt;/p&gt;&lt;p xss=removed&gt;Waktu penebaran benih yang baik adalah pagi atau sore hari. Sebelum ditebar, Anda harus mengaklimatisasi benih dengan cara menyamakan kondisi air dalam media pengangkutan dengan air dalam KJA. Benih berukuran 20—25 gram dapat ditebar dengan kepadatan 150 ekor/m&lt;span xss=removed&gt;3&lt;/span&gt;. Jika benih yang digunakan sudah lebih dari 250 gram/ekor, padat tebar menjadi 100 ekor/m&lt;span xss=removed&gt;3&lt;/span&gt;.&lt;/p&gt;&lt;p xss=removed&gt;Pakan yang diberikan pada ikan kuwe yang dibudidayakan dapat berupa ikan rucah yang dipotong-potong sesuai besar bukaan mulut ikan dan diberikan sebanyak 6—8 persen bobot tubuh per harinya pada pagi dan sore hari. Pakan yang diberikan juga dapat berupa pelet tenggelam dengan frekuensi pemberian dua kali sehari hingga ikan kenyang.&lt;/p&gt;&lt;p&gt;&lt;span xss=removed&gt;&lt;/span&gt;&lt;/p&gt;&lt;p xss=removed&gt;Agar ikan tidak mudah sakit, pemberian akan harus cukup dan tidak berlebihan. Selain itu, tebar tidak terlalu padat. Ikan sudah bisa dipanen setelah masa pemeliharaan berlangsung selama 5—6 bulan. Ikan kuwe bisa dipanen saat berukuran 300—400 gram.&lt;/p&gt;', 'Budidaya Ikan Kuwe yang Digemari Masyarakat Pesisir', 'publish', NULL, NULL, NULL, 'post', 'artikel', 'resource/doc/images/Budidaya-Ikan-Kuwe-yang-Digemari-Masyarakat-Pesisir.jpg', NULL, 'Admin', '', '2022-06-06 12:03:11', '2022-06-11 16:09:26', NULL, 'operator', '1', NULL, 2, NULL),
(682, '2022-05-29 12:07:00', 'operator', '&lt;div xss=removed&gt;Tapanuli Tengah - Tinggi gelombang air laut diperairan Sibolga dan Tapanuli Tengah (Tapteng) naik 4 meter akibat hujan deras yang mengguyur wilayah tersebut.&lt;/div&gt;&lt;div xss=removed&gt;&lt;br&gt;&lt;/div&gt;&lt;div xss=removed&gt;Kepala BMKG Pinangsori Kabupaten Tapanuli Tengah Marolop Rumahorbo bahwa kondisi cuaca saat ini di Sibolga-Tapteng terjadi badai guntur dan hujan deras. Sedangkan untuk ketinggian gelombang air laut diwilayah perairan Sibolga-Tapteng 4 meter.&lt;/div&gt;&lt;div xss=removed&gt;&lt;br&gt;&lt;/div&gt;&lt;div xss=removed&gt;Untuk itu dihimbau kepada masyarakat untuk berhati-hati, khususnya kepada para nelayan agar waspada saat melaut, kata Marolop.&lt;/div&gt;&lt;div xss=removed&gt;&lt;br&gt;&lt;/div&gt;&lt;div xss=removed&gt;Sementara itu sejak Minggu malam sampai dengan Senin petang, hujan masih mengguyur wilayah Sibolga-Tapteng. Dibeberapa lokasi genangan air sudah menutupi areal persawahan yang ada di kawasan Terminal Baru Pandan. Demikian juga debit air di Sungai Sibuluan mengalami kenaikan.&lt;/div&gt;&lt;div xss=removed&gt;&lt;br&gt;&lt;/div&gt;&lt;div xss=removed&gt;Sejumlah warga berharap agar hujan berhenti mengingat kawasan mereka rentan dengan banjir jika musim penghujan tiba.&lt;/div&gt;&lt;div xss=removed&gt;&lt;br&gt;&lt;/div&gt;&lt;div xss=removed&gt;Doa kami kepada Tuhan agar hujan berhenti, karena sudah semalaman hujan terus. Tadi pagi kami terkendala saat mau mengantar anak sekolah, apalagi &lt;/div&gt;&lt;div xss=removed&gt;hari ini merupakan hari pertama masuk sekolah. Selain itu juga, kawasan tempat kami tinggal rawan banjir, karena persis di pinggir aliran sungai, kata Rustam warga Perumahan Pandan Asri.&lt;/div&gt;', 'Gelombang Air Laut Sibolga-Tapteng 4 Meter', 'publish', NULL, NULL, NULL, 'post', 'berita', 'resource/doc/images/nelayan1.jpg', NULL, NULL, NULL, '2022-06-06 12:07:59', '2022-06-06 12:11:55', NULL, 'operator', 'operator', NULL, NULL, NULL),
(686, '1970-01-01 07:00:00', 'operator', '&lt;p&gt;test&lt;/p&gt;', 'test', 'publish', NULL, NULL, NULL, 'post', 'tim', NULL, NULL, NULL, NULL, '2022-06-08 21:13:39', '2022-06-08 21:13:53', '2022-06-09 10:06:33', 'operator', 'operator', NULL, NULL, NULL),
(687, '2022-06-08 21:14:00', 'operator', '&lt;p&gt;test&lt;/p&gt;', 'test', 'publish', NULL, NULL, NULL, 'post', 'tim', NULL, NULL, NULL, NULL, '2022-06-08 21:14:10', '2022-06-08 21:14:20', '2022-06-09 10:06:39', 'operator', 'operator', NULL, NULL, NULL),
(688, '2022-06-09 10:00:00', 'operator', '&lt;p&gt;test&lt;/p&gt;', 'test', 'publish', NULL, NULL, NULL, 'post', 'tim', NULL, NULL, NULL, NULL, '2022-06-09 10:00:12', '2022-06-09 10:06:10', '2022-06-09 10:06:21', 'operator', 'operator', NULL, NULL, NULL),
(689, '2022-06-09 10:06:50', 'operator', NULL, NULL, 'draft', NULL, NULL, NULL, 'post', 'tim', NULL, NULL, NULL, NULL, '2022-06-09 10:06:50', NULL, NULL, 'operator', NULL, NULL, NULL, NULL),
(690, '2022-06-09 10:39:01', 'operator', NULL, NULL, 'draft', NULL, NULL, NULL, 'post', 'tim', NULL, NULL, NULL, NULL, '2022-06-09 10:39:01', NULL, NULL, 'operator', NULL, NULL, NULL, NULL),
(691, '2022-06-13 14:18:31', 'operator', NULL, NULL, 'draft', NULL, NULL, NULL, 'post', 'artikel', NULL, NULL, NULL, NULL, '2022-06-13 14:18:31', NULL, NULL, 'operator', NULL, NULL, NULL, NULL),
(692, '2022-06-14 15:24:10', 'operator', NULL, NULL, 'draft', NULL, NULL, NULL, 'post', 'berita', NULL, NULL, NULL, NULL, '2022-06-14 15:24:10', NULL, NULL, 'operator', NULL, NULL, NULL, NULL),
(693, '2022-06-14 15:39:00', 'operator', '&lt;p&gt;test&lt;/p&gt;', 'test', 'draft', NULL, NULL, NULL, 'post', 'berita', NULL, NULL, NULL, NULL, '2022-06-14 15:39:33', '2022-06-14 15:39:43', '2022-06-14 15:39:54', 'operator', 'operator', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_file`
--

CREATE TABLE `post_file` (
  `file_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_nm` varchar(255) DEFAULT NULL,
  `counter` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `runningtext`
--

CREATE TABLE `runningtext` (
  `id` int(11) NOT NULL,
  `running_text` text DEFAULT NULL,
  `alamat_tautan` varchar(225) DEFAULT NULL,
  `running_active` enum('1','0') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `runningtext`
--

INSERT INTO `runningtext` (`id`, `running_text`, `alamat_tautan`, `running_active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'test2', 'https://www.google.com', '0', '2021-12-15 13:36:45', '2022-05-29 14:48:52', NULL, NULL, 'operator', NULL),
(3, 'testingA', 'https://www.google.com/', '0', NULL, '2021-12-22 13:35:07', NULL, NULL, 'operator', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `slide_id` int(11) NOT NULL,
  `slide_nm` varchar(100) DEFAULT NULL,
  `slide_desc` varchar(100) DEFAULT NULL,
  `slide_img` varchar(100) DEFAULT NULL,
  `slide_active` enum('1','0') DEFAULT NULL COMMENT '1 aktif 0 non aktif',
  `slide_stiky` enum('1','0') DEFAULT NULL COMMENT '1 aktif 0 non aktif',
  `slide_url` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL,
  `out_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`slide_id`, `slide_nm`, `slide_desc`, `slide_img`, `slide_active`, `slide_stiky`, `slide_url`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `out_url`) VALUES
(5, 'slide 1', 'Slide 1', 'resource/doc/images/tortoise-5029662.jpg', '1', '0', NULL, '2021-12-06 07:26:05', '2022-06-07 09:18:27', NULL, 'operator', 'operator', NULL, 'https://wonderfulindonesia.co.id/'),
(9, 'slide 2', 'Slide 2', 'resource/doc/images/wallpaperbetter_(2)3.jpg', '1', '0', NULL, '2022-06-07 09:23:03', '2022-06-07 09:26:42', NULL, 'operator', 'operator', NULL, 'https://wonderfulindonesia.co.id/');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `sosmed` text DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `foto`, `phone`, `mobile`, `address`, `sosmed`, `pesan`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, NULL, 'Operator', NULL, '0274', '0815', 'Jl Plosokuning', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'Operator Fishmap', 'resource/doc/images/profil/no-profile-pic-icon-12.png', '0274', '0815', 'Jl. Karya Wisata', '{\"github\":\"\",\"twitter\":\"@twitter\",\"instagram\":\"@instagram\",\"facebook\":\"facebook\"}', '-', NULL, '2022-06-14 14:44:05', NULL, NULL, '2', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `com_menu`
--
ALTER TABLE `com_menu`
  ADD PRIMARY KEY (`nav_id`),
  ADD KEY `FK_com_menu_p` (`portal_id`);

--
-- Indexes for table `com_portal`
--
ALTER TABLE `com_portal`
  ADD PRIMARY KEY (`portal_id`);

--
-- Indexes for table `com_preferences`
--
ALTER TABLE `com_preferences`
  ADD PRIMARY KEY (`pref_id`);

--
-- Indexes for table `com_role`
--
ALTER TABLE `com_role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `FK_com_role_p` (`portal_id`);

--
-- Indexes for table `com_role_menu`
--
ALTER TABLE `com_role_menu`
  ADD PRIMARY KEY (`nav_id`,`role_id`),
  ADD KEY `FK_com_role_menu_r` (`role_id`);

--
-- Indexes for table `com_role_user`
--
ALTER TABLE `com_role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `FK_com_role_user_r` (`role_id`);

--
-- Indexes for table `com_user`
--
ALTER TABLE `com_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `com_user_login`
--
ALTER TABLE `com_user_login`
  ADD PRIMARY KEY (`user_id`,`login_date`);

--
-- Indexes for table `com_user_super`
--
ALTER TABLE `com_user_super`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `dokumen_file`
--
ALTER TABLE `dokumen_file`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `dokumen_file_FK` (`cat_id`);

--
-- Indexes for table `dokumen_kategori`
--
ALTER TABLE `dokumen_kategori`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `gallery_files`
--
ALTER TABLE `gallery_files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `gallery_files_FK` (`album_id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`layanan_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popup`
--
ALTER TABLE `popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popup_layanan`
--
ALTER TABLE `popup_layanan`
  ADD PRIMARY KEY (`pop_id`),
  ADD KEY `popup_layanan_FK` (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_file`
--
ALTER TABLE `post_file`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `post_file_FK` (`post_id`);

--
-- Indexes for table `runningtext`
--
ALTER TABLE `runningtext`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_FK` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `com_menu`
--
ALTER TABLE `com_menu`
  MODIFY `nav_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=692;

--
-- AUTO_INCREMENT for table `com_portal`
--
ALTER TABLE `com_portal`
  MODIFY `portal_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `com_preferences`
--
ALTER TABLE `com_preferences`
  MODIFY `pref_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `com_role`
--
ALTER TABLE `com_role`
  MODIFY `role_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `com_user`
--
ALTER TABLE `com_user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dokumen_file`
--
ALTER TABLE `dokumen_file`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `dokumen_kategori`
--
ALTER TABLE `dokumen_kategori`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gallery_album`
--
ALTER TABLE `gallery_album`
  MODIFY `album_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `gallery_files`
--
ALTER TABLE `gallery_files`
  MODIFY `file_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `layanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `popup`
--
ALTER TABLE `popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `popup_layanan`
--
ALTER TABLE `popup_layanan`
  MODIFY `pop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=694;

--
-- AUTO_INCREMENT for table `post_file`
--
ALTER TABLE `post_file`
  MODIFY `file_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `runningtext`
--
ALTER TABLE `runningtext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `com_menu`
--
ALTER TABLE `com_menu`
  ADD CONSTRAINT `FK_com_menu_p` FOREIGN KEY (`portal_id`) REFERENCES `com_portal` (`portal_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `com_role`
--
ALTER TABLE `com_role`
  ADD CONSTRAINT `FK_com_role_p` FOREIGN KEY (`portal_id`) REFERENCES `com_portal` (`portal_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `com_role_menu`
--
ALTER TABLE `com_role_menu`
  ADD CONSTRAINT `FK_com_role_menu_m` FOREIGN KEY (`nav_id`) REFERENCES `com_menu` (`nav_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_com_role_menu_r` FOREIGN KEY (`role_id`) REFERENCES `com_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `com_role_user`
--
ALTER TABLE `com_role_user`
  ADD CONSTRAINT `FK_com_role_user_r` FOREIGN KEY (`role_id`) REFERENCES `com_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_com_role_user_u` FOREIGN KEY (`user_id`) REFERENCES `com_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `com_user_login`
--
ALTER TABLE `com_user_login`
  ADD CONSTRAINT `FK_com_user_login` FOREIGN KEY (`user_id`) REFERENCES `com_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `com_user_super`
--
ALTER TABLE `com_user_super`
  ADD CONSTRAINT `FK_com_user_super` FOREIGN KEY (`user_id`) REFERENCES `com_user` (`user_id`);

--
-- Constraints for table `dokumen_file`
--
ALTER TABLE `dokumen_file`
  ADD CONSTRAINT `dokumen_file_FK` FOREIGN KEY (`cat_id`) REFERENCES `dokumen_kategori` (`cat_id`);

--
-- Constraints for table `gallery_files`
--
ALTER TABLE `gallery_files`
  ADD CONSTRAINT `gallery_files_FK` FOREIGN KEY (`album_id`) REFERENCES `gallery_album` (`album_id`);

--
-- Constraints for table `popup_layanan`
--
ALTER TABLE `popup_layanan`
  ADD CONSTRAINT `popup_layanan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `popup` (`id`);

--
-- Constraints for table `post_file`
--
ALTER TABLE `post_file`
  ADD CONSTRAINT `post_file_FK` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_FK` FOREIGN KEY (`user_id`) REFERENCES `com_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
