-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2022 at 02:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tpkad_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name_id` int(11) DEFAULT NULL,
  `office_status_id` int(11) DEFAULT NULL,
  `bank_operational_id` int(11) DEFAULT NULL,
  `bank_owner_id` int(11) DEFAULT NULL,
  `dat_i_id` int(11) DEFAULT NULL,
  `dat_i_i_id` int(11) DEFAULT NULL,
  `kr_id` int(11) DEFAULT NULL,
  `job_desk_id` int(11) DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_maps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_pos_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_no_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_no_permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_close_permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_date_permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_status_permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_date_operation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_date_change` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_date_close` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_no_close` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `id_bank`, `bank_name_id`, `office_status_id`, `bank_operational_id`, `bank_owner_id`, `dat_i_id`, `dat_i_i_id`, `kr_id`, `job_desk_id`, `bank_name`, `bank_address`, `longitude`, `latitude`, `bank_maps`, `bank_pos_code`, `bank_no_phone`, `bank_no_permission`, `bank_close_permission`, `bank_date_permission`, `bank_status_permission`, `bank_date_operation`, `bank_date_change`, `bank_date_close`, `bank_no_close`, `bank_status`, `created_at`, `updated_at`) VALUES
(1, '002', 1, 2, 1, 1, 1, 2, 1, 1, 'Kot. Palangka Raya admin 1', 'Jl. Patimura', '113.89394706287402', '-2.228464874834742', 'http=>//maps.google.com', '73112', '0812312341234', 'IZIN/01/01', NULL, '01 Agustus 2022', NULL, '03 Agustus 2022', NULL, NULL, NULL, 'active', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(2, '002', 1, 2, 1, 1, 1, 2, 1, 1, 'Kot. Palangka Raya Anak 1 bank 1', 'Jl. Patimura', '113.91129462172279', '-2.229323015142654', 'http=>//maps.google.com', '73112', '0812312341234', 'IZIN/01/01', NULL, '01 Agustus 2022', NULL, '03 Agustus 2022', NULL, NULL, NULL, 'active', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(3, '002', 1, 2, 1, 1, 1, 2, 1, 1, 'Kot. Palangka anak 2 bank 1', 'Jl. Patimura', '113.90236320528572', '-2.2074402815327403', 'http=>//maps.google.com', '73112', '0812312341234', 'IZIN/01/01', NULL, '01 Agustus 2022', NULL, '03 Agustus 2022', NULL, NULL, NULL, 'active', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(4, '2323454', 3, 1, 1, 1, 1, 1, 1, 1, 'Induk Kedua', 'Jalan Bik Kedua', '113.9027067213026', '-2.2196260005937773', 'http://maps.google.com', '2134', '3213', '213', NULL, '24 Agustus 2022', NULL, '13 Agustus 2022', NULL, NULL, NULL, 'active', '2022-09-27 19:53:17', '2022-09-27 19:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `bank_admins`
--

CREATE TABLE `bank_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_admins`
--

INSERT INTO `bank_admins` (`id`, `bank_id`, `user_id`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '08080808', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(2, 2, 3, '08080808', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(3, 3, 4, '08080808', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(4, 4, 5, NULL, '2022-09-27 19:54:17', '2022-09-27 19:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `bank_groups`
--

CREATE TABLE `bank_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_group_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_names`
--

CREATE TABLE `bank_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_names`
--

INSERT INTO `bank_names` (`id`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, 'PT. Bank Rakyat Indonesia (Persero), Tbk', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(2, 'PT. Bank Mandiri (Persero), Tbk', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(3, 'PT Bank Induk Kedua', '2022-09-27 19:53:00', '2022-09-27 19:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `bank_operationals`
--

CREATE TABLE `bank_operationals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_operational` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_operationals`
--

INSERT INTO `bank_operationals` (`id`, `bank_operational`, `created_at`, `updated_at`) VALUES
(1, 'Bank Konvensional', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(2, 'Bank Syariah', '2022-09-27 19:52:45', '2022-09-27 19:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `bank_owners`
--

CREATE TABLE `bank_owners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_owners`
--

INSERT INTO `bank_owners` (`id`, `bank_owner`, `created_at`, `updated_at`) VALUES
(1, 'Bank Pemerintah', '2022-09-27 19:52:45', '2022-09-27 19:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `dat_i_i_s`
--

CREATE TABLE `dat_i_i_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dat_i_i_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dat_i_i_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dat_i_i_s`
--

INSERT INTO `dat_i_i_s` (`id`, `dat_i_i_code`, `dat_i_i_name`, `created_at`, `updated_at`) VALUES
(1, '5804', 'Kab. Murung Raya', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(2, '5808', 'Kab. Barito Utara', '2022-09-27 19:52:45', '2022-09-27 19:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `dat_i_s`
--

CREATE TABLE `dat_i_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dat_i_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dat_i_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dat_i_s`
--

INSERT INTO `dat_i_s` (`id`, `dat_i_code`, `dat_i_name`, `created_at`, `updated_at`) VALUES
(1, '58', 'Kalimantan Tengah', '2022-09-27 19:52:45', '2022-09-27 19:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_information`
--

CREATE TABLE `financial_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `financial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `litte_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paragrafh_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paragrafh_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paragrafh_3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_information`
--

INSERT INTO `financial_information` (`id`, `slug`, `financial`, `title`, `litte_description`, `paragrafh_1`, `paragrafh_2`, `paragrafh_3`, `path_image`, `created_at`, `updated_at`) VALUES
(1, 'kur', 'KUR', 'Ini Judul', 'Program Kredit Usaha Rakyat (KUR) adalah salah satu program pemerintah dalam meningkatkan akses pembiayaan kepada Usaha Mikro, Kecil, dan Menengah (UMKM) yang disalurkan melalui lembaga keuangan dengan pola penjaminan.', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', 'image/media/s.png', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(2, 'k-pmr', 'K-PMR', 'Ini Judul', 'K-PMR Program Kredit Usaha Rakyat (KUR) adalah salah satu program pemerintah dalam meningkatkan akses pembiayaan kepada Usaha Mikro, Kecil, dan Menengah (UMKM) yang disalurkan melalui lembaga keuangan dengan pola penjaminan.', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', 'image/media/s.png', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(3, 'buka-rekening', 'Buka Rekening', 'Ini Judul', 'Buka Rekening Program Kredit Usaha Rakyat (KUR) adalah salah satu program pemerintah dalam meningkatkan akses pembiayaan kepada Usaha Mikro, Kecil, dan Menengah (UMKM) yang disalurkan melalui lembaga keuangan dengan pola penjaminan.', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', 'image/media/s.png', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(4, 'simpel', 'SIMPEL', 'Ini Judul', 'SIMPLE adalah salah satu program pemerintah dalam meningkatkan akses pembiayaan kepada Usaha Mikro, Kecil, dan Menengah (UMKM) yang disalurkan melalui lembaga keuangan dengan pola penjaminan.', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', 'image/media/s.png', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(5, 'qris', 'QRIS', 'Ini Judul', 'QRIS adalah lorem dalah salah satu program pemerintah dalam meningkatkan akses pembiayaa', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', 'image/media/s.png', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(6, 'latar-belakang', 'Latar Belakang', 'Latar Belakang', 'Akses keuangan merupakan hak dasar bagi seluruh masyarakat dan memiliki peran penting dalam meningkatkan taraf hidup masyarakat.', 'Akses keuangan merupakan hak dasar bagi seluruh masyarakat dan memiliki peran penting dalam meningkatkan taraf hidup masyarakat. Hal ini sejalan dengan Rencana Pembangunan Jangka Menengah Nasional (RPJMN) 2015-2019 bahwa salah satu sasaran penguatan sektor keuangan dalam lima tahun mendatang adalah meningkatnya akses masyarakat dan UMKM terhadap layanan jasa keuangan formal dalam kerangka pembangunan ekonomi yang inklusif dan berkeadilan.', 'Hasil Survei Nasional Literasi Keuangan yang dilakukan oleh Otoritas Jasa Keuangan (OJK) pada tahun 2013 menunjukkan bahwa tingkat pemahaman masyarakat terhadap produk serta layanan jasa keuangan masih rendah yaitu hanya 21,84%, sementara tingkat inklusi keuangan mencapai 59,74%. Tingkat literasi dan inklusi tersebut tidak merata di sektor jasa keuangan, dimana tingkat literasi dan inklusi sektor perbankan relatif lebih tinggi dari pada sektor keuangan lainnnya.\r\n\r\nDalam berbagai forum kebijakan publik, isu akses keuangan sering dikaitkan dengan upaya untuk mendorong UMKM dan sektor produktif. Dalam pertemuan tahunan OJK dengan pelaku industri jasa keuangan tanggal 15 Januari 2016 yang dihadiri oleh Presiden Republik Indonesia, disebutkan perlunya upaya nyata untuk mendorong kegiatan ekonomi produktif melalui pemberdayaan kemampuan UMKM, pengembangan ekonomi daerah, dan penguatan sektor ekonomi prioritas. Hal ini memerlukan program yang mampu mempercepat akses keuangan di daerah dalam rangka menciptakan pertumbuhan ekonomi yang lebih merata, partisipatif, dan inklusif.', 'Program percepatan akses keuangan tersebut sangat membutuhkan peran aktif dari Pemerintah Daerah dan stakeholders terkait. Untuk itu, OJK dan Kementerian Dalam Negeri serta institusi terkait lainnya membentuk Tim Percepatan Akses Keuangan Daerah atau yang disingkat dengan TPAKD.', 'image/assets/6png', '2022-09-27 19:52:46', '2022-09-29 07:07:35'),
(7, 'dasar-pembentukan', 'Dasar Pembentukan', 'Dasar Pembentukan', 'Laar Belakang adalah lorem dalah salah satu program pemerintah dalam meningkatkan akses pembiayaa', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', 'image/media/s.png', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(8, 'road-map', 'Road Map', 'Road Map', 'Laar Belakang adalah lorem dalah salah satu program pemerintah dalam meningkatkan akses pembiayaa', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', 'image/media/s.png', '2022-09-27 19:52:46', '2022-09-27 19:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `grafiks`
--

CREATE TABLE `grafiks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_value_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_value_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_value_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_value_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_aktif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grafiks`
--

INSERT INTO `grafiks` (`id`, `name`, `name_value_1`, `name_value_2`, `name_value_3`, `name_value_4`, `value_1`, `value_2`, `value_3`, `value_4`, `is_aktif`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-09-27 19:52:46', '2022-09-27 19:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `grafik_duas`
--

CREATE TABLE `grafik_duas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_value_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_value_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_value_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_value_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_aktif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grafik_duas`
--

INSERT INTO `grafik_duas` (`id`, `name`, `name_value_1`, `name_value_2`, `name_value_3`, `name_value_4`, `value_1`, `value_2`, `value_3`, `value_4`, `is_aktif`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-09-27 19:52:46', '2022-09-27 19:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `job_desks`
--

CREATE TABLE `job_desks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_desk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_desks`
--

INSERT INTO `job_desks` (`id`, `job_desk`, `created_at`, `updated_at`) VALUES
(1, 'Bank Devisa', '2022-09-27 19:52:45', '2022-09-27 19:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id`, `kr`, `created_at`, `updated_at`) VALUES
(1, 'KR 9', '2022-09-27 19:52:45', '2022-09-27 19:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `kutipans`
--

CREATE TABLE `kutipans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kutipan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_06_132321_create_bank_groups_table', 1),
(6, '2022_08_08_132218_create_bank_admins_table', 1),
(7, '2022_08_08_132239_create_banks_table', 1),
(8, '2022_08_08_133222_create_dat_i_s_table', 1),
(9, '2022_08_08_133312_create_office_statuses_table', 1),
(10, '2022_08_08_134215_create_dat_i_i_s_table', 1),
(11, '2022_08_08_135703_create_krs_table', 1),
(12, '2022_08_08_135944_create_job_desks_table', 1),
(13, '2022_08_09_123759_create_bank_operationals_table', 1),
(14, '2022_08_09_124015_create_bank_owners_table', 1),
(15, '2022_08_09_234728_create_bank_names_table', 1),
(16, '2022_08_10_084816_create_roles_table', 1),
(17, '2022_08_11_073030_create_news_table', 1),
(18, '2022_08_11_080800_create_profiles_table', 1),
(19, '2022_08_11_084242_create_pengajuan_kurs_table', 1),
(20, '2022_09_22_022110_create_kutipans_table', 1),
(21, '2022_09_22_022520_create_grafiks_table', 1),
(22, '2022_09_27_092028_create_grafik_duas_table', 1),
(23, '2022_09_27_134309_create_financial_information_table', 1),
(24, '2022_09_28_012729_create_tpakd_kaltengs_table', 1),
(25, '2022_09_28_012905_create_documents_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `little_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paragrafh_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paragrafh_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paragrafh_3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `little_description`, `photo_path`, `paragrafh_1`, `paragrafh_2`, `paragrafh_3`, `status`, `slug`, `excerpt`, `date`, `created_at`, `updated_at`) VALUES
(1, 'title -aaa', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officia laborum, sequi, amet tenetur assumenda sint quaerat natus autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, magni voluptatibus errom t. Officia laborum, sequi, amet tenetur assumenda sint quaerat natus autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, magni voluptatibus errom', 'image/media/s.png', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', '1', 'title--aaa', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officia labo...', '2022-09-29', '2022-09-27 19:52:46', '2022-09-29 07:27:32'),
(2, 'title -bbb', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom', 'image/media/s.png', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', NULL, 'dua', NULL, '2020-08-22', '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(3, 'title -ccc', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom\n             Lorem ipsum, dolor sit amet consectetur adipisicing elit.\n             Officia laborum, sequi, amet tenetur assumenda sint quaerat natus \n             autem reprehenderit obcaecati eum quam! Tempore accusamus vero nam ullam, \n             magni voluptatibus errom', 'image/media/s.png', 'paragrafh 1', 'paragrafh 2', 'paragrafh 3', NULL, 'tiga', NULL, '2020-08-22', '2022-09-27 19:52:46', '2022-09-27 19:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `office_statuses`
--

CREATE TABLE `office_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_statuses`
--

INSERT INTO `office_statuses` (`id`, `office_status`, `created_at`, `updated_at`) VALUES
(1, 'Kantor Cabang Pembantu (Dalam Negeri)', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(2, 'Kantor Cabang (Dalam Negeri)', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(3, 'Kantor Fungsional', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(4, 'Kantor Kas', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(5, 'Kantor Cabang Pembantu (Dalam Negeri) Bank Umum Syariah', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(6, 'Kantor Fungsional Bank Umum Syariah', '2022-09-27 19:52:45', '2022-09-27 19:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_kurs`
--

CREATE TABLE `pengajuan_kurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kur_nama` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kur_email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kur_nik` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kur_gender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kur_no_telepon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kur_tanggal_lahir` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_pending` date DEFAULT NULL,
  `date_proses` date DEFAULT NULL,
  `date_done` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_kurs`
--

INSERT INTO `pengajuan_kurs` (`id`, `kur_nama`, `kur_email`, `kur_nik`, `kur_gender`, `kur_no_telepon`, `kur_tanggal_lahir`, `bank_id`, `date_pending`, `date_proses`, `date_done`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ahmadi baru', 'clanuciha31@email.com', '1231231231231231', 'L', '123123123123', '2022-09-30', '1', '2022-09-30', NULL, NULL, 'pending', '2022-09-30 05:40:40', '2022-09-30 05:40:40'),
(2, 'Ahmadi baru', 'clanuciha31@gmail.com', '1231231231231232', 'P', '123123123123', '2022-09-30', '1', '2022-09-30', NULL, NULL, 'pending', '2022-09-30 05:46:05', '2022-09-30 05:46:05'),
(3, 'Ahmadi Kur Udin', 'clanuciha31@gmail.com', '1231231231231232', 'P', '123123123123', '2022-10-01', '3', '2022-10-01', NULL, NULL, 'pending', '2022-09-30 16:39:06', '2022-09-30 16:39:06'),
(4, 'Ahmadi Kur Udin', 'clanuciha31@gmail.com', '1231231231231232', 'P', '123123123123', '2022-10-01', '3', '2022-10-01', NULL, NULL, 'pending', '2022-09-30 16:39:31', '2022-09-30 16:39:31'),
(5, 'Ahmadi Kur Udin', 'clanuciha31@gmail.com', '1231231231231232', 'P', '123123123123', '2022-10-01', '3', '2022-10-01', NULL, NULL, 'pending', '2022-09-30 16:41:11', '2022-09-30 16:41:11'),
(6, 'Ahmadi Kur kedua', 'clanuciha31@gmail.com', '1231231231231232', 'P', '123123123123', '2022-10-01', '3', '2022-10-01', NULL, NULL, 'pending', '2022-09-30 16:41:28', '2022-09-30 16:41:28'),
(7, 'Ahmadi Kur kedua', 'clanuciha31@gmail.com', '1231231231231232', 'P', '123123123123', '2022-10-01', '3', '2022-10-01', NULL, NULL, 'pending', '2022-09-30 16:42:15', '2022-09-30 16:42:15'),
(8, 'Ahmadi Kur kedua', 'clanuciha31@gmail.com', '1231231231231232', 'P', '123123123123', '2022-10-01', '3', '2022-10-01', NULL, NULL, 'pending', '2022-09-30 16:42:34', '2022-09-30 16:42:34'),
(9, 'Ahmadi Kur kesembilan', 'clanuciha31@gmail.com', '1231231231231232', 'P', '123123123123', '2022-10-01', '3', '2022-10-01', NULL, NULL, 'pending', '2022-09-30 16:43:07', '2022-09-30 16:43:07'),
(10, 'Ahmadi Kur kesembilandasd', 'clanuciha31@gmail.com', '1231231231231232', 'L', '123123123123', '2022-10-02', '1', '2022-10-02', NULL, NULL, 'pending', '2022-10-02 07:32:54', '2022-10-02 07:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `latar_belakang_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latar_belakang_photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dasar_pembentukan_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dasar_pembentukan_photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `road_map_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `road_map_photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(2, 'admin-bank', '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(3, 'bank', '2022-09-27 19:52:45', '2022-09-27 19:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `tpakd_kaltengs`
--

CREATE TABLE `tpakd_kaltengs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tpakd_kaltengs`
--

INSERT INTO `tpakd_kaltengs` (`id`, `slug`, `name`, `status`, `path_image`, `created_at`, `updated_at`) VALUES
(1, 'tpakd-kabupaten-katingan-edit', 'TPAKD Kabupaten Katingan edit', '1', 'assets/img/1jpg', '2022-09-29 12:11:29', '2022-09-29 05:49:30'),
(2, 'dua', 'TPAKD Kabupaten Sukamara', '1', 'assets/img/5Kobar.png', '2022-09-29 12:11:29', '2022-09-29 12:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin@gmail.com', 1, '$2y$10$TWDSLcbOWCl9mmow3IM87.ockM1LUDFfyWyNk1QRcj9bcnl6VvA9m', NULL, '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(2, 'admin-bank-1', 'adminbank1@gmail.com', 2, '$2y$10$gOquMfnKet8zIvC5j6uVAOb3gCxncSM1WzwKBtwulysdmOerfw6ze', NULL, '2022-09-27 19:52:45', '2022-09-27 19:52:45'),
(3, 'group-1-bank-1', 'group_1_bank_1@gmail.com', 3, '$2y$10$qCKCOpF/y/SFj/1wDcDseeuR/DpppQIpxvFU7lkhik4RvC/Bt6EXm', NULL, '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(4, 'group-1-bank-2', 'group_1_bank_2@gmail.com', 3, '$2y$10$Jr0Z/kKd0NsNNfvEMNECQ.T1R4vU6rrkUrPGUFJEay3SEkfJrcZZi', NULL, '2022-09-27 19:52:46', '2022-09-27 19:52:46'),
(5, 'induk-kedua', NULL, 2, '$2y$10$C0IfPlrt35PKjt9VOpXD4uUdGkZ344vyIyCaJp/czJrLYrhX.Gky2', NULL, '2022-09-27 19:54:17', '2022-09-27 19:54:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_admins`
--
ALTER TABLE `bank_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_groups`
--
ALTER TABLE `bank_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_names`
--
ALTER TABLE `bank_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_operationals`
--
ALTER TABLE `bank_operationals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_owners`
--
ALTER TABLE `bank_owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dat_i_i_s`
--
ALTER TABLE `dat_i_i_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dat_i_s`
--
ALTER TABLE `dat_i_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `financial_information`
--
ALTER TABLE `financial_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grafiks`
--
ALTER TABLE `grafiks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grafik_duas`
--
ALTER TABLE `grafik_duas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_desks`
--
ALTER TABLE `job_desks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kutipans`
--
ALTER TABLE `kutipans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_statuses`
--
ALTER TABLE `office_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengajuan_kurs`
--
ALTER TABLE `pengajuan_kurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tpakd_kaltengs`
--
ALTER TABLE `tpakd_kaltengs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_admins`
--
ALTER TABLE `bank_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_groups`
--
ALTER TABLE `bank_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_names`
--
ALTER TABLE `bank_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_operationals`
--
ALTER TABLE `bank_operationals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_owners`
--
ALTER TABLE `bank_owners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dat_i_i_s`
--
ALTER TABLE `dat_i_i_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dat_i_s`
--
ALTER TABLE `dat_i_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_information`
--
ALTER TABLE `financial_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grafiks`
--
ALTER TABLE `grafiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grafik_duas`
--
ALTER TABLE `grafik_duas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_desks`
--
ALTER TABLE `job_desks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kutipans`
--
ALTER TABLE `kutipans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `office_statuses`
--
ALTER TABLE `office_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengajuan_kurs`
--
ALTER TABLE `pengajuan_kurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tpakd_kaltengs`
--
ALTER TABLE `tpakd_kaltengs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
