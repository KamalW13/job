<?php 
include 'functions.php';

$categories = fetchData("SELECT * FROM categories");

$info = '';

if (isset($_POST['submit'])) {
	
	$name = $_POST['name'];
	$categorie = $_POST['categorie'];
	$desc = $_POST['desc'];
	$price = $_POST['price'];
	$fileName = checkingUpload('image');

	// functions.php: 46-48 & 57-59
	if ($fileName === 'nothingfile') {
		$info = 'File belum di pilih!';
	} else if ($fileName === 'not image') {
		$info = 'File yang di upload bukan gambar!';
	} else {

		// Jika tambah Datanya Berhasil
		if (addProduct($_POST, $fileName) >= 1) {
			echo "
				<script>
				 	alert('Data berhasil ditambah!');
				 	document.location.href = 'CPanel.php';
		 		</script>";

		} else {
			// Jika Gagal
			$info = 'Data Gagal ditambahkan! Tunggu 2 detik.';
			header("Refresh: 2;");
		}

		
	}

}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Data</title>

</head>
<body>

	<form method="post" enctype="multipart/form-data">
		<input type="file" name="image">
		<input type="text" name="name" placeholder="Name">

		<select name="categorie">
			<option hidden="">Select Categories</option>

			<?php foreach ($categories as $categorie): ?>
				<option value="<?= $categorie['categories']; ?>"><?= $categorie['categories']; ?></option>
			<?php endforeach; ?>
		</select>

		<input type="text" name="desc" placeholder="Description">
		<input type="number" name="price" placeholder="1000">

		<button type="submit" name="submit" class="submit">Submit</button>
	</form>

	<div class="hiddenwarning hide">
		<h1>Info:</h1>
		<h3><?= $info;  ?></h3>
	</div>


</body>
</html>
