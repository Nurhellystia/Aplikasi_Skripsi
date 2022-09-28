<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['pelanggan'])){
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
}
if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])) {
	echo "<script>alert('Produk kosong, silahkan belanja terlebih dahulu!');</script>";
	echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Toko Vivi | Checkout</title>
	<link rel ="stylesheet" type="text/css" href="nav.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'menu.php'; ?>
	<!-- <pre><?php print_r($_SESSION['pelanggan']); ?></pre> -->
	<section class="konten">
		<div class="container">
			<h2 class="text-center"><span class="glyphicon glyphicon-ok"></span><br>Checkout</h2>
			<table class="table table-bordered">
				<thead class="label-info">
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Produk</th>
						<th class="text-center">Harga</th>
						<th class="text-center">Berat</th>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Sub Berat</th>
						<th class="text-center">Sub Harga</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$nomor = 1;
					$total_belanja = 0;
					$totalberat = 0;
					foreach ($_SESSION['keranjang'] as $id_produk => $jumlah):
					$ambil = $koneksi->query("SELECT*FROM produk WHERE id_produk ='$id_produk'");
					$pecah = $ambil->fetch_assoc();
					$subharga = $pecah['harga_produk']*$jumlah;
					$subberat = $pecah["berat_produk"]*$jumlah;
					$totalberat += $subberat;

					?>
					<tr>
						<td class="text-center"><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td class="text-center">Rp. <?php echo number_format($pecah['harga_produk']);?></td>
						<td class="text-center"><?php echo number_format($pecah['berat_produk']);?> g</td>
						<td class="text-center"><?php echo $jumlah; ?></td>
						<td class="text-center"><?php echo $subberat;?> g</td>
						<td class="text-center">Rp. <?php echo number_format($subharga);?></td>
						
					</tr>
				<?php 
				$nomor++;
				$total_belanja+=$subharga; 
				endforeach; ?>
				</tbody>
				<tfoot>
					<th class="text-center" colspan="5">Total</th>
					<th class="text-center"><?php echo number_format($totalberat); ?> g</th>
					<th class="text-center">Rp. <?php echo number_format($total_belanja); ?></th>
				</tfoot>
			</table>
			<form method="POST">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group has-feedback">
							<input type="text" readonly class="form-control" value="<?php echo$_SESSION['pelanggan']['nama_pelanggan']; ?>">
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group has-feedback">
							<input type="text" readonly class="form-control" value="<?php echo$_SESSION['pelanggan']['telepon_pelanggan']; ?>">
							<span class="glyphicon glyphicon-earphone form-control-feedback"></span>
						</div>
					</div>
					<br>
				<div style="margin-left: 15px;"><h3>Alamat</h3>
					
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Provinsi</label>
						<select class="form-control" name="nama_provinsi">

						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Kota / Kabupaten</label>
						<select class="form-control" name="nama_kota">

						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Ekspedisi</label>
						<select class="form-control" name="nama_ekspedisi">
							
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Ongkir</label>
						<select class="form-control" name="nama_ongkir">
							
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<input type="hidden" name="total_berat" value="<?php echo $totalberat;?>" class="form-control">
						<input type="hidden" name="provinsi" class="form-control">
						<input type="hidden" name="kota" class="form-control">
						<input type="hidden" name="tipe" class="form-control">
						<input type="hidden" name="kodepos" class="form-control">
						<input type="hidden" name="ekspedisi" class="form-control">
						<input type="hidden" name="paket" class="form-control">
						<input type="hidden" name="ongkir" class="form-control">
						<input type="hidden" name="estimasi" class="form-control">
					</div>
				</div>
			</div>
				<div class="form-group has-feedback">
					<label>Alamat Lengkap</label>
					<textarea name="alamat_pengiriman" rows="4" class="form-control" style="resize: none;"><?php echo $_SESSION['pelanggan']['alamat_pelanggan']; ?></textarea>
					<span class="glyphicon glyphicon-home form-control-feedback"></span>
				</div>
				<p class="text-right">
				<button class="btn btn-success" name="checkout"><span class="glyphicon glyphicon-ok"></span> Checkout</button>
				</p>
			</form>
			<?php
			if (isset($_POST['checkout'])) {
				// code...
				$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
				$tanggal_pembelian = date("Y-m-d");
				$alamat_pengiriman = $_POST['alamat_pengiriman'];

				$totalberat = $_POST["total_berat"];
				$provinsi = $_POST["provinsi"];
				$kota = $_POST["kota"];
				$tipe = $_POST["tipe"];
				$kodepos = $_POST["kodepos"];
				$ekspedisi = $_POST["ekspedisi"];
				$paket = $_POST["paket"];
				$ongkir = $_POST["ongkir"];
				$estimasi = $_POST["estimasi"];

				
				$total_pembelian = $total_belanja + $ongkir;

				$koneksi->query("INSERT INTO pembelian(id_pelanggan, tanggal_pembelian, total_pembelian, alamat_pengiriman, totalberat,provinsi, kota, tipe, kodepos, ekspedisi, paket, ongkir, estimasi) 

					VALUES ('$id_pelanggan', '$tanggal_pembelian', '$total_pembelian', '$alamat_pengiriman', '$totalberat','$provinsi','$kota','$tipe','$kodepos','$ekspedisi','$paket','$ongkir','$estimasi')");
				

				$id_pembelian_barusan = $koneksi->insert_id;
				foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
					$ambil = $koneksi->query("SELECT*FROM produk WHERE id_produk = '$id_produk'");
					$perproduk = $ambil->fetch_assoc();

					$nama = $perproduk['nama_produk'];
					$harga = $perproduk['harga_produk'];
					$berat = $perproduk['berat_produk'];
					$subharga = $perproduk['harga_produk']*$jumlah;
					$subberat = $perproduk['berat_produk']*$jumlah;
					$stok = $perproduk['stok_produk']-$jumlah;
					$koneksi->query("INSERT INTO pembelian_produk(id_pembelian, id_produk, nama, harga, berat, subharga, subberat, jumlah) VALUES('$id_pembelian_barusan', '$id_produk','$nama', '$harga', '$berat', '$subharga', '$subberat', '$jumlah')");
					$koneksi->query("UPDATE produk SET stok_produk = '$stok' WHERE id_produk = '$id_produk'");
				}
				unset($_SESSION['keranjang']);
				echo "<script>alert('Pembelian Sukses');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
			}
			?>
			<!-- <pre><?php print_r($_SESSION['keranjang']); ?></pre> -->
		</div>
	</section>


<script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'dataprovinsi.php',
			success:function(hasil_provinsi){
				
				$("select[name=nama_provinsi]").html(hasil_provinsi);
			}
		});
		$("select[name=nama_provinsi").on("change", function(){
			var id_provinsi_terpilih = $("option:selected",this).attr("id_provinsi");
			$.ajax({
				type:'post',
				url:'datakota.php',
				data:'id_provinsi='+id_provinsi_terpilih,
				success:function(hasil_kota){
					$("select[name=nama_kota]").html(hasil_kota);
				}
			});
		});

		$.ajax({
			type:'post',
			url:'dataekspedisi.php',
			success:function(hasil_ekspedisi){
				$("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
			}
		});
		$("select[name=nama_ekspedisi]").on("change", function(){
			var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
			// alert(ekspedisi_terpilih);
			var kota_terpilih = $("option:selected","select[name=nama_kota]").attr("id_kota");
			// alert(kota_terpilih);
			var total_berat = $("input[name=total_berat]").val();
			$.ajax({
				type:'post',
				url:'dataongkir.php',
				data:'ekspedisi='+ekspedisi_terpilih+'&kota='+kota_terpilih+'&berat='+total_berat,
				success:function(hasil_ongkir){
					$("select[name=nama_ongkir]").html(hasil_ongkir);
					$("input[name=ekspedisi]").val(ekspedisi_terpilih);
				}
			})
		});
		$("select[name=nama_kota").on("change", function(){
			var prov = $("option:selected",this).attr("nama_provinsi");
			var kota = $("option:selected",this).attr("nama_kota");
			var tipe = $("option:selected",this).attr("tipe_kota");
			var kodepos = $("option:selected",this).attr("kodepos");
			var tipe = $("option:selected",this).attr("tipe_kota");

			$("input[name=provinsi]").val(prov);
			$("input[name=kota]").val(kota);
			$("input[name=tipe]").val(tipe);
			$("input[name=kodepos]").val(kodepos);
		});
		$("select[name=nama_ongkir").on("change", function(){
			var paket = $("option:selected",this).attr("paket");
			var ongkir = $("option:selected",this).attr("ongkir");
			var etd = $("option:selected",this).attr("etd");


			$("input[name=paket]").val(paket);
			$("input[name=ongkir]").val(ongkir);
			$("input[name=estimasi]").val(etd);
		})
	});
</script>
</body>
</html>