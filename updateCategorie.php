<?php 

include 'functions.php';

$id = $_GET['id'];
$data = fetchData("SELECT * FROM categories WHERE id = '$id' ")[0];
var_dump($data);

if (isset($_POST['submit'])) {
	
	var_dump($id);
	$name = $_POST['name'];

	if (updateCategorie($id, $name) >= 1){
		echo "
		<script>
		 	alert('Data berhasil diubah!');
		 	document.location.href = 'CPanel.php';
 		</script>";
	}
}

 ?>

<form method="post">
	<input type="text" name="name" value="<?= $data['categories']; ?>">
	<button type="reset">Reset</button>
	<button type="Submit" name="submit">Submit</button>
</form>