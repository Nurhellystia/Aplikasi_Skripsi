<?php 
include 'koneksi.php';
include 'menu.php';
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Bukti Pembayaran</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<section class="content">
		<div class="container cari">
			<div>
			<h2 class="panel-default panel-heading text-center">Bukti Pembayaran</h2>
			<?php
			$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'"); 
			$detail = $ambil->fetch_assoc();
			$ambilpem = $koneksi->query("SELECT * FROM pembayaran WHERE pembayaran.id_pembelian='$_GET[id]'"); 
			$detailpem = $ambilpem->fetch_assoc(); 
			$bayar = $detail['status_pembelian'];
			$idpem = $detail['id_pembelian'];
			?>		
				<div class="row">
					<div class="col-md-6">
					<?php
					if (empty($detailpem)){
						echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> Belum mengirimkan bukti pembayaran</div>";
					} else {
					?>

						<br>
						<img style="margin-bottom: 10px;" class="img-rounded" src="foto_bukti/<?php echo $detailpem['bukti'];?>"width='500' height='350'>
					<?php } ?>

					</div>
				<div class="col-md-6">
				<?php
				if(empty($detailpem)){
				}
				else { ?>
					<h3>Bukti Pembayaran</h3>
					<table class="table">
						<tr>
							<th>Nama Penyetor</th>
							<td><?php echo$detailpem['nama'];?></td>
						</tr><tr>
							<th>Bank</th>
							<td><?php echo$detailpem['bank'];?></td>
						</tr><tr>
							<th>Tanggal</th>
							<td><?php echo$detailpem['tanggal'];?></td>
						</tr><tr>
							<th>Jumlah</th>
							<td>Rp. <?php echo number_format($detailpem['jumlah']);?></td>
						</tr>
					</table>
				<?php } ?>
				</div>
			</div>
			<p class="text-right">
				<a href="riwayat.php" class="btn btn-warning"><span class="glyphicon glyphicon-repeat"></span>Kembali</a>
			</p>
			</div>
		</div>
	</section>
</body>
</html>