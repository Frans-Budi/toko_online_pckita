-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221207.ce5ce76a8d
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2022 pada 08.09
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pckita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Laptop'),
(2, 'Camera'),
(3, 'TV'),
(4, 'Headphones'),
(5, 'Storage'),
(6, 'Speaker'),
(7, 'Microphone');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_konsumen` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `kuantitas` int(10) UNSIGNED DEFAULT NULL,
  `sub_total` double UNSIGNED DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_konsumen`, `id_produk`, `kuantitas`, `sub_total`, `status`) VALUES
(44, 20, 27, 1, 2, 1),
(45, 20, 9, 1, 847, 1),
(46, 20, 30, 3, 18, 1),
(47, 20, 33, 1, 7, 1),
(48, 19, 9, 1, 847, 1),
(52, 21, 19, 1, 146, 1),
(53, 21, 27, 3, 6, 0),
(54, 20, 22, 1, 12, 1),
(55, 20, 32, 1, 25, 1),
(56, 20, 32, 1, 25, 1),
(57, 20, 12, 1, 25, 1),
(58, 20, 17, 1, 259, 1),
(59, 20, 4, 1, 272, 1),
(60, 20, 28, 1, 7, 1),
(61, 20, 4, 1, 272, 1),
(62, 20, 5, 1, 243, 0),
(63, 20, 12, 1, 25, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerpem`
--

CREATE TABLE `kerpem` (
  `id_keranjang` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kerpem`
--

INSERT INTO `kerpem` (`id_keranjang`, `id_pembayaran`) VALUES
(44, 9),
(45, 10),
(46, 10),
(47, 10),
(48, 11),
(52, 12),
(54, 13),
(55, 14),
(56, 15),
(57, 16),
(58, 17),
(59, 18),
(60, 19),
(61, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsumen`
--

CREATE TABLE `konsumen` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konsumen`
--

INSERT INTO `konsumen` (`id`, `username`, `password`) VALUES
(19, 'fbklegend', '$2y$10$flAJE5c.J.Sy5TLpvb8Q0u9Mwprh07atVbi6bhEVkpLXREAuTl51K'),
(20, 'fazry', '$2y$10$CSuFOo69EPCUE0eWNlcwdu3u91ciJdD5GVsBOdN5a/qMijFmtEvoC'),
(21, 'teuku', '$2y$10$R5En0NF8AK4wOZO/d0zhKuWYsQpsQbNyygSKsAEKQZnFTQQYVUeY2'),
(22, 'shisily', '$2y$10$K/4yHYqxvYOY7DfMZczKsORkj9nnd02jI2K/9RtCzpGnom0rHBAuO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `met_pembayaran`
--

CREATE TABLE `met_pembayaran` (
  `id` int(11) NOT NULL,
  `alat_pembayaran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `met_pembayaran`
--

INSERT INTO `met_pembayaran` (`id`, `alat_pembayaran`) VALUES
(1, 'Bank BCA'),
(2, 'Bank BRI'),
(3, 'Bank BNI'),
(4, 'Bank BSI'),
(5, 'Bank Mandiri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `total` double UNSIGNED DEFAULT NULL,
  `id_met_pembayaran` int(11) DEFAULT NULL,
  `waktu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `invoice`, `total`, `id_met_pembayaran`, `waktu`) VALUES
(9, '63aaf7bc7b9bc', 2, 3, '2022-12-27 20:48:44'),
(10, '63ab7deb74c95', 872, 2, '2022-12-28 06:21:15'),
(11, '63abc8b1f09b9', 847, 3, '2022-12-28 11:40:17'),
(12, '63abcc44eb073', 146, 5, '2022-12-28 11:55:32'),
(13, '63abd5be7530a', 12, 2, '2022-12-28 12:35:58'),
(14, '63abd634c0d63', 25, 4, '2022-12-28 12:37:56'),
(15, '63abd64b2a013', 25, 2, '2022-12-28 12:38:19'),
(16, '63abd675e0a87', 25, 2, '2022-12-28 12:39:01'),
(17, '63abd6c4a60a4', 259, 1, '2022-12-28 12:40:20'),
(18, '63abd6eeccf81', 272, 1, '2022-12-28 12:41:02'),
(19, '63abd8218f75a', 7, 3, '2022-12-28 12:46:09'),
(20, '63abd891991b4', 272, 3, '2022-12-28 12:48:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `harga` double UNSIGNED DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `description`, `harga`, `gambar`, `id_kategori`) VALUES
(3, 'Nakamichi Soundbox LITE Speaker Portable Audio Wireless Bluetooth', '✨Sesuai dengan tagline kami : &quot; Your Luxury Audio World&quot;, Nakamichi di design atas kecintaan pada suara melodi terbaik oleh founder kami Etsuro Nakamichi terhadap musik dan komitmen untuk memberikan kualitas dan performa terbaik musik\r\n\r\nNakamichi mempunyai beragam produk seperti Earphone, Speaker, TWS, Headphone, speaker hingga Soundbar', 44, '63a7ccdab2c42.jpg', 6),
(4, 'Asus A416MAO N4020 4GB 256SSD W11+OHS 14&quot; FHD VIPS - GREY', 'SPEISIFIKASI :\r\n- Processor : Intel DualCore Celeron N4020\r\n- Graphic : Intel HD Graphics\r\n- Screen : 14&quot; FHD\r\n- Memori : 4GB DDR4\r\n- Kapasitas Penyimpanan : 256GB SSD\r\n- Sistem Operasi : Windows 11\r\n- Office Home Students 2021', 272, '63a70e990188a.jpg', 1),
(5, 'Lenovo ideapad Slim 3i Celeron N4020 256 GB SSD Win10+OHS Murah - BUSINESS BLACK', 'Laptop Lenovo ideapad Slim 3i Celeron N4020 256 GB SSD Win10+OHS Murah\r\n\r\nSKU:\r\n\r\n81WH00A2ID - Business Black\r\n81WH00A3ID - Platinum Grey\r\n81WH00A4ID - Abyss Blue\r\n81WH0049ID - FHD - Black\r\n81WH0047ID - FHD - PLATINUMGREY', 243, '63a713dadbc06.jpg', 1),
(8, 'Dell latitude core i5 E7450-5300U - Original Laptop Dell', 'The best second, always low prices\r\n\r\nPENGIRIMAN SETIAP HARI | BUKA JAM 09:00 - 21:00 WIB\r\n\r\nPasti Termurah | Pasti Terbaik | Pasti Bergaransi\r\n\r\nSTOCK SILAKAN TANYAKAN DAHULU YA GAN!\r\n\r\nLAMA GARANSI : 30 Hari garansi Toko lengkap dengan nota dan keterangan garansi', 377, '63a714729d562.jpg', 1),
(9, 'Apple Macbook Air 2020 M1 Chip 13 inch 512GB Touch ID Grey Silver Gold - CPO, 256GB GOLD', 'BONUS SCREEN DAN KEYBOARD PROTECTOR!\r\n*SELAMA PERSEDIAAN MASIH ADA*\r\n(Jika tidak dikirim no complain ya gan karena bonus sesuai ketersediaan stock)\r\n\r\nSekilas info tentang kami :\r\n1. Brand new - Original - Segel\r\n2. Garansi Resmi Apple 1 Tahun, Garansi Toko 7 Hari\r\n3. Gratis Ongkir &amp; Asuransi + Cashback up to 300rb + Bisa COD\r\n4. Positif review 99 % dari 100 % kepuasan customer\r\n5. Sudah melayani 100,000 ++ customer secara online\r\n6. After sales yg siap melayani anda selama 24 jam', 847, '63a714cdf28f9.jpg', 1),
(10, 'Sony A6000 Kit 16-50mm OSS Kamera Mirrorless A6000 Paket Original - Distributor, Memory 16GB', 'Sony A6000 kit 16-50mm OSS\r\nGaransi 1 tahun Distributor\r\nJaminan 100 baru\r\nBonus:\r\n√ Tas mirrorless\r\n√ Memory toshiba 16gb\r\n√ Cleaning kit\r\n\r\nProduct Highlights\r\n24.3MP APS-C Exmor APS HD CMOS Sensor\r\nBIONZ X Image Processor\r\nTru-Finder 0.39&quot; 1,440k-Dot OLED EVF\r\n3.0&quot; 921k-Dot Xtra Fine Tilting LCD\r\nFull HD 1080p XAVC S Video at 24/60 fps\r\nBuilt-In Wi-Fi Connectivity with NFC\r\nFast Hybrid AF &amp; 179 Phase-Detect Points\r\nUp to 11 fps Shooting and ISO 25600\r\nMulti-Interface Shoe and Built-In Flash\r\nSony 16-50mm f/3.5-5.6 OSS Zoom Lens', 485, '63a715bcd5fe7.jpg', 2),
(11, 'Canon Eos 80D Kit 18-135mm IS USM Paket', 'Product Highlights :\r\n24.2MP APS-C CMOS Sensor\r\nDIGIC 6 Image Processor\r\n3.0&quot; 1.04m-Dot Vari-Angle Touchscreen\r\nFull HD 1080p Video Recording at 60 fps\r\n45-Point All Cross-Type AF System\r\nDual Pixel CMOS AF\r\nExpanded ISO 25600, Up to 7 fps Shooting\r\nBuilt-In Wi-Fi with NFC\r\nRGB+IR 7560-Pixel Metering Sensor\r\nEF-S 18-135mm f/3.5-5.6 IS USM Lens', 1068, '63a718d581749.jpg', 2),
(12, 'CCTV Bardi Smart Indoor PTZ IP Camera Free Cloud ( Exclusive Android )', '- Apa itu Cloud Recording pada Indihome Smart?\r\nCloud Recording Indihome Smart adalah media untuk penyimpanan data recording yang ada pada IPCAM anda secara Private, dimana data tersebut dapat terjaga keamanannya.\r\n\r\n- Mengapa Cloud Recording Indihome Smart?\r\nServer Cloud Recording Indihome Smart tersimpan di Indonesia, tidak mengandalkan perangkat keras seperti SD CARD yang mudah rusak dan menyebabkan data hilang.\r\n\r\n- Apakah perlu SD CARD jika sudah berlangganan Cloud Recording Indihome Smart?\r\nTidak memerlukan SD CARD, karena Cloud Recording Indihome Smart dapat menyimpan data secara aman.\r\n\r\n- Apakah ada maksimal kapasitas untuk penyimpanan data di Cloud Recording Indihome Smart?\r\nTidak ada, penyimpanan data di Cloud Recording Indihome Smart tidak terbatas (Unlimited)', 25, '63a71933e16ef.jpg', 2),
(13, 'GoPro Hero 11 Black Action Camera - Garansi Resmi 1 Tahun', '𝐆𝐨𝐏𝐫𝐨 𝐇𝐄𝐑𝐎𝟏𝟏 𝐁𝐥𝐚𝐜𝐤\r\nGaransi resmi Changhong IT\r\n\r\n𝐒𝐩𝐞𝐬𝐢𝐟𝐢𝐤𝐚𝐬𝐢:\r\nSensor 27 MP\r\nResolusi Video 5.3K60, 4K120, 2.7K240\r\nStabilisasi Video HyperSmooth 5.0\r\nSlow Motion 8x\r\nBaterai Enduro 1720 mAh\r\nWaterproof 10 m\r\nDimensi 71,8 x 50,8 x 33,6 mm\r\nBerat 154 g\r\n\r\n𝐈𝐧 𝐓𝐡𝐞 𝐁𝐨𝐱:\r\nCamera\r\nHard case\r\nMounting buckle\r\nAdhesive curved mount\r\nThumb screw\r\nEnduro battery\r\nUSB C Cable', 556, '63a719b781901.png', 2),
(14, 'BARDI IP Smart Camera Outdoor PTZ CCTV Kamera Otomatis WiFi (Surabaya) - CCTV OutdoorPTZ', 'BARDI IP Camera Outdoor PTZ TPD merupakan kamera pintar yang dapat menyalurkan video dan suara lewat smartphone.\r\n\r\nProduk ini TIDAK TERMASUK Memory Card, jika ingin mendapatkannya harap membeli produk Bundling melalui Variasi yang ada.\r\n\r\nBARDI IP Camera Outdoor PTZ TPD memiliki tempat penyimpanan slot SD Card max 128GB (tidak termasuk) dan dapat memberi notifikasi bila ada yang lewat pada jam yang di tentukan dalam aplikasi. Pada posisi gelap akan otomatis switch ke night vision. (kamera cctv ini belum support onvif)\r\n\r\nBARDI IP Camera Outdoor PTZ TPD ini hanya hanya perlu untuk disambungkan ke sumber listrik dan dihubungkan ke aplikasi', 26, '63a719ef8ba20.jpg', 2),
(15, 'TCL 40 inch Smart TV LED - Android 11.0 - FHD - 40A7', 'Keunggulan Produk :\r\n\r\n-Panel A+ with control quality and high resolution\r\n\r\n-Certified Android TV (Android 11.0)\r\n\r\n-Gamepad /Joystick Wireless Enabled\r\n\r\n-Panel Color Up to 16,7 million\r\n\r\n-Viewing Angle Screen 178°\r\n\r\n-Bluetooth audio (Connected with Speaker/ Headset)\r\n\r\n-Certified Netflix\r\n\r\n-Certified Youtube\r\n\r\n-Perfect Smart function with Google assistant\r\n\r\n-Perfect Picture quality with FHD technology\r\n\r\n-Perfect design with super narrow bezel (Frameless)\r\n\r\n-Perfect sound quality with Dolby audio &amp; smart voice', 165, '63a7c3641c861.jpg', 3),
(17, 'Toshiba LED TV - 4K SMART VIDAA 43&quot; - 43E330LP', 'E330LP akan memberikanmu pengalaman audio-visual yang menyenangkan. Dengan kejernihan 4K dan teknologi audio yang mumpuni, membuatmu merasakan real moment yang tidak pernah kamu jumpai sebelumnya. Miliki sekarang!', 259, '63a7c3baa6a4b.jpg', 3),
(18, 'SAMSUNG 60BU8000 SMART TV CRYSTAL UHD 4K 60INCH UA60BU8000 // 60AU8000', 'Spesifikasi\r\nBrand : SAMSUNG\r\nFitur utama :\r\n- Dynamic Crystal Color\r\n- Crystal Processor 4K\r\n- Sleek and Slim (AriSlim Design dan Slim Fit Wall Mount)\r\n\r\nSpesifikasi :\r\n- Screen size : 60 inch\r\n- Resolution : 4K UHD (3,840 x 2,160)\r\n- HDR 10+ : Yes\r\n- Bluetooth Low Energy : Yes\r\n- Power Consumption (Max) : 125W\r\n- Power Suplay : AC100-240V 50/60Hz\r\n- PQI (Picture Quality Index) : 2200\r\n- Dolby Digital Plus : Yes\r\n- HDMI : 3\r\n- USB : 2\r\n- Audio Out : Optical\r\n- Set Size with Stand (WxHxD, mm) : 1353 x 814.7 x 281.8 mm\r\n- Sice Package (WxHxD) :1510 x 906 x 158 mm\r\n- Sistem operasi : TIZEN OS\r\n- Aplikasi yang tersedia : YouTube, Netflix, Film +, Browser Web, App store', 658, '63a7c4a724658.jpg', 3),
(19, 'Led Tv Coocaa 40S3u 40 inch Smart Tv Youtube', 'Hadirkan entertainment pada rumah Anda dengan COOCAA Smart TV 40S3U. TV dengan panel LED ini siap menampilkan acara favorit Anda dan keluarga dengan tampilan High Definition dengan warna yang tajam dan jernih. Anda juga dapat melakukan pulug &amp; play dengan perangkat lainnya dengan mudah, karena pada TV ini disematkan HDMI dan USB. Tidak hanya itu, fitur Smart Audio dengan bantuan teknologi SRS Dolby Audio+ akan menghasilkan suara yang lebih jelas.', 146, '63a7c5301f3b4.jpg', 3),
(20, 'Xiaomi MI TV A2 32 Inch Dolby Vision HDR10 Android Smart Digital', 'Layar\r\nTipe Layar: HD\r\nResolusi: 1.366 × 768\r\nKedalaman warna: 16,7 miliar\r\nRefresh rate: 60 Hz\r\nSudut tampilan: 178°(H)/178°(V)\r\n\r\nSpeaker\r\nSpeaker (Output Suara): 2 × 10 W\r\nMendukung Dolby Audio™, DTS-X, dan DTS® Virtual:X Sound\r\nSistem Operasi\r\nAndroid TV™\r\nProsesor\r\nCPU: CA55 × 4\r\nGPU: Mali G31 MP2\r\n\r\nKonten\r\nNetflix, Prime Video, dan YouTube bawaan\r\nRibuan aplikasi tersedia di Google Play\r\nRumah Pintar\r\nGoogle Assistant bawaan\r\nPusat kontrol rumah pintar\r\nChromecast built-in\r\nMendukung Miracast\r\nDesain\r\nUkuran: 32&quot;\r\nTampilan tanpa batas, tanpa bezel\r\nWarna: Hitam\r\nKaki penyangga: Dua buah\r\nTombol daya', 124, '63a7c5d3c5120.jpg', 3),
(21, 'SONY WH-1000XM4 Black Wireless NC Headphone / 1000XM4 / 1000X', 'ONLY MUSIC.\r\nNOTHING ELSE.\r\nSony’s intelligent industry-leading noise canceling1 headphones with premium sound elevate your listening experience with the ability to personalize and control everything you hear.\r\n\r\nIndustry-leading noise cancelation4\r\nIndustry-leading noise cancellation technology4 means you hear every word, note, and tune with incredible clarity, no matter your environment.', 249, '63a7c624a69e3.jpg', 4),
(22, 'Lenovo TH10 Headphone Bluetooth Wireless Headset Earphone 5.0 - Hitam', 'NOTE : SAAT PENGGUNAAN MENGGUNAKAN KABEL AUX, FUNGSI TOMBOL PADA HEADPHONE TIDAK AKAN BERFUNGSI\r\n\r\n-Rasakan suara HIFI,3D dengan Dual power loudspeakers dan CVC microphones.\r\n-Audio AUX yang kompatibel dengan banyak perangkat android atau ios.\r\nNyaman dipakai lama, dengan masa pakai baterai yang kuat.\r\n\r\nSpesifikasi Produk :\r\n\r\nBluetooth version : V5.0\r\nBluetooth distance : 10m\r\nSpeaker size : 40mm\r\nFrequency range : 20Hz-20KHz\r\nImpedence of glass speaker : 32Ω ±15%\r\nSpeaker sensitivity : 110dB±3dB\r\nMicrophone sensitivity : -42dB±3dB\r\nPlaying time : about 10 hours (60% volume)\r\nBattery capacity : 3.7V/300mAh\r\nKabel koneksi : 3.5mm audio cable\r\nCharging interface : USB\r\nSurround : 9D\r\nBluetooth transmission distance : 10-15m\r\nBattery life : 8 hours of gaming, 12 hours of playback', 12, '63a7c6a1b7e22.jpg', 4),
(23, 'THINKPLUS LENOVO TH10 HEADPHONE BLUETOOTH HEADSET EARPHONE V5.0 - Hitam', 'Keunggulan Produk :\r\n\r\n- Rasakan suara HIFI,3D dengan Dual power loudspeakers dan CVC microphones.\r\n- Audio AUX yang kompatibel dengan banyak perangkat android atau ios.\r\n- Nyaman dipakai lama, dengan masa pakai baterai yang kuat.\r\n\r\nSpesifikasi Produk :\r\n\r\nBluetooth version : V5.0\r\nBluetooth distance : 10m\r\nSpeaker size : 40mm\r\nFrequency range : 20Hz-20KHz\r\nImpedence of glass speaker : 32Ω ±15%\r\nSpeaker sensitivity : 110dB±3dB\r\nMicrophone sensitivity : -42dB±3dB\r\nPlaying time : about 10 hours (60% volume)\r\nBattery capacity : 3.7V/300mAh\r\nKabel koneksi : 3.5mm audio cable\r\nCharging interface : USB\r\nSurround : 9D\r\nBluetooth transmission distance : 10-15m\r\nBattery life : 8 hours of gaming, 12 hours of playback', 11, '63a7c6d3213d0.jpg', 4),
(24, 'ACOME Wired Earphone Headset In-Ear Color Super Bass Headphone AW02 - Black Green', 'Bahan Metal dengan Desain Mix Warna\r\n- Warna Tahan Lama, Tidak Gampang Luntur, &amp; Anti Gores\r\n\r\nAluminium Super Bass Earphone\r\n- Suara Lebih Terjaga dengan Efek Bass yang Lebih Detail\r\n\r\nSpeaker Dynamic 10 mm Diameter\r\n- Suara Lebih Jelas, Lebih Hidup &amp; Lebih Real\r\n\r\nSmart Control\r\n- Cukup geser ke atas atau ke bawah untuk mengatur volume &amp; Cukup tekan 1 tombol untuk mengatur lagu serta\r\nmenerima panggilan', 15, '63a7c8bc58878.jpg', 4),
(25, 'Headphone Headset Kabel Anak Unitech J19 + Microphone Extra Bass - Biru Muda', 'HIGHLIGHT\r\n- Bantalan telinga empuk sehingga nyaman dipakai untuk waktu yang lama\r\n- Model keren\r\n- Dilengkapi dengan microphone untuk melakukan voice call / video call\r\n- 40mm Driver Unit\r\n\r\nSPESIFIKASI\r\nPembicara: 40mm\r\nSensitivitas: 105 dB S.P.L pada 1Khz\r\nImpedansi: 32 ohm\r\nRespon Frekuensi: 20Hz-20.000Hz\r\nNilai Daya: 15mQ\r\nKemampuan Daya: 150mW\r\nPanjang kabel: 2,3 +/- 0,3 m\r\nUnit Mikrofon: 6x5mm -58dB +/- 3dB\r\nJenis Plug: Stereo 3.5mm', 6, '63a7ca530de11.jpg', 4),
(26, 'FlashDisk OTG Dual Drive Micro USB 3.0/ 32GB, 64GB, 128GB - 64 gb', 'FlashDisk OTG Dual Drive Micro USB 3.0/ 32GB, 64GB, 128GB\r\n\r\nReady stock!\r\nCara Untuk cek harga: -\r\nClick &quot;kapasitas&quot; yang ingin diorder - Harga\r\n\r\nReady Storage capacity: 32Gb, 64GB,128GB\r\n\r\nUltra Dual USB Drive m3.1 32GB/64GB/128GB Hitam dan Biru Version\r\n- Mendukung ponsel Android terbaru - konektor micro USB di 1 sisi dan USB 3.1 di sisi lainnya\r\n- kinerja high-speed USB 3.1 hingga 150MB/s untuk memindahkan file lebih cepat antara drive dan ke komputer\r\n- kompatibel dengan HP android yang support OTG micro USB', 5, '63a7cad607c74.jpg', 5),
(27, 'Flashdisk SanDisk Cruzer Blade - USB 16GB 32GB 64GB 128GB - FlashDrive - 2GB', 'lashdisk Cruzer Blade\r\n(Langsung order aja ya kak, kita selalu ready stok)\r\n\r\nBawa dan simpan setiap file favorit anda menggunakan USB Flash Disk keluaran SanDisk ini, SanDisk Cruzer Blade. Dengan bentuk yang kecil namun cepat untuk men-transfer konten digital dari komputer ke komputer lainnya. SanDisk Cruzer Blade memiliki fitur SanDisk SecureAccess yang melindungi file didalam USB flash disk dari akses ilegal serta nikmati fitur backup online yang aman dari YuuWaa untuk mengakses file secara online dimana saja.', 2, '63a7cb1455bd1.jpg', 5),
(28, 'Sandisk OTG 64GB USB Type-C USB 3.1 Ultra Dual Drive', '- USB Type-C and USB Type-A connectors; USB 3.1 (Gen 1)\r\n- kinerja high-speed USB 3.1 hingga 150MB/s untuk memindahkan file lebih cepat antara drive dan ke komputer\r\n- kompatibel dengan HP android yang support OTG (bisa dicek di web SanDisk untuk daftarnya) dan memiliki port USB Type-C\r\n- aplikasi SanDisk Memory Zone (tersedia di Google Play) untuk mengelola dan membackup dengan mudah konten pada smartphone/tablet anda\r\n- garansi resmi 5 tahun Sandisk Indonesia (list distributor bisa dilihat di web Sandisk)', 7, '63a7cb46da8de.jpg', 5),
(29, 'SanDisk Ultra Microsd 64GB 80MB/s - No Adapter', '​SanDisk Ultra microSDHC UHS-I Class 10 32GB 100MB/s (NO ADAPTER)\r\n\r\n*Untuk Pembelian Grosir : https://www.tokopedia.com/cxshop/product\r\n\r\n- class 10, kecepatan baca hingga 100MB/s*\r\n- tidak ada adapter\r\n- cocok untuk smartphone dan tablet anda\r\n- pastikan smartphone dan tablet anda mendukung hingga kapasitas ini\r\n- garansi resmi 7 tahun Sandisk Indonesia (list distributor bisa dilihat di web Sandisk)\r\n- ongkos kirim ditanggung pembeli sepenuhnya\r\n\r\n* Kecepatan baca diatas didasarkan pada tes internal yang dilakukan dalam kondisi terkendali. Kecepatan sebenarnya bisa bervariasi tergantung kapasitas kartu dan device', 5, '63a7cbc9ce3e1.jpg', 5),
(30, 'Samsung Kartu Memori TF Class10 Kapasitas 128GB Memory Card Micro SD', 'Features:\r\nHigh speed\r\nUp to 95MB/s read speed, up to 20MB/s write speed (compatible with Class10 ).\r\nExpand capacity\r\nEnjoy full HD videos and photo without worrying not enough capacity.\r\nFor mobile device\r\nGreat performance in action cameras, DSLRs, high-end smartphones, and tablets (adapter is not included).\r\nReliability\r\nResistant to Water, Temperature, X-ray and Magnetism.\r\nLarge capacity\r\nLarge capacity helps you make full use of advanced digital devices to save cherished memories.\r\nSpecification:\r\nBrand: Samsung\r\nCard type: TF (micro SD) card\r\nRead speed: up to 95MB/s\r\nspeed Class 10', 6, '63a7cc073b5c2.jpg', 5),
(31, 'Simbadda Speaker CST 5000 N+ - HItam', 'Speaker Bluetooth dengan design simple dan sporty siap menemani Anda bersantai menikmati musik. Woofer dengan 30 watt menghasilkan suara yang powerfull, sehingga cocok untuk segala jenis musik. Dilengkapi dengan Radio dan Bluetooth, Sd card dan slot USB memudahkan kamu lebih bereksperimen dengna perangkat yang kamu miliki.\r\n\r\nSpesifikasi :\r\nRMS : 30 Watt\r\nDriver : 4” + 3”x2\r\nPower Input : AC 220 V / 50 Hz\r\nImpedance : 6Ω bass / 4Ω satellite\r\nFunction : LED Display / FM Radio / SD CARD / USB / Bluetooth\r\nFrequency Response : 50 Hz - 20 kHz\r\nS/N Ratio : 70 dB\r\nCabinet Material : Wood + Plastic ABS\r\nColor : Black\r\nDimension (L x W x H) Subwoofer 150 x 220 x 238 mm\r\nSatelite 87 x 78 x 152 mm', 29, '63a7cc9b03dc8.jpg', 6),
(32, 'Eggel Terra 3 Mini 360 Waterproof Portable Bluetooth Speaker', '◉ IP67 Waterproof, Dustproof, and Shockproof\r\nTerra telah lulus sertifikasi IP67 Waterproof, memungkinkan speaker untuk berfungsi di kedalaman 1 meter air selama 30 menit, atau pada lingkungan berpasir/debu extreme apapun. Proteksi dari TPU dan Silicon Sheet memungkinkan Terra dpt menahan impact jatuh dari ketinggian 1 meter\r\n\r\n◉ 360 degree Spatial Sound with Dual Neodymium Drivers + Passive Radiators\r\nTerra menempatkan 2 x 45mm Custom Neodymium Drivers pada sisi Kanan dan Kiri dengan 1 x Passive Radiator; hasilnya suara yg powerful dan jernih, mencakup seluruh area dengan konsisten dan seragam, tanpa zona mati', 25, '63a7cdda72d98.jpg', 6),
(33, 'THINKPLUS LENOVO K3 BLUETOOTH PORTABLE SPEAKER STEREO WIRELESS SPEAKER - Diskon Spesial', '\r\nSpeaker bluetooth dengan teknologi Bluetooth 5.0 yang lebih stabil, ukurannya mini dan dilengkapi lanyard portabel,mudah dibawa.\r\n\r\nTeknologi suara 360° omnidirectional memastikan bahwa suaranya seimbang dan tersebar, dan kualitas suaranya sangat baik, dengan treble yang cerah, midrange penuh, dan bass yang jernih.\r\n\r\nMasa pakai baterai konsumsi daya rendah, waktu siaga yang lama, dilengkapi dengan mikrofon internal, selain mendengarkan musik setiap hari, Anda juga dapat menjawab panggilan kapan saja.\r\n\r\nTombol silikon, nyaman, responsif, mudah dioperasikan. Mendukung dua speaker untuk menikmati pengalaman suara surround stereo 3D.', 7, '63a7ce078abdc.jpg', 6),
(34, 'SOUNDTECH USB Microphone Mic Condenser Recording Streaming Podcast PC', 'SOUNDTECH ST-800 KIT USB Microphone Plug&amp;Play (sudah tertanam sound chipset / sound card)\r\n\r\nANDA DAPAT :\r\n✔ Microphone Condenser SOUNDTECH ST-800\r\n✔ Windshield (Busa Angin)\r\n✔ POP Filter Profesional\r\n✔ Shockproof Mount (Mount Anti Guncangan)\r\n✔ Kabel USB\r\n✔ Arm Stand (Stand Mic)\r\n✔ Penjepit Meja (komponen arm stand)\r\n\r\n-KUALITAS SUARA YANG SANGAT BAIK:\r\nMikrofon memberi Anda laju sampel hingga 24 bit / 192khz, sehingga rekaman Anda akan menjadi sangat jelas. Dan memiliki respons frekuensi yang luas (30 hz hingga 16khz) dan memberikan kualitas reproduksi suara yang luar biasa untuk audio resolusi tinggi', 28, '63a7cf0ff0a32.jpg', 7),
(35, 'COSTA CM-U100 Microphone USB professional Condenser Podcast,Vocal', 'Plug and Play\r\nThrough the USB cable A to cable B, the microphone can be easily connected to Mac and Windows computers without any additional driver software or sound card, which effectively shields interference signals and is more stable.\r\n\r\nPowerful Noise Reduction Function\r\nPress and hold the &quot;MUTE&quot; mute button for 3 seconds to turn on the noise reduction mode,it will filter out more than 90% of excess noise, and only keep the human voice. When recording songs in a quiet environment, you can turn off the noise reduction function for recording, and you can thoroughly present various delicate changes in the sound.\r\n\r\nCardioid Polarity Mode\r\nThe design of the cardioid polarity mode reduces the sound pickup from the side and improves the isolation of the required sound source, and makes the sound clearer and more realistic. The microphone is suitable for various systems, such as Windows, Mac OS, Linux, Chrome OS, etc.', 23, '63a7cf3ac1f31.jpg', 7),
(36, 'Fantech Leviosa MCX01 Microphone USB For PC GARANSI RESMI - KABEL OTG MICRO', 'Spec :\r\nType : Condenser Microphone\r\nMic Sensitivity : -38dB ± 3dB\r\nImpedance : 16Ω\r\nPolar Pattern : Cardioid\r\nFrequency Response : 20Hz - 20kHz\r\nSample Rate : 48kHz at 16bit\r\nPlug Type : USB A to USB B (Cable included)\r\nCord Length : 2.5 Meter\r\nDimensions : 172 x 45.5 x 45.5 mm\r\nWeight : 252 gram\r\nRGB :\r\n\r\nInclude :\r\n- PoP Filter\r\n- Foldable Tripod\r\n- USB Cable 2.5m\r\n- Mount Adapter', 29, '63a7cf7958d2b.jpg', 7),
(37, 'Mic Wireless UHF Microphone Model Bando Call Center Rechargeable', 'Alat ini merupakan mikrofon nirkabel yang dapat mentransmisi suara melalui sinyal UHF. Dengan mengadopsi sinyal UHF, membuat frekuensi alat ini konstan dan tanpa delay sekalipun. Mikrofon ini sangat cocok digunakan oleh call center atau bidang pekerjaan lainnya yang berkaitan dengan audio. Dapatkan mikrofon berkualitas dari TaffSTUDIO ini sekarang juga.\r\n\r\nFitur\r\n\r\nChip Digital UHF\r\n\r\nSalah satu keunggulan dari mikrofon nirkabel ini adalah karena dibekali dengan chip digital UHF. Chip ini memiliki penundaan tranmisi sebesar 1 ms, yang berati tidak ada jeda atau delay. Sinyal transmisi yang dihasilkan juga lebih andal, suara yang dihasilkan juga lebih stabil dan jernih.', 9, '63a7cf9fe9c9a.jpg', 7),
(38, 'HyperX Solo Cast Gaming Microphone Hyper X Kingston Usb Mic SoloCast - White', 'HyperX Solo Cast Gaming Microphone Hyper X Kingston Usb Mic SoloCast\r\n\r\nPro Audio Usb Microphone For Streaming Recording And Voice Chat\r\n\r\n- Plug N Play\r\n- Tap To Mute Sensor\r\n- Usb Connection', 56, '63a7cfdb56740.jpg', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id`, `nama`, `tgl_lahir`, `jenis_kelamin`, `gambar`) VALUES
(19, 'Frans Budi Kashira', '2003-09-24', 'pria', 'fbklegend.jpg'),
(20, 'Fazry Rachman', '2001-11-11', 'Pilih', 'fazry.jpeg'),
(21, 'Teuku Khairul Amrik', '2003-03-19', 'pria', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_konsumen` (`id_konsumen`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `kerpem`
--
ALTER TABLE `kerpem`
  ADD KEY `fk_kerpem_pembayaran` (`id_pembayaran`),
  ADD KEY `id_keranjang` (`id_keranjang`);

--
-- Indeks untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `met_pembayaran`
--
ALTER TABLE `met_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembayaran_met_pembayaran` (`id_met_pembayaran`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produk_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `met_pembayaran`
--
ALTER TABLE `met_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kerpem`
--
ALTER TABLE `kerpem`
  ADD CONSTRAINT `fk_kerpem_pembayaran` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kerpem_ibfk_1` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_met_pembayaran` FOREIGN KEY (`id_met_pembayaran`) REFERENCES `met_pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`id`) REFERENCES `konsumen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
