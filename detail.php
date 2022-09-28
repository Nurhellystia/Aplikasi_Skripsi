<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Detail</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'menu.php'; ?>
	<section class="konten">
		<div class="container">
			<h1>Detail Produk</h1><br>
			<?php
			$id_produk = $_GET['id'];
			$ambil = $koneksi->query("SELECT*FROM produk WHERE id_produk='$id_produk'");
			$detail = $ambil->fetch_assoc();
			$stok = $detail['stok_produk'];
			?><!-- 
			<pre><?php print_r($detail); ?></pre> -->

			<div class="row">
				<div class="col-md-6">
					<img src="foto_produk/<?php echo $detail['foto_produk']; ?>" alt="" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h2><?php echo $detail['nama_produk'];?></h2>
					<h3>Rp. <?php echo number_format($detail['harga_produk']);?></h3>
					<h4><?php echo $detail['berat_produk'];?> Gram</h4>
					<h4>Stok : <?php echo $detail['stok_produk'];?></h4>
					<form method="POST">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" value="1" min="1">
							<div class="input-group-btn">
								<button class="btn btn-success" name="beli"><span class="glyphicon glyphicon-shopping-cart"></span> Beli Sekarang</button>
							</div>
						</div>
					</div>
					</form>
					<?php
					if (isset($_POST['beli'])){
						$jumlah = $_POST['jumlah'];
						if($stok == 0){
							echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok kosong</div>";
							echo "<script> location='detail.php'; ?>'; </script>";
						}if($_POST['jumlah'] > $stok){
							echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Jumlah pembelian tidak boleh melebihi stok</div>";
							echo "<script> location='detail.php'; ?>'; </script>";
						}
						else{
							$_SESSION['keranjang'][$id_produk] = $jumlah;
							echo "<script>alert('Produk telah masuk ke dalam keranjang');</script>";
							echo "<script>location='keranjang.php';</script>";
						}
					}
					?>
					<p><?php   echo nl2br($detail['deskripsi_produk']);?></p>
					<p class="text-right"><a href="index.php" class="btn btn-warning"><span class="glyphicon glyphicon-repeat"></span> Kembali</a>
					</p>
				</div>
			</div>
		</div>
	</section>
</body>
</html>