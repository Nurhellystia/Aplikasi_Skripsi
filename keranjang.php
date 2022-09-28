<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['pelanggan'])){
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
}
if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])) {
	echo "<script>alert('Keranjang kosong, silahkan belanja terlebih dahulu!');</script>";
	echo "<script>location='index.php';</script>";
}

// if (!isset($_GET['id'])) {

// 	echo "<script>alert('Stok tidak sebanyak itu ferguso!');</script>";
// 	echo "<script>location='index.php';</script>";

// }else{
// foreach ($_SESSION['keranjang'] as $id_produk => $jumlah[]):
// endforeach;
// $idproduk = $_GET['id'];
// $ambil = $koneksi->query("SELECT*FROM produk WHERE id_produk='$idproduk'");
// while($pecah = $ambil->fetch_assoc()){
// $stok = $pecah['stok_produk'];
// if ($jumlah > $stok) {

// }
// }}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Keranjang</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<?php include 'menu.php';?>
	<section class="konten">
		<div class="container">
			<h2 class="text-center"><span class="glyphicon glyphicon-shopping-cart"></span><br>Keranjang Belanja</h2>
			<table class="table table-bordered">
				<thead class="label-info">
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Produk</th>
						<th class="text-center">Harga</th>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Sub Harga</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>

				<?php
				$nomor = 1;
				foreach ($_SESSION['keranjang'] as $id_produk => $jumlah):
				$ambil = $koneksi->query("SELECT*FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga = $pecah['harga_produk']*$jumlah;
				?>
					<tr>
						<td class="text-center"><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td class="text-center">Rp. <?php echo number_format($pecah['harga_produk']);?></td>
						<td class="text-center"><?php echo $jumlah; ?></td>
						<td class="text-center">Rp. <?php echo number_format($subharga);?></td>
						<td class="text-center">
							<a href="hapus_keranjang.php?id=<?php echo $id_produk; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
						</td>
					</tr>
				<?php 
				$nomor++;
				endforeach;
				?>
				
				</tbody>
			</table>
			<p class="text-right">
			<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-repeat"></span> Lanjutkan Belanja</a>

			<a href="checkout.php" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Checkout</a>
			</p>
		</div>
	</section>
</body>
</html>