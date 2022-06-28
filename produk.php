<?php

require "koneksi.php";

$query = mysqli_query($koneksi, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id_kategori");
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLenght = strlen($characters);
    $randomString = '';
    for($i = 0; $i < $length; $i++){
        $randomString .= $characters[rand(0, $charactersLenght -1)];
    }
    return $randomString;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
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
        <h3>Tambah Produk</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
            </div>
            <div>
                <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Satu</option>
                    <?php
                        while($data=mysqli_fetch_array($queryKategori)){
                    ?>
                        <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga">
            </div>
            <div>
                <label for="foto">Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div>
                <label for="ketersediaan_stok">Ketersediaan Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan stok" class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="Habis">Habis</option>
                </select>
            </div><br>
            <div>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
        </form>

        <?php
        if(isset($_POST['simpan'])){
            $nama = ($_POST['nama']);
            $kategori = ($_POST['kategori']);
            $harga = ($_POST['harga']);
            $detail = ($_POST['detail']);
            $ketersediaan_stok = ($_POST['ketersediaan_stok']);

            $target_dir = "./gambarproduk/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
            $random_name = generateRandomString(20);
            $new_name = $random_name . "." . $imageFileType;


            if($nama=='' || $kategori=='' || $harga==''){
        ?>
            <div class="alert alert-warning mt-3" role="alert">
                Nama, Kategori dan Harga Wajib diisi
            </div>

        <?php

            } else {
                if($nama_file != ''){
                    if($image_size > 500000){
        ?>
                       <div class="alert alert-warning mt-3" role="alert">
                          file tidak boleh lebih dari 500 kb
                       </div>
        <?php                
                    } else {
                        if($imageFileType != 'jpg'  &&  $imageFileType != 'png'  &&  $imageFileType != 'gif'){
        ?>
                           <div class="alert alert-warning mt-3" role="alert">
                              file wajib bertipe jpg, png, gif
                           </div>
        <?php                    
                        } else {
                            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name );
                        }
                    }
                } 

                $queryTambah = mysqli_query($koneksi, "INSERT INTO produk 
                (kategori_id, nama, harga, foto, detail, ketersediaan_stok) 
                VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

                if($queryTambah){
        ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Produk Berhasil Di Simpan
                    </div>
                        
                    <meta http-equiv="refresh" content="1; url = produk.php" />
        <?php
                } else {
                    echo mysqli_error($koneksi);
                }
            }
        }
        
        ?>
      </div>

      <div class="container m-5 mt-3">
        <h2>List Produk</h2>
        <div class="table-responsive">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Ketersediaan Stok</th>
                        <th>Action</th>
                    </th>
                </thead>
                <tbody>
                    <?php
                        if($jumlahProduk==0){
                    ?>
                        <tr>
                            <td colspan=6 class="text-center">Data Produk Tidak Tersedia</td>
                        </tr>
                    <?php
                        } else {
                            $number = 1;
                            while($data=mysqli_fetch_array($query)){
                    ?>
                            <tr>
                                <td><?php  echo $number; ?></td>
                                <td><?php  echo $data['nama']; ?></td>
                                <td><?php  echo $data['nama_kategori']; ?></td>
                                <td><?php  echo $data['harga']; ?></td>
                                <td><?php  echo $data['ketersediaan_stok']; ?></td>
                                <td>
                                    <a href="produkdetail.php? p=<?php echo $data['kategori_id'];?>" class="btn btn-info"><i class="fas fa-search">Edit</i></a>
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