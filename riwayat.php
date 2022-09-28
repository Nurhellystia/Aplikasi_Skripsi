<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Riwayat</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<section class="riwayat">
		<div class="container">
			<h2 class="text-center"><span class="glyphicon glyphicon-time"></span><br>Riwayat Belanja <br></h2>
			<p class="text-left text-danger"><span class="glyphicon glyphicon-info-sign"></span> Jika Anda sudah menerima barang, klik tombol "Barang Diterima"</p>
			<table class="table table-bordered cari">
				<thead class="label-info">
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Tanggal</th>
						<th class="text-center">Total</th>
						<th class="text-center">Status</th>
						<th class="text-center">No. Resi</th>
						<th class="text-center">Status Barang</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$nomor = 1;
					$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
					$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = $id_pelanggan");
					while ($pecah = $ambil->fetch_assoc()) { 
						$status = $pecah['status_pembelian'];?>
					<tr>
						<td class="text-center"><?php echo $nomor; ?></td>
						<td class="text-center"><?php echo date("d F Y", strtotime($pecah['tanggal_pembelian'])); ?></td>
						<td class="text-center">Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>

						<?php if($status == "pending"){ ?>
						<td class="text-center"><p class="label-danger img-rounded"><span class="glyphicon glyphicon-time"></span> Pending</p></td>
							<?php } else if ($status == "Barang Dikirim") { ?>
						<td class="text-center"><p class="label-primary img-rounded"><span class="glyphicon glyphicon-time"></span> <?php echo $pecah['status_pembelian']; ?></p></td>
							<?php } else if ($status == "Barang Diterima") { ?>
						<td class="text-center"><p class="label-success img-rounded"><span class="glyphicon glyphicon-ok"></span> <?php echo $pecah['status_pembelian']; ?></p></td>
							<?php } else if ($status == "Menunggu Konfirmasi") { ?>
						<td class="text-center"><p class="label-warning img-rounded"><span class="glyphicon glyphicon-time"></span> <?php echo $pecah['status_pembelian']; ?></p></td>
							<?php } ?>

						
						<?php if ($status == "Barang Dikirim" OR $status == "Barang Diterima") { ?>
						<td class="text-center"><?php echo $pecah['resi_pengiriman']; ?> </td>
						<?php } else { ?> <td></td> <?php } ?>
						<?php if ($status == "Barang Dikirim") { ?>
						<td class="text-center">
							<a href="barang_diterima.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Barang Diterima</a>
						</td>
						<?php } elseif($status == "Barang Diterima"){ ?>
							<td class="text-center"><span class="glyphicon glyphicon-ok text-success"></span></td> <?php
						} else { ?> <td></td> <?php } ?>


						<td class="text-center">
						<?php if($status == "Menunggu Konfirmasi" OR $status == "Barang Dikirim" OR $status == "Barang Diterima"){ ?>
							<a href="nota.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info"><span class="glyphicon glyphicon-info-sign"></span> Nota</a>
							<a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-ok"></span> Lihat Pembayaran</a>
						<?php } elseif ($status == "pending") { ?>
							<a href="nota.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info"><span class="glyphicon glyphicon-info-sign"></span> Nota</a>
							<a href="pembayaran.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Kirim Pembayaran</a> <?php
						} ?>			
					</td>
					</tr>
				<?php $nomor ++; } ?>
				</tbody>
			</table>
		</div>
	</section>
</body>
</html>