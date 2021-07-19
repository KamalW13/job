<?php 
include 'functions.php';

$info = '';

if (isset($_POST['submit'])) {

	// Jika tambah Datanya Berhasil
	if (addCategorie($_POST) >= 1) {
		echo "
				<script>
				 	alert('Data berhasil ditambah!');
				 	document.location.href = 'CPanel.php';
		 		</script>";

	} else {
		// Jika Gagal
		echo "
				<script>
				 	alert('Data gagal ditambah!');
				 	document.location.href = 'CPanel.php';
		 		</script>";
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Data | Categorie</title>

</head>
<body>

	<form method="post">
		<input type="text" name="categorie" placeholder="Name Categorie" required="">

		<button type="submit" name="submit" class="submit">Submit</button>
	</form>

	<div class="hiddenwarning hide">
		<h1>Info:</h1>
		<h3><?= $info;  ?></h3>
	</div>


</body>
</html>
