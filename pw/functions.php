<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "prakweb_2022_b_203040103");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $conn;

	$kode_buku = htmlspecialchars($data["kode_buku"]);
	$judul_buku = htmlspecialchars($data["judul_buku"]);
	$penulis_buku = htmlspecialchars($data["penulis_buku"]);
	$harga = htmlspecialchars($data["harga"]);

	// upload gambar
	$gambar = upload();
	if( !$gambar) {
		return false;
	}

	$query = "INSERT INTO buku
				VALUES
				('', '$gambar',  '$kode_buku', '$judul_buku', '$penulis_buku', '$harga')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang di upload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu');
				</script>";
		return false;
	}

	// cek apakah yang di upload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar');
			</script>";
		return false;
	}

	// lolos pengecekan, gambar siap di upload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;


	move_uploaded_file($tmpName, 'img/' . $namaFile);

	return $namaFileBaru;

}




function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM buku WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;

	$id = $data["id"];
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	$judul_buku = htmlspecialchars($data["judul_buku"]);
	$penulis_buku = htmlspecialchars($data["penulis_buku"]);
	$kode_buku = htmlspecialchars($data["kode_buku"]);
	$harga = htmlspecialchars($data["harga"]);

	// cek apakah user pilih gambar baru atau tidak
	if( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();

	}
	
	$query = "UPDATE buku SET
				gambar = '$gambar',
				kode_buku = '$kode_buku'
				judul_buku = '$judul_buku',
				penulis_buku = '$penulis_buku',
				harga = '$harga'
				WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari($keyword) {
	$query = "SELECT * FROM buku
				WHERE
			kode_buku LIKE '%$keyword%' OR
            judul_buku LIKE '%$keyword%' OR
            penulis_buku LIKE '%$keyword%' OR
            harga LIKE '%$keyword%'
            ";
    return query($query);
}

function registrasi($data) {
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar')
			</script>";
		return false;
	}

	// cek konfirmasi password
	if( $password !== $password2) {
		echo "<script>
				alert('konfirmasi password tidak sesuai');
			</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

	return mysqli_affected_rows($conn);
}




?>