<?php

include 'koneksi.php';

if (isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $level = $_POST['level'];

  $cek = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username' and level = '$level' ");

  if (mysqli_num_rows($cek) === 1){
    $data = mysqli_fetch_assoc($cek);

    if ($password == $data['password']){

      if ($level == "Pengguna"){
        header("location:homeUser.php");
      } else if ($level == "Admin"){
        header("location:dassboard.php");
      }
    } else {
      echo"<script>
     alert('username atau password salah');
     window.location = 'index.php';
    </script>";
    }

  } else {
    echo"<script>
     alert('username atau password salah');
     window.location = 'index.php';
    </script>";
  }
}

?>



<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <title>LOG IN</title>
  <link rel="stylesheet" href="style.css" media="screen" type="text/css" />

</head>

<body>
  <div class="container">
  <div class="login-card">
    <img src="./gambar/Bkstrore.png" alt="" width="250" height="300" class="me-2">
    <h1>BK STORE LOGIN</h1>
    <form action="" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <select class="form-control" name="level">
      <option value ="Pengguna">Pengguna</option>
      <option value ="Admin">Admin</option>
    </select>   
    <input type="submit" name="login" class="login login-submit" value="login">
    </form>

  <div class="login-help">
  <p>Belum Punya Akun Pengguna? <a href="registrasi.php"> Daftar!</a></p>
  </div>
</div>
</div>
</body>

</html>