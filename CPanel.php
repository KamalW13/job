<?php 

include 'functions.php';

$data = fetchData("SELECT * FROM product");
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
	<title>CPanel</title>
</head>
<body>


<h1>List Data</h1>
	<div class="search">
		<form method="post">
			<input type="text" name="search" placeholder="search...">
			<select name="categorie">
				<option value="noSelect">All Categorie</option>

			<?php foreach($categories as $categorie): ?>
				<option value="<?= $categorie['categories']; ?>"><?= $categorie['categories']; ?></option>
			<?php endforeach; ?>

			</select>
			<button type="submit" name="searchButton">search</button>
		</form>
	</div>

<!-- Link untuk melihat tampilan User Biasa/ Not Admin -->
<a href="home.php">Page User</a>

<br>

<!-- Link untuk menambah Data -->
<a href="addProduct.php">Tambah Data</a>
	
		<table border="1" cellpadding="10">
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Categories</th>
				<th>Description</th>
				<th>Price</th>
				<th>Action</th>
			</tr>

	<div class="tableData">
		<?php foreach ($data as $result): ?>
			<tr>
				<td><img src="img/<?= $result['image']; ?>" width="200"></td>
				<td><?= $result['name']; ?></td>
				<td><?= $result['categories']; ?></td>
				<td><?= $result['desc']; ?></td>
				<td>Rp.<?= rupiah($result['price']); ?></td>
				<td><a href="deleteProduct.php?id=<?= $result['id']; ?>" onclick="return confirm('Anda Yakin Ingin Menghapus <?= $result['name']; ?>?');">Hapus</a> | <a href="updateProduct.php?id=<?= $result['id']; ?> ">Edit</a></td>
			</tr>
		<?php endforeach; ?>

	</div>

<h1>List Categories</h1>

<ul>
	<li>
		<a href="addCategorie.php">Tambah Categorie</a>
	</li>
<?php foreach ($categories as $categorie): ?>
	<li>
		<?= $categorie['categories']; ?> [ <a href="deleteCategorie.php?id=<?= $categorie['id']; ?>" onclick="confirm('Anda Yakin ingin menghapus?')">hapus</a> | <a href="updateCategorie.php?id=<?= $categorie['id']; ?>">Edit</a> ]
	</li>
<?php endforeach; ?>
</ul>


<script src="script/script.js"></script>
</body>
</html>
