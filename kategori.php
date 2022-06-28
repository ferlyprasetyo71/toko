<?php

require "koneksi.php";

$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
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

      <div class="container m-5 mt-3 my-5 col-12 col-md-6">
        <h3>Tambah Kategori</h3>

        <form action="" method="post">
            <div>
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" placeholder="input nama kategori" class="form-control">
            </div>
            <div class="mt-3">
                <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
            </div>
        </form> 
        <?php
            if(isset($_POST['simpan_kategori'])){
                 $kategori = ($_POST['kategori']);

                $queryExist = mysqli_query($koneksi, "SELECT nama FROM kategori WHERE nama = '$kategori'");
                $jumlahDataKategoriBaru = mysqli_num_rows ($queryExist);

                if($jumlahDataKategoriBaru > 0){
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                    Kategori Sudah Ada
                   </div>
                    <?php
                } else {
                    $querySimpan = mysqli_query($koneksi, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                    if($querySimpan){
                        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                        Kategori Berhasil Di Simpan
                        </div>
                        <meta http-equiv="refresh" content="1; url = kategori.php" />
                        <?php

                    } else {
                        echo mysqli_error($koneksi);
                    }
                }
            }
        ?>
      </div>

      <div class="container m-5 mt-3">
        <h2>List Kategori</h2>
        <div class="table-responsive">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </th>
                </thead>
                <tbody>
                    <?php
                        if($jumlahKategori==0){
                    ?>
                        <tr>
                            <td colspan=3 class="text-center">Data Kategori Tidak Tersedia</td>
                        </tr>
                        <?php
                        } else {
                            $number = 1;
                            while($data=mysqli_fetch_array($queryKategori)){
                            ?>
                            <tr>
                                <td><?php echo $number; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td>
                                    <a href="kategoridetail.php?p=<?php echo $data['id_kategori'];?>"
                                    class="btn btn-info"><i class="fas fa-search">Edit</i></a>
                                </td>
                            </tr>
                            <?php
                            $number++;
                            }
                        }
                        ?>

                </tbody>
            </table>
        </div>
      </div>
    
</body>
</html>