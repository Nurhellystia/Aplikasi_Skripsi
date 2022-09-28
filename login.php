<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Login</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<div class="container">
		<div class="row" style="margin-top: 100px">
			<div class="col-md-4 col-md-offset-4 cari"><br>
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title text-center">
							<label>Toko Vivi | Login</label>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST">
							<div class="form-group has-feedback">
								<label>Email</label>
								<input type="email" class="form-control" name="email" required>
								<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
							</div>
							<div class="form-group has-feedback">
								<label>Password</label>
								<input type="password" class="form-control" name="password" required>
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
							</div>
							<button class="btn btn-primary btn-lg btn-block" name="login">Login</button><br>
							<p>Belum punya akun? <a href="daftar.php" style="text-decoration: none;">Daftar</a></p>
						</form>
						<?php
						if(isset($_POST['login'])){
							$email = $_POST['email'];
							$password = $_POST['password'];

							$ambil = $koneksi->query("SELECT*FROM pelanggan WHERE email_pelanggan ='$email' AND password_pelanggan = '$password'");
							$akun_cocok = $ambil->num_rows;
							if($akun_cocok == 1){
								$akun = $ambil->fetch_assoc();

								$_SESSION['pelanggan'] = $akun;
								echo "<div class='alert alert-success text-center'><span class=glyphicon glyphicon-ok'></span> Login Berhasil</div>";
								if (isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])) {

									echo "<meta http-equiv='refresh' content='1;url=checkout.php'?>";
								}
								else{
									echo "<meta http-equiv='refresh' content='1;url=index.php'?>";
								}
							}
							else{
								echo "<div class='alert alert-danger text-center'><span class='glyphicon glyphicon-remove'></span> Login gagal silahkan periksa akun Anda!</div>";
								echo "<meta http-equiv='refresh' content='1;url=login.php'?>";
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
