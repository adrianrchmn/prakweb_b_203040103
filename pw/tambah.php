<?php
/* session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
} */

require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	

	// cek apakah data berhasil di tambahkan atau tidak
	if( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan');
				document.location.href = 'index.php';
			</script>
		";
	}



}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data</title>
</head>
<body>
	<h1>Tambah Data Buku</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="gambar">Gambar	:</label><br>
				<input type="file" name="gambar" id="gambar">
			</li><br>
			<li>
				<label for="kode_buku">Kode Buku	:</label><br>
				<input type="text" name="kode_buku" id="kode_buku" required>
			</li><br>
			<li>
				<label for="judul_buku">Judul Buku	:</label><br>
				<input type="text" name="judul_buku" id="judul_buku" required>
			</li><br>
			<li>
				<label for="penulis_buku">Penulis Buku	:</label><br>
				<input type="text" name="penulis_buku" id="penulis_buku" required>
			</li><br>
			<li>
				<label for="harga">Harga	:</label><br>
				<input type="price" name="harga" id="harga" required>
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
				<button type="submit" name="submit">Tambah Data</button>
			</li>
		</ul>
	</form>
</body>
</html>