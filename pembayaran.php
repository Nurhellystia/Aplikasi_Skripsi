<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
}

$idpem = $_GET['id'];
$ambil = $koneksi->query("SELECT*FROM pembelian WHERE id_pembelian = '$idpem'");
$detpem = $ambil->fetch_assoc();
$id_pel_beli =$detpem['id_pelanggan'];
$id_pel_login = $_SESSION['pelanggan']['id_pelanggan'];
if($id_pel_login!==$id_pel_beli){
	echo "<script>alert('Jangan Nakal');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Pembayaran</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<div class="container cari">
		<h1 class="text-center">Kirim Pembayaran</h1>
		<p>Kirim bukti pembayaran anda disini !</p>
		<div class="alert alert-info">
			<span class="glyphicon glyphicon-info-sign"></span> Total tagihan Anda <strong>Rp. <?php echo number_format($detpem['total_pembelian']);?></strong>
		</div>
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Penyetor</label>
				<input type="text" class="form-control" name="nama" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>">
			</div>
			<div class="form-group">
				<label>Bank</label>
					<div>
					<select name="bank" class="form-control text-center" required>
						<option value="" selected disabled>-Pilih Bank-</option>
						<option value="BNI">BNI</option>
						<option value="BRI">BRI</option>
						<option value="BCA">BCA</option>
						<option value="BJB">BJB</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1" >
			</div>
			<div class="form-group">
				<label>Foto Bukti</label>
				<input type="file" class="form-control" name="bukti">
				<p class="text text-danger">* Foto bukti harus JPG/PNG maksimal 3MB</p>
			</div>
			<br>
			<div class="text-right">
				<button class="btn btn-primary cari" name="kirim"><span class="glyphicon glyphicon-ok"></span>  Kirim</button>
				<a href="riwayat.php" class="btn btn-warning cari"> <span class="glyphicon glyphicon-repeat"></span> Kembali</a><br><br>
		</form>
	</div>
	<?php
	if(isset($_POST['kirim'])){
		$ekstensi_diperbolehkan	= array('png','jpg');
		$namabukti = $_FILES['bukti']['name'];
		$x = explode('.', $namabukti);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['bukti']['size'];
		$lokasibukti = $_FILES['bukti']['tmp_name'];

		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if($ukuran < 3044070){			
				$namafix = date('YmdHis').$namabukti;
				move_uploaded_file($lokasibukti, "foto_bukti/$namafix");
				$nama = $_POST['nama'];
				$bank = $_POST['bank'];
				$jumlah = $_POST['jumlah'];
				$tanggal = date('Y-m-d');

				$sql="INSERT INTO pembayaran (id_pembelian, nama, bank, jumlah, tanggal, bukti) VALUES('$idpem','$nama', '$bank', '$jumlah', '$tanggal', '$namafix')";
				$query= mysqli_query($koneksi,$sql);
				if($query){
					$koneksi->query("UPDATE pembelian SET status_pembelian = 'Menunggu Konfirmasi' WHERE id_pembelian='$idpem'");
					echo "<script>alert('Terima kasih sudah mengirim bukti pembayaran');</script>";
					echo "<script>location='riwayat.php';</script>";
				}else{
					echo "<script>alert('Pembayaran anda gagal');</script>";
				}
			}else{
				echo "<div class='alert alert-warning'>Ukuran file terlalu besar</div>";
			}
		}else{
			echo "<div class='alert alert-warning'>Jenis file ini tidak diperbolehkan</div>";
		}
	}
	?>
	</div>
</body>
</html>