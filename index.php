<?php 
session_start();   // ============> SESSION
include 'functions.php';

// Jika ada session dan session login value nya 1
if (isset($_SESSION['login']) && $_SESSION['login'] === '1') {
		header("Location: home.php");
}

//  =========================================================================
if (isset($_POST['submitLogin'])) { //  ===== Saat menekan Tombol Login
	$username = $_POST['userLogin'];
	$password = $_POST['passLogin'];

	$data = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");
	
	// Mengambil data yang username nya sesuai apa yang di input 
	$obj = mysqli_fetch_assoc($data);

	//cek Username
	// Ketika Hasilnya adalah False / tidak ditemukan
	if (!$obj['username']) {
		echo "<script> alert('Akun anda belum melakukan Registratsi'); </script>";
	} else {
		
		// Cek Password
		// Membandingkan antara password yang di input dengan password yang sudah di hash
		if (password_verify($password, $obj['password'])) {
			// Apa yg dilakukan jika password benar
			$_SESSION['login'] = '1';

			echo "
            <script>
                alert('Login Berhasil!');
                document.location.href = 'home.php';
            </script>";

		} else {
			// Apa yg dilakukan jika password salah
			echo "<script> alert('PASSWORD SALAH! Silahkan refresh'); </script>";
		}
	}
}


//  =========================================================================
if (isset($_POST['submitRegister'])) {	//  ===== Saat menekan Tombol Register
	$username = $_POST['userReg'];
	$password = $_POST['passReg'];
	$confirmpass = $_POST['confirmPassReg'];

	// Cek ada username yang sama atau tidak
	$UseUsername = fetchData("SELECT username FROM user WHERE username = '$username' ");
	if ($UseUsername) {
		echo "<script> 
			alert('Username Sudah ada!');
			document.location.href = 'index.php'; 
				</script>";
		die;
	}

	// Register
	if (register($username, $password, $confirmpass)) {
		echo "<script> alert('Register Berhasil!'); </script>";
	} else{
		echo "<script> alert('Register Gagal!'); </script>";
	}
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>

<h1>Login Form</h1>
<form method="post">
	<input type="text" name="userLogin" placeholder="username">
	<input type="password" name="passLogin" placeholder="password">
	<button type="submit" name="submitLogin">Login!</button>
</form>

<h1>Register Form</h1>
<form method="post">
	<input type="text" name="userReg" placeholder="username">
	<input type="password" name="passReg" placeholder="password">
	<input type="password" name="confirmPassReg" placeholder="Confirm Password">
	<button type="submit" name=submitRegister>Register!</button>
</form>


</body>
</html>