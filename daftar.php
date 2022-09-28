<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Daftar</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<div class="container" style="margin-top: 100px;">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 cari">
				<div class="panel">
					<div class="panel-default panel-heading">
						<h3 class="panel-title text-center"><b>Toko Vivi | Daftar Pelanggan</b></h3>
					</div>
					<div class="panel-body">
						<form method="POST" class="form-horizontal">
							<div class="form-group has-feedback">
								<label class="col-md-3 control-label">Nama</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="nama" required>
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="col-md-3 control-label">Email</label>
								<div class="col-md-7">
									<input type="email" class="form-control" name="email" placeholder="Contoh@email.com" required>
									<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="col-md-3 control-label">Password</label>
								<div class="col-md-7">
									<input type="password" class="form-control" name="password" required>
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="col-md-3 control-label">Konfirmasi Password</label>
								<div class="col-md-7">
									<input type="password" class="form-control" name="password2" required>
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="col-md-3 control-label">Alamat</label>
								<div class="col-md-7">
									<textarea name="alamat" rows="3" class="form-control" style="resize: none;" required></textarea>

								<span class="glyphicon glyphicon-home form-control-feedback"></span>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="col-md-3 control-label">No. Telepon</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="telepon" required>
								<span class="glyphicon glyphicon-earphone form-control-feedback"></span>
								</div>
							</div>
							<div class="form-group has-feedback">
								<div class="col-md-7 col-md-offset-3 text-right">
									<button class="btn btn-primary" name="daftar">Daftar</button>
									<p class="text-left"><br>Sudah punya akun ? <a href="login.php" style="text-decoration: none;">Login</a></p>
								</div>
							</div>
						</form>
						<?php if (isset($_POST['daftar'])) {
							$nama = $_POST['nama'];
							$email = $_POST['email'];
							$password = $_POST['password'];
							$password2 = $_POST['password2'];
							$alamat = $_POST['alamat'];
							$telepon = $_POST['telepon'];
							// cek email
							$ambil = $koneksi->query("SELECT*FROM pelanggan WHERE email_pelanggan = '$email'");
							$cocok = $ambil->num_rows;

							if ($cocok == 1){
								echo "<script>alert('Pendaftaran gagal, Email sudah digunakan!');</script>";
								echo "<script>location='daftar.php';</script>";
							}
							elseif ($password != $password2) {
								echo "<script>alert('Konfirmasi password Anda tidak cocok');</script>";
								echo "<script>location='daftar.php';</script>";
							}
							else{
								$koneksi->query("INSERT INTO pelanggan(email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat_pelanggan) VALUES ('$email', '$password', '$nama', '$telepon', '$alamat')");
								echo "<script>alert('Pendaftaran Berhasil, Silahkan Login!');</script>";
								echo "<script>location='login.php';</script>";
							}
						}
						?>
					</div>					
				</div>				
			</div>			
		</div>
	</div>
</body>
</html>