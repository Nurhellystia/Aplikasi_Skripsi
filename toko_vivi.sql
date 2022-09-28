-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2021 pada 08.08
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anscell`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'DadanS', 'Dadan3', 'Dadan Sudarna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `tarif` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Kuningan', 15000),
(2, 'Cirebon', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'dadan.sudarna.10@gmail.com', 'Dadan3', 'Dadan', '081214431775', ''),
(4, 'dadan.sudarna.3@gmail.com', 'Dadan3', 'Dadan Sudarna', '081214431775', 'Cengal, Japara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(1, 34, 'Dadan Sudarna', 'BNI 081214431775', 9515000, '2021-12-15', '20211215191919LOGO UNIKU.png'),
(2, 37, 'Dadan Sudarna', 'BNI 081214431775', 2515000, '2021-12-15', '20211215225533samsung-galaxy-m21-1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` varchar(100) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`) VALUES
(34, 4, 1, '2021-12-15', 9515000, 'Kuningan', 15000, 'Jalan Dipati Ewangga Cengal Dusun IV', 'Sudah Dibayar'),
(35, 1, 1, '2021-12-15', 3815000, 'Kuningan', 15000, 'Jalan Ciporang', 'pending'),
(36, 2, 1, '2021-12-15', 14714000, 'Kuningan', 15000, 'Jalan Cijoho', 'pending'),
(37, 4, 1, '2021-12-15', 2515000, 'Kuningan', 15000, 'Jln Raya Kuningan', 'Sudah Dibayar'),
(38, 4, 1, '2021-12-15', 1515000, 'Kuningan', 15000, 'Jln Raya Ciamis', 'pending'),
(39, 4, 1, '2021-12-15', 4814000, 'Kuningan', 15000, 'Jln Raya Cengal', 'pending'),
(41, 4, 1, '2021-12-15', 7314000, 'Kuningan', 15000, 'Jln Raya Cengal', 'pending'),
(42, 4, 1, '2021-12-15', 8015000, 'Kuningan', 15000, 'Jln Raya Cijoho', 'pending'),
(43, 4, 1, '2021-12-16', 17115000, 'Kuningan', 15000, 'Jalan Raya Kuningan Kota', 'pending'),
(44, 4, 2, '2021-12-16', 1520000, 'Cirebon', 20000, 'Jalan Raya Cirebon', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(15) NOT NULL,
  `berat` int(11) NOT NULL,
  `subharga` int(15) NOT NULL,
  `subberat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subharga`, `subberat`) VALUES
(18, 34, 1, 1, 'Samsung Galaxy M21', 2500000, 188, 2500000, 188),
(19, 34, 40, 1, 'Samsung Galaxy M32', 2000000, 180, 2000000, 180),
(20, 34, 38, 1, 'Samsung Galaxy M52 5G', 5000000, 173, 5000000, 173),
(21, 35, 2, 1, 'Samsung Galaxy A02', 1500000, 206, 1500000, 206),
(22, 35, 39, 1, 'Samsung Galaxy A52', 2300000, 186, 2300000, 186),
(23, 36, 11, 1, 'Samsung Galaxy A22', 2799000, 186, 2799000, 186),
(24, 36, 38, 1, 'Samsung Galaxy M52 5G', 5000000, 173, 5000000, 173),
(25, 36, 39, 3, 'Samsung Galaxy A52', 2300000, 186, 6900000, 558),
(26, 37, 1, 1, 'Samsung Galaxy M21', 2500000, 188, 2500000, 188),
(27, 38, 2, 1, 'Samsung Galaxy A02', 1500000, 206, 1500000, 206),
(28, 39, 11, 1, 'Samsung Galaxy A22', 2799000, 186, 2799000, 186),
(29, 39, 40, 1, 'Samsung Galaxy M32', 2000000, 180, 2000000, 180),
(30, 41, 1, 1, 'Samsung Galaxy M21', 2500000, 188, 2500000, 188),
(31, 41, 11, 1, 'Samsung Galaxy A22', 2799000, 186, 2799000, 186),
(32, 41, 40, 1, 'Samsung Galaxy M32', 2000000, 180, 2000000, 180),
(33, 42, 1, 2, 'Samsung Galaxy M21', 2500000, 188, 5000000, 376),
(34, 42, 41, 1, 'Samsung Galaxy A32', 3000000, 184, 3000000, 184),
(35, 43, 2, 1, 'Samsung Galaxy A02', 1500000, 206, 1500000, 206),
(36, 43, 43, 2, 'Oppo Reno 7', 7800000, 171, 15600000, 342),
(37, 44, 2, 1, 'Samsung Galaxy A02', 1500000, 206, 1500000, 206);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `stok_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`) VALUES
(1, 'Samsung Galaxy M21', 2500000, 0, 188, 'samsung-galaxy-m21-1.jpg', 'DISPLAY\r\nType	Super AMOLED, 420 nits (peak)\r\nSize	6.4 inches, 100.5 cm2 (~84.2% screen-to-body ratio)\r\nResolution	1080 x 2340 pixels, 19.5:9 ratio (~403 ppi density)\r\nPLATFORM\r\nOS	Android 10, upgradable to Android 11, One UI 3.1 Core\r\nChipset	Exynos 9611 (10nm)\r\nCPU	Octa-core (4x2.3 GHz Cortex-A73 & 4x1.7 GHz Cortex-A53)\r\nGPU	Mali-G72 MP3\r\nMEMORY\r\nInternal	64GB 4GB RAM, 128GB 6GB RAM UFS 2.1\r\nMAIN CAMERA\r\n48 MP, f/2.0, 26mm (wide), 1/2.0\", 0.8Âµm, PDAF\r\n8 MP, f/2.2, 12mm (ultrawide), 1/4.0\", 1.12Âµm\r\n5 MP, f/2.2, (depth)\r\nVideo	4K@30fps, 1080p@30fps, 720p@240fps, gyro-EIS'),
(2, 'Samsung Galaxy A02', 1500000, 7, 206, 'samsung-galaxy-a02-0.jpg', 'DISPLAY\r\nType	PLS IPS\r\nSize	6.5 inches, 102.0 cm2 (~81.9% screen-to-body ratio)\r\nResolution	720 x 1600 pixels, 20:9 ratio (~270 ppi density)\r\nPLATFORM\r\nOS	Android 10, upgradable to Android 11, One UI 3.1\r\nChipset	Mediatek MT6739W (28 nm)\r\nCPU	Quad-core 1.5 GHz Cortex-A53\r\nGPU	PowerVR GE8100\r\nMEMORY\r\nInternal 	32GB 2GB RAM, 32GB 3GB RAM, 32GB 4GB RAM, 64GB 3GB RAM eMMC 5.1\r\nMAIN CAMERA\r\nDual	13 MP, f/1.9, (wide), AF\r\n2 MP, f/2.4, (macro)\r\nVideo	1080p@30fps'),
(11, 'Samsung Galaxy A22', 2799000, 8, 186, 'samsung-galaxy-a22-1.jpg', 'DISPLAY\r\nType	Super AMOLED, 90Hz, 600 nits\r\nSize	6.4 inches, 98.9 cm2 (~84.3% screen-to-body ratio)\r\nResolution	720 x 1600 pixels, 20:9 ratio (~274 ppi density)\r\nPLATFORM	\r\nOS	Android 11, One UI Core 3.1\r\nChipset	Mediatek MT6769V/CU Helio G80 (12 nm)\r\nCPU	Octa-core (2x2.0 GHz Cortex-A75 & 6x1.8 GHz Cortex-A55)\r\nGPU	Mali-G52 MC2\r\nMEMORY\r\nInternal	 64GB 4GB RAM, 128GB 4GB RAM, 128GB 6GB RAM eMMC 5.1\r\nMAIN CAMERA\r\nQuad	48 MP, f/1.8, (wide), 1/2.0\", 0.8Âµm, PDAF, OIS\r\n8 MP, f/2.2, 123Ëš (ultrawide), 1/4.0\", 1.12Âµm\r\n2 MP, f/2.4, (macro)\r\n2 MP, f/2.4, (depth)\r\nVideo	1080p@30fps'),
(38, 'Samsung Galaxy M52 5G', 5000000, 8, 173, 'samsung-galaxy-m52-5g-1.jpg', 'DISPLAY\r\nType	Super AMOLED Plus, 120Hz\r\nSize	6.7 inches, 108.4 cm2 (~86.4% screen-to-body ratio)\r\nResolution	1080 x 2400 pixels, 20:9 ratio (~393 ppi density)\r\nPLATFORM\r\nOS	Android 11, One UI 3.1\r\nChipset	Qualcomm SM7325 Snapdragon 778G 5G (6 nm)\r\nCPU	Octa-core (4x2.4 GHz Kryo 670 & 4x1.8 GHz Kryo 670)\r\nGPU	Adreno 642L\r\nMEMORY\r\nInternal	128GB 6GB RAM, 128GB 8GB RAM\r\nMAIN CAMERA	\r\nTriple	64 MP, f/1.8, 26mm (wide), PDAF\r\n12 MP, f/2.2, 123Ëš, (ultrawide)\r\n5 MP, f/2.4, (macro)\r\nVideo	4K@30fps, 1080p@30fps'),
(39, 'Samsung Galaxy A52', 2300000, 8, 186, 'samsung-galaxy-a52-4g-10.jpg', 'DISPLAY\r\nType	Super AMOLED, 90Hz, 800 nits (HBM)\r\nSize	6.5 inches, 101.0 cm2 (~84.1% screen-to-body ratio)\r\nResolution	1080 x 2400 pixels, 20:9 ratio (~407 ppi density)\r\nProtection	Corning Gorilla Glass 5\r\n 	Always-on display\r\nPLATFORM\r\nOS	Android 11, One UI 3.1\r\nChipset	Qualcomm SM7125 Snapdragon 720G (8 nm)\r\nCPU	Octa-core (2x2.3 GHz Kryo 465 Gold & 6x1.8 GHz Kryo 465 Silver)\r\nGPU	Adreno 618\r\nMEMORY\r\nCard slot	microSDXC (uses shared SIM slot)\r\nInternal	128GB 4GB RAM, 128GB 6GB RAM, 128GB 8GB RAM, 256GB 6GB RAM, 256GB 8GB RAM\r\nMAIN CAMERA\r\nQuad	64 MP, f/1.8, 26mm (wide), 1/1.7X\", 0.8Âµm, PDAF, OIS\r\n12 MP, f/2.2, 123Ëš (ultrawide), 1.12Âµm\r\n5 MP, f/2.4, (macro)\r\n5 MP, f/2.4, (depth)\r\nVideo	4K@30fps, 1080p@30/60fps; gyro-EIS'),
(40, 'Samsung Galaxy M32', 2000000, 8, 180, 'samsung-galaxy-m32-1.jpg', 'DISPLAY\r\nType	Super AMOLED, 90Hz, 800 nits (HBM)\r\nSize	6.4 inches, 98.9 cm2 (~83.9% screen-to-body ratio)\r\nResolution	1080 x 2400 pixels, 20:9 ratio (~411 ppi density)\r\nProtection	Corning Gorilla Glass 5\r\nPLATFORM\r\nOS	Android 11, One UI 3.1\r\nChipset	Mediatek MT6769V/CU Helio G80 (12 nm)\r\nCPU	Octa-core (2x2.0 GHz Cortex-A75 & 6x1.8 GHz Cortex-A55)\r\nGPU	Mali-G52 MC2\r\nMEMORY\r\nCard slot	microSDXC (dedicated slot)\r\nInternal	64GB 4GB RAM, 128GB 6GB RAM, 128GB 8GB RAM eMMC 5.1\r\nMAIN CAMERA\r\nQuad	64 MP, f/1.8, 26mm (wide), 1/1.97\", 0.7Âµm, PDAF\r\n8 MP, f/2.2, 123Ëš, (ultrawide), 1/4.0\", 1.12Âµm\r\n2 MP, f/2.4, (macro)\r\n2 MP, f/2.4, (depth)\r\nVideo	1080p@30fps'),
(41, 'Samsung Galaxy A32', 3000000, 8, 184, 'samsung-galaxy-a32-4g-3.jpg', 'DISPLAY\r\nType	Super AMOLED, 90Hz, 800 nits (HBM)\r\nSize	6.4 inches, 98.9 cm2 (~84.6% screen-to-body ratio)\r\nResolution	1080 x 2400 pixels, 20:9 ratio (~411 ppi density)\r\nProtection	Corning Gorilla Glass 5\r\nPLATFORM\r\nOS	Android 11, One UI 3.1\r\nChipset	Mediatek MT6769V/CU Helio G80 (12 nm)\r\nCPU	Octa-core (2x2.0 GHz Cortex-A75 & 6x1.8 GHz Cortex-A55)\r\nGPU	Mali-G52 MC2\r\nMEMORY\r\nInternal	64GB 4GB RAM, 128GB 4GB RAM, 128GB 6GB RAM, 128GB 8GB RAM\r\nMAIN CAMERA\r\nQuad	64 MP, f/1.8, 26mm (wide), PDAF\r\n8 MP, f/2.2, 123Ëš, (ultrawide), 1/4.0\", 1.12Âµm\r\n5 MP, f/2.4, (macro)\r\n5 MP, f/2.4, (depth)\r\nVideo	1080p@30fps'),
(43, 'Oppo Reno 7', 7800000, 8, 171, 'oppo-reno7-5g-2.jpg', 'Bangsat\r\n');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
