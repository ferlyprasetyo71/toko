<?php

include 'koneksi.php';

if (isset($_POST['submit'])){
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$level = $_POST['level'];
	
	$cek_user = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username' and level = 'level' ");
	$cek_login = mysqli_num_rows($cek_user);

	if ($cek_login > 0){
		echo "<script>
		    alert('username telah terdaftar);
			window.location = 'registrasi.php';
		</script>";
	} else {
		if ($password1 != $password2) {
			echo "<script>
		    alert('konfirmasi password tidak sesuai');
			window.location = 'registrasi.php';
		</script>";
		} else {
			$password = ($password1);
			mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$nama', '$password', '$level')");
			echo "<script>
		    alert('Data Berhasil Dikirim');
			window.location = 'index.php';
		</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Registrasi Data</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="register.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<div class="main-w3layouts wrapper">
		<h1>BK STORE SIGN UP</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="" method="POST">
				    <input class="text" type="text" name="username" placeholder="username" required="yes"><br><br><br>
					<input class="text" type="text" name="nama" placeholder="Nama Lengkap" required="yes"><br><br><br>
					<input class="text" type="password" name="password1" placeholder="Password" required="">
					<input class="text w3lpass" type="password" name="password2" placeholder="Confirm Password" required="">
					<select class="form-control" type="text" name="level">
					    <option value ="Pengguna">Pengguna</option>
					</select>
					<input type="submit" value="SIGN UP" name="submit">
				</form>
			</div>
		</div>
</body>
</html>