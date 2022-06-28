<?php

include "koneksi.php";
$queryProduk = mysqli_query($koneksi, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BK STORE | HOME</title>
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
      <div class="container-fluid banner d-flex align-items-center">
      <div class="container text-center text white">
        <a class="navbar-brand" href="#">
          <img src="./gambar/Bkstrore.png" alt="" width="150" height="150" class="me-2">
        </a>
        <h1>BK STORE</h1>
        <h1>Mau Cari apa?</h1>
        <div class="col-md 8 offset -md-2">
            <form method="get" action="produkuser.php">
                <div class="input-group input-group-lg my-4">
                    <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                    <button type="submit" class="btn warna2 text-white">Telusuri</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container text-center">
        <h3>Kategori Terlaris</h3>
        <div class="row mt-5">
            <div class="col-4">
                <div class="highlighted-kategori kategori-baju-pria d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produkuser.php?kategori=Baju pria">Baju Pria</a><h4>
                </div>
            </div>
            <div class="col-4">
                <div class="highlighted-kategori kategori-baju-wanita d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produkuser.php?kategori=Baju wanita">Baju Wanita</a><h4>
                </div>
            </div>
            <div class="col-4">
                <div class="highlighted-kategori sepatu d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produkuser.php?kategori=Sepatu">Sepatu</a><h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid warna3 py-5">
   <div class="container text-center">
      <h3>Tentang Kami</h3>
   </div>
</div>

<div class="container-fluid py-5">
    <div class="container text-center">
        <h1>Produk</h1>

    <div class="row mt-5">
        <?php 
         while($data = mysqli_fetch_array($queryProduk)){?>
         <div class="col-sm-6 col-md-4 mb-3">
          <div class = "card h-100">
           <div class="image-box">
             <img src="gambarproduk/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
           </div><br>
              <div class="card-body m-2 mt-5">
                <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                <p class="card-text text-harga">Rp <?php echo $data['harga']; ?></p>
                <a href="produkuser.php?nama=<?php echo $data['nama']; ?>" class="btn warna2 text-white">Lihat Detail</a>
              </div>
            </div>
          </div>
          <?php } ?>
       </div>
       <a class="btn btn-outline-warning mt 3" href="produkuser.php">See More</a>
    </div>
    <div class="container text-center mt-5">
        <footer>
            Since 2022 &copy; BK STORE
        </footer>
    </div>
</body>
</html>