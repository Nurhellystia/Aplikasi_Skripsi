<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['pelanggan'])){
	echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Beranda</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

</head>
<body>
	<?php include 'menu.php'; ?>
	<section class="konten">		
		<div class="container">

			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
			    	<li data-target="myCarousel" data-slide-to="0" class="active"></li>
			    	<li data-target="myCarousel" data-slide-to="1"></li>
			 	</ol>

			 	<div class="carousel-inner">
				    <div class="item active">
						<img src="img/promoopporeno7.jpg" class="d-block-w-100 img-rounded">
						<div class="carousel-caption" style="margin-bottom: 20px;">
				           	<h3>DISC 20%</h3>
				     	    <p>Promo ini berlaku 01 sampai 10 Oktober 2022!</p>
				     	    <a href="detail.php?id=59" class="btn btn-danger"> Beli Sekarang </a>
			      	   </div>
					</div>
					<div class="item">
						<img src="img/About1.jpg" class="d-block-w-100 img-rounded">
					</div>
				</div>
			 	<a class="left carousel-control img-rounded" href="index.php" role="button"data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			    <span class="sr-only">Previous</span>
			 	</a>
			 	<a class="right carousel-control img-rounded" href="index.php" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right"></span>
			    <span class="sr-only">Next</span>
			 	</a>
			</div>



			<h1>Produk Terbaru</h1><br>
			<div class="row">
			<?php 
			$ambil = $koneksi->query("SELECT*FROM produk");
			while($perproduk= $ambil->fetch_assoc()){
				$idprod = $perproduk['id_produk'];?>
				<div class="col-md-3" style="width: 290px; height: 500px;">
					<div class="thumbnail">
						<img src="foto_produk/<?php echo $perproduk['foto_produk'] ?>" alt="" class="img-responsive img-rounded">
						<div class="caption text-center">
							<?php 
							$stok = $perproduk['stok_produk'];
							if($stok == "0"){ ?>
								<h4 class="text text-muted"><?php echo $perproduk['nama_produk'] ?></h4>
								<h5 class="text text-muted">Rp. <?php echo number_format($perproduk['harga_produk']) ?></h5>
								<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary cari"><span class="glyphicon glyphicon-info-sign"></span> Detail
								</a>
								
								<a onclick="return alert('Stok kosong')"class="btn btn-success cari"> <span class="glyphicon glyphicon-shopping-cart"></span> Beli Sekarang
								</a>
							<?php }

							elseif($stok !== "0" ){ ?>
								<h4><?php echo $perproduk['nama_produk'] ?></h4>
								<h5>Rp. <?php echo number_format($perproduk['harga_produk']) ?></h5>

								<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary cari"><span class="glyphicon glyphicon-info-sign"></span> Detail
								</a>

								<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-success cari"><span class="glyphicon glyphicon-shopping-cart"></span> Beli sekarang
								</a>

						<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</section>
</body>
</html>