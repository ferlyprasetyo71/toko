<?php

include 'koneksi.php';

$id = $_GET['p'];

$query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori='$id'");
$data = mysqli_fetch_array($query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
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

    <div class="container mt-5">
       <h2>Detail Kategori</h2>

       <div class="col-12 col-md-6">
           <form action="" method="post">
               <div>
                   <label for="kategori">Kategori</label>
                   <input type="text" name="kategori" id="kategori" class="form-control" value= "<?php echo $data['nama'];?>">
                </div>
                <div class = "mt-5">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                </div>
           </form>

           <?php
               if(isset($_POST['editBtn'])){
                $kategori = ($_POST['kategori']);

                if($data['nama']==$kategori){
                    ?>

                       <meta http-equiv="refresh" content="0; url = kategori.php" />

                    <?php
                } else {
                    $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahData = mysqli_num_rows($query);
                    
                    if($jumlahData > 0){
                        ?>

                          <div class="alert alert-primary mt-3" role="alert">
                           Kategori Sudah Ada
                          </div>
                        <?php

                    } else {
                        $querySimpan = mysqli_query($koneksi, "UPDATE kategori SET nama='$kategori' WHERE id_kategori='$id'");
                        if($querySimpan){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                            Kategori Berhasil Di Update
                            </div>
                            <meta http-equiv="refresh" content="1; url = kategori.php" />
                            <?php
    
                        } else {
                            echo mysqli_error($koneksi);
                        }
                    }
                }
            }

            if(isset($_POST['deleteBtn'])){
              
              $queryCheck = mysqli_query($koneksi, "SELECT * FROM produk WHERE kategori_id ='$id'");
              $dataCount = mysqli_num_rows($queryCheck);
              
              if($dataCount > 0){
            ?>
                <div class="alert alert-warning mt-3" role="alert">
                  Kategori Tidak Bisa di hapus Karena sudah di gunakan di Produk
                </div>
            <?php
            die();
              }
              
                $queryDelete = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$id'");
                if($queryDelete){
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                    Kategori Berhasil Di Hapus
                    </div>
                    <meta http-equiv="refresh" content="1; url = kategori.php" />
                    <?php
                } else {
                    echo mysqli_error($koneksi);
                }
            }
           ?>
        </div>
    </div>
</body>
</html>