<?php 

// Configuration Connection Database
$host = "localhost";
$user = "root";
$password = "";
$usingDatabase = "job";

$connection = mysqli_connect($host, $user, $password, $usingDatabase);


// Function Fetch Data
function fetchData($query){
	global $connection;

	$resultQuery = mysqli_query($connection, $query);
	$box = [];

	// Looping for fetch data
	while ($results = mysqli_fetch_assoc($resultQuery)) {
		$box[] = $results;
	}

	return $box;
}

// Function Add Data Product
function addProduct($data, $gambar){
	global $connection;

	$image = $gambar;
	$name = htmlspecialchars($data['name']);
	$categorie = htmlspecialchars($data['categorie']);
	$desc = htmlspecialchars($data['desc']);
	$price = htmlspecialchars($data['price']);


	$query = "INSERT INTO product VALUES ('', '$image', '$name', '$categorie', '$desc', '$price')";

	mysqli_query($connection, $query);
	return true;
}

// Function Add Data Categorie
function addCategorie($data){
	global $connection;

	$name = htmlspecialchars($data['categorie']);
	$query = "INSERT INTO categories VALUES ('', '$name')";

	mysqli_query($connection, $query);
	return true;
}


// Check Upload File
function checkingUpload($files){
	// ================
	$file = $files;

	$nameFile = $file['name'];
	$tmpName = $file['tmp_name']; // location file
	$size = $file['size'];
	$error = $file['error'];
	// ================

	// cek File ada atau tidak
	if ($error === 4) {
		echo "<script> alert('Tidak ada file yang dimasukan'); </script>";
		return false;
	}

	// cek type file
	$type = ['jpg', 'jpeg', 'png'];

	$explodeName = explode('.', $nameFile);
	$returnTypeFile = strtolower(end($explodeName));

	// Jika tidak ada type file seperti variable $type
	if ( !in_array($returnTypeFile, $type)) {
		echo "<script> alert('File yang dimasukan bukan gambar'); </script>";
		return false;
	}

	$newNameFile = uniqid();
	$newNameFile .= '.';
	$newNameFile .= $returnTypeFile;

	move_uploaded_file($tmpName, 'img/' . $newNameFile);
	return $newNameFile;

}

// Function Delete Data
function deleteData($id, $table){
	 global $connection;

	 mysqli_query($connection, "DELETE FROM $table WHERE id = $id ");
	 return mysqli_affected_rows($connection);
}


// ========================================== EDIT ==========================================


// Function Edit Data Categorie
function updateCategorie($id, $name){
	global $connection;
	
	$query = "UPDATE `categories` SET `categories` = '$name' WHERE `categories`.`id` = $id";

	mysqli_query($connection, $query);

	return mysqli_affected_rows($connection);
}

// Function Edit Data Product
function updateProduct($data, $gambarLama){
	global $connection;

	$id = $data['id'];
    $name = $data['name'];
    $desc = $data['desc'];
    $price = $data['price'];
    $categorie = $data['categorie'];
    $gambarlama = $gambarLama;

    // Run Function CheckingUpload: 57
    $gambarbaru = checkingUpload($_FILES['gambarBaru']);

    // functions.php: 69
    if ($gambarbaru === false) {
    	echo "<script> alert('File Upload Tidak ada atau bukan gambar yang di upload'); </script>";

    	$query = "
    		UPDATE `product` SET 
    			`name` = '$name' , 
    			`desc` = '$desc' , 
    			`price` = '$price' 
    		WHERE `product`.`id` = $id";

    	mysqli_query($connection, $query);
    	echo "<script> alert ('Edit Data Succes! without new image'); </script>";

    } else {

    	$query = "
    		UPDATE `product` SET 
    			`image` = '$gambarbaru' , 
    			`name` = '$name' , 
    			`desc` = '$desc' , 
    			`price` = '$price' 
    		WHERE `product`.`id` = $id";

    	mysqli_query($connection, $query);
    	echo "<script> alert ('Edit Data Succes! with new image'); </script>";

    	// Menghapus file gambar lama ketika mengupload file baru
    	$fileGambar = "img/$gambarlama";

    	// Jika File ditemukan
    	if (file_exists($fileGambar)) {
    		unlink($fileGambar); // Hapus Gambar
    	}

    }

    return true;

}


// ========================================== END EDIT ==========================================


function register($usernm, $password, $confirmpassword){
	global $connection;

	// strtolower() : mengubah string ke huruf kecil
	// mysqli_real_escape_string() : memungkinkan user memasukan kutip
	// htmlspecialchars() : protect saat ada user yang ingin memasukan HTML ke input dan otomatis akan dirubah menjadi String


	$username = htmlspecialchars(strtolower($usernm));
	$pass = htmlspecialchars(mysqli_real_escape_string($connection, $password));
	$confirmpass = htmlspecialchars(mysqli_real_escape_string($connection, $confirmpassword));

	// Check sama atau tidak (password dan konfirmasi password)
	if ($pass !== $confirmpassword) {
		echo "<script> 
			alert('Password dan Konfirmasi tidak sama!');
			document.location.href = 'index.php'; 
				</script>";
		return false;
	}

	$passwordHash = password_hash($pass, PASSWORD_DEFAULT);

	$query = "
		INSERT INTO user 
			VALUES(
				'', '$username', '$passwordHash'
			)";
	mysqli_query($connection, $query);

	return mysqli_affected_rows($connection);

}


// Ubah Format ke Rupiah
function rupiah($angka){
	$format = number_format($angka);
	return $format;
}

 ?>