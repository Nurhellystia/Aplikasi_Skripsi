<?php
session_start();
include 'koneksi.php';
$keyword = $_GET['search'];
$semuadata = array();
$ambil = $koneksi->query("SELECT*FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%' OR berat_produk LIKE '%$keyword%'");
while ($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Pencarian</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<section class="konten">
		<div class="container">
			<h3>Hasil Pencarian : <?php echo $keyword ?></h3>
			<div class="row">
			<?php foreach($semuadata as $key => $value):
				?>
				<div class="col-md-3" style="width: 290px; height: 400px;">
					<div class="thumbnail">
						<img src="foto_produk/<?php echo $value['foto_produk'] ?>" alt="" class="img-responsive">
						<div class="caption text-center">
							<?php 
							$stok = $value['stok_produk'];
							if($stok == "0"){ ?>
								<h4 class="text text-muted"><?php echo $value['nama_produk'] ?></h4>
								<h5 class="text text-muted">Rp. <?php echo number_format($value['harga_produk']) ?></h5>
								<a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary">Detail Produk</a>
								<a onclick="return alert('Stok kosong')"class="btn btn-success">Beli Sekarang</a>
							<?php }

							elseif($stok !== "0" ){ ?>
								<h4><?php echo $value['nama_produk'] ?></h4>
								<h5>Rp. <?php echo number_format($value['harga_produk']) ?></h5>
								<a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary">Detail Produk</a>
								<a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-success">Beli Sekarang</a>
							<?php } ?>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
			</div>
		</div>
	</section>
</body>
</html>