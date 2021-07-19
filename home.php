<?php
session_start();  // ============> SESSION
include 'functions.php';

// Jika tidak ada session atau ada session namun bukan '1'
if (!isset($_SESSION['login']) || $_SESSION['login'] !== '1') {
	header("Location: index.php");
}

// Kumpulan Data Product
$data = fetchData("SELECT * FROM product");

// Kumpulan Data Kategori
$categories = fetchData("SELECT * FROM categories");

// Jika Tombol Search sudah ditekan
if (isset($_POST['searchButton'])) {
	$input = $_POST['search'];
	$categorie = $_POST['categorie'];


	if ($categorie === 'noSelect') {
		$data = fetchData("SELECT * FROM product WHERE name LIKE '%$input%'");
	} else {
		$data = fetchData("SELECT * FROM product WHERE name LIKE '%$input%' AND categories LIKE '%$categorie%'");
	}


}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<a href="CPanel.php">Page CPanel</a>
	<br>
	<a href="logout.php">LogOut</a>
	
	<h1>List Data</h1>
	<div class="search">
		<form method="post">
			<input type="text" name="search" placeholder="search...">
			<select name="categorie">
				<option value="noSelect">All Categorie</option>

				<!-- Looping database Categories -->
				<?php foreach ($categories as $categorie): ?>
				<option value="<?= $categorie['categories']; ?>"><?= $categorie['categories']; ?></option>
				<?php endforeach; ?>

			</select>
			<button type="submit" name="searchButton">search</button>
		</form>
	</div>

	
	
		<table border="1" cellpadding="10">
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Categories</th>
				<th>Description</th>
				<th>Price</th>
			</tr>

	<div class="tableData">
		<?php foreach ($data as $result): ?>
			<tr>
				<td><img src="img/<?= $result['image']; ?>" width="200"></td>
				<td><?= $result['name']; ?></td>
				<td><?= $result['categories']; ?></td>
				<td><?= $result['desc']; ?></td>
				<td>Rp.<?= rupiah($result['price']); ?></td>
			</tr>
		<?php endforeach; ?>

		</table>
	</div>


	
<script src="script/script.js"></script>
</body>
</html>