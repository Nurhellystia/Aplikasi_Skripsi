<?php 

session_start();
include 'koneksi.php';
if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
}
$koneksi->query("UPDATE pembelian SET status_pembelian = 'Barang Diterima' WHERE id_pembelian='$_GET[id]'");
echo "<script>alert('Terima kasih sudah belanja disini');</script>";
echo "<script>location='riwayat.php';</script>";
?>