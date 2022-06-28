<?php
require "koneksi.php";

$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");

//mendapatkan produk berdasarkan nama produk/keyword
if(isset($_GET['keyword'])){
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama LIKE '%$_GET[keyword]%'");

//mendapatkan produk dari kategori
} else if (isset($_GET['kategori'])){
    $queryGetKategoriId = mysqli_query($koneksi, "SELECT id_kategori FROM kategori WHERE nama = '$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);
    
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori_id = '$kategoriId[id_kategori]'");
//mendapatkan produk default
} else {
    $queryProduk = mysqli_query($koneksi, "SELECT * FROM produk");
}

$countData = mysqli_num_rows($queryProduk);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BK STORE | Produk</title>
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
            </ul>
          </div>
        </div>
      </nav>

      <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
      </div>

      <div class="container">
            <div class="row">
                <div class="col-lg-3 mt-5 mb-5">
                    <h3>Kategori</h3>
                    <ul class="list-group mt-5">
                        <?php
                        while($kategori = mysqli_fetch_array($queryKategori)){
                        ?>
                        <a href="produkuser.php?kategori=<?php echo $kategori['nama']; ?>">
                       <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                        </a>
                       <?php }?>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <h3 class="text-center mt-5 mb-3">Produk</h3>
                    <div class = "row">
                <?php
                        if($countData<1){
                ?>
                           <h4 class="container text-center my-5">Produk yang anda cari tidak tersedia!</h4>
                <?php
                        }
                ?>


                        <?php
                        while($produk = mysqli_fetch_array($queryProduk)){
                        ?>
                        <div class="col-md-4 mb-4">
                          <div class = "card h-100">
                            <div class="image-box">
                               <img src="gambarproduk/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                            </div><br>
                            <div class="card-body m-2 mt-5">
                               <h4 class="card-title"><?php echo $produk['nama']; ?></h4>
                               <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                               <p class="card-text text-harga">Rp <?php echo $produk['harga']; ?></p>
                               <a href="detailuser.php?nama=<?php  echo $produk['nama']; ?>" class="btn warna2 text-white">Lihat Detail</a>
                            </div>
                         </div>
                      </div>
                      <?php } ?>
                    </div>
                    <div class="container text-center">
                       <footer>
                          Since 2022 &copy; BK STORE
                       </footer>
                    </div>
                 </div>
            </div>
         </div>
    </div>
</body>
</html>