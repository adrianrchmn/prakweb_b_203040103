<?php
/*session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
} */

require 'functions.php';

// pagination
// konfigurasi
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman *$halamanAktif ) - $jumlahDataPerHalaman;


$buku = query("SELECT * FROM buku LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $buku = cari($_POST["keyword"]);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Halaman Admin</title>
</head>
<body>

<!-- navbar -->
<div class="jumbotron jumbotron-fluid">
    <div class="container text-center">
    <a href="index.php" class="brand-logo"><img src="img/logo.png" width="300"></a>
    </div>
</div>


<div class="container text-right">
    <a href="tambah.php" class="btn btn-primary">Tambah data</a>
<br><br>

<form action="" method="post">
    <input type="text" name="keyword" size="30" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off">
    <button type="submit" name="cari">Cari</button>
</form>
<br>
</div>


<table border="1" cellpadding="10" cellspacing="0" class="table">
    <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>Kode Buku</th>
        <th>Judul Buku</th>
        <th>Penulis Buku</th>
        <th>Harga</th>
        <th>Gambar</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach( $buku as $bu ) : ?>
    <tr>
        <td><?= $i ?></td>
        <td>
            <a href="ubah.php?id=<?= $bu["id"]; ?>">ubah</a>    |
            <a href="hapus.php?id=<?= $bu["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
        </td>
        <td><?= $bu["kode_buku"]; ?></td>
        <td><?= $bu["judul_buku"]; ?></td>
        <td><?= $bu["penulis_buku"]; ?></td>
        <td><?= $bu["harga"]; ?></td>
        <td><img src="img/<?= $bu["gambar"]; ?>" width="150"></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

</table>


<!-- navigasi -->
<div class="container text-center">
<?php if( $halamanAktif > 1 ) : ?>
<a href="?halaman=<?= $halamanAktif -1; ?>">&laquo</a>
<?php endif; ?>

<?php for($i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
    <?php if( $i == $halamanAktif ) : ?>
        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
    <?php else : ?>
        <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
    <?php endif; ?>

<?php endfor; ?>

<?php if( $halamanAktif < $jumlahHalaman ) : ?>
<a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo</a>
<?php endif; ?>
</div>
<br><br>

<!--
<div class="container text-center">
<a href="logout.php" class="btn btn-primary">Logout</a>
</div>
<br><br> -->



<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->

</body>
</html>