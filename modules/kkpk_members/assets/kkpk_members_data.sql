-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2025 at 03:55 PM
-- Server version: 8.4.6-cll-lve
-- PHP Version: 8.4.14

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webmalay_attend`
--

-- --------------------------------------------------------

--
-- Table structure for table `kkpk_members`
--

CREATE TABLE `kkpk_members` (
  `id` int UNSIGNED NOT NULL,
  `no_kkpk` varchar(50) DEFAULT NULL,
  `no_kp` varchar(20) DEFAULT NULL,
  `jawatan_kkpk` varchar(100) DEFAULT NULL,
  `nama_penuh` varchar(150) DEFAULT NULL,
  `no_telefon` varchar(20) DEFAULT NULL,
  `emel` varchar(100) DEFAULT NULL,
  `alamat` text,
  `nama_syarikat_perniagaan` varchar(150) DEFAULT NULL,
  `jenis_industri` varchar(100) DEFAULT NULL,
  `pekerjaan_jawatan` varchar(100) DEFAULT NULL,
  `kepakaran` varchar(150) DEFAULT NULL,
  `tujuan` text,
  `referral` varchar(100) DEFAULT NULL,
  `syer_1000` tinyint(1) DEFAULT '0',
  `syer_100` tinyint(1) DEFAULT '0',
  `daftar_20` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `catatan` text,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kkpk_members`
--

