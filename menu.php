<nav class="navbar navbar-default cari">
	<ul class="nav navbar-nav navbar-left" style="margin-top: 10px;">
		<li><a href="index.php"><img src="img/Logo2.jpg" style="margin-top: -23px; margin-bottom: -10px;" width="70" height="70"></a></li>
		<li><a href="index.php" class="navbar-brand"><b>TOKO VIVI</b></a></li>
		

		<li><a href="keranjang.php" class="navbar-brand"><span class="glyphicon glyphicon-shopping-cart"> </span> Keranjang <sup class="label-info img-rounded"> <b>&ensp;<?php
		
		if (empty($_SESSION['keranjang'])) {
			echo "0";
		}else{
			foreach ($_SESSION['keranjang'] as $id_produk => $jumlah[]): endforeach;
			if (empty($jumlah)){
				echo "0";
			}else{
				$jum = 0;
				$jum = array_sum($jumlah); 
				echo $jum;
				if (empty($jum)){
					echo "0";
				}
			}
		}
		?>&ensp;</b> </sup></a></li>
		
		<li><a href="checkout.php" class="navbar-brand"><span class="glyphicon glyphicon-ok"></span> Chekout</a></li>
		<li><a href="riwayat.php" class="navbar-brand"><span class="glyphicon glyphicon-time"></span> Riwayat Belanja</a></li>
		<li>
		<?php
		if(isset($_SESSION['pelanggan'])): ?>
			<form class="navbar-form navbar-left" method="GET" action="pencarian.php">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Cari" name="search">
				</div>
				<button type="submit" class="btn btn-primary">
					<span class="glyphicon glyphicon-search"></span>
				</button>
			</form>
		</li>
	</ul>

	<ul class="nav navbar-nav navbar-right" style="margin-top: 10px;">
		<li><a href="index.php" class="navbar-brand"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['pelanggan']['nama_pelanggan'];?></a></li>
		<li><a><b>|</b></a></li>
		<li><a href="logout.php" style="margin-right: 2cm;" class="navbar-brand"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		<?php else : ?>
		<li>
			<form class="navbar-form navbar-left" method="GET" action="pencarian.php">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Cari" name="search">
				</div>

				<button class="btn btn-primary">
					<span class="glyphicon glyphicon-search"></span>
				</button>
			</form>
		</li>
		<li><a href="daftar.php" style="margin-left: 10cm;" class="navbar-brand"><span class="glyphicon glyphicon-new-window"></span> Daftar</a></li>
		<li><a><b>|</b></a></li>
		<li><a href="login.php" class="navbar-brand"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		
		<?php endif ?>
	</ul>
</nav>