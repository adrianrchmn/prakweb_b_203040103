<?php
/*session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
} */

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data buku berdasarkan id
$bu = query("SELECT * FROM buku WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	

	// cek apakah data berhasil diubah atau tidak
	if( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah');
				document.location.href = 'index.php';
			</script>
		";
	}



}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data</title>
</head>
<body>
	<h1>Ubah Data Buku</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $bu["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $bu["gambar"]; ?>">
		<ul>
			<li>
				<label for="gambar">Gambar	:</label><br>
				<img src="img/<?= $bu['gambar']; ?>" width="50"><br>
				<input type="file" name="gambar" id="gambar">
			</li><br>
			<li>
				<label for="kode_buku">Kode Buku	:</label><br>
				<input type="text" name="kode_buku" id="kode_buku" required value="<?= $bu["kode_buku"]; ?>">
			</li><br>
			<li>
				<label for="judul_buku">Judul Buku	:</label><br>
				<input type="text" name="judul_buku" id="judul_buku" required value="<?= $bu["judul_buku"]; ?>">
			</li><br>
			<li>
				<label for="penulis_buku">Penulis Buku	:</label><br>
				<input type="text" name="penulis_buku" id="penulis_buku" required value="<?= $bu["penulis_buku"]; ?>">
			</li><br>

			<li>
				<label for="harga">Harga	:</label><br>
				<input type="price" name="harga" id="harga" required value="<?= $bu["harga"]; ?>">
			</li><br>
			<!-- <li>
				<label for="merk">Merk	:</label><br>
				<select name="merk" id="merk">
					<option value="">-------Pilihan-------</option>
					<option value="Alpinestars">Alpinestars</option>
					<option value="Crossbone">Crossbone</option>
					<option value="Expedition">Expedition</option>
					<option value="Gaerne">Gaerne</option>
					<option value="Orca">Orca</option>
					<option value="Polisport">Polisport</option>
					<option value="Thor">Thor</option>
					<option value="UFO">UFO</option>
					<option value="">-</option>
				</select>
			</li><br> -->
			<li>
				<button type="submit" name="submit">Ubah Data</button>
			</li>
		</ul>
	</form>
</body>
</html>