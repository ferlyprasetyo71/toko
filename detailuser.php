<?php

require "koneksi.php";

$nama = ($_GET['nama']);
$queryProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BK STORE | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styleuser.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark warna1">
        <div class="container">
           <a class="navbar-brand" href="#">
                <img src="gambar/Bkstrore.png" alt="" width="50" height="50" class="me-2">
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item me-3">
                <a class="nav-link active" aria-current="page" href="homeUser.php">Home</a>
              </li>
              <li class="nav-item me-3">
                <a class="nav-link" href="produkuser.php">Produk</a>
              </li>
              <li class="nav-item me-3">
                <a class="nav-link" href="tentangkami.html">About Us</a>
              </li> 
              <li class="nav-item me-3">
                <a class="nav-link" href="index.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="gambarproduk/<?php echo $produk['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-md-6 offset-md-1">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p clas="fs-5">
                        <?php echo $produk['detail']; ?>
                    </P>
                    <p class="text-harga">
                        Rp <?php echo $produk['harga']; ?>
                    </p>
                    <p class="fs-5">Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok'] ?><strong></p>
                    <button type="submit" class="btn btn-danger" name="Beli"><a href="beli.html">Beli</a></button>
                </div>
            </div>
        </div>
      </div>
</body>
</html>