INSERT INTO `kkpk_members` (`id`, `no_kkpk`, `no_kp`, `jawatan_kkpk`, `nama_penuh`, `no_telefon`, `emel`, `alamat`, `nama_syarikat_perniagaan`, `jenis_industri`, `pekerjaan_jawatan`, `kepakaran`, `tujuan`, `referral`, `syer_1000`, `syer_100`, `daftar_20`, `status`, `catatan`, `password`, `created_at`, `updated_at`) VALUES
(1, 'KKPK-2025-001', '640217-02-5619', 'Pengerusi', 'Roslan Bin Othman', '012-4979355', 'roslanothman17@gmail.com', 'No. 995, Jalan Alyssa 1, Taman Tunku Sarina, 06000 Jitra, Kedah', 'Acces Two Network (My I Care)', 'Medical Tourism', 'Pesara', 'Pengurusan', 'Berminat dalam pengurusan koperasi dan produk pelancongan', NULL, 1, 1, 0, 1, '', 'password', NULL, NULL),
(2, 'KKPK-2025-002', '860504-02-5368', 'Timbalan Pengerusi', 'Siti Noraini Binti Abdullah (BKM)', '017-4638729', 'ctglobaltravel@yahoo.com', 'Lot 303, Villa Zaara, Kampung Gelam, Jalan Datuk Kumbar, 05300 Alor Setar', 'CT Global Travel and Tour Sdn. Bhd.', 'Pelancongan / Travel', 'Agensi Pelancongan', 'Pelancongan', 'Untuk merancakkan aktiviti pelancongan negeri Kedah', 'En. Roslan', 1, 1, 0, 1, '', 'password', NULL, NULL),
(3, 'KKPK-2025-003', '980921-02-7459', 'Setiausaha', 'Faisal Hasif Bin Ishak', '013-2853177', 'fhishak5992@gmail.com', 'No. 174, Taman Sri Merpati, Jalan Kuala Kedah, 06600 Alor Setar', 'Kilauan Sejahtera Enterprise', 'Koperasi / F&B', 'Usahawan', 'Koperasi', 'Berkongsi ilmu koperasi, pengurusan F&B', 'Ku Abd Jalil', 0, 1, 0, 1, '', 'password', NULL, NULL),
(4, 'KKPK-2025-004', '620301-02-5867', 'Bendahari', 'Ku Abd Jalil Bin Ku Hamid', '011-65585867', 'kujalil1962@gmail.com', 'No. 16, Taman Meranti Jalan Datuk Kumbar 05300.Alor Setar Kedah', 'Nurseri Pak Ku', 'Nurseri Pokok', 'Pemilik', '', 'Bendahari koperasi', 'En. Roslan', 1, 1, 0, 1, '', 'password', NULL, NULL),
(5, 'KKPK-2025-005', '771101-02-5895', 'Ahli Lembaga Koperasi', 'Abdul Halim Bin Ishak', '010-8783445', 'halim.ishak7778@gmail.com', 'No. 17, Kampung Kepala Bendang, Kepala Batas, 06200 Jitra, Kedah', 'Tenaga Group Entrepreneur ', 'Perladangan / FnB / Pembinaan', 'Usahawan', 'Pengurusan', 'Pengusaha Ladang Sawit, Perusahaan Makanan dan Kontraktor', 'Mohd bin jaafar', 1, 1, 0, 1, '', 'password', NULL, NULL),
(6, 'KKPK-2025-006', '780419-02-5013', 'Ahli Lembaga Koperasi', 'Phi Rat A/L Eman (PJK)', '012-4997603', 'phiratt78@gmail.com', 'Wisma RNK, Jitra, 06000 Kedah', 'RNK Hotel / RNK Jaya Group', 'Hotel / Homestay', 'Usahawan', 'ICT / Komputer', 'Mempromosi pelancongan Kedah, tarik pelancong dari Thailand', 'En. Roslan', 1, 1, 0, 1, '', 'password', NULL, NULL),
(7, 'KKPK-2025-007', '651210-02-5134', 'Juru Audit Dalaman', 'Salina Binti Salim', '011-59511012', 'salinasalim65@gmail.com', 'No. 995, Jalan Alyssa 1, Taman Tunku Sarina, 06000 Jitra, Kedah', 'Butik An Najjah (Butik Muslimah)', 'Fesyen / Retail', 'Usahawan', 'Guru / Pengurusan', 'Mengangkat fesyen baju Kedah.', 'En. Roslan', 0, 1, 0, 1, '', 'password', NULL, NULL),
(8, 'KKPK-2025-008', '800824-02-5688', 'Ahli Individu', 'Mazura Binti Jaafar', '019-2177535', 'terunaikanbakar1@gmail.com', 'No. 488, Kampung Pengapit Batu, Taman Derga Jaya, Jalan Datuk Kumbar, Alor Setar', 'MJ Heritage Tourism Sdn. Bhd.', 'FnB / Eco Tourism / Logistik', 'Pemilik Perniagaan', 'FnB', 'Restoran, Dewan, Cruise Makan sambil belayar, perkhidmatan sewa van', 'En. Roslan', 1, 1, 0, 1, '*no ahli 048', 'password', NULL, NULL),
(9, 'KKPK-2025-009', '620811-02-5680', 'Ahli Individu', 'Razamin Binti Ramli', '019-4587762', 'razaminr@gmail.com', 'No. 12B Jalan Kg Jalil, KM22.5 Lebuhraya Bkt Kayu Hitam, 06000 Jitra', 'Nauranovation Resources', 'Homestay / FnB', 'Usahawan', 'Produk komuniti', 'Ingin memajukan industri pelancongan masyarakat untuk ekonomi', '', 0, 1, 0, 1, '', 'password', NULL, NULL),
(10, 'KKPK-2025-010', '890210-02-5511', 'Ahli Individu', 'Zulfadhli Bin Ahmad', '012-4477559', 'takafulman@outlook.com', 'No. 116, Desa Tanjung, Jalan Istana, Bandar Darulaman, 06000 Jitra, Kedah', 'Ukhuwah Ikhlas Network', 'Insurans', 'Pengurus', 'Insurans', '', 'En. Roslan', 0, 1, 0, 1, '', 'password', NULL, NULL),
(11, 'KKPK-2025-011', '831024-02-5833 ', 'Ahli Individu', 'Badrul Hisham Bin Mohamad ', '017-4496983 ', 'bardbiost2@gmail.com ', 'No. 151, Jalan Melati, Taman Desa Chengai Indah, Telok Chengai 06600, Alor Setar, Kedah', 'Biost Global Venture', 'Sport Tourism / FnB', 'Pemilik', 'Operasi', 'Pelancongan Sukan dan Makanan Tempatan', 'Faisal Hasif', 0, 1, 0, 1, '', 'password', NULL, NULL),
(12, 'KKPK-2025-012', '640324-02-5665', 'Ahli Individu', 'Mohamad Zaidi Bin Kasa', '017-4943268', 'mohdzaidiiii09@gmail.com', 'Kg Wang Perah, Mukim Kubang Pasu, 06000 Jitra, Kedah', 'Agro Pelancongan Bukit Perangin', 'Agro Pelancongan', 'Pemilik', '', 'Promosi agro pelancongan, sewa ATV', 'Ku Abd Jalil', 0, 1, 0, 1, '', 'password', NULL, NULL),
(13, 'KKPK-2025-013', '921015-02-5857', 'Ahli Individu', 'Muhammad Daniel Arieff Bin Ezhar', '011-11985857', 'danielbeego92@gmail.com', 'Lot 4031, Lorong Sepakat Jalan Kuala Kedah, 05400 Alor Setar, Kedah', 'Erad Homestay', 'Homestay', 'Pengurus', '', '', 'Faisal Hasif', 0, 1, 0, 1, '', 'password', NULL, NULL),
(14, 'KKPK-2025-014', '', 'Ahli Individu', 'Wong Sie Kiong', '012-4765784', 'wongsiekiong@gmail.com', 'No. 4i, Taman Bukit Indah, 07000 Kuah, Langkawi', 'Wong Sie Kiong', 'Own / Travel', 'Usahawan', '', '', '', 0, 1, 0, 1, 'tiada no. kp', 'password', NULL, NULL),
(15, 'KKPK-2025-015', '870318-02-5830', 'Ahli Individu', 'Siti Noorhidayah Binti Noorazman', '019-4506618', 'umairah6752@gmail.com', 'Kg Padang Temesu, 06400 Pokok Sena, Kedah', 'SN Indah Jaya Enterprise / RCY', 'Makanan / Rempeyek', 'Usahawan', 'Produk makanan', 'Meluaskan perniagaan rempeyek', '', 0, 1, 0, 1, '', 'password', NULL, NULL),
(16, 'KKPK-2025-016', '810208-02-5333', 'Ahli Individu', 'Adzrull Radzly Bin Abu', '012-4469863', 'adzrull@gmail.com', 'Kampung Machang, Batu 14 1/2, Jalan Kodiang, 06000 Jitra, Kedah', 'Maker Recipe Sdn Bhd', 'Pembuatan / RTE', 'Swasta', 'Produk RTC', 'Menjual produk RTE/RTC ke homestay', '', 0, 1, 0, 1, '', 'password', NULL, NULL),
(17, 'KKPK-2025-017', '920105-02-6015', 'Ahli Individu', 'Khairil Azri Bin Azlan', '019-4064506', 'azriazlan19@gmail.com', 'No. 1575, Taman Sultan Badlishah, 05050 Alor Setar, Kedah', 'KHS Outdoor Enterprise', 'Travel / Outdoor', 'Pengurus', 'Outdoor / Travel', 'Travel & Outdoor Activity', 'Faisal Hasif', 0, 1, 0, 1, '', 'password', NULL, NULL),
(18, 'KKPK-2025-018', '800729-02-5305', 'Ahli Individu', 'Tan Wei Chun', '012-5530071', 'wc_tan2002@yahoo.com', 'Lot 79, Kg. Stesen Keretapi, Tunjang, 06000 Jitra, Kedah', 'Travel Tick Sdn Bhd', 'Travel / Cruise', 'Manager', 'Travel / Cruise', 'Travel agent, cruise tourism', '', 0, 1, 1, 1, '', 'password', NULL, NULL),
(19, 'KKPK-2025-019', '750320-02-5091', 'Ahli Individu', 'Mahdzir Bin Hasan', '012-5696464', 'detsuria@gmail.com', 'No. 627, Taman Nuri, Jalan Datuk Kumbar, 05300 Alor Setar, Kedah', 'Mahdzir Hasan Det', 'Juru Gambar', 'Pemilik', 'Media & Promosi', '', '', 0, 1, 0, 1, '', 'password', NULL, NULL),
(20, 'KKPK-2025-020', '730512-02-5303', 'Ahli Individu', 'Zulkifli Bin Hassan ', '012-4291231', 'zulkiflihassan004@gmail.com', 'Lot 5558, Kg, Gajah Putih, Jeneri, Sik, Kedah', 'Singgahan Gajah Putih Enterprise', 'Homestay', 'Pemilik', 'Pemasaran', '', 'Ku Abd Jalil', 0, 1, 0, 1, '', 'password', NULL, NULL),
(21, 'KKPK-2025-021', '880814-26-5402', 'Ahli Individu', 'Fateen Syaheera Binti Mohd', '013-4888208', 'syaheera.mohd@gmail.com ', 'No. 65, Kampung Hilir, 06200 Kepala Batas, Kedah', 'FS Vanture', 'Kedai Minuman', 'Bekerja', 'Pemilik', '', 'En. Roslan', 0, 1, 0, 1, '', 'password', NULL, NULL),
(22, 'KKPK-2025-022', '850511-02-5017', 'Ahli Individu', 'Mohd Badrul Kamal Bin Mohd Noor', '012-5235574', 'awannurtravel@gmail.com', 'NO 12,TINGKAT 1, Lebuhraya Sultanah Bahiyah, Tmn Perindustrian Senangin, 05150 Alor Setar, Kedah', 'Awannur Travel And Tours Sdn Bhd', 'Travel Agent', 'Pemilik', 'Pengarah Syarikat', '', 'Siti Noraini', 0, 1, 0, 1, '', 'password', NULL, NULL),
(23, 'KKPK-2025-023', '820905-02-5995', 'Ahli Individu', 'Muhamad Azhari Bin Hussain', '011-14435830', 'mightytraveltour@gmail.com', 'No. 325, Jalan Kemboja 24, Bandar Amanajaya, 08000 Sungai Petani, Kedah', 'Mighty Travel & Tour Sdn Bhd', 'Travel Agent', 'Pemilik', 'Pengarah Urusan', '', 'Faisal Hasif', 0, 1, 0, 1, '', 'password', NULL, NULL),
(24, 'KKPK-2025-024', '850902-02-5831', 'Ahli Individu', 'Ai Wut A/L Ji Tahib', '012-9035831', 'aiwut.rattanachort@gmail.com', 'Kampung Tok Set, Mukim Padang Kerbau, 06750 Pendang, Kedah', '', 'Pelancongan', 'Berniaga', 'Produk pelancongan', 'Produk pelancongan konsep ?Back to Nature?', '', 0, 1, 0, 1, 'tiada ssm', 'password', NULL, NULL),
(25, 'KKPK-2025-025', '531001-02-5377', 'Ahli Individu', 'Che Saad Bin Edeng', '012-4981594', 'adoriharmoni@gmail.com', 'No. 206, Taman Nilam, Jalan Datuk Kumbar, 05300 Alor Star, Kedah', 'Era Top Travel & Tour Sdn Bhd', 'Pelancongan', 'Agen Pemasaran', '', '', 'Ku Abd Jalil', 0, 1, 0, 1, '', 'password', NULL, NULL),
(26, 'KKPK-2025-026', '', 'Ahli Individu', 'Zinon Zainal Abbidin', '019-4122146', '', '', '', '', '', '', '', '', 0, 1, 0, 1, 'tiada data', 'password', NULL, NULL),
(27, 'KKPK-2025-027', '', 'Ahli Individu', 'AR Holiday ( Asyraf Ar )', '011-10516844', '', '', '', '', '', '', '', '', 0, 1, 0, 1, 'tiada data', 'password', NULL, NULL),
(28, 'KKPK-2025-028', '', 'Ahli Individu', 'Masdi', '019-4793088', '', '', '', '', '', '', '', '', 0, 1, 0, 1, 'tiada data', 'password', NULL, NULL),
(29, 'KKPK-2025-029', '', 'Ahli Individu', 'Shamsudin Abdullah', '019-4585850', '', '', '', '', '', '', '', '', 0, 1, 0, 1, 'tiada data', 'password', NULL, NULL),
(30, 'KKPK-2025-030', '', 'Ahli Individu', 'Shafiq?bin?Mohammad', '013-4005151', '', '', '', '', '', '', '', '', 0, 1, 0, 1, 'tiada data', 'password', NULL, NULL),
(31, 'KKPK-2025-031', '', 'Ahli Individu', 'Man Kuala', '012-5108191', '', '', '', '', '', '', '', '', 0, 1, 0, 1, 'tiada data', 'password', NULL, NULL),
(32, 'KKPK-2025-032', '', 'Ahli Individu', 'Teoh Hong Peng', '', '', '', '', '', '', '', '', '', 0, 1, 1, 1, 'tiada data', 'password', NULL, NULL),
(33, 'KKPK-2025-033', '', 'Ahli Individu', 'Mikeo Global', '', '', '', '', '', '', '', '', '', 0, 1, 0, 1, 'tiada data', 'password', NULL, NULL),
(34, 'KKPK-2025-034', '', 'Ahli Individu', 'Azri Ahmad', '', '', '', '', '', '', '', '', '', 0, 1, 0, 1, 'tiada data', 'password', NULL, NULL),
(35, '', '790617-02-5061', 'Permohonan Ahli', 'Mohd Azam Bin Ismail', '019-4783920', 'mohdazam@gmail.com', 'No. 120, Jalan Permatang, 06000 Jitra, Kedah', 'Azam Enterprise', 'Homestay / Pelancongan', 'Usahawan', 'Hospitaliti / Homestay', 'Menyediakan homestay untuk pelancong, ingin bergabung dalam koperasi', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(36, '', '850312-02-5432', 'Permohonan Ahli', 'Nurul Huda Binti Rahman', '013-4456721', 'nurulhuda@yahoo.com', 'No. 25, Taman Sri Derga, Jalan Datuk Kumbar, 05300 Alor Setar, Kedah', '', 'Pendidikan / Komuniti', 'Guru', 'Pendidikan', 'Berminat sertai aktiviti pelancongan komuniti, terutama eco-tourism', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(37, '', '900821-02-5123', 'Permohonan Ahli', 'Wan Khairul Anuar Bin Wan Ibrahim', '017-8321920', 'wananuar@gmail.com', 'No. 7, Lorong Bunga Raya 2, Taman Bunga Raya, 06500 Alor Setar, Kedah', '', 'Perkhidmatan Teknikal', 'Juruteknik', 'Elektrikal', 'Menawarkan perkhidmatan teknikal berkaitan fasiliti pelancongan', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(38, '', '921102-02-5467', 'Permohonan Ahli', 'Aida Suzana Binti Ahmad', '019-5562810', 'aidasuzana@hotmail.com', 'No. 55, Jalan Aman 3, Taman Aman, 06000 Jitra, Kedah', 'Butik Aida', 'Fesyen / Retail', 'Pereka Fesyen', 'Reka Bentuk Fesyen', 'Membawa fesyen Kedah ke peringkat lebih tinggi', 'Salina', 0, 0, 0, 0, '', 'password', NULL, NULL),
(39, '', '870403-02-5176', 'Permohonan Ahli', 'Mohd Firdaus Bin Ahmad', '012-6559182', 'firdaus.ahmad@gmail.com', 'No. 88, Jalan Kampung Baru, 06500 Alor Setar, Kedah', '', 'Pelancongan / Travel', 'Pemandu Pelancong', 'Guiding / Tourism', 'Menawarkan perkhidmatan pemandu pelancong berlesen', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(40, '', '930621-02-5229', 'Permohonan Ahli', 'Noraini Binti Hassan', '016-7392821', 'norainihassan@gmail.com', 'No. 11, Jalan Langgar, 05400 Alor Setar, Kedah', '', 'Kerajaan / Sokongan', 'Pegawai Kerajaan', 'Pentadbiran', 'Menyokong koperasi sebagai platform pelancongan negeri', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(41, '', '810105-02-5312', 'Permohonan Ahli', 'Mohamad Rizal Bin Ramlee', '012-4782940', 'rizalramlee@yahoo.com', 'No. 201, Jalan Putra, 05150 Alor Setar, Kedah', 'MR Construction', 'Pembinaan / Infrastruktur', 'Kontraktor', 'Pembinaan', 'Menyediakan sokongan bina fasiliti pelancongan', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(42, '', '941123-02-5471', 'Permohonan Ahli', 'Sharifah Noraini Bt Syed Omar', '013-7291820', 'sharifahnoraini@gmail.com', 'No. 5, Taman Aman Jaya, Jalan Sultanah, 05350 Alor Setar, Kedah', '', 'Pendidikan / Akademik', 'Pensyarah', 'Pendidikan / Latihan', 'Membantu dalam latihan & modul pelancongan', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(43, '', '750312-02-5088', 'Permohonan Ahli', 'Khairul Anuar Bin Osman', '012-3891273', 'khairulanuar@gmail.com', 'No. 33, Taman Sri Putri, 06000 Jitra, Kedah', 'KAO Enterprise', 'F&B / Produk Lokal', 'Usahawan', 'Makanan Tradisional', 'Menjual produk makanan tradisional Kedah', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(44, '', '960215-02-5532', 'Permohonan Ahli', 'Nurul Hidayah Bt Mahmud', '017-3382739', 'nurulhidayah@gmail.com', 'No. 102, Jalan Kuala Kedah, 06600 Alor Setar, Kedah', '', 'Pendidikan / Belia', 'Pelajar', 'Belia / Komuniti', 'Berminat dalam aktiviti koperasi, pelancongan belia', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(45, '', '790214-02-5093', 'Permohonan Ahli', 'Hishamuddin Bin Yahya', '013-4782930', 'hishamyahya@gmail.com', 'No. 99, Taman Sri Muda, Jalan Anak Bukit, 05150 Alor Setar, Kedah', 'Hisham Catering', 'F&B / Perkhidmatan', 'Usahawan', 'Katering / F&B', 'Menyediakan katering untuk pelancongan', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(46, '', '870712-02-5154', 'Permohonan Ahli', 'Norazlin Binti Zainal', '014-7283910', 'norazlinz@gmail.com', 'No. 66, Lorong Mawar, Taman Mawar, 06000 Jitra, Kedah', 'Azlin Design Studio', 'Seni / Kreatif', 'Designer', 'Reka Grafik', 'Rekaan grafik & branding produk pelancongan', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(47, '', '900530-02-5218', 'Permohonan Ahli', 'Mohd Shahril Bin Hassan', '012-8391920', 'shahrilhassan@gmail.com', 'No. 21, Kampung Kepala Batas, 06100 Kubang Pasu, Kedah', 'Shahril Construction', 'Pembinaan / Infrastruktur', 'Kontraktor', 'Pembinaan', 'Menawarkan kerja bina pondok rehat & kemudahan pelancongan', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(48, '', '810427-02-5273', 'Permohonan Ahli', 'Zainab Binti Osman', '019-6572830', 'zainabosman@gmail.com', 'No. 17, Jalan Taman Damai, 06500 Alor Setar, Kedah', '', 'Komuniti / Sokongan', 'Pesara', 'Komuniti', 'Menyokong program komuniti koperasi', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(49, '', '950815-02-5367', 'Permohonan Ahli', 'Mohd Hafiz Bin Mohamad', '016-9382731', 'hafizmohamad@gmail.com', 'No. 14, Jalan Desa, Taman Desa Aman, 06000 Jitra, Kedah', 'Hafiz Studio', 'Media / Fotografi', 'Jurugambar', 'Fotografi', 'Fotografi produk & destinasi pelancongan', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(50, '', '780901-02-5034', 'Permohonan Ahli', 'Norhayati Binti Abdullah', '012-5678192', 'norhayatiabd@gmail.com', 'No. 22, Jalan Sultanah, 05300 Alor Setar, Kedah', '', 'Kerajaan / Sokongan', 'Penjawat Awam', 'Pentadbiran / Promosi', 'Berminat menyumbang kepakaran dalam promosi', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(51, '', '820622-02-5129', 'Permohonan Ahli', 'Ahmad Zaki Bin Zakaria', '013-9283719', 'zakizakaria@gmail.com', 'No. 19, Jalan Melati, Taman Melati, 06000 Jitra, Kedah', 'Zaki IT Solutions', 'ICT / Sistem', 'IT Specialist', 'ICT / Sistem', 'Sistem tempahan online untuk koperasi', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(52, '', '970424-02-5490', 'Permohonan Ahli', 'Siti Khadijah Bt Salleh', '017-5283910', 'sitikhadijahs@gmail.com', 'No. 29, Taman Sri Kota, Jalan Langgar, 05400 Alor Setar, Kedah', '', 'Belia / Komuniti', 'Pelajar', 'Belia / Komuniti', 'Menyokong koperasi melalui aktiviti belia', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(53, '', '860107-02-5183', 'Permohonan Ahli', 'Mohd Faizal Bin Latif', '012-8392731', 'faizallatif@gmail.com', 'No. 77, Jalan Sungai Korok, 06000 Jitra, Kedah', 'Faizal Agro', 'Agro / Produk Desa', 'Usahawan', 'Agro / Makanan Desa', 'Menyediakan produk makanan agro untuk koperasi', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(54, '', '890311-02-5240', 'Permohonan Ahli', 'Norhidayah Binti Hassan', '011-7382930', 'norhidayahhassan@gmail.com', 'No. 45, Kampung Gelam, Jalan Datuk Kumbar, 05300 Alor Setar, Kedah', '', 'Pendidikan / Komuniti', 'Guru', 'Pendidikan', 'Sokong aktiviti koperasi, modul latihan', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(55, '', '920901-09-5062', 'Permohonan Ahli', 'Liyana Binti Nor Hizan', '019-4036939', 'yanafiryana@gmail.com', 'Lot 801, Lorong Seri Berangan 2, Kampung Pulau Pisang, 06000 Jitra', 'Homestay Pulau Pisang', 'Pelancongan', 'Berniaga', 'Pelancongan', 'Mengembangkan perniagaan homestay', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(56, '', '990221-02-5443', 'Permohonan Ahli', 'Mohd Asyraf Najmi Bin Ramli', '011-10516844', 'asyraf.grabas@gmail.com', 'No. 106, Lorong 5, Taman Mustika, Jalan Hutan Kampung, 05350 Alor Setar', 'AR Transportation & Holiday', 'Pelancongan / Transport', 'Travel Agency', 'Pelancongan', 'Menyediakan pengangkutan dan pakej pelancongan', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(57, '', '750505-02-5186', 'Permohonan Ahli', 'Kanda Kitsna', '012-3367889', 'kandakit@yahoo.com', 'Kampung Tok Set, Mukim Padang Kerbau, 06750 Pendang, Kedah', '', 'Pelancongan', 'Berniaga', 'Produk pelancongan', 'Produk pelancongan baru', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(58, '', '770514-02-5653', 'Permohonan Ahli', 'Muhammad Imran Bin Mohd Isa', '012-5102007', 'imran.b24u@gmail.com', 'No. 3A, Taman Bee Bee Park, Jalan Jerai 4, Simpang Kuala, 05400 Alor Setar', 'Imzwana Enterprise', 'Akuakultur / Ternakan', 'Guru', 'Penternakan', 'Pasaran tilapia merah, kambing susu', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(59, '', '620818-02-5245', 'Permohonan Ahli', 'Abdul Rahman Bin Ahmad', '012-5108191', 'mankuala8191@gmail.com', 'No. F589, Lorong Air Masin, Batas Paip, Jalan Kuala Kedah, 06600 Kuala Kedah', 'Chalet Rimbun Hijau', 'Penginapan / Chalet', 'Usahawan', 'Chalet & Dusun Durian', 'Menimba ilmu perniagaan, urus chalet & dusun durian', 'Tuan Ku Jalil', 0, 0, 0, 0, '', 'password', NULL, NULL),
(60, '', '870215-02-5897', 'Permohonan Ahli', 'Muhd Zakhwan Bin Mhd Zahari', '012-4562125', 'wafaharmoni@yahoo.com', 'No. 132, Jalan Fajar, Jalan Sultanah, 05350 Alor Setar, Kedah', 'RTS Sound Production', 'Event Management', 'Usahawan', 'Event / Sound System', 'Promosi budaya Kedah, event sound & lighting', '', 0, 0, 0, 0, '', 'password', NULL, NULL),
(61, '', '700226-06-5470', 'Permohonan Ahli', 'Tun Sarimah Mohd Sharif', '016-9227055', 'tunshasha@gmail.com', '?Teratakku? No.2, Lorong 2/12B, Kg Batu Muda, Ampat Tin, 51100 KL', 'My Travel Agency / JMV Ferry', 'Travel / Ferry', 'Pemilik', 'Travel / Ferry', 'Agen pelancongan, operator feri', 'Roslan Othman', 0, 0, 0, 0, '', 'password', NULL, NULL),
(62, '', '580224-02-5631', 'Permohonan Ahli', 'Uzur Bin Abd Majid', '013-4305080', 'uzirmajid@gmail.com', 'No. 96, Bukit Indah, Bandar Darulaman, 06000 Jitra, Kedah', 'AMZED Development Sdn Bhd', 'Resort', 'Pemilik', 'Resort', 'Mengusahakan resort', 'Pn Salina', 0, 0, 0, 0, '', 'password', NULL, NULL),
(63, '', '640828-02-5343', 'Permohonan Ahli', 'Mohammad Jamil Bin Said', '019-5758282', 'jamilmotac@gmail.com', 'No. 4286, Jalan Serampang, Taman Ria Jaya, 08000 Sungai Petani, Kedah', 'Heavenly Travel Sdn Bhd', 'Travel Agency', 'Senior Manager', 'Travel Agency / MOTAC', 'Bekas pegawai MOTAC, menyokong koperasi', 'Koperasi', 0, 0, 0, 0, '', 'password', NULL, NULL),
(64, '', '920816-02-5086', 'Permohonan Ahli', 'Rafieza Adiba Bt Roslan', '012-2654055', 'rafieza.roslan@gmail.com', 'No. 995, Jalan Alyssa 1, Taman Tunku Sarina, Jitra, Kedah', 'Butik An-Najjah', 'Butik Pakaian', 'Pemilik', 'Butik', 'Pengurusan butik', 'Salina', 0, 0, 0, 0, '', 'password', NULL, NULL),
(65, '', '950514-02-5256', 'Permohonan Ahli', 'Rasyeeda Atiqah Bt Roslan', '012-6754055', 'rasyeeda.atiqah@gmail.com', 'Jitra, Kedah', 'Butik An-Najjah', 'Butik Pakaian', 'Penolong Pengurus', 'Pengurusan Butik', 'Membantu operasi butik', 'Pn Salina', 0, 0, 0, 0, '', 'password', NULL, NULL),
(66, '', '670914-02-5945', 'Permohonan Ahli', 'Abdul Gani Bin Che Su', '019-5121409', 'abdulganiabdulganibinchesu@gmail.com', 'No. 1A (Tepi FAMA), Jalan Gangsa, Alor Setar, Kedah', 'Agnia Jaya Enterprise', 'Kedai Makanan', 'Pengurus', 'Pengurusan Kedai', 'Menjalankan kedai makan', 'En Roslan', 0, 0, 0, 0, '', 'password', NULL, NULL),
(67, '', '900729-07-5239', 'Permohonan Ahli', 'Mohamad Syazwan Zamer', '013-5235925', 'msyazwanzamer@gmail.com', 'Jitra, Kedah', 'Butik An-Najjah', 'Butik Pakaian', 'Operation', 'Operasi', 'Operasi butik', 'Salina', 0, 0, 0, 0, '', 'password', NULL, NULL),
(68, '', '', 'Permohonan Ahli', 'Samsudin bin Abdullah', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, '', 'password', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kkpk_members`
--
ALTER TABLE `kkpk_members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kkpk_members`
--
ALTER TABLE `kkpk_members`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
