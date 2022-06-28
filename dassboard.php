<?php

require "koneksi.php";

$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($koneksi, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dashboard</title>
  </head>
  <style>
    .kotak{
        border : solid;
    }

    .summary-kategory{
        background-color: rgb(9, 204, 97);
        border-radius: 10px;
    }

    .summary-produk{
        background-color: rgb(49, 82, 230);
        border-radius: 10px;
    }
  </style>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item me-3">
                <a class="nav-link active" aria-current="page" href="dassboard.php">Home</a>
         
              <li class="nav-item me-3">
                <a class="nav-link" href="kategori.php">kategori</a>
              </li>
              <li class="nav-item me-3">
                <a class="nav-link" href="produk.php">Produk</a>
              </li>     </li>
              <li class="nav-item me-3">
                <a class="nav-link" href="index.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container mt-5"><h2>SELAMAT DATANG ADMIN</h2></div>
      <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="summary-kategory p-5">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="fs-2">Kategori</h3>
                            <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
                            <p class="fs-6"><a href="kategori.php" class="text-white">Lihat Detail</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="summary-produk p-5">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="fs-2">Produk</h3>
                            <p class="fs-4"><?php echo $jumlahProduk; ?> Produk</p>
                            <p class="fs-6"><a href="produk.php" class="text-white">Lihat Detail</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
  </body>
</html>