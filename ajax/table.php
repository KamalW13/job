<?php 
include 'functions.php';

// Mengambil data dari URL/GET
$input = $_GET['input'];
$categorie = $_GET['categorie'];

if ($categorie === 'noSelect') {
	$data = fetchData("SELECT * FROM product WHERE name LIKE '%$input%'");
} else {
	$data = fetchData("SELECT * FROM product WHERE name LIKE '%$input%' AND categories LIKE '%$categorie%'");
}


}
 ?>


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