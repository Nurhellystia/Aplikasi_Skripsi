<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Nota</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="konten">
		<div class="container cari">
			<h2 class="text-center panel-default panel-heading">Nota Pembelian</h2>
			<?php 
			$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
				WHERE pembelian.id_pembelian ='$_GET[id]'");
			$detail = $ambil->fetch_assoc();
			$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
			$idpelangganyangsudahbeli = $detail['id_pelanggan'];
			if ($idpelangganyangsudahbeli !== $id_pelanggan){
				echo "<script>alert('Jangan Nakal')</script>";
				echo "<script>location='riwayat.php';</script>";
				exit();
			}
			?>
			<!-- <pre><?php print_r($detail); ?></pre> -->

		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h3>Pembelian</h3>
					<strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
					Tanggal : <?php echo date("d F Y", strtotime($detail['tanggal_pembelian'])); ?> <br>
					Total : Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
				</div>

				<div class="col-md-4">
					<h3>Pelanggan</h3>
					<strong>Nama : <?php echo $detail['nama_pelanggan']; ?></strong> <br>
					Telepon : <?php echo $detail['telepon_pelanggan'];?> <br>
					Email : <?php echo $detail['email_pelanggan']; ?><br>
				</div>

				<div class="col-md-4">
					<h3>Pengiriman</h3>
					<strong> Kota / kabupaten : <?php echo $detail['kota']; ?></strong><br>
					Ongkos Pengiriman  : Rp. <?php echo number_format($detail['ongkir']); ?><br>
					Ekspedisi : <?php echo $detail['ekspedisi'];?> <?php echo $detail['paket'];?> <?php echo $detail['estimasi']; ?><br>
					Alamat : <?php echo $detail['alamat_pengiriman']; ?><br>
				</div>

			</div>
		</div>
			<table class="table table-bordered text-center" style="margin-top: 10px;">
				<thead class="label-info">
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Nama Produk</th>
						<th class="text-center">Harga Produk</th>
						<th class="text-center">Berat Produk</th>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Subharga</th>
						<th class="text-center">Subberat</th>
					</tr>
				</thead>
				<tbody>

				<?php $nomor=1; ?>
				<?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
				<?php while($pecah = $ambil->fetch_assoc()) { ?>

					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama']; ?></td>
						<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
						<td><?php echo $pecah['berat']; ?> g</td>
						<td><?php echo $pecah['jumlah']; ?></td>
						<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
						<td><?php echo $pecah['subberat']; ?> g</td>
					</tr>

				<?php $nomor++; ?>
				<?php } ?>

				</tbody>
			</table>
			<?php 
			$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian ='$_GET[id]'");
			$pelangganbayar = $ambil->fetch_assoc();
			$bayar = $pelangganbayar['status_pembelian'];
			if ($bayar == "pending"){
			?>
			<div class="row">
				<div class="col-md-5 alert alert-warning" style="margin-left: 15px;">
					<div><span class="glyphicon glyphicon-info-sign"></span>
						<p><br>Silahkan melakukan pembayaran sebesar <?php echo number_format($detail['total_pembelian']); ?> ke </p>
						<strong>BANK BNI 		20180910005 AN. NUR HELLYSTIA ASMARA</strong><br>
						<strong>BANK BRI		20190910005 AN. NUR HELLYSTIA ASMARA</strong><br>
						<strong>BANK Mandiri	20220910005 AN. NUR HELLYSTIA ASMARA</strong>
					</div>
				</div>
			</div>
			<?php }

			elseif ($bayar == "Barang Dikirim" OR $bayar == "Barang Diterima") { ?>
			<div class="row">
				<div class="col-md-4 alert alert-success" style="margin-left: 15px;">
					<div><span class="glyphicon glyphicon-info-sign"></span>
						<strong> PEMBAYARAN ANDA SUDAH LUNAS</strong>
					</div>
				</div>
			</div>
			<?php }

			elseif ($bayar == "Menunggu Konfirmasi") { ?>
			<div class="row">
				<div class="col-md-4 alert alert-warning" style="margin-left: 15px;">
					<div><span class="glyphicon glyphicon-info-sign"></span>
						<strong> PEMBAYARAN ANDA SEDANG DIKONFIRMASI</strong>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>
	<div class="container">
		<div class="row text-right">
			<?php
			if ($bayar == "Barang Dikirim" OR $bayar == "Barang Diterima" OR $bayar == "Menunggu Konfirmasi"){
			?>
				<br>
				<a href="riwayat.php" class="btn btn-warning cari"><span class="glyphicon glyphicon-repeat"></span> Kembali</a> <?php } 
				
				else { ?>
				<br>
				<a href="pembayaran.php?id=<?php echo $pelangganbayar['id_pembelian'];?>" class="btn btn-success cari"><span class="glyphicon glyphicon-ok"></span> Pembayaran</a>
				<a href="riwayat.php" class="btn btn-warning cari"><span class="glyphicon glyphicon-repeat"></span> Kembali</a>
			<?php } ?>
		</div>
	</div>
</body>
</html